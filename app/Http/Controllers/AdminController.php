<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Panorama;
use App\Models\Achievement;
use App\Models\ProgramKeahlian;
use App\Models\Comment; // ✅ TAMBAHKAN: Import model Comment
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

        // Program Stats
        $totalPrograms = ProgramKeahlian::count();
        $recentPrograms = ProgramKeahlian::latest()->take(5)->get();

        // ✅ Comment Stats - TAMBAHKAN BAGIAN INI
        $totalComments = Comment::count();
        $pendingCommentsCount = Comment::where('is_approved', false)->count();
        $pendingComments = Comment::where('is_approved', false)
            ->latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'totalPanoramas', 
            'activePanoramas', 
            'recentPanoramas',
            'totalAchievements', 
            'activeAchievements', 
            'recentAchievements',
            'totalPrograms', 
            'recentPrograms',
            // ✅ TAMBAHKAN: Kirim data komentar ke view
            'totalComments',
            'pendingCommentsCount',
            'pendingComments'
        ));
    }
}