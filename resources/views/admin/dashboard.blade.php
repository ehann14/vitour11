<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SMK Negeri 11 Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { 
            --primary-blue: #1e3c72; 
            --secondary-blue: #2a5298; 
            --accent-teal: #00c9b1; 
            --white: #ffffff;
        }
        body { 
            background: #f8f9fa; 
            font-family: 'Poppins', sans-serif; 
        }
        .sidebar { 
            min-height: 100vh; 
            background: var(--primary-blue); 
            color: white; 
            display: flex;
            flex-direction: column;
        }
        .sidebar a { 
            color: rgba(255,255,255,0.9); 
            text-decoration: none; 
            padding: 12px 20px; 
            display: block; 
            border-radius: 8px;
            margin: 4px 0;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active { 
            background: var(--secondary-blue); 
            color: white; 
        }
        .sidebar .logout-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.9);
            padding: 12px 20px;
            text-align: left;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .sidebar .logout-btn:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .stat-card { 
            border: none; 
            border-radius: 12px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
            transition: transform 0.2s; 
        }
        .stat-card:hover { 
            transform: translateY(-3px); 
        }
        .stat-icon { 
            width: 50px; 
            height: 50px; 
            border-radius: 10px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 1.5rem; 
        }
        .bg-teal-light { 
            background: rgba(0,201,177,0.15); 
            color: var(--accent-teal); 
        }
        .bg-blue-light {
            background: rgba(30,60,114,0.15);
            color: var(--primary-blue);
        }
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 1rem 2rem;
        }
        .navbar-brand-admin {
            font-weight: 700;
            color: var(--primary-blue) !important;
            font-size: 1.3rem;
        }
        .preview-thumb {
            width: 60px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            background: #f8f9fa;
            transition: transform 0.2s;
        }
        .preview-thumb:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 border-bottom" style="border-color: rgba(255,255,255,0.2) !important;">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Admin SMK 11
                    </h5>
                </div>
                <nav class="mt-3 p-2 flex-grow-1">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.panorama.index') }}" class="{{ request()->routeIs('admin.panorama.*') ? 'active' : '' }}">
                        <i class="fas fa-images me-2"></i>Kelola Panorama
                    </a>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                    </a>
                </nav>
                <div class="p-3 border-top mt-auto" style="border-color: rgba(255,255,255,0.2) !important;">
                    <!-- ✅ FIX: Ganti auth.logout → admin.logout -->
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
                        <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);">Dashboard</h4>
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted">Halo, {{ Auth::user()->name ?? 'Admin' }}!</span>
                            <div class="bg-teal-light rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px; font-weight: 600;">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Dashboard Content -->
                <div class="p-4">
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Stats Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-teal-light">
                                        <i class="fas fa-images"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0 small">Total Panorama</p>
                                        <h4 class="fw-bold mb-0">{{ $totalPanoramas ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0 small">Aktif</p>
                                        <h4 class="fw-bold mb-0">{{ $activePanoramas ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-blue-light">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0 small">Terbaru</p>
                                        <h4 class="fw-bold mb-0">{{ $recentPanoramas->count() ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Panoramas Table -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold" style="color: var(--primary-blue);">Panorama Terbaru</h5>
                            <a href="{{ route('admin.panorama.create') }}" class="btn btn-sm" 
                               style="background: var(--primary-blue); color: white; border-radius: 20px;">
                                <i class="fas fa-plus me-1"></i>Tambah Baru
                            </a>
                        </div>
                        <div class="card-body">
                            @if(isset($recentPanoramas) && $recentPanoramas->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Preview</th>
                                                <th>Nama</th>
                                                <th>Scene ID</th>
                                                <th>Tipe</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentPanoramas as $panorama)
                                            <tr>
                                                <td>
                                                    @php
                                                        $previewUrl = '/' . ($panorama->image_path ?? '');
                                                        $onErrorScript = "this.src='https://via.placeholder.com/60x40/1e3c72/ffffff?text=No+Image&font=roboto'";
                                                    @endphp
                                                    <img src="{{ $previewUrl }}" 
                                                         alt="{{ $panorama->name }}" 
                                                         class="preview-thumb"
                                                         onerror="{{ $onErrorScript }}">
                                                </td>
                                                <td>
                                                    <div class="fw-bold">{{ $panorama->name }}</div>
                                                    <small class="text-muted">#{{ $panorama->id }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        {{ $panorama->scene_id }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge" 
                                                          style="background: {{ $panorama->type == '360' ? 'var(--accent-teal)' : 'var(--primary-blue)' }}; color: white;">
                                                        {{ $panorama->type == '360' ? '360°' : 'Normal' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge" 
                                                          style="background: {{ $panorama->is_active ? '#28a745' : '#6c757d' }}; color: white;">
                                                        {{ $panorama->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('admin.panorama.edit', $panorama->id) }}" 
                                                           class="btn btn-outline-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.panorama.destroy', $panorama->id) }}" 
                                                              onsubmit="return confirm('Hapus panorama ini?')" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger">
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
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-images text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                                    <p class="text-muted mt-3 mb-0 fs-5">Belum ada panorama.</p>
                                    <a href="{{ route('admin.panorama.create') }}" 
                                       class="btn btn-primary mt-3" 
                                       style="background: var(--primary-blue); border: none; border-radius: 20px;">
                                        <i class="fas fa-plus me-2"></i>Tambah Panorama Pertama
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
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>
</html>