<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanoramaController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Splash Screen - Halaman Pertama
Route::get('/', function () {
    return view('splash');
})->name('splash');

// ✅ Home Utama - Pindah ke /beranda
Route::get('/beranda', [HomeController::class, 'index'])->name('home');
Route::get('/denah', [HomeController::class, 'denah'])->name('denah');
Route::get('/view/{scene_id}', [HomeController::class, 'view'])->name('view');

// ✅ ADMIN LOGIN ROUTES
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin Routes (Harus Login)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Panorama Management
    Route::prefix('panorama')->name('panorama.')->group(function () {
        Route::get('/', [PanoramaController::class, 'index'])->name('index');
        Route::get('/create', [PanoramaController::class, 'create'])->name('create');
        Route::post('/store', [PanoramaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PanoramaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PanoramaController::class, 'update'])->name('update');
        Route::delete('/{id}', [PanoramaController::class, 'destroy'])->name('destroy');
        
        // AJAX Routes
        Route::post('/{id}/toggle-status', [PanoramaController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/bulk-toggle', [PanoramaController::class, 'bulkToggle'])->name('bulk-toggle');
        Route::post('/bulk-delete', [PanoramaController::class, 'bulkDelete'])->name('bulk-delete');
    });
});