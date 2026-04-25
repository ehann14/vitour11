<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Panorama - Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-blue: #1e3c72; --secondary-blue: #2a5298; --accent-teal: #00c9b1; }
        body { background: #f8f9fa; font-family: 'Poppins', 'Segoe UI', sans-serif; }
        .sidebar { min-height: 100vh; background: var(--primary-blue); color: white; }
        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: flex; align-items: center; gap: 10px; border-radius: 8px; margin: 4px 0; transition: background 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: white; padding: 12px 20px; text-align: left; width: 100%; cursor: pointer; display: flex; align-items: center; gap: 10px; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; position: sticky; top: 0; z-index: 100; }
        .form-card { background: white; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 2rem; }
        .form-label { font-weight: 500; color: #495057; }
        .btn-primary-custom { background: var(--primary-blue); color: white; border-radius: 25px; padding: 0.6rem 1.5rem; border: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
        .btn-primary-custom:hover { background: var(--secondary-blue); color: white; transform: translateY(-2px); }
        .btn-secondary-custom { background: #6c757d; color: white; border-radius: 25px; padding: 0.6rem 1.5rem; border: none; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; }
        .btn-secondary-custom:hover { background: #5a6268; color: white; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; }
        .alert-success-custom { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .image-preview { width: 100%; max-height: 300px; object-fit: contain; border-radius: 12px; border: 2px solid #dee2e6; }
        .drop-zone { border: 2px dashed #dee2e6; border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.2s; background: #f8f9fa; }
        .drop-zone:hover, .drop-zone.dragover { border-color: var(--accent-teal); background: rgba(0,201,177,0.05); }
        .hotspot-item { background: #f8f9fa; border-radius: 10px; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid var(--accent-teal); }
        .current-image { max-width: 200px; border-radius: 8px; border: 2px solid #dee2e6; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 border-bottom" style="border-color:rgba(255,255,255,0.2)!important">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i>Admin SMK 11</h5>
                </div>
                <nav class="mt-3 p-2">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i><span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.panorama.index') }}" class="{{ request()->routeIs('admin.panorama.*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i><span>Kelola Panorama</span>
                    </a>
                    <!-- ✅ BARU: Menu Kelola Prestasi -->
                    <a href="{{ route('admin.achievements.index') }}" class="{{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
                        <i class="fas fa-trophy"></i><span>Kelola Prestasi</span>
                    </a>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i><span>Lihat Website</span>
                    </a>
                </nav>
                <div class="mt-auto p-3 border-top" style="border-color:rgba(255,255,255,0.2)!important">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
                    </form>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10">
                <nav class="navbar-admin">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 style="color: var(--primary-blue); margin: 0;"><i class="fas fa-edit me-2"></i>Edit Panorama</h4>
                        <a href="{{ route('admin.panorama.index') }}" class="btn-secondary-custom"><i class="fas fa-arrow-left"></i>Kembali</a>
                    </div>
                </nav>
                
                <div class="p-4">
                    @if(session('success'))
                    <div class="alert-custom alert-success-custom"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span></div>
                    @endif
                    @if($errors->any())
                    <div class="alert-custom alert-error-custom">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div><strong>Terjadi kesalahan:</strong><ul class="mb-0 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    </div>
                    @endif
                    
                    <div class="form-card">
                        <form action="{{ route('admin.panorama.update', $panorama->id) }}" method="POST" enctype="multipart/form-data" id="panoramaForm">
                            @csrf
                            @method('PUT')
                            
                            <!-- Nama Panorama -->
                            <div class="mb-3">
                                <label class="form-label">Nama Panorama *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $panorama->name) }}" required placeholder="Contoh: Ruang Kelas XII RPL 1">
                            </div>
                            
                            <!-- Scene ID (Read-only) -->
                            <div class="mb-3">
                                <label class="form-label">Scene ID</label>
                                <input type="text" class="form-control" value="{{ $panorama->scene_id }}" readonly style="background: #e9ecef; font-family: monospace;">
                                <small class="text-muted">Scene ID tidak dapat diubah setelah dibuat.</small>
                            </div>
                            
                            <!-- Tipe -->
                            <div class="mb-3">
                                <label class="form-label">Tipe Panorama</label>
                                <select class="form-select" disabled>
                                    <option value="360" {{ $panorama->type == '360' ? 'selected' : '' }}>🔄 360° Virtual Tour</option>
                                    <option value="normal" {{ $panorama->type == 'normal' ? 'selected' : '' }}>🖼️ Gambar Normal</option>
                                </select>
                                <input type="hidden" name="type" value="{{ $panorama->type }}">
                            </div>
                            
                            <!-- Gambar Saat Ini -->
                            @if($panorama->image_path && file_exists(public_path($panorama->image_path)))
                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini</label><br>
                                <img src="{{ asset($panorama->image_path) }}" alt="{{ $panorama->name }}" class="current-image">
                            </div>
                            @endif
                            
                            <!-- Upload Gambar Baru -->
                            <div class="mb-3">
                                <label class="form-label">Ganti Gambar (Opsional)</label>
                                <div class="drop-zone" id="dropZone">
                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color: var(--accent-teal);"></i>
                                    <p class="mb-0 fw-bold">Klik atau drag gambar baru ke sini</p>
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah. JPG, PNG, WebP. Maksimal 10MB</small>
                                    <input type="file" name="image" id="imageInput" accept="image/*" class="d-none">
                                </div>
                                <img id="imagePreview" class="image-preview mt-3 d-none" alt="Preview">
                            </div>
                            
                            <!-- Hotspots Editor (JSON) -->
                            @if($panorama->type == '360')
                            <div class="mb-3">
                                <label class="form-label">Hotspots (JSON)</label>
                                <textarea name="hotspots" class="form-control" rows="8" style="font-family: monospace; font-size: 0.85rem;" placeholder='[{"pitch": 0, "yaw": 0, "type": "scene", "sceneId": "next-room", "text": "Ke Ruang Lain"}]'>{{ old('hotspots', is_string($panorama->hotspots) ? $panorama->hotspots : json_encode($panorama->hotspots ?? [], JSON_PRETTY_PRINT)) }}</textarea>
                                <small class="text-muted">Format JSON array. Gunakan <a href="https://jsonlint.com" target="_blank">JSONLint</a> untuk validasi.</small>
                            </div>
                            @endif
                            
                            <!-- Order & Status -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Urutan Tampilan</label>
                                    <input type="number" name="order" class="form-control" value="{{ old('order', $panorama->order ?? 0) }}" min="0" placeholder="0 = paling atas">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active', $panorama->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isActive">Aktif (Tampilkan di website)</label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Buttons -->
                            <div class="d-flex gap-2 pt-3 border-top">
                                <button type="submit" class="btn-primary-custom"><i class="fas fa-save"></i>Update Panorama</button>
                                <a href="{{ route('admin.panorama.index') }}" class="btn-secondary-custom"><i class="fas fa-times"></i>Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview & drop zone
        const dropZone = document.getElementById('dropZone');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        
        dropZone.addEventListener('click', () => imageInput.click());
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => { e.preventDefault(); e.stopPropagation(); }, false);
        });
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'), false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'), false);
        });
        
        dropZone.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length) { imageInput.files = files; handleImagePreview(files[0]); }
        });
        
        imageInput.addEventListener('change', e => { if (e.target.files[0]) handleImagePreview(e.target.files[0]); });
        
        function handleImagePreview(file) {
            if (!file.type.startsWith('image/')) { alert('File harus berupa gambar!'); return; }
            if (file.size > 10 * 1024 * 1024) { alert('Ukuran maksimal 10MB!'); return; }
            
            const reader = new FileReader();
            reader.onload = e => { imagePreview.src = e.target.result; imagePreview.classList.remove('d-none'); };
            reader.readAsDataURL(file);
        }
        
        // Auto-dismiss alerts
        document.querySelectorAll('.alert-custom').forEach(alert => {
            setTimeout(() => { alert.style.opacity = '0'; setTimeout(() => alert.remove(), 300); }, 5000);
        });
    </script>
</body>
</html>