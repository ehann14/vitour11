<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Galeri - Admin SMK Negeri 11 Bandung</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #1e3c72; --secondary-blue: #2a5298; --accent-teal: #00c9b1; --white: #ffffff; }
        body { background: #f8f9fa; font-family: 'Poppins', sans-serif; }
        
        /* ===== SIDEBAR (SAMA PERSIS) ===== */
        .sidebar { min-height: 100vh; background: var(--primary-blue); color: white; display: flex; flex-direction: column; }
        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 4px 0; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: rgba(255,255,255,0.9); padding: 12px 20px; text-align: left; width: 100%; font-size: 1rem; cursor: pointer; transition: all 0.3s; }
        .sidebar .logout-btn:hover { background: rgba(255,255,255,0.1); color: white; }
        
        /* ===== LAINNYA (SAMA PERSIS DENGAN HALAMAN LAIN) ===== */
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; }
        .form-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2rem; margin-bottom: 2rem; }
        .form-label { font-weight: 600; color: #6c757d; margin-bottom: 0.5rem; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 0.25rem rgba(30,60,114,0.25); }
        .btn-primary-custom { background: var(--primary-blue); border: none; padding: 0.75rem 2rem; border-radius: 25px; font-weight: 600; color: white; transition: all 0.3s; }
        .btn-primary-custom:hover { background: var(--secondary-blue); transform: translateY(-2px); color: white; }
        .btn-secondary-custom { background: #e9ecef; border: none; padding: 0.75rem 2rem; border-radius: 25px; font-weight: 600; color: #6c757d; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; }
        .btn-secondary-custom:hover { background: #dee2e6; color: #495057; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .form-text { font-size: 0.85rem; color: #6c757d; }
        .preview-container { width: 100%; max-width: 300px; margin: 0 auto; }
        .preview-img { width: 100%; height: 200px; object-fit: cover; border-radius: 12px; border: 2px dashed #dee2e6; background: #f8f9fa; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- ✅ SIDEBAR KONSISTEN (SEMUA HALAMAN SAMA) -->
        <div class="col-md-2 sidebar p-0">
            <div class="p-3 border-bottom" style="border-color: rgba(255,255,255,0.2) !important;">
                <h5 class="mb-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i>Admin SMK 11</h5>
            </div>
            <nav class="mt-3 p-2 flex-grow-1">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.panorama.index') }}" class="{{ request()->routeIs('admin.panorama.*') ? 'active' : '' }}">
                    <i class="fas fa-images me-2"></i>Kelola Panorama
                </a>
                <a href="{{ route('admin.achievements.index') }}" class="{{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
                    <i class="fas fa-trophy me-2"></i>Kelola Prestasi
                </a>
                <a href="{{ route('admin.program.index') }}" class="{{ request()->routeIs('admin.program.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group me-2"></i>Kelola Program
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <i class="fas fa-images me-2"></i>Kelola Galeri
                </a>
                <a href="{{ route('admin.comments.index') }}" class="{{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                    <i class="fas fa-comments me-2"></i>Kelola Komentar
                    @if(isset($pendingCommentsCount) && $pendingCommentsCount > 0)
                    <span class="badge bg-danger rounded-pill ms-2">{{ $pendingCommentsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                </a>
            </nav>
            <div class="p-3 border-top mt-auto" style="border-color: rgba(255,255,255,0.2) !important;">
                <form method="POST" action="{{ route('admin.logout') }}">@csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <nav class="navbar-admin">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);"><i class="fas fa-plus-circle me-2"></i>Tambah Galeri</h4>
                    <a href="{{ route('admin.gallery.index') }}" class="btn-secondary-custom"><i class="fas fa-arrow-left"></i>Kembali</a>
                </div>
            </nav>

            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert-custom alert-error-custom">
                        <i class="fas fa-exclamation-circle me-2"></i><strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <div class="form-card">
                    <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <!-- Preview Image -->
                            <div class="col-12 text-center">
                                <label class="form-label">Preview Gambar</label>
                                <div class="preview-container">
                                    <img id="imagePreview" src="" alt="Preview" class="preview-img d-none">
                                    <div id="placeholder" class="preview-img d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-image fa-2x"></i>
                                    </div>
                                </div>
                                <small class="form-text d-block mt-2">Preview akan muncul setelah gambar dipilih</small>
                            </div>

                            <!-- Judul -->
                            <div class="col-12">
                                <label class="form-label">Judul <span class="text-muted small">(Opsional)</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" value="{{ old('title') }}" placeholder="Contoh: Kegiatan Upacara Bendera">
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label class="form-label">Deskripsi <span class="text-muted small">(Opsional)</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          name="description" rows="3" placeholder="Jelaskan singkat tentang gambar ini">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Kategori -->
                            <div class="col-md-6">
                                <label class="form-label">Kategori <span class="text-muted small">(Opsional)</span></label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror"
                                       name="category" value="{{ old('category') }}" placeholder="Contoh: kegiatan, fasilitas">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text">Kategori membantu pengelompokan di halaman publik</small>
                            </div>

                            <!-- Urutan -->
                            <div class="col-md-6">
                                <label class="form-label">Urutan Tampil</label>
                                <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                                       name="urutan" value="{{ old('urutan', 0) }}" min="0">
                                @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text">Semakin kecil angka, semakin atas posisinya</small>
                            </div>

                            <!-- Upload Gambar -->
                            <div class="col-12">
                                <label class="form-label">Gambar <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       name="image" accept="image/*" required onchange="previewImage(this)">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text">Format: JPG, PNG, WebP. <strong>Maksimal 10MB.</strong></small>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active">Tampilkan di Website</label>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn-primary-custom">
                                <i class="fas fa-save me-2"></i>Simpan Galeri
                            </button>
                            <a href="{{ route('admin.gallery.index') }}" class="btn-secondary-custom">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Preview image
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('placeholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Auto-dismiss alerts
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }, 5000);
    });
});
</script>
</body>
</html>