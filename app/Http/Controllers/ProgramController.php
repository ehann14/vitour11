<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use App\Models\KonsentrasiKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Tampilkan halaman Program Keahlian (Public)
     * Route: GET /program-keahlian
     */
    public function programKeahlian()
    {
        $programs = ProgramKeahlian::withCount('konsentrasi')
            ->where('is_active', true)
            ->orderBy('urutan')
            ->latest()
            ->get();
            
        return view('program-keahlian', compact('programs'));
    }

    /**
     * Tampilkan detail Program (Public)
     * Route: GET /program/{slug}
     */
    public function detailProgram($slug)
    {
        $program = ProgramKeahlian::with(['konsentrasi' => function($query) {
            $query->where('is_active', true);
        }])->where('slug', $slug)
          ->where('is_active', true)
          ->firstOrFail();
        
        return view('program-detail', compact('program'));
    }

    /**
     * Tampilkan halaman Konsentrasi Keahlian (Public)
     * Route: GET /konsentrasi-keahlian
     */
    public function konsentrasiKeahlian()
    {
        $konsentrasi = KonsentrasiKeahlian::with('program')
            ->where('is_active', true)
            ->latest()
            ->get();
            
        $groupedKonsentrasi = $konsentrasi->groupBy(function($item) {
            return $item->program->nama ?? 'Lainnya';
        });
        
        return view('konsentrasi-keahlian', compact('groupedKonsentrasi', 'konsentrasi'));
    }

    /**
     * Tampilkan detail Konsentrasi (Public)
     * Route: GET /konsentrasi/{slug}
     */
    public function detailKonsentrasi($slug)
    {
        $konsentrasi = KonsentrasiKeahlian::with('program')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        return view('konsentrasi-detail', compact('konsentrasi'));
    }
}