<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramKeahlianController extends Controller
{
    public function index()
    {
        $programs = ProgramKeahlian::orderBy('urutan')->withCount('konsentrasi')->get();
        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('programs', 'public');
        }

        $validated['slug'] = Str::slug($request->nama);

        ProgramKeahlian::create($validated);

        return redirect()->route('admin.program.index')->with('success', 'Program keahlian berhasil ditambahkan');
    }

    public function edit(ProgramKeahlian $program)
    {
        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, ProgramKeahlian $program)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($program->logo) {
                Storage::disk('public')->delete($program->logo);
            }
            $validated['logo'] = $request->file('logo')->store('programs', 'public');
        }

        $validated['slug'] = Str::slug($request->nama);

        $program->update($validated);

        return redirect()->route('admin.program.index')->with('success', 'Program keahlian berhasil diupdate');
    }

    public function destroy(ProgramKeahlian $program)
    {
        if ($program->logo) {
            Storage::disk('public')->delete($program->logo);
        }
        $program->delete();

        return redirect()->route('admin.program.index')->with('success', 'Program keahlian berhasil dihapus');
    }
}