<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanoramaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\Admin\ProgramKeahlianController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
// ✅ TAMBAHAN: Import controller komentar
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Splash & Public Pages
Route::get('/', function () {
    return view('splash');
})->name('splash');

Route::get('/beranda', [HomeController::class, 'index'])->name('home');
Route::get('/denah', [HomeController::class, 'denah'])->name('denah');
Route::get('/prestasi', [HomeController::class, 'prestasi'])->name('prestasi');

// Program Akademik Routes - Public
Route::get('/program-keahlian', [ProgramController::class, 'index'])->name('program.keahlian');
Route::get('/program/{slug}', [ProgramController::class, 'detailProgram'])->name('program.detail');

// Gallery Routes - Public
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galeri/kategori/{category}', [GalleryController::class, 'filter'])->name('gallery.filter');

// Panorama Viewer Routes
Route::get('/view/{scene_id}', [HomeController::class, 'view'])->name('view');
Route::get('/api/panorama/{scene_id}', [HomeController::class, 'apiShow'])->name('api.panorama.show');

// ✅ Comment Routes - Public
Route::post('/kirim-komentar', [CommentController::class, 'store'])->name('comment.store');

// Auth Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin Routes
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
        
        Route::post('/{id}/toggle-status', [PanoramaController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/bulk-toggle', [PanoramaController::class, 'bulkToggle'])->name('bulk-toggle');
        Route::post('/bulk-delete', [PanoramaController::class, 'bulkDelete'])->name('bulk-delete');
    });

    // Achievement Management
    Route::prefix('achievements')->name('achievements.')->group(function () {
        Route::get('/', [AchievementController::class, 'index'])->name('index');
        Route::get('/create', [AchievementController::class, 'create'])->name('create');
        Route::post('/store', [AchievementController::class, 'store'])->name('store');
        Route::get('/{achievement}/edit', [AchievementController::class, 'edit'])->name('edit');
        Route::put('/{achievement}', [AchievementController::class, 'update'])->name('update');
        Route::delete('/{achievement}', [AchievementController::class, 'destroy'])->name('destroy');
        Route::post('/{achievement}/toggle-status', [AchievementController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Program Keahlian Management (Admin)
    Route::prefix('program')->name('program.')->group(function () {
        Route::get('/', [ProgramKeahlianController::class, 'index'])->name('index');
        Route::get('/create', [ProgramKeahlianController::class, 'create'])->name('create');
        Route::post('/store', [ProgramKeahlianController::class, 'store'])->name('store');
        Route::get('/{program}/edit', [ProgramKeahlianController::class, 'edit'])->name('edit');
        Route::put('/{program}', [ProgramKeahlianController::class, 'update'])->name('update');
        Route::delete('/{program}', [ProgramKeahlianController::class, 'destroy'])->name('destroy');
        
        Route::post('/{program}/toggle-status', [ProgramKeahlianController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Gallery Management (Admin)
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', [AdminGalleryController::class, 'index'])->name('index');
        Route::get('/create', [AdminGalleryController::class, 'create'])->name('create');
        Route::post('/store', [AdminGalleryController::class, 'store'])->name('store');
        Route::get('/{gallery}/edit', [AdminGalleryController::class, 'edit'])->name('edit');
        Route::put('/{gallery}', [AdminGalleryController::class, 'update'])->name('update');
        Route::delete('/{gallery}', [AdminGalleryController::class, 'destroy'])->name('destroy');
        Route::post('/{gallery}/toggle-status', [AdminGalleryController::class, 'toggleStatus'])->name('toggle-status');
    });

    // ✅ Comment Management (Admin) - BARU
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/', [AdminCommentController::class, 'index'])->name('index');
        Route::post('/{id}/toggle', [AdminCommentController::class, 'toggleStatus'])->name('toggle');
        Route::delete('/{id}', [AdminCommentController::class, 'destroy'])->name('destroy');
    });

});