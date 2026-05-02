<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Panorama;
use App\Models\Achievement;
use App\Models\ProgramKeahlian;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     * - Menampilkan statistik semua modul
     * - Auto-delete FIFO: Jika komentar disetujui > 10, hapus yang paling lama
     */
    public function index()
    {
        // ✅ FIFO AUTO-DELETE: Pastikan maksimal 10 komentar approved di database
        $approvedCount = Comment::where('is_approved', true)->count();
        
        if ($approvedCount > 10) {
            // Hitung berapa yang perlu dihapus
            $toDelete = $approvedCount - 10;
            
            // Hapus komentar approved paling lama (oldest first)
            Comment::where('is_approved', true)
                ->oldest()
                ->limit($toDelete)
                ->delete();
        }

        // === Panorama Stats ===
        $totalPanoramas = Panorama::count();
        $activePanoramas = Panorama::where('is_active', true)->count();
        $recentPanoramas = Panorama::latest()->take(5)->get();

        // === Achievement Stats ===
        $totalAchievements = Achievement::count();
        $activeAchievements = Achievement::where('is_active', true)->count();
        $recentAchievements = Achievement::latest()->take(5)->get();

        // === Program Stats ===
        $totalPrograms = ProgramKeahlian::count();
        $recentPrograms = ProgramKeahlian::latest()->take(5)->get();

        // === Comment Stats ===
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
            'totalComments',
            'pendingCommentsCount',
            'pendingComments'
        ));
    }
}