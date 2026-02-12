<?php

namespace App\Http\Controllers;

use App\Models\SchoolMap;

class SchoolMapController extends Controller
{
    // Tampilkan semua denah
    public function index()
    {
        $maps = SchoolMap::all();
        return view('school.map', compact('maps'));
    }

    // Tampilkan detail denah
    public function show($id)
    {
        $map = SchoolMap::findOrFail($id);
        return view('school.detail', compact('map'));
    }
}