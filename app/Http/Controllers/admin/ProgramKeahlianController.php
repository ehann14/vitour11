<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProgramKeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = ProgramKeahlian::orderBy('urutan')
            ->latest()
            ->paginate(10);

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
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:program_keahlian,slug',
            'singkatan'   => 'required|string|max:10',
            'deskripsi'   => 'nullable|string',
            'visi'        => 'nullable|string',
            'misi'        => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan'      => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ], [
            'nama.required' => 'Nama program keahlian wajib diisi',
            'slug.required' => 'Slug wajib diisi',
            'slug.unique'   => 'Slug sudah digunakan',
            'singkatan.required' => 'Singkatan wajib diisi',
            'logo.image'    => 'File harus berupa gambar',
            'logo.mimes'    => 'Format gambar: jpeg, png, jpg, webp',
            'logo.max'      => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('program', 'public');
        }

        // Handle checkbox is_active
        $validated['is_active'] = $request->has('is_active');

        // Auto-generate slug if not provided or empty
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        ProgramKeahlian::create($validated);

        return redirect()->route('admin.program.index')
            ->with('success', '✅ Program keahlian berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $program = ProgramKeahlian::findOrFail($id);
        return view('admin.program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $program = ProgramKeahlian::findOrFail($id);

        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:program_keahlian,slug,' . $id,
            'singkatan'   => 'required|string|max:10',
            'deskripsi'   => 'nullable|string',
            'visi'        => 'nullable|string',
            'misi'        => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan'      => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ], [
            'nama.required' => 'Nama program keahlian wajib diisi',
            'slug.required' => 'Slug wajib diisi',
            'slug.unique'   => 'Slug sudah digunakan',
            'singkatan.required' => 'Singkatan wajib diisi',
            'logo.image'    => 'File harus berupa gambar',
            'logo.mimes'    => 'Format gambar: jpeg, png, jpg, webp',
            'logo.max'      => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($program->logo && Storage::disk('public')->exists($program->logo)) {
                Storage::disk('public')->delete($program->logo);
            }
            $validated['logo'] = $request->file('logo')->store('program', 'public');
        }

        // Handle checkbox is_active
        $validated['is_active'] = $request->has('is_active');

        // Auto-generate slug if changed
        if ($request->filled('nama') && $program->nama !== $validated['nama'] && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $program->update($validated);

        return redirect()->route('admin.program.index')
            ->with('success', '✅ Program keahlian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $program = ProgramKeahlian::findOrFail($id);

        // Hapus file logo jika ada
        if ($program->logo && Storage::disk('public')->exists($program->logo)) {
            Storage::disk('public')->delete($program->logo);
        }

        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', '🗑️ Program keahlian berhasil dihapus!');
    }

    /**
     * Update urutan program keahlian (untuk drag & drop atau sorting)
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|integer|exists:program_keahlian,id',
            'orders.*.urutan' => 'required|integer|min:0',
        ]);

        foreach ($request->orders as $item) {
            ProgramKeahlian::where('id', $item['id'])->update(['urutan' => $item['urutan']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan berhasil diperbarui']);
    }
}