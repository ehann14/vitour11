<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Galeri - Admin SMK Negeri 11 Bandung</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #1e3c72; --secondary-blue: #2a5298; --accent-teal: #00c9b1; --white: #ffffff; }
        body { background: #f8f9fa; font-family: 'Poppins', sans-serif; }
        .sidebar { min-height: 100vh; background: var(--primary-blue); color: white; display: flex; flex-direction: column; }
        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 4px 0; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: rgba(255,255,255,0.9); padding: 12px 20px; text-align: left; width: 100%; font-size: 1rem; cursor: pointer; transition: all 0.3s; }
        .sidebar .logout-btn:hover { background: rgba(255,255,255,0.1); color: white; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; }
        .content-wrapper { padding: 1.5rem 2rem; }
        .form-card { border: none; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .form-card .card-header { background: white; border-radius: 16px 16px 0 0; padding: 1rem 1.5rem; border-bottom: 1px solid #eee; }
        .form-card .card-header h5 { margin: 0; color: var(--primary-blue); font-weight: 700; }
        .btn-teal { background: var(--accent-teal); border-color: var(--accent-teal); color: white; }
        .btn-teal:hover { background: #00a391; border-color: #00a391; color: white; }
        .preview-container { width: 100%; max-width: 300px; margin: 0 auto; }
        .preview-img { width: 100%; height: 200px; object-fit: cover; border-radius: 12px; border: 2px dashed #dee2e6; background: #f8f9fa; }
        .current-img { width: 100%; max-height: 250px; object-fit: contain; border-radius: 12px; border: 2px solid var(--accent-teal); }
        @media (max-width: 768px) {
            .sidebar { position: fixed; left: -100%; width: 260px; z-index: 1050; transition: left 0.3s; }
            .sidebar.active { left: 0; }
            .content-wrapper { margin-left: 0 !important; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 border-bottom" style="border-color: rgba(255,255,255,0.2) !important;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i>Admin SMK 11</h5>
                </div>
                <nav class="mt-3 p-2 flex-grow-1">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Dashboard</a>
                    <a href="{{ route('admin.panorama.index') }}"><i class="fas fa-images me-2"></i>Kelola Panorama</a>
                    <a href="{{ route('admin.achievements.index') }}"><i class="fas fa-trophy me-2"></i>Kelola Prestasi</a>
                    <a href="{{ route('admin.program.index') }}"><i class="fas fa-layer-group me-2"></i>Kelola Program</a>
                    <a href="{{ route('admin.gallery.index') }}" class="active"><i class="fas fa-images me-2"></i>Kelola Galeri</a>
                    <a href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt me-2"></i>Lihat Website</a>
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
                        <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);">✏️ Edit Galeri</h4>
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted">Halo, {{ Auth::user()->name ?? 'Admin' }}!</span>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 600; background: rgba(0,201,177,0.15); color: var(--accent-teal);">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="content-wrapper">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0 small">
                            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="form-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5><i class="fas fa-edit me-2"></i>Edit Galeri</h5>
                            <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <!-- Current Image Preview -->
                                @if($gallery->image)
                                <div class="text-center mb-4">
                                    <label class="form-label fw-bold">Gambar Saat Ini</label>
                                    <div class="preview-container">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Current" class="current-img">
                                    </div>
                                    <small class="text-muted d-block mt-2">Klik "Pilih Gambar" di bawah untuk mengganti</small>
                                </div>
                                @endif

                                <!-- Preview New Image -->
                                <div class="text-center mb-4 d-none" id="newPreviewContainer">
                                    <label class="form-label fw-bold">Preview Gambar Baru</label>
                                    <div class="preview-container">
                                        <img id="imagePreview" src="" alt="Preview" class="preview-img">
                                    </div>
                                </div>

                                <!-- Judul -->
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">Judul <span class="text-muted small">(Opsional)</span></label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $gallery->title) }}" placeholder="Contoh: Kegiatan Upacara Bendera">
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label for="description" class="form-label fw-bold">Deskripsi <span class="text-muted small">(Opsional)</span></label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Jelaskan singkat tentang gambar ini">{{ old('description', $gallery->description) }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="mb-3">
                                    <label for="category" class="form-label fw-bold">Kategori <span class="text-muted small">(Opsional)</span></label>
                                    <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $gallery->category) }}" placeholder="Contoh: kegiatan, fasilitas, prestasi">
                                    @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <small class="text-muted">Kategori membantu pengelompokan di halaman publik</small>
                                </div>

                                <!-- Urutan -->
                                <div class="mb-3">
                                    <label for="urutan" class="form-label fw-bold">Urutan Tampil</label>
                                    <input type="number" name="urutan" id="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', $gallery->urutan) }}" min="0">
                                    @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <small class="text-muted">Semakin kecil angka, semakin atas posisinya</small>
                                </div>

                                <!-- Upload Gambar Baru - 10MB -->
                                <div class="mb-3">
                                    <label for="image" class="form-label fw-bold">Ganti Gambar <span class="text-muted small">(Opsional)</span></label>
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <small class="text-muted">Format: jpeg, png, jpg, webp | <strong>Maksimal 10MB</strong> | Kosongkan jika tidak ingin mengganti</small>
                                </div>

                                <!-- Status Aktif -->
                                <div class="form-check form-switch mb-4">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="isActive">Tampilkan di halaman publik</label>
                                </div>

                                <!-- Tombol -->
                                <div class="d-flex gap-2 flex-wrap">
                                    <button type="submit" class="btn btn-teal px-4">💾 Update Galeri</button>
                                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">↩ Batal</a>
                                    <button type="button" class="btn btn-outline-danger ms-auto" data-bs-toggle="modal" data-bs-target="#deleteModal">🗑️ Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">⚠️ Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus galeri ini?</p>
                    <p class="text-muted small mb-0">Gambar dan data terkait akan dihapus permanen.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const container = document.getElementById('newPreviewContainer');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                container.classList.add('d-none');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.alert').forEach(alert => {
                setTimeout(() => { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }, 5000);
            });
        });
    </script>
</body>
</html>