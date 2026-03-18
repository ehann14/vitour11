<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanoramaController;

// ================= PUBLIC ROUTES =================

// Halaman Utama
Route::get('/', function () {
    return view('home');
})->name('home');

// Viewer 360° (Denah)
Route::get('/denah', [PanoramaController::class, 'viewer'])->name('denah');

// ================= ADMIN ROUTES =================

// Halaman Login Admin
Route::get('/admin/login', function () {
    return view('admin');
})->name('admin.login');

// Proses Autentikasi Admin
Route::post('/admin/authenticate', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if ($request->email === 'admin123@gmail.com' && $request->password === 'Hann11gg') {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors(['login' => 'Email atau password salah!'])->withInput();
})->name('admin.authenticate');

// Dashboard Admin (dengan proteksi di dalam closure)
Route::get('/admin/dashboard', [PanoramaController::class, 'dashboard'])
    ->name('admin.dashboard');

// Upload Scene Baru
Route::post('/admin/panorama/store', [PanoramaController::class, 'store'])
    ->name('admin.panorama.store');

// Update Scene
Route::put('/admin/panorama/{id}', [PanoramaController::class, 'update'])
    ->name('admin.panorama.update');

// Update Order
Route::post('/admin/panorama/order', [PanoramaController::class, 'updateOrder'])
    ->name('admin.panorama.order');

// Hapus Scene
Route::delete('/admin/panorama/{id}', [PanoramaController::class, 'destroy'])
    ->name('admin.panorama.destroy');

// Get Scenes API
Route::get('/admin/panorama/scenes', [PanoramaController::class, 'getScenes'])
    ->name('admin.panorama.scenes');

// Logout Admin
Route::post('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect()->route('home');
})->name('admin.logout');