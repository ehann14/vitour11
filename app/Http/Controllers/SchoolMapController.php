<?php

namespace App\Http\Controllers;

use App\Models\SchoolMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SchoolMapController extends Controller
{
    /**
     * Display all school maps
     */
    public function index()
    {
        $maps = SchoolMap::active()
            ->ordered()
            ->get();

        return view('school.maps.index', compact('maps'));
    }

    /**
     * Show specific map
     */
    public function show($slug)
    {
        $map = SchoolMap::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Increment view count
        $map->incrementView();

        return view('school.maps.show', compact('map'));
    }

    /**
     * Show create form (Admin only)
     */
    public function create()
    {
        return view('school.maps.create');
    }

    /**
     * Store new map (Admin only)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Max 5MB
            'order' => 'nullable|integer'
        ]);

        $image = $request->file('image');
        $imageName = time() . '_' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();
        
        // Store image
        $imagePath = $image->storeAs('school_maps', $imageName, 'public');

        SchoolMap::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'] ?? '',
            'image_path' => $imagePath,
            'image_name' => $image->getClientOriginalName(),
            'file_size' => $image->getSize(),
            'file_type' => $image->getClientOriginalExtension(),
            'order' => $validated['order'] ?? 0,
            'status' => 'active'
        ]);

        return redirect()->route('school.maps.index')
            ->with('success', 'Denah sekolah berhasil ditambahkan!');
    }

    /**
     * Show edit form (Admin only)
     */
    public function edit($id)
    {
        $map = SchoolMap::findOrFail($id);
        return view('school.maps.edit', compact('map'));
    }

    /**
     * Update map (Admin only)
     */
    public function update(Request $request, $id)
    {
        $map = SchoolMap::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer'
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'] ?? $map->description,
            'order' => $validated['order'] ?? $map->order
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($map->image_path) {
                Storage::disk('public')->delete($map->image_path);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('school_maps', $imageName, 'public');

            $data['image_path'] = $imagePath;
            $data['image_name'] = $image->getClientOriginalName();
            $data['file_size'] = $image->getSize();
            $data['file_type'] = $image->getClientOriginalExtension();
        }

        $map->update($data);

        return redirect()->route('school.maps.index')
            ->with('success', 'Denah sekolah berhasil diperbarui!');
    }

    /**
     * Delete map (Admin only)
     */
    public function destroy($id)
    {
        $map = SchoolMap::findOrFail($id);
        $map->delete();

        return redirect()->route('school.maps.index')
            ->with('success', 'Denah sekolah berhasil dihapus!');
    }

    /**
     * Restore deleted map (Admin only)
     */
    public function restore($id)
    {
        $map = SchoolMap::onlyTrashed()->findOrFail($id);
        $map->restore();

        return redirect()->route('school.maps.index')
            ->with('success', 'Denah sekolah berhasil dipulihkan!');
    }
}