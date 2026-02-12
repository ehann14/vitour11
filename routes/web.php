<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Splash screen
});

Route::get('/home', function () {
    return view('home'); // Halaman utama
})->name('home');