<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KonsentrasiKeahlian;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KonsentrasiKeahlianController extends Controller
{
    public function index()
    {
        $konsentrasi = KonsentrasiKeahlian::orderBy('urutan')
            ->with('program')
            ->get();
        
        return view('admin.konsentrasi.index', compact('konsentrasi'));
    }

    public function create()
    {
        $programs = ProgramKeahlian::where('is_active', true)->orderBy('nama')->get();
        return view('admin.konsentrasi.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_keahlian_id' => 'required|exists:program_keahlian,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kompetensi' => 'nullable|string',
            'prospek_karir' => 'nullable|string',
            'urutan' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->nama);

        KonsentrasiKeahlian::create($validated);

        return redirect()->route('admin.konsentrasi.index')->with('success', 'Konsentrasi keahlian berhasil ditambahkan');
    }

    public function edit(KonsentrasiKeahlian $konsentrasi)
    {
        $programs = ProgramKeahlian::where('is_active', true)->orderBy('nama')->get();
        return view('admin.konsentrasi.edit', compact('konsentrasi', 'programs'));
    }

    public function update(Request $request, KonsentrasiKeahlian $konsentrasi)
    {
        $validated = $request->validate([
            'program_keahlian_id' => 'required|exists:program_keahlian,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kompetensi' => 'nullable|string',
            'prospek_karir' => 'nullable|string',
            'urutan' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->nama);

        $konsentrasi->update($validated);

        return redirect()->route('admin.konsentrasi.index')->with('success', 'Konsentrasi keahlian berhasil diupdate');
    }

    public function destroy(KonsentrasiKeahlian $konsentrasi)
    {
        $konsentrasi->delete();

        return redirect()->route('admin.konsentrasi.index')->with('success', 'Konsentrasi keahlian berhasil dihapus');
    }
}