<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::orderBy('date', 'desc')->paginate(10);
        return view('admin.achievements.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.achievements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'level' => 'required|in:Kota,Provinsi,Nasional,Internasional',
            'type' => 'required|in:Individu,Kelompok',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ranking' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'student_name' => 'nullable|string|max:255',
            'student_class' => 'nullable|string|max:100',
            'advisor_name' => 'nullable|string|max:255',
            'advisor_title' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except(['image_path']);
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');

        // Handle upload image
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('achievements', 'public');
        }

        Achievement::create($data);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        return redirect()->route('admin.achievements.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'level' => 'required|in:Kota,Provinsi,Nasional,Internasional',
            'type' => 'required|in:Individu,Kelompok',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ranking' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'student_name' => 'nullable|string|max:255',
            'student_class' => 'nullable|string|max:100',
            'advisor_name' => 'nullable|string|max:255',
            'advisor_title' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except(['image_path']);
        
        // Update slug hanya jika title berubah
        if ($request->title !== $achievement->title) {
            $data['slug'] = Str::slug($request->title);
        }
        
        $data['is_active'] = $request->has('is_active');

        // Handle upload image baru
        if ($request->hasFile('image_path')) {
            // Hapus image lama jika ada
            if ($achievement->image_path && Storage::disk('public')->exists($achievement->image_path)) {
                Storage::disk('public')->delete($achievement->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('achievements', 'public');
        }

        $achievement->update($data);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        // Hapus file image jika ada
        if ($achievement->image_path && Storage::disk('public')->exists($achievement->image_path)) {
            Storage::disk('public')->delete($achievement->image_path);
        }

        $achievement->delete();

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil dihapus');
    }

    /**
     * Toggle status aktif/nonaktif prestasi.
     */
    public function toggleStatus(Achievement $achievement)
    {
        $achievement->update([
            'is_active' => !$achievement->is_active
        ]);

        $status = $achievement->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()->with('success', "Prestasi '{$achievement->title}' berhasil {$status}");
    }
}