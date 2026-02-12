<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolMapController;

// Halaman utama
Route::get('/', function() {
    return view('home');
})->name('home');

// Routes untuk denah sekolah
Route::prefix('denah')->name('school.')->group(function () {
    Route::get('/', [SchoolMapController::class, 'index'])->name('map');
    Route::get('/{id}', [SchoolMapController::class, 'show'])->name('detail');
});