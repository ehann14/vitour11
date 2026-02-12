<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;

// Route untuk halaman denah sekolah
Route::get('/denah-sekolah', [SchoolController::class, 'map'])->name('school.map');