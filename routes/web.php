<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolMapController;

// Public routes - bisa diakses semua orang
Route::prefix('denah-sekolah')->name('school.maps.')->group(function () {
    Route::get('/', [SchoolMapController::class, 'index'])->name('index');
    Route::get('/{slug}', [SchoolMapController::class, 'show'])->name('show');
});

// Admin routes - hanya untuk admin
Route::prefix('admin/denah-sekolah')->name('admin.school.maps.')->middleware(['auth'])->group(function () {
    Route::get('/create', [SchoolMapController::class, 'create'])->name('create');
    Route::post('/', [SchoolMapController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [SchoolMapController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SchoolMapController::class, 'update'])->name('update');
    Route::delete('/{id}', [SchoolMapController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/restore', [SchoolMapController::class, 'restore'])->name('restore');
});