<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Prestasi - Admin SMK Negeri 11 Bandung</title>
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
        .btn-danger-custom { background: #dc3545; border: none; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 500; color: white; transition: all 0.3s; }
        .btn-danger-custom:hover { background: #bd2130; color: white; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; }
        .alert-success-custom { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .form-text { font-size: 0.85rem; color: #6c757d; }
        .preview-img { max-width: 200px; border-radius: 8px; border: 2px solid #dee2e6; }
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
                    <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);"><i class="fas fa-edit me-2"></i>Edit Prestasi</h4>
                    <a href="{{ route('admin.achievements.index') }}" class="btn-secondary-custom"><i class="fas fa-arrow-left"></i>Kembali</a>
                </div>
            </nav>

            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
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
                    <form method="POST" action="{{ route('admin.achievements.update', $achievement) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        
                        <div class="row g-4">
                            <!-- Judul -->
                            <div class="col-12">
                                <label class="form-label">Judul Prestasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" value="{{ old('title', $achievement->title) }}" required placeholder="Contoh: Juara 1 LKS Tingkat Provinsi">
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Level & Type -->
                            <div class="col-md-6">
                                <label class="form-label">Tingkat Kompetisi <span class="text-danger">*</span></label>
                                <select class="form-select @error('level') is-invalid @enderror" name="level" required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="Kota" {{ old('level', $achievement->level) == 'Kota' ? 'selected' : '' }}>Kota</option>
                                    <option value="Provinsi" {{ old('level', $achievement->level) == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                    <option value="Nasional" {{ old('level', $achievement->level) == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                    <option value="Internasional" {{ old('level', $achievement->level) == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                </select>
                                @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Prestasi <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="Akademik" {{ old('type', $achievement->type) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                    <option value="Non-Akademik" {{ old('type', $achievement->type) == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                </select>
                                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Ranking & Lokasi -->
                            <div class="col-md-6">
                                <label class="form-label">Peringkat (Opsional)</label>
                                <input type="number" class="form-control @error('ranking') is-invalid @enderror"
                                       name="ranking" value="{{ old('ranking', $achievement->ranking) }}" min="1" max="10" placeholder="1 = Juara 1">
                                @error('ranking')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Lokasi (Opsional)</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                       name="location" value="{{ old('location', $achievement->location) }}" placeholder="Contoh: Bandung, Jawa Barat">
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Prestasi <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                       name="date" value="{{ old('date', $achievement->date?->format('Y-m-d')) }}" required>
                                @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label class="form-label">Deskripsi (Opsional)</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          name="description" rows="3" placeholder="Ceritakan singkat tentang pencapaian ini...">{{ old('description', $achievement->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Siswa -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Siswa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('student_name') is-invalid @enderror"
                                       name="student_name" value="{{ old('student_name', $achievement->student_name) }}" required placeholder="Nama lengkap siswa">
                                @error('student_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kelas (Opsional)</label>
                                <input type="text" class="form-control @error('student_class') is-invalid @enderror"
                                       name="student_class" value="{{ old('student_class', $achievement->student_class) }}" placeholder="Contoh: XII RPL 1">
                                @error('student_class')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Pembimbing -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Pembimbing (Opsional)</label>
                                <input type="text" class="form-control @error('advisor_name') is-invalid @enderror"
                                       name="advisor_name" value="{{ old('advisor_name', $achievement->advisor_name) }}">
                                @error('advisor_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jabatan Pembimbing (Opsional)</label>
                                <input type="text" class="form-control @error('advisor_title') is-invalid @enderror"
                                       name="advisor_title" value="{{ old('advisor_title', $achievement->advisor_title) }}" placeholder="Contoh: Guru Pembina">
                                @error('advisor_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Gambar -->
                            <div class="col-12">
                                <label class="form-label">Foto Prestasi (Opsional)</label>
                                @if($achievement->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $achievement->image_path) }}" alt="{{ $achievement->title }}" class="preview-img">
                                    <small class="form-text d-block mt-1">Gambar saat ini</small>
                                </div>
                                @endif
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       name="image" accept="image/*">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF, WebP. Maksimal 2MB.</small>
                            </div>

                            <!-- Status & Order -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $achievement->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Tampilkan di Website</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Urutan Tampilan</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       name="order" value="{{ old('order', $achievement->order) }}" min="0" placeholder="0 = paling atas">
                                @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn-primary-custom">
                                <i class="fas fa-save me-2"></i>Update Prestasi
                            </button>
                            <a href="{{ route('admin.achievements.index') }}" class="btn-secondary-custom">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="button" class="btn-danger-custom" id="deleteBtn" data-id="{{ $achievement->id }}">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DELETE form (separate) -->
<form id="deleteForm" method="POST" style="display:none">@csrf @method('DELETE')</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Delete button handler
document.getElementById('deleteBtn')?.addEventListener('click', function() {
    if(confirm('Yakin ingin menghapus prestasi ini?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/achievements/${this.dataset.id}`;
        form.submit();
    }
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