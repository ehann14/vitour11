<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Splash screen
});

Route::get('/home', function () {
    return view('home'); // Halaman home
})->name('home');

Route::get('/denah', function () {
    return view('denah'); // Halaman denah 360°
})->name('denah');