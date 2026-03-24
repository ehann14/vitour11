<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panorama;
use App\Models\Scene; // Jika ada model Scene
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Handle the admin dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Pastikan hanya user yang login bisa akses
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        // Ambil statistik untuk dashboard
        $totalPanoramas = Panorama::count();
        $activePanoramas = Panorama::where('is_active', true)->count();
        $totalScenes = class_exists('App\Models\Scene') ? Scene::count() : 0;
        
        // Ambil data panorama terbaru untuk ditampilkan
        $recentPanoramas = Panorama::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalPanoramas',
            'activePanoramas', 
            'totalScenes',
            'recentPanoramas'
        ));
    }

    /**
     * Optional: Method dashboard() jika route masih pakai @dashboard
     * (Bisa dihapus jika pakai @index seperti di web.php atas)
     */
    public function dashboard(Request $request)
    {
        return $this->index($request);
    }
}