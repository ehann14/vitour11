<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panorama;
use App\Models\Achievement; // ← ✅ PASTIKAN INI ADA (pake Models, bukan Controllers)

class AdminController extends Controller
{
    public function index()
    {
        // Stats Panorama
        $totalPanoramas = Panorama::count();
        $activePanoramas = Panorama::where('is_active', true)->count();
        $recentPanoramas = Panorama::orderBy('created_at', 'desc')->take(5)->get();
        
        // ✅ Stats & Recent Achievements
        $totalAchievements = Achievement::count();
        $activeAchievements = Achievement::where('is_active', true)->count();
        $recentAchievements = Achievement::orderBy('created_at', 'desc')->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalPanoramas',
            'activePanoramas', 
            'recentPanoramas',
            'totalAchievements',
            'activeAchievements',
            'recentAchievements'
        ));
    }
}