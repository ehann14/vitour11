<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        // Ambil komentar yang sudah disetujui
        $comments = Comment::where('is_approved', true)
                           ->latest()
                           ->get();
        
        return view('home', compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:500',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'message.required' => 'Pesan harus diisi',
            'message.max' => 'Pesan maksimal 500 karakter',
        ]);

        Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'is_approved' => false, // Default pending
        ]);

        return back()->with('success', 'Terima kasih! Komentar Anda akan ditampilkan setelah disetujui admin.');
    }
}