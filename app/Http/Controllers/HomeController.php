<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panorama;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Home Page - SMK Negeri 11 Bandung (pakai home.blade.php yang sudah ada)
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Denah Sekolah - Halaman denah/venue map
     */
    public function denah()
    {
        try {
            $panoramas = Panorama::where('is_active', true)
                ->orderBy('order')
                ->get();
            
            return view('denah', compact('panoramas'));
            
        } catch (\Exception $e) {
            Log::error('Denah Error: ' . $e->getMessage());
            return view('denah', ['panoramas' => collect()]);
        }
    }

    /**
     * Viewer - Lihat panorama 360
     */
    public function view($scene_id)
    {
        try {
            $panorama = Panorama::where('scene_id', $scene_id)
                ->where('is_active', true)
                ->firstOrFail();
            
            return view('viewer', compact('panorama'));
            
        } catch (\Exception $e) {
            Log::error('View Error: ' . $e->getMessage());
            abort(404, 'Panorama tidak ditemukan');
        }
    }
}