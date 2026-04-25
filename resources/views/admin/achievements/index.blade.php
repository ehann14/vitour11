<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Prestasi - Admin SMK Negeri 11 Bandung</title>
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
        .preview-img { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6; }
        .badge-level { font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; font-weight: 600; }
        .badge-kota { background: #10b981; color: white; }
        .badge-provinsi { background: #3b82f6; color: white; }
        .badge-nasional { background: #8b5cf6; color: white; }
        .badge-internasional { background: #ef4444; color: white; }
        .btn-action { padding: 6px 12px; border-radius: 6px; }
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
                        <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);">🏆 Kelola Prestasi</h4>
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted">Halo, {{ Auth::user()->name ?? 'Admin' }}!</span>
                            <div class="bg-teal-light rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px; font-weight: 600; background: rgba(0,201,177,0.15); color: var(--accent-teal);">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Content -->
                <div class="p-4">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Daftar Prestasi</h5>
                        <a href="{{ route('admin.achievements.create') }}" class="btn btn-primary" 
                           style="background: var(--primary-blue); border: none; border-radius: 20px;">
                            <i class="fas fa-plus me-1"></i>Tambah Prestasi
                        </a>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            @if($achievements->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Judul</th>
                                            <th>Level</th>
                                            <th>Tipe</th>
                                            <th>Siswa</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($achievements as $item)
                                        <tr>
                                            <td>
                                                @if($item->image_path)
                                                <img src="{{ asset('storage/' . $item->image_path) }}" 
                                                     alt="{{ $item->title }}" class="preview-img">
                                                @else
                                                <div class="preview-img bg-light d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $item->title }}</div>
                                                <small class="text-muted">#{{ $item->id }}</small>
                                            </td>
                                            <td>
                                                <span class="badge-level badge-{{ strtolower($item->level) }}">{{ $item->level }}</span>
                                            </td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                <div>{{ $item->student_name }}</div>
                                                @if($item->student_class)
                                                <small class="text-muted">{{ $item->student_class }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $item->date->format('d M Y') }}</td>
                                            <td>
                                                <form action="{{ route('admin.achievements.toggle-status', $item) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                        {{ $item->is_active ? '✅ Aktif' : '⏸ Nonaktif' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.achievements.edit', $item) }}" class="btn btn-outline-primary btn-action">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.achievements.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus prestasi ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-action">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">{{ $achievements->links() }}</div>
                            @else
                            <div class="text-center py-5">
                                <i class="fas fa-trophy text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                                <p class="text-muted mt-3 mb-0">Belum ada data prestasi</p>
                                <a href="{{ route('admin.achievements.create') }}" class="btn btn-primary mt-3" style="background: var(--primary-blue); border: none; border-radius: 20px;">
                                    <i class="fas fa-plus me-2"></i>Tambah Prestasi Pertama
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }, 5000);
        });
    </script>
</body>
</html>