<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Program - Admin SMK Negeri 11 Bandung</title>
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
        
        /* ===== LAINNYA ===== */
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
        .image-preview { max-width: 200px; border-radius: 8px; border: 2px dashed #dee2e6; }
        #logoPreview { display: none; margin-top: 1rem; }
        #logoPreview img { max-width: 100%; border-radius: 8px; }
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
                    <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);"><i class="fas fa-plus-circle me-2"></i>Tambah Program Keahlian</h4>
                    <a href="{{ route('admin.program.index') }}" class="btn-secondary-custom"><i class="fas fa-arrow-left"></i>Kembali</a>
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
                    <form method="POST" action="{{ route('admin.program.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <!-- Nama Program -->
                            <div class="col-12">
                                <label class="form-label">Nama Program <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       name="nama" value="{{ old('nama') }}" required 
                                       placeholder="Contoh: Rekayasa Perangkat Lunak" id="inputNama">
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Slug (Auto) -->
                            <div class="col-md-6">
                                <label class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       name="slug" value="{{ old('slug') }}" required 
                                       placeholder="rekayasa-perangkat-lunak" id="inputSlug" readonly>
                                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text"><i class="fas fa-info-circle me-1"></i>Diisi otomatis dari Nama Program</small>
                            </div>

                            <!-- Singkatan -->
                            <div class="col-md-6">
                                <label class="form-label">Singkatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('singkatan') is-invalid @enderror"
                                       name="singkatan" value="{{ old('singkatan') }}" required 
                                       placeholder="Contoh: RPL" maxlength="10">
                                @error('singkatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                          name="deskripsi" rows="3" placeholder="Jelaskan program keahlian ini...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Visi -->
                            <div class="col-12">
                                <label class="form-label">Visi</label>
                                <textarea class="form-control @error('visi') is-invalid @enderror"
                                          name="visi" rows="2" placeholder="Visi program...">{{ old('visi') }}</textarea>
                                @error('visi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Misi -->
                            <div class="col-12">
                                <label class="form-label">Misi</label>
                                <textarea class="form-control @error('misi') is-invalid @enderror"
                                          name="misi" rows="3" placeholder="Misi program...">{{ old('misi') }}</textarea>
                                @error('misi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Logo Program -->
                            <div class="col-12">
                                <label class="form-label">Logo Program</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                       name="logo" accept="image/*" id="inputLogo">
                                @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text"><i class="fas fa-info-circle me-1"></i>JPG, PNG, WebP. Maksimal 2MB</small>
                                <div id="logoPreview"><img id="previewImg" src="#" alt="Preview Logo"></div>
                            </div>

                            <!-- Urutan & Status -->
                            <div class="col-md-6">
                                <label class="form-label">Urutan Tampilan</label>
                                <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                                       name="urutan" value="{{ old('urutan', 0) }}" min="0">
                                @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text">Semakin kecil angka, semakin atas posisinya</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Aktif (Tampilkan di website)</label>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn-primary-custom">
                                <i class="fas fa-save me-2"></i>Simpan Program
                            </button>
                            <a href="{{ route('admin.program.index') }}" class="btn-secondary-custom">
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
// Preview logo sebelum upload
document.getElementById('inputLogo')?.addEventListener('change', function(e) {
    const preview = document.getElementById('logoPreview');
    const previewImg = document.getElementById('previewImg');
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            previewImg.src = event.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});

// Auto-generate slug dari nama program
document.getElementById('inputNama')?.addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('inputSlug').value = slug;
});

// Auto-dismiss alerts
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }, 5000);
    });
});
</script>
</body>
</html>