<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panorama;
use App\Models\Achievement;
use App\Models\ProgramKeahlian;      // ← ✅ Tambahkan import ini
use App\Models\KonsentrasiKeahlian; // ← ✅ Tambahkan import ini

class AdminController extends Controller
{
    public function index()
    {
        // ===== PANORAMA STATS =====
        $totalPanoramas = Panorama::count();
        $activePanoramas = Panorama::where('is_active', true)->count();
        $recentPanoramas = Panorama::orderBy('created_at', 'desc')->take(5)->get();
        
        // ===== ACHIEVEMENT STATS =====
        $totalAchievements = Achievement::count();
        $activeAchievements = Achievement::where('is_active', true)->count();
        $recentAchievements = Achievement::orderBy('created_at', 'desc')->take(5)->get();
        
        // ===== PROGRAM STATS (BARU) =====
        $totalPrograms = ProgramKeahlian::count();
        $recentPrograms = ProgramKeahlian::orderBy('created_at', 'desc')->take(5)->get();
        
        // ===== KONSENTRASI STATS (BARU) =====
        $totalKonsentrasi = KonsentrasiKeahlian::count();
        
        // ===== KIRIM SEMUA DATA KE VIEW =====
        return view('admin.dashboard', compact(
            // Panorama
            'totalPanoramas',
            'activePanoramas', 
            'recentPanoramas',
            // Achievement
            'totalAchievements',
            'activeAchievements',
            'recentAchievements',
            // Program (BARU)
            'totalPrograms',
            'recentPrograms',
            // Konsentrasi (BARU)
            'totalKonsentrasi'
        ));
    }
}