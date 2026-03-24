<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panorama;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class PanoramaController extends Controller
{
    /**
     * Display a listing of panoramas.
     */
    public function index(Request $request)
    {
        $query = Panorama::query();
        
        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('scene_id', 'like', "%{$search}%");
            });
        }
        
        // Type filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Status filter
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        // Pagination
        $perPage = $request->get('per_page', 10);
        $panoramas = $query->orderBy('order')->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('admin.panorama.index', compact('panoramas'));
    }

    /**
     * Show the form for creating a new panorama.
     */
    public function create()
    {
        return view('admin.panorama.create');
    }

    /**
     * Store a newly created panorama in storage.
     * ⚠️ INI BAGIAN PENTING UNTUK UPLOAD FILE
     */
    public function store(Request $request)
    {
        try {
            // 1. VALIDASI INPUT
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'scene_id' => 'required|string|max:255|unique:panoramas,scene_id',
                'image_path' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240', // Max 10MB
                'type' => 'required|in:360,normal',
                'order' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
                'hotspots' => 'nullable|json',
                'icon' => 'nullable|string|max:255',
            ], [
                'image_path.required' => 'Gambar wajib diupload.',
                'image_path.image' => 'File harus berupa gambar.',
                'image_path.mimes' => 'Format gambar harus: jpeg, jpg, png, webp.',
                'image_path.max' => 'Ukuran gambar maksimal 10MB.',
                'scene_id.unique' => 'Scene ID ini sudah digunakan.',
            ]);

            // 2. PROSES UPLOAD FILE
            if ($request->hasFile('image_path')) {
                // Simpan file ke disk 'public' (folder: storage/app/public/panoramas)
                $path = $request->file('image_path')->store('panoramas', 'public');
                
                // Simpan path relatif ke database (storage/panoramas/xxx.jpg)
                $validated['image_path'] = 'panoramas/' . basename($path);
                
                Log::info('File uploaded successfully: ' . $validated['image_path']);
            } else {
                Log::error('No file uploaded in request.');
                return redirect()->back()->with('error', 'Gagal mengupload gambar. File tidak terdeteksi.');
            }

            // 3. SIMPAN KE DATABASE
            Panorama::create($validated);

            return redirect()->route('admin.panorama.index')
                ->with('success', 'Panorama berhasil ditambahkan!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Store Critical Error: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
            return redirect()->back()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified panorama.
     */
    public function edit($id)
    {
        $panorama = Panorama::findOrFail($id);
        return view('admin.panorama.edit', compact('panorama'));
    }

    /**
     * Update the specified panorama in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image_path' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
                'type' => 'required|in:360,normal',
                'order' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
                'hotspots' => 'nullable|json',
                'icon' => 'nullable|string|max:255',
            ]);

            $panorama = Panorama::findOrFail($id);
            
            // Handle file upload jika ada file baru
            if ($request->hasFile('image_path')) {
                // Hapus file lama dari storage jika ada
                if ($panorama->image_path) {
                    $oldPath = str_replace('storage/', 'public/', $panorama->image_path);
                    if (Storage::exists($oldPath)) {
                        Storage::delete($oldPath);
                    }
                }
                
                // Simpan file baru
                $path = $request->file('image_path')->store('panoramas', 'public');
                $validated['image_path'] = 'panoramas/' . basename($path);
            }
            
            $panorama->update($validated);

            return redirect()->route('admin.panorama.index')
                ->with('success', 'Panorama berhasil diperbarui!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal memperbarui: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified panorama from storage.
     */
    public function destroy($id)
    {
        try {
            $panorama = Panorama::findOrFail($id);
            
            // Hapus file gambar terkait dari storage
            if ($panorama->image_path) {
                $filePath = str_replace('storage/', 'public/', $panorama->image_path);
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            }
            
            $panorama->delete();

            return redirect()->route('admin.panorama.index')
                ->with('success', 'Panorama berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Delete Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    // ... (Method AJAX toggleStatus, bulkToggle, bulkDelete tetap sama seperti sebelumnya) ...
    public function toggleStatus(Request $request, $id) {
        try {
            $panorama = Panorama::findOrFail($id);
            $panorama->update(['is_active' => $request->boolean('is_active')]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function bulkToggle(Request $request) {
        try {
            Panorama::whereIn('id', $request->input('ids', []))->update(['is_active' => $request->boolean('is_active')]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function bulkDelete(Request $request) {
        try {
            $ids = $request->input('ids', []);
            foreach(Panorama::whereIn('id', $ids)->get() as $p) {
                if($p->image_path) Storage::delete(str_replace('storage/', 'public/', $p->image_path));
            }
            Panorama::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}