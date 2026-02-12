<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Tampilkan halaman denah sekolah
     */
    public function map()
    {
        return view('school.map');
    }
}