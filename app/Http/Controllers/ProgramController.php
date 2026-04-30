<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Tampilkan halaman Program Keahlian (Public)
     */
    public function index()
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
    public function show($slug)
    {
        $program = ProgramKeahlian::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        return view('program-detail', compact('program'));
    }

    /**
     * API: Get program keahlian untuk frontend (opsional)
     */
    public function apiIndex()
    {
        $programs = ProgramKeahlian::where('is_active', true)
            ->select('id', 'nama', 'slug', 'singkatan', 'logo', 'deskripsi')
            ->orderBy('urutan')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $programs
        ]);
    }

    /**
     * API: Get detail program by slug (opsional)
     */
    public function apiShow($slug)
    {
        $program = ProgramKeahlian::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $program
        ]);
    }
}