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
        .sidebar { min-height: 100vh; background: var(--primary-blue); color: white; display: flex; flex-direction: column; }
        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 4px 0; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: rgba(255,255,255,0.9); padding: 12px 20px; text-align: left; width: 100%; font-size: 1rem; cursor: pointer; transition: all 0.3s; }
        .sidebar .logout-btn:hover { background: rgba(255,255,255,0.1); color: white; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; }
        .form-card { background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 25px; }
        .form-label { font-weight: 500; color: var(--gray-700); }
        .btn-primary-custom { background: var(--primary-blue); border: none; border-radius: 20px; padding: 10px 25px; }
        .btn-primary-custom:hover { background: var(--secondary-blue); }
        .btn-secondary-custom { background: #6c757d; border: none; border-radius: 20px; padding: 10px 25px; color: white; }
        .btn-secondary-custom:hover { background: #5a6268; }
        .preview-img { max-height: 120px; border-radius: 10px; border: 2px solid #dee2e6; }
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
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.panorama.index') }}" class="{{ request()->routeIs('admin.panorama.*') ? 'active' : '' }}">
                        <i class="fas fa-images me-2"></i>Kelola Panorama
                    </a>
                    <a href="{{ route('admin.achievements.index') }}" class="{{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
                        <i class="fas fa-trophy me-2"></i>Kelola Prestasi
                    </a>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                    </a>
                </nav>
                <div class="p-3 border-top mt-auto" style="border-color: rgba(255,255,255,0.2) !important;">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <!-- Top Navbar -->
                <nav class="navbar-admin">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);">✏️ Edit Prestasi</h4>
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted">Halo, {{ Auth::user()->name ?? 'Admin' }}!</span>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px; font-weight: 600; background: rgba(0,201,177,0.15); color: var(--accent-teal);">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Content -->
                <div class="p-4">
                    <div class="mb-4">
                        <a href="{{ route('admin.achievements.index') }}" class="text-decoration-none" style="color: var(--primary-blue);">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Prestasi
                        </a>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>Ada kesalahan pada form:
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="form-card">
                        <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Judul -->
                            <div class="mb-3">
                                <label class="form-label">Judul Prestasi *</label>
                                <input type="text" name="title" class="form-control" 
                                       value="{{ old('title', $achievement->title) }}" required 
                                       placeholder="Contoh: Juara 1 LKS Tingkat Provinsi">
                            </div>

                            <!-- Level & Type -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Tingkat Kompetisi *</label>
                                    <select name="level" class="form-select" required>
                                        <option value="">Pilih Tingkat</option>
                                        <option value="Kota" {{ old('level', $achievement->level) == 'Kota' ? 'selected' : '' }}>Kota</option>
                                        <option value="Provinsi" {{ old('level', $achievement->level) == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                        <option value="Nasional" {{ old('level', $achievement->level) == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                        <option value="Internasional" {{ old('level', $achievement->level) == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Prestasi *</label>
                                    <select name="type" class="form-select" required>
                                        <option value="">Pilih Jenis</option>
                                        <option value="Akademik" {{ old('type', $achievement->type) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                        <option value="Non-Akademik" {{ old('type', $achievement->type) == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Ranking & Lokasi -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Peringkat (Opsional)</label>
                                    <input type="number" name="ranking" class="form-control" 
                                           value="{{ old('ranking', $achievement->ranking) }}" min="1" max="10" placeholder="1 = Juara 1">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Lokasi (Opsional)</label>
                                    <input type="text" name="location" class="form-control" 
                                           value="{{ old('location', $achievement->location) }}" placeholder="Contoh: Bandung, Jawa Barat">
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label class="form-label">Tanggal Prestasi *</label>
                                <input type="date" name="date" class="form-control" 
                                       value="{{ old('date', $achievement->date->format('Y-m-d')) }}" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label class="form-label">Deskripsi (Opsional)</label>
                                <textarea name="description" class="form-control" rows="3" 
                                          placeholder="Ceritakan singkat tentang pencapaian ini...">{{ old('description', $achievement->description) }}</textarea>
                            </div>

                            <!-- Siswa -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Siswa *</label>
                                    <input type="text" name="student_name" class="form-control" 
                                           value="{{ old('student_name', $achievement->student_name) }}" required placeholder="Nama lengkap siswa">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kelas (Opsional)</label>
                                    <input type="text" name="student_class" class="form-control" 
                                           value="{{ old('student_class', $achievement->student_class) }}" placeholder="Contoh: XII RPL 1">
                                </div>
                            </div>

                            <!-- Pembimbing -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Pembimbing (Opsional)</label>
                                    <input type="text" name="advisor_name" class="form-control" 
                                           value="{{ old('advisor_name', $achievement->advisor_name) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jabatan Pembimbing (Opsional)</label>
                                    <input type="text" name="advisor_title" class="form-control" 
                                           value="{{ old('advisor_title', $achievement->advisor_title) }}" placeholder="Contoh: Guru Pembina">
                                </div>
                            </div>

                            <!-- Gambar -->
                            <div class="mb-3">
                                <label class="form-label">Foto Prestasi (Opsional)</label>
                                
                                @if($achievement->image_path)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $achievement->image_path) }}" 
                                         alt="{{ $achievement->title }}" class="preview-img">
                                    <small class="text-muted d-block mt-1">Gambar saat ini</small>
                                </div>
                                @endif
                                
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF, WebP. Maksimal 2MB.</small>
                            </div>

                            <!-- Status & Order -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" 
                                               {{ old('is_active', $achievement->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isActive">Tampilkan di Website</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Urutan Tampilan</label>
                                    <input type="number" name="order" class="form-control" 
                                           value="{{ old('order', $achievement->order) }}" min="0" placeholder="0 = paling atas">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 pt-3 border-top">
                                <button type="submit" class="btn btn-primary-custom">
                                    <i class="fas fa-save me-1"></i> Update Prestasi
                                </button>
                                <a href="{{ route('admin.achievements.index') }}" class="btn btn-secondary-custom">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-dismiss alerts
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }, 5000);
        });
    </script>
</body>
</html>