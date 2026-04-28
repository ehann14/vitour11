<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;

class ProgramKeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ✅ PAGINATION
        $programs = ProgramKeahlian::orderBy('created_at', 'desc')
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
            'nama' => 'required|string|max:255',
            'singkatan' => 'required|string|max:50',
            'slug' => 'required|string|max:255|unique:program_keahlian,slug',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        // Upload Logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('program', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        ProgramKeahlian::create($validated);

        return redirect()
            ->route('admin.program.index')
            ->with('success', 'Program berhasil ditambahkan');
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'required|string|max:50',
            'slug' => 'required|string|max:255|unique:program_keahlian,slug,' . $program->id,
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        // Upload Logo Baru
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('program', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $program->update($validated);

        return redirect()
            ->route('admin.program.index')
            ->with('success', 'Program berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramKeahlian $program)
    {
        $program->delete();

        return redirect()
            ->route('admin.program.index')
            ->with('success', 'Program berhasil dihapus');
    }
}