<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #1e3c72; --secondary-blue: #2a5298; --accent-teal: #00c9b1; --white: #ffffff; }
        body { background: #f8f9fa; font-family: 'Poppins', sans-serif; }
        
        /* ✅ FIXED SIDEBAR STYLES */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 16.666667%; /* Match col-md-2 width */
            background: var(--primary-blue);
            color: white;
            display: flex;
            flex-direction: column;
            z-index: 1030;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }
        
        /* Custom scrollbar untuk sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }

        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 4px 0; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: rgba(255,255,255,0.9); padding: 12px 20px; text-align: left; width: 100%; font-size: 1rem; cursor: pointer; transition: all 0.3s; }
        .sidebar .logout-btn:hover { background: rgba(255,255,255,0.1); color: white; }
        
        /* ✅ MAIN CONTENT ADJUSTMENT FOR FIXED SIDEBAR */
        .main-content {
            margin-left: 16.666667%; /* Match sidebar width */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .stat-card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .bg-teal-light { background: rgba(0,201,177,0.15); color: var(--accent-teal); }
        .bg-blue-light { background: rgba(30,60,114,0.15); color: var(--primary-blue); }
        .bg-gold-light { background: rgba(245,158,11,0.15); color: #f59e0b; }
        .bg-purple-light { background: rgba(139,92,246,0.15); color: #8b5cf6; }
        .bg-pink-light { background: rgba(236,72,153,0.15); color: #ec4899; }
        .bg-orange-light { background: rgba(255,159,67,0.15); color: #ff9f43; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; position: sticky; top: 0; z-index: 1020; }
        .preview-thumb { width: 60px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #dee2e6; background: #f8f9fa; transition: transform 0.2s; }
        .preview-thumb:hover { transform: scale(1.1); }
        .preview-achievement { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6; background: #f8f9fa; }
        .preview-program { width: 60px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #dee2e6; background: #f8f9fa; }
        .preview-gallery { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6; background: #f8f9fa; transition: transform 0.2s; }
        .preview-gallery:hover { transform: scale(1.1); }
        
        /* ✅ EQUAL HEIGHT CARDS */
        .section-card { 
            border: none; 
            border-radius: 16px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
            margin-bottom: 1.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .section-card .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        .section-card .table-responsive {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .section-card table {
            margin-bottom: 0;
        }
        
        .section-header { 
            background: white; 
            border-radius: 16px 16px 0 0; 
            padding: 1rem 1.5rem; 
            border-bottom: 1px solid #eee; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        .section-header h5 { margin: 0; color: var(--primary-blue); font-weight: 700; }
        .badge-status-aktif { background: #28a745; color: white; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .badge-status-nonaktif { background: #6c757d; color: white; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .badge-status-pending { background: #ffc107; color: #000; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .empty-state { text-align: center; padding: 3rem 1rem; color: #6c757d; }
        .empty-state i { font-size: 3rem; opacity: 0.3; margin-bottom: 1rem; display: block; }
        .comment-preview { max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .comment-avatar { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 600; background: rgba(236,72,153,0.15); color: #ec4899; }
        
        /* ✅ ROW EQUAL HEIGHT */
        .row-equal-height {
            display: flex;
            flex-wrap: wrap;
        }
        .row-equal-height > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }

        /* Gallery Grid for Full Width Section */
        .gallery-grid-dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
        }
        .gallery-item-dashboard {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .gallery-item-dashboard:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .gallery-item-dashboard img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        .gallery-item-dashboard .gallery-info {
            padding: 12px;
        }
        .gallery-item-dashboard .gallery-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--primary-blue);
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .gallery-item-dashboard .gallery-category {
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        /* ✅ RESPONSIVE: Mobile Sidebar Toggle */
        @media (max-width: 767px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar-toggle-btn {
                display: block !important;
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 1025;
            }
            .overlay.show {
                display: block;
            }
        }
        @media (min-width: 768px) {
            .sidebar-toggle-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- ✅ Overlay untuk mobile -->
    <div class="overlay" id="sidebarOverlay"></div>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- ✅ Sidebar (Fixed) -->
            <div class="sidebar p-0">
                <div class="p-3 border-bottom d-flex align-items-center justify-content-between" style="border-color: rgba(255,255,255,0.2) !important;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i>Admin SMK 11</h5>
                    <!-- Toggle button untuk mobile -->
                    <button class="btn btn-sm btn-link text-white d-md-none sidebar-toggle-btn" id="sidebarCloseBtn">
                        <i class="fas fa-times"></i>
                    </button>
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

            <!-- ✅ Main Content (Dengan margin kiri untuk sidebar) -->
            <div class="main-content col-md-10">
                <!-- Top Navbar -->
                <nav class="navbar-admin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <!-- ✅ Toggle button untuk mobile -->
                            <button class="btn btn-sm btn-outline-primary d-md-none sidebar-toggle-btn" id="sidebarToggleBtn">
                                <i class="fas fa-bars"></i>
                            </button>
                            <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);">📊 Dashboard</h4>
                        </div>
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

                    <!-- Stats Cards (6 Cards) -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-2 col-sm-4">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-teal-light"><i class="fas fa-images"></i></div>
                                    <div><p class="text-muted mb-0 small">Panorama</p><h4 class="fw-bold mb-0">{{ $totalPanoramas ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle"></i></div>
                                    <div><p class="text-muted mb-0 small">Aktif</p><h4 class="fw-bold mb-0">{{ $activePanoramas ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-gold-light"><i class="fas fa-trophy"></i></div>
                                    <div><p class="text-muted mb-0 small">Prestasi</p><h4 class="fw-bold mb-0">{{ $totalAchievements ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-purple-light"><i class="fas fa-layer-group"></i></div>
                                    <div><p class="text-muted mb-0 small">Program</p><h4 class="fw-bold mb-0">{{ $totalPrograms ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <div class="card stat-card p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stat-icon bg-orange-light"><i class="fas fa-images"></i></div>
                                    <div><p class="text-muted mb-0 small">Galeri</p><h4 class="fw-bold mb-0">{{ $totalGalleries ?? 0 }}</h4></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <a href="{{ route('admin.comments.index') }}" class="text-decoration-none">
                                <div class="card stat-card p-3 border-warning">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="stat-icon bg-pink-light"><i class="fas fa-comments"></i></div>
                                        <div>
                                            <p class="text-muted mb-0 small">Pending</p>
                                            <h4 class="fw-bold mb-0 text-warning">{{ $pendingCommentsCount ?? 0 }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Three Columns: Panorama, Achievements, Programs (EQUAL HEIGHT) -->
                    <div class="row g-4 row-equal-height">
                        
                        <!-- Column 1: Recent Panoramas -->
                        <div class="col-lg-4 col-md-6">
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
                                                        <div class="fw-bold text-truncate" style="max-width: 90px;" title="{{ $panorama->name }}">{{ $panorama->name }}</div>
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
                                    <div class="empty-state py-3">
                                        <i class="fas fa-images"></i>
                                        <p class="mb-0 small">Belum ada panorama</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Recent Achievements -->
                        <div class="col-lg-4 col-md-6">
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
                                                        <div class="fw-bold text-truncate" style="max-width: 90px;" title="{{ $achievement->title }}">{{ $achievement->title }}</div>
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
                                    <div class="empty-state py-3">
                                        <i class="fas fa-trophy"></i>
                                        <p class="mb-0 small">Belum ada prestasi</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Recent Programs -->
                        <div class="col-lg-4 col-md-6">
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
                                                        <div class="fw-bold text-truncate" style="max-width: 90px;" title="{{ $program->nama }}">{{ $program->nama }}</div>
                                                        <small class="text-muted" style="font-size:0.75rem">{{ $program->singkatan }}</small>
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
                                    <div class="empty-state py-3">
                                        <i class="fas fa-layer-group"></i>
                                        <p class="mb-0 small">Belum ada program</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- ✅ Comments Section - Full Width -->
                    <div class="row g-4 mt-2">
                        <div class="col-12">
                            <div class="section-card">
                                <div class="section-header">
                                    <h5><i class="fas fa-comments me-2"></i>Komentar Terbaru (Menunggu Persetujuan)</h5>
                                    <a href="{{ route('admin.comments.index') }}" class="btn btn-sm" style="background: #ec4899; color: white; border-radius: 20px;">
                                        <i class="fas fa-list me-1"></i>Lihat Semua
                                    </a>
                                </div>
                                <div class="card-body p-0">
                                    @if(isset($pendingComments) && $pendingComments->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="50">Avatar</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Pesan</th>
                                                    <th width="150">Tanggal</th>
                                                    <th width="80">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendingComments->take(5) as $comment)
                                                <tr>
                                                    <td>
                                                        <div class="comment-avatar">
                                                            {{ strtoupper(substr($comment->name, 0, 1)) }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="fw-bold">{{ $comment->name }}</div>
                                                    </td>
                                                    <td>
                                                        <small class="text-muted">{{ $comment->email }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="comment-preview" title="{{ $comment->message }}">{{ $comment->message }}</div>
                                                    </td>
                                                    <td>
                                                        <small class="text-muted">{{ $comment->created_at->format('d M Y, H:i') }}</small>
                                                        <br>
                                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $comment->created_at->diffForHumans() }}</small>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.comments.toggle', $comment->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success py-0 px-2" title="Setujui">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus komentar ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger py-0 px-2" title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="empty-state py-4">
                                        <i class="fas fa-comments"></i>
                                        <p class="mb-0">Tidak ada komentar yang menunggu persetujuan</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ✅ Gallery Section - Full Width Below Comments (5 Terbaru) -->
                    <div class="row g-4 mt-2">
                        <div class="col-12">
                            <div class="section-card">
                                <div class="section-header">
                                    <h5><i class="fas fa-images me-2"></i>Galeri Terbaru (5 Foto)</h5>
                                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm" style="background: #ff9f43; color: white; border-radius: 20px;">
                                        <i class="fas fa-plus me-1"></i>Tambah Galeri
                                    </a>
                                </div>
                                <div class="card-body p-0">
                                    @if(isset($recentGalleries) && $recentGalleries->count() > 0)
                                    <div class="gallery-grid-dashboard">
                                        @foreach($recentGalleries->take(5) as $gallery)
                                        <div class="gallery-item-dashboard">
                                            @if($gallery->image)
                                                <img src="{{ asset('storage/' . $gallery->image) }}" 
                                                     alt="{{ $gallery->title }}"
                                                     onerror="this.src='https://via.placeholder.com/200x120/1e3c72/ffffff?text=No+Image'">
                                            @else
                                                <img src="https://via.placeholder.com/200x120/1e3c72/ffffff?text=No+Image" alt="No Image">
                                            @endif
                                            
                                            <div class="gallery-info">
                                                <div class="gallery-title">{{ $gallery->title }}</div>
                                                <div class="gallery-category">
                                                    <i class="fas fa-tag me-1"></i>{{ $gallery->category ?? 'Umum' }}
                                                    @if($gallery->is_active)
                                                    <span class="badge-status-aktif ms-2">Aktif</span>
                                                    @else
                                                    <span class="badge-status-nonaktif ms-2">Nonaktif</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class="empty-state py-4">
                                        <i class="fas fa-images"></i>
                                        <p class="mb-0">Belum ada galeri</p>
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
            // Auto close alert after 5 seconds
            document.querySelectorAll('.alert').forEach(alert => {
                setTimeout(() => { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }, 5000);
            });

            // ✅ Sidebar Toggle untuk Mobile
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const closeBtn = document.getElementById('sidebarCloseBtn');

            function toggleSidebar() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
                document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
            }

            if(toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
            if(closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            if(overlay) overlay.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking a link on mobile
            document.querySelectorAll('.sidebar a').forEach(link => {
                link.addEventListener('click', () => {
                    if(window.innerWidth < 768 && sidebar.classList.contains('show')) {
                        toggleSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                if(window.innerWidth >= 768) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>
</html>