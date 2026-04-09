<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panorama;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PanoramaController extends Controller
{
    /**
     * Display a listing of panoramas.
     */
    public function index(Request $request)
    {
        $query = Panorama::query();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('scene_id', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        $perPage = $request->get('per_page', 10);
        $panoramas = $query->orderBy('order')->orderBy('created_at', 'desc')->paginate($perPage);
        
        return view('admin.panorama.index', compact('panoramas'));
    }

    public function create()
    {
        return view('admin.panorama.create');
    }

    /**
     * Store a newly created panorama.
     * ✅ FIX: Upload langsung ke public/panoramas (bypass symlink Windows)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'scene_id' => 'required|string|max:255|unique:panoramas,scene_id',
                'image_path' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240',
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

            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                
                // Generate nama file unik
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                
                // ✅ FIX: Simpan LANGSUNG ke public/panoramas
                $destinationPath = public_path('panoramas');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $file->move($destinationPath, $filename);
                
                // Simpan path relatif ke database (tanpa prefix)
                $validated['image_path'] = 'panoramas/' . $filename;
                
                Log::info('File uploaded to public/panoramas: ' . $validated['image_path']);
            } else {
                Log::error('No file uploaded in request.');
                return redirect()->back()->with('error', 'Gagal mengupload gambar. File tidak terdeteksi.');
            }

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

    public function edit($id)
    {
        $panorama = Panorama::findOrFail($id);
        return view('admin.panorama.edit', compact('panorama'));
    }

    /**
     * Update panorama.
     * ✅ FIX: Hanya update image_path jika ada file baru
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
            
            // ✅ FIX: Hanya proses upload jika ada file baru
            if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
                // Hapus file lama dari public/panoramas
                if ($panorama->image_path && file_exists(public_path($panorama->image_path))) {
                    unlink(public_path($panorama->image_path));
                }
                
                // Upload file baru langsung ke public/panoramas
                $file = $request->file('image_path');
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                
                $destinationPath = public_path('panoramas');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $file->move($destinationPath, $filename);
                
                // Update path di array validated
                $validated['image_path'] = 'panoramas/' . $filename;
            } else {
                // ✅ PENTING: Hapus image_path dari validated agar tidak overwrite data lama
                unset($validated['image_path']);
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
            Log::error('Update Error: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
            return redirect()->back()
                ->with('error', 'Gagal memperbarui: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete panorama.
     * ✅ FIX: Hapus file dari public/panoramas
     */
    public function destroy($id)
    {
        try {
            $panorama = Panorama::findOrFail($id);
            
            if ($panorama->image_path) {
                $filePath = public_path($panorama->image_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
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
                if($p->image_path) {
                    $filePath = public_path($p->image_path);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            Panorama::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}