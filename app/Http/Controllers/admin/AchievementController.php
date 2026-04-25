<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('order')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'level' => 'required|in:Kota,Provinsi,Nasional,Internasional',
            'type' => 'required|in:Akademik,Non-Akademik',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'ranking' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'student_name' => 'required|string|max:255',
            'student_class' => 'nullable|string|max:100',
            'advisor_name' => 'nullable|string|max:255',
            'advisor_title' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('achievements', 'public');
        }

        Achievement::create($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', '✅ Prestasi berhasil ditambahkan');
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'level' => 'required|in:Kota,Provinsi,Nasional,Internasional',
            'type' => 'required|in:Akademik,Non-Akademik',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'ranking' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'student_name' => 'required|string|max:255',
            'student_class' => 'nullable|string|max:100',
            'advisor_name' => 'nullable|string|max:255',
            'advisor_title' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($achievement->image_path) {
                Storage::disk('public')->delete($achievement->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('achievements', 'public');
        }

        $achievement->update($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', '✅ Prestasi berhasil diupdate');
    }

    public function destroy(Achievement $achievement)
    {
        if ($achievement->image_path) {
            Storage::disk('public')->delete($achievement->image_path);
        }
        
        $achievement->delete();

        return redirect()->route('admin.achievements.index')
            ->with('success', '✅ Prestasi berhasil dihapus');
    }

    public function toggleStatus(Achievement $achievement)
    {
        $achievement->update(['is_active' => !$achievement->is_active]);
        
        return redirect()->back()->with('success', '✅ Status berhasil diubah');
    }
}