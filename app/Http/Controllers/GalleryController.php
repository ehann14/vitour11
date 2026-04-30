<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_active', true)
            ->orderBy('urutan')
            ->latest()
            ->paginate(12);

        $categories = Gallery::where('is_active', true)
            ->distinct('category')
            ->pluck('category')
            ->filter();

        return view('gallery.index', compact('galleries', 'categories'));
    }

    public function filter($category)
    {
        $galleries = Gallery::where('is_active', true)
            ->where('category', $category)
            ->orderBy('urutan')
            ->latest()
            ->paginate(12);

        $categories = Gallery::where('is_active', true)
            ->distinct('category')
            ->pluck('category')
            ->filter();

        return view('gallery.index', compact('galleries', 'categories'));
    }
}