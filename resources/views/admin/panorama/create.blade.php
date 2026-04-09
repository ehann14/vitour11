<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Panorama - Admin SMK Negeri 11 Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-blue: #1e3c72; --secondary-blue: #2a5298; --accent-teal: #00c9b1; }
        body { background: #f8f9fa; font-family: 'Poppins', sans-serif; }
        .sidebar { min-height: 100vh; background: var(--primary-blue); color: white; }
        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 4px 0; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: rgba(255,255,255,0.9); padding: 12px 20px; text-align: left; width: 100%; cursor: pointer; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; }
        .form-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2rem; margin-bottom: 2rem; }
        .form-label { font-weight: 600; color: #6c757d; }
        .form-control:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 0.25rem rgba(30,60,114,0.25); }
        .btn-primary-custom { background: var(--primary-blue); border: none; padding: 0.75rem 2rem; border-radius: 25px; font-weight: 600; color: white; }
        .btn-primary-custom:hover { background: var(--secondary-blue); color: white; }
        .btn-secondary-custom { background: #e9ecef; border: none; padding: 0.75rem 2rem; border-radius: 25px; font-weight: 600; color: #6c757d; }
        .preview-image { width: 100%; max-height: 300px; object-fit: cover; border-radius: 12px; display: none; margin-top: 1rem; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 border-bottom"><h5 class="mb-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i>Admin SMK 11</h5></div>
                <nav class="mt-3 p-2">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Dashboard</a>
                    <a href="{{ route('admin.panorama.index') }}" class="active"><i class="fas fa-images me-2"></i>Kelola Panorama</a>
                    <a href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt me-2"></i>Lihat Website</a>
                </nav>
                <div class="mt-auto p-3 border-top">
                    <form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt me-2"></i>Logout</button></form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <nav class="navbar-admin">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);"><i class="fas fa-plus-circle me-2"></i>Tambah Panorama Baru</h4>
                        <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary-custom btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
                    </div>
                </nav>

                <div class="p-4">
                    <!-- ✅ PENTING: TAMPILKAN ERROR VALIDASI DI SINI -->
                    @if ($errors->any())
                        <div class="alert-custom alert-error-custom">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-card">
                        <!-- ✅ PENTING: enctype="multipart/form-data" WAJIB ADA UNTUK UPLOAD FILE -->
                        <form method="POST" action="{{ route('admin.panorama.store') }}" enctype="multipart/form-data" id="panoramaForm">
                            @csrf

                            <div class="row g-4">
                                <!-- Nama -->
                                <div class="col-md-6">
                                    <label class="form-label">Nama Panorama *</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                </div>
                                <!-- Scene ID -->
                                <div class="col-md-6">
                                    <label class="form-label">Scene ID *</label>
                                    <input type="text" name="scene_id" class="form-control" value="{{ old('scene_id') }}" required placeholder="gerbang, lapangan, dll">
                                </div>
                                <!-- Tipe -->
                                <div class="col-md-6">
                                    <label class="form-label">Tipe *</label>
                                    <select name="type" class="form-select" required>
                                        <option value="360">360° Virtual Tour</option>
                                        <option value="normal">Gambar Normal</option>
                                    </select>
                                </div>
                                <!-- Order -->
                                <div class="col-md-6">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                                </div>
                                
                                <!-- ✅ UPLOAD GAMBAR (PENTING) -->
                                <div class="col-12">
                                    <label class="form-label">Upload Gambar *</label>
                                    <input type="file" name="image_path" class="form-control" accept="image/*" required onchange="previewImage(this)">
                                    <small class="text-muted">Format: JPG, PNG, WebP. Maksimal 10 MB.</small>
                                    <img id="imagePreview" class="preview-image" alt="Preview">
                                </div>

                                <!-- Icon -->
                                <div class="col-md-6">
                                    <label class="form-label">Icon</label>
                                    <input type="text" name="icon" class="form-control" value="{{ old('icon', 'fas fa-image') }}">
                                </div>
                                <!-- Status -->
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                        <label class="form-check-label">Aktif</label>
                                    </div>
                                </div>
                                <!-- Hotspots -->
                                <div class="col-12">
                                    <label class="form-label">Hotspots (JSON)</label>
                                    <textarea name="hotspots" class="form-control" rows="3">{{ old('hotspots') }}</textarea>
                                </div>
                            </div>

                            <div class="d-flex gap-3 mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>Simpan</button>
                                <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary-custom">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview Gambar
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        // Format Scene ID otomatis
        document.querySelector('[name="scene_id"]').addEventListener('input', function(e) {
            this.value = this.value.toLowerCase().replace(/\s+/g, '-');
        });
    </script>
</body>
</html> 