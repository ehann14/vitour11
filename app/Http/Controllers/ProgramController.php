<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Tampilkan halaman Program Keahlian (Public)
     */
    public function programKeahlian()
    {
        $programs = ProgramKeahlian::where('is_active', true)
            ->orderBy('urutan')
            ->latest()
            ->get();
            
        return view('program-keahlian', compact('programs'));
    }

    /**
     * Tampilkan detail Program (Public)
     */
    public function detailProgram($slug)
    {
        $program = ProgramKeahlian::where('slug', $slug)
          ->where('is_active', true)
          ->firstOrFail();
        
        return view('program-detail', compact('program'));
    }
}