<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use App\Models\KonsentrasiKeahlian;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Halaman Program Keahlian (Public)
     */
    public function programKeahlian()
    {
        $programs = ProgramKeahlian::where('is_active', true)
            ->orderBy('urutan')
            ->withCount('konsentrasi')
            ->get();
        
        return view('program.program-keahlian', compact('programs'));
    }

    /**
     * Detail Program Keahlian
     */
    public function detailProgram($slug)
    {
        $program = ProgramKeahlian::where('slug', $slug)
            ->where('is_active', true)
            ->with('konsentrasi')
            ->firstOrFail();
        
        return view('program.detail-program', compact('program'));
    }

    /**
     * Halaman Konsentrasi Keahlian (Public)
     */
    public function konsentrasiKeahlian()
    {
        $konsentrasi = KonsentrasiKeahlian::where('is_active', true)
            ->orderBy('urutan')
            ->with('program')
            ->get();
        
        $groupedKonsentrasi = $konsentrasi->groupBy('program.nama');
        
        return view('program.konsentrasi-keahlian', compact('groupedKonsentrasi'));
    }

    /**
     * Detail Konsentrasi Keahlian
     */
    public function detailKonsentrasi($slug)
    {
        $konsentrasi = KonsentrasiKeahlian::where('slug', $slug)
            ->where('is_active', true)
            ->with('program')
            ->firstOrFail();
        
        return view('program.detail-konsentrasi', compact('konsentrasi'));
    }
}