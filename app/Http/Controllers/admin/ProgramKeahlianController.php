<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramKeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = ProgramKeahlian::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.program.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'nama', 'singkatan', 'deskripsi', 'visi', 'misi', 'urutan', 'is_active'
        ]);

        // Generate slug unik
        $data['slug'] = $this->generateUniqueSlug($request->nama);

        // Handle upload logo
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('programs', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        ProgramKeahlian::create($data);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program keahlian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramKeahlian $program)
    {
        return redirect()->route('admin.program.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramKeahlian $program)
    {
        return view('admin.program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramKeahlian $program)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only([
            'nama', 'singkatan', 'deskripsi', 'visi', 'misi', 'urutan', 'is_active'
        ]);

        // Update slug hanya jika nama berubah
        if ($request->nama !== $program->nama) {
            $data['slug'] = $this->generateUniqueSlug($request->nama, $program->id);
        }

        // Handle upload logo baru
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($program->logo && Storage::disk('public')->exists($program->logo)) {
                Storage::disk('public')->delete($program->logo);
            }
            $data['logo'] = $request->file('logo')->store('programs', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $program->update($data);

        return redirect()->route('admin.program.index')
            ->with('success', 'Program keahlian berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramKeahlian $program)
    {
        // Hapus file logo jika ada
        if ($program->logo && Storage::disk('public')->exists($program->logo)) {
            Storage::disk('public')->delete($program->logo);
        }

        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', 'Program keahlian berhasil dihapus');
    }

    /**
     * Toggle status aktif/nonaktif program.
     */
    public function toggleStatus(ProgramKeahlian $program)
    {
        $program->update([
            'is_active' => !$program->is_active
        ]);

        $status = $program->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()->with('success', "Program '{$program->nama}' berhasil {$status}");
    }

    /**
     * Generate unique slug dengan auto-increment jika sudah ada.
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        $query = ProgramKeahlian::where('slug', $slug);
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
            
            $query = ProgramKeahlian::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }
}