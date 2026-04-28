<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Panorama;
use App\Models\Achievement;
use App\Models\ProgramKeahlian; // ✅ Hanya ini yang dipakai
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Panorama Stats
        $totalPanoramas = Panorama::count();
        $activePanoramas = Panorama::where('is_active', true)->count();
        $recentPanoramas = Panorama::latest()->take(5)->get();

        // Achievement Stats
        $totalAchievements = Achievement::count();
        $activeAchievements = Achievement::where('is_active', true)->count();
        $recentAchievements = Achievement::latest()->take(5)->get();

        // Program Stats (✅ Hanya Program, tanpa Konsentrasi)
        $totalPrograms = ProgramKeahlian::count();
        $recentPrograms = ProgramKeahlian::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPanoramas', 'activePanoramas', 'recentPanoramas',
            'totalAchievements', 'activeAchievements', 'recentAchievements',
            'totalPrograms', 'recentPrograms'
        ));
    }
}