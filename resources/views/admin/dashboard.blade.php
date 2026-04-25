<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - SMK Negeri 11 Bandung</title>
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
        .stat-card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .bg-teal-light { background: rgba(0,201,177,0.15); color: var(--accent-teal); }
        .bg-blue-light { background: rgba(30,60,114,0.15); color: var(--primary-blue); }
        .bg-gold-light { background: rgba(245,158,11,0.15); color: #f59e0b; }
        .bg-purple-light { background: rgba(139,92,246,0.15); color: #8b5cf6; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; }
        .preview-thumb { width: 60px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #dee2e6; background: #f8f9fa; transition: transform 0.2s; }
        .preview-thumb:hover { transform: scale(1.1); }
        .preview-achievement { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6; background: #f8f9fa; }
        .preview-program { width: 60px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #dee2e6; background: #f8f9fa; }
        .section-card { border: none; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 1.5rem; }
        .section-header { background: white; border-radius: 16px 16px 0 0; padding: 1rem 1.5rem; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .section-header h5 { margin: 0; color: var(--primary-blue); font-weight: 700; }
        .badge-level { font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; font-weight: 600; }
        .badge-kota { background: #10b981; color: white; }
        .badge-provinsi { background: #3b82f6; color: white; }
        .badge-nasional { background: #8b5cf6; color: white; }
        .badge-internasional { background: #ef4444; color: white; }
        .badge-status-aktif { background: #28a745; color: white; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .badge-status-nonaktif { background: #6c757d; color: white; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .empty-state { text-align: center; padding: 3rem 1rem; color: #6c757d; }
        .empty-state i { font-size: 3rem; opacity: 0.3; margin-bottom: 1rem; display: block; }
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
                    <!-- ✅ BARU: Menu Program & Konsentrasi -->
                    <a href="{{ route('admin.program.index') }}" class="{{ request()->routeIs('admin.program.*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group me-2"></i>Kelola Program
                    </a>
                    <a href="{{ route('admin.konsentrasi.index') }}" class="{{ request()->routeIs('admin.konsentrasi.*') ? 'active' : '' }}">
                        <i class="fas fa-sitemap me-2"></i>Kelola Konsentrasi
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
                <!-- Top Navbar -->
                <nav class="navbar-admin">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);">📊 Dashboard</h4>
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted">Halo, {{ Auth::user()->name ?? 'Admin' }}!</span>
                            <div class="bg-teal-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 600;">
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

                    <!-- Stats Cards (6 Cards - 2 Rows) -->
                    <div class="row g-3 mb-4">
                        <!-- Row 1: Panorama & Achievements -->
                        <div class="col-md-2">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-teal-light"><i class="fas fa-images"></i></div>
                                    <div><p class="text-muted mb-0 small">Total Panorama</p><h4 class="fw-bold mb-0">{{ $totalPanoramas ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle"></i></div>
                                    <div><p class="text-muted mb-0 small">Panorama Aktif</p><h4 class="fw-bold mb-0">{{ $activePanoramas ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-gold-light"><i class="fas fa-trophy"></i></div>
                                    <div><p class="text-muted mb-0 small">Total Prestasi</p><h4 class="fw-bold mb-0">{{ $totalAchievements ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-medal"></i></div>
                                    <div><p class="text-muted mb-0 small">Prestasi Aktif</p><h4 class="fw-bold mb-0">{{ $activeAchievements ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <!-- Row 2: Program & Konsentrasi (BARU) -->
                        <div class="col-md-2">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-purple-light"><i class="fas fa-layer-group"></i></div>
                                    <div><p class="text-muted mb-0 small">Total Program</p><h4 class="fw-bold mb-0">{{ $totalPrograms ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-purple-light"><i class="fas fa-sitemap"></i></div>
                                    <div><p class="text-muted mb-0 small">Total Konsentrasi</p><h4 class="fw-bold mb-0">{{ $totalKonsentrasi ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Three Columns: Panorama, Achievements, Programs -->
                    <div class="row g-4">
                        
                        <!-- Column 1: Recent Panoramas -->
                        <div class="col-lg-4">
                            <div class="section-card">
                                <div class="section-header">
                                    <h5><i class="fas fa-images me-2"></i>Panorama</h5>
                                    <a href="{{ route('admin.panorama.create') }}" class="btn btn-sm" style="background: var(--primary-blue); color: white; border-radius: 20px;">
                                        <i class="fas fa-plus me-1"></i>Tambah
                                    </a>
                                </div>
                                <div class="card-body p-0">
                                    @if(isset($recentPanoramas) && $recentPanoramas->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="70">Preview</th>
                                                    <th>Nama</th>
                                                    <th width="60">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentPanoramas->take(4) as $panorama)
                                                <tr>
                                                    <td>
                                                        @php $previewUrl = $panorama->image_path ? asset($panorama->image_path) : 'https://via.placeholder.com/60x40/1e3c72/ffffff?text=No+Image'; @endphp
                                                        <img src="{{ $previewUrl }}" alt="{{ $panorama->name }}" class="preview-thumb" onerror="this.src='https://via.placeholder.com/60x40/1e3c72/ffffff?text=No+Image'">
                                                    </td>
                                                    <td>
                                                        <div class="fw-bold text-truncate" style="max-width: 120px;" title="{{ $panorama->name }}">{{ $panorama->name }}</div>
                                                    </td>
                                                    <td>
                                                        @if($panorama->is_active)<span class="badge-status-aktif">Aktif</span>@else<span class="badge-status-nonaktif">Nonaktif</span>@endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="empty-state">
                                        <i class="fas fa-images"></i>
                                        <p class="mb-0">Belum ada panorama</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Recent Achievements -->
                        <div class="col-lg-4">
                            <div class="section-card">
                                <div class="section-header">
                                    <h5><i class="fas fa-trophy me-2"></i>Prestasi</h5>
                                    <a href="{{ route('admin.achievements.create') }}" class="btn btn-sm" style="background: #f59e0b; color: white; border-radius: 20px;">
                                        <i class="fas fa-plus me-1"></i>Tambah
                                    </a>
                                </div>
                                <div class="card-body p-0">
                                    @if(isset($recentAchievements) && $recentAchievements->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="70">Foto</th>
                                                    <th>Judul</th>
                                                    <th width="60">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentAchievements->take(4) as $achievement)
                                                <tr>
                                                    <td>
                                                        @if($achievement->image_path)
                                                        <img src="{{ asset('storage/' . $achievement->image_path) }}" alt="{{ $achievement->title }}" class="preview-achievement">
                                                        @else
                                                        <div class="preview-achievement d-flex align-items-center justify-content-center bg-light"><i class="fas fa-trophy text-muted"></i></div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="fw-bold text-truncate" style="max-width: 120px;" title="{{ $achievement->title }}">{{ $achievement->title }}</div>
                                                    </td>
                                                    <td>
                                                        @if($achievement->is_active)<span class="badge-status-aktif">Aktif</span>@else<span class="badge-status-nonaktif">Nonaktif</span>@endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="empty-state">
                                        <i class="fas fa-trophy"></i>
                                        <p class="mb-0">Belum ada prestasi</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Recent Programs (BARU) -->
                        <div class="col-lg-4">
                            <div class="section-card">
                                <div class="section-header">
                                    <h5><i class="fas fa-layer-group me-2"></i>Program</h5>
                                    <a href="{{ route('admin.program.create') }}" class="btn btn-sm" style="background: #8b5cf6; color: white; border-radius: 20px;">
                                        <i class="fas fa-plus me-1"></i>Tambah
                                    </a>
                                </div>
                                <div class="card-body p-0">
                                    @if(isset($recentPrograms) && $recentPrograms->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="70">Logo</th>
                                                    <th>Nama</th>
                                                    <th width="60">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentPrograms->take(4) as $program)
                                                <tr>
                                                    <td>
                                                        @if($program->logo)
                                                        <img src="{{ asset('storage/' . $program->logo) }}" alt="{{ $program->nama }}" class="preview-program">
                                                        @else
                                                        <div class="preview-program d-flex align-items-center justify-content-center bg-light"><i class="fas fa-layer-group text-muted"></i></div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="fw-bold text-truncate" style="max-width: 120px;" title="{{ $program->nama }}">{{ $program->nama }}</div>
                                                        <small class="text-muted">{{ $program->singkatan }}</small>
                                                    </td>
                                                    <td>
                                                        @if($program->is_active)<span class="badge-status-aktif">Aktif</span>@else<span class="badge-status-nonaktif">Nonaktif</span>@endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="empty-state">
                                        <i class="fas fa-layer-group"></i>
                                        <p class="mb-0">Belum ada program</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.alert').forEach(alert => {
                setTimeout(() => { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }, 5000);
            });
        });
    </script>
</body>
</html>