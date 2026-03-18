<?php

namespace App\Http\Controllers;

use App\Models\Panorama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanoramaController extends Controller
{
    // Viewer untuk public
    public function viewer()
    {
        $panoramas = Panorama::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return view('denah', compact('panoramas'));
    }

    // Admin Dashboard
    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $panoramas = Panorama::orderBy('order')->get();
        return view('admin.dashboard', compact('panoramas'));
    }

    // Upload gambar baru
    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'scene_id' => 'required|string|max:100|unique:panoramas,scene_id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:20480',
            'type' => 'required|in:360,normal',
            'icon' => 'required|string'
        ]);

        $path = $request->file('image')->store('panoramas', 'public');

        Panorama::create([
            'name' => $request->name,
            'scene_id' => $request->scene_id,
            'image_path' => $path,
            'type' => $request->type,
            'order' => Panorama::max('order') + 1,
            'hotspots' => [],
            'icon' => $request->icon,
            'is_active' => true
        ]);

        return redirect()->back()->with('success', 'Scene berhasil ditambahkan!');
    }

    // Update scene & hotspots
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $panorama = Panorama::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:360,normal',
            'icon' => 'required|string',
            'is_active' => 'boolean',
            'hotspots' => 'nullable|array'
        ]);

        $data = [
            'name' => $request->name,
            'type' => $request->type,
            'icon' => $request->icon,
            'is_active' => $request->has('is_active'),
            'hotspots' => $request->hotspots ?? []
        ];

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($panorama->image_path);
            $data['image_path'] = $request->file('image')->store('panoramas', 'public');
        }

        $panorama->update($data);

        return redirect()->back()->with('success', 'Scene berhasil diupdate!');
    }

    // Update order (drag & drop)
    public function updateOrder(Request $request)
    {
        if (!session('admin_logged_in')) {
            return response()->json(['success' => false], 403);
        }

        foreach ($request->orders as $id => $order) {
            Panorama::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    // Hapus scene
    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $panorama = Panorama::findOrFail($id);
        Storage::disk('public')->delete($panorama->image_path);
        $panorama->delete();

        return redirect()->back()->with('success', 'Scene berhasil dihapus!');
    }

    // Get all scenes for hotspot target selection
    public function getScenes()
    {
        $panoramas = Panorama::where('is_active', true)
            ->orderBy('order')
            ->get(['id', 'name', 'scene_id']);
        
        return response()->json($panoramas);
    }
}