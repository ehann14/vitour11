<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Program - Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-blue: #1e3c72; --secondary-blue: #2a5298; --accent-teal: #00c9b1; }
        body { background: #f8f9fa; font-family: 'Poppins', sans-serif; }
        .sidebar { min-height: 100vh; background: var(--primary-blue); color: white; }
        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: flex; align-items: center; gap: 10px; border-radius: 8px; margin: 4px 0; transition: background 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: white; padding: 12px 20px; text-align: left; width: 100%; cursor: pointer; display: flex; align-items: center; gap: 10px; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; }
        .form-card { background: white; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 2rem; }
        .form-label { font-weight: 500; color: #495057; }
        .btn-primary-custom { background: var(--primary-blue); color: white; border-radius: 25px; padding: 0.6rem 1.5rem; border: none; }
        .btn-primary-custom:hover { background: var(--secondary-blue); color: white; }
        .btn-secondary-custom { background: #6c757d; color: white; border-radius: 25px; padding: 0.6rem 1.5rem; border: none; text-decoration: none; }
        .btn-secondary-custom:hover { background: #5a6268; color: white; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .image-preview { max-width: 200px; border-radius: 8px; border: 2px dashed #dee2e6; }
        /* Tambahan: preview image */
        #logoPreview { display: none; margin-top: 1rem; }
        #logoPreview img { max-width: 100%; border-radius: 8px; }
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
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
                    <a href="{{ route('admin.panorama.index') }}"><i class="fas fa-images"></i><span>Kelola Panorama</span></a>
                    <a href="{{ route('admin.achievements.index') }}"><i class="fas fa-trophy"></i><span>Kelola Prestasi</span></a>
                    <a href="{{ route('admin.program.index') }}" class="active"><i class="fas fa-layer-group"></i><span>Kelola Program</span></a>
                    
                    {{-- 🔧 FIX: Hapus route admin.konsentrasi.index yang tidak didefinisikan --}}
                    {{-- Jika fitur Konsentrasi dibutuhkan, definisikan route-nya dulu di web.php --}}
                    {{-- <a href="{{ route('admin.konsentrasi.index') }}"><i class="fas fa-sitemap"></i><span>Kelola Konsentrasi</span></a> --}}
                    
                    <a href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt"></i><span>Lihat Website</span></a>
                </nav>
                <div class="mt-auto p-3 border-top" style="border-color:rgba(255,255,255,0.2)!important">
                    <form method="POST" action="{{ route('admin.logout') }}">@csrf
                        <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
                    </form>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10">
                <nav class="navbar-admin">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 style="color: var(--primary-blue); margin: 0;"><i class="fas fa-plus-circle me-2"></i>Tambah Program Keahlian</h4>
                        <a href="{{ route('admin.program.index') }}" class="btn-secondary-custom"><i class="fas fa-arrow-left"></i>Kembali</a>
                    </div>
                </nav>
                
                <div class="p-4">
                    {{-- Error Validation Display --}}
                    @if($errors->any())
                    <div class="alert-custom alert-error-custom">
                        <strong><i class="fas fa-exclamation-circle me-1"></i>Terjadi Kesalahan:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <div class="form-card">
                        <form action="{{ route('admin.program.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- Nama Program --}}
                            <div class="mb-3">
                                <label class="form-label">Nama Program <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama') }}" required 
                                       placeholder="Contoh: Rekayasa Perangkat Lunak"
                                       id="inputNama">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Singkatan --}}
                            <div class="mb-3">
                                <label class="form-label">Singkatan <span class="text-danger">*</span></label>
                                <input type="text" name="singkatan" class="form-control @error('singkatan') is-invalid @enderror" 
                                       value="{{ old('singkatan') }}" required 
                                       placeholder="Contoh: RPL" maxlength="10">
                                @error('singkatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Deskripsi --}}
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                                          rows="3" placeholder="Jelaskan program keahlian ini...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Visi --}}
                            <div class="mb-3">
                                <label class="form-label">Visi</label>
                                <textarea name="visi" class="form-control @error('visi') is-invalid @enderror" 
                                          rows="2" placeholder="Visi program...">{{ old('visi') }}</textarea>
                                @error('visi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Misi --}}
                            <div class="mb-3">
                                <label class="form-label">Misi</label>
                                <textarea name="misi" class="form-control @error('misi') is-invalid @enderror" 
                                          rows="3" placeholder="Misi program...">{{ old('misi') }}</textarea>
                                @error('misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Logo Program --}}
                            <div class="mb-3">
                                <label class="form-label">Logo Program</label>
                                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" 
                                       accept="image/*" id="inputLogo">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>JPG, PNG, WebP. Maksimal 2MB</small>
                                
                                {{-- Preview Image --}}
                                <div id="logoPreview">
                                    <img id="previewImg" src="#" alt="Preview Logo">
                                </div>
                            </div>
                            
                            {{-- Urutan & Status --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Urutan Tampilan</label>
                                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" 
                                           value="{{ old('urutan', 0) }}" min="0">
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Semakin kecil angka, semakin atas posisinya</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" 
                                               id="isActive" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isActive">Aktif (Tampilkan di website)</label>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Tombol Aksi --}}
                            <div class="d-flex gap-2 pt-3 border-top">
                                <button type="submit" class="btn-primary-custom">
                                    <i class="fas fa-save me-1"></i>Simpan Program
                                </button>
                                <a href="{{ route('admin.program.index') }}" class="btn-secondary-custom">
                                    <i class="fas fa-times me-1"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Script: Preview Image & Auto-Slug (Opsional) --}}
    <script>
        // Preview logo sebelum upload
        document.getElementById('inputLogo').addEventListener('change', function(e) {
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
        
        // Optional: Auto-generate slug dari nama (jika backend mendukung)
        // document.getElementById('inputNama').addEventListener('input', function() {
        //     // Logic slug generation bisa ditambahkan di sini
        // });
    </script>
</body>
</html>