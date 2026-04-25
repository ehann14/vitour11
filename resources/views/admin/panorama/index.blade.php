<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Panorama - Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { 
            --primary-blue: #1e3c72; 
            --secondary-blue: #2a5298; 
            --accent-teal: #00c9b1; 
        }
        
        body {
            background: #f8f9fa;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }

        .sidebar { 
            min-height: 100vh; 
            background: var(--primary-blue); 
            color: white; 
        }
        .sidebar a { 
            color: rgba(255,255,255,0.9); 
            text-decoration: none; 
            padding: 12px 20px; 
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px; 
            margin: 4px 0; 
            transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar a.active { 
            background: var(--secondary-blue); 
            color: white; 
        }
        .sidebar .logout-btn { 
            background: none; 
            border: none; 
            color: white; 
            padding: 12px 20px; 
            text-align: left; 
            width: 100%; 
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .navbar-admin { 
            background: white; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
            padding: 1rem 2rem;
            position: sticky; 
            top: 0; 
            z-index: 100;
        }
        
        .stats-row { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            gap: 1rem; 
            margin-bottom: 2rem; 
        }
        .stat-card { 
            background: white; 
            border-radius: 16px; 
            padding: 1.5rem; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            display: flex; 
            align-items: center; 
            gap: 1rem;
        }
        .stat-icon { 
            width: 50px; 
            height: 50px; 
            border-radius: 12px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .stat-icon.blue { background: rgba(30,60,114,0.15); color: var(--primary-blue); }
        .stat-icon.green { background: rgba(40,167,69,0.15); color: #28a745; }
        .stat-icon.teal { background: rgba(0,201,177,0.15); color: var(--accent-teal); }
        
        .table-card { 
            background: white; 
            border-radius: 16px; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            overflow: hidden; 
        }
        .table-card .table { margin: 0; }
        .table-card .table th { 
            background: #f8f9fa; 
            font-weight: 600; 
            color: #495057; 
            padding: 1rem; 
            font-size: 0.9rem;
        }
        .table-card .table td { 
            vertical-align: middle; 
            padding: 1rem; 
            font-size: 0.9rem;
        }
        
        .thumbnail-preview { 
            width: 100px; 
            height: 70px; 
            object-fit: cover; 
            border-radius: 8px; 
            border: 2px solid #dee2e6;
        }
        .thumbnail-placeholder {
            width: 100px; 
            height: 70px; 
            background: #e9ecef; 
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #dee2e6;
        }
        .thumbnail-placeholder i {
            font-size: 2rem;
            color: #6c757d;
        }
        
        .btn-action { 
            padding: 0.4rem 0.8rem; 
            border-radius: 6px; 
            font-size: 0.85rem; 
            margin: 0 2px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-edit { background: #17a2b8; color: white; }
        .btn-edit:hover { background: #138496; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-delete:hover { background: #bd2130; color: white; }
        
        .btn-toggle { 
            padding: 0.4rem 0.8rem; 
            border-radius: 20px; 
            font-size: 0.8rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-toggle.active { 
            background: #28a745; 
            color: white; 
        }
        .btn-toggle:not(.active) { 
            background: #6c757d; 
            color: white; 
        }
        
        .badge-360 { 
            background: rgba(0,201,177,0.15); 
            color: var(--accent-teal); 
            padding: 0.4rem 0.8rem; 
            border-radius: 20px; 
            font-size: 0.8rem;
            font-weight: 600;
        }
        .badge-normal { 
            background: rgba(30,60,114,0.15); 
            color: var(--primary-blue); 
            padding: 0.4rem 0.8rem; 
            border-radius: 20px; 
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .alert-custom { 
            border-radius: 12px; 
            padding: 1rem 1.5rem; 
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .alert-success-custom { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        
        .filter-bar { 
            background: white; 
            border-radius: 16px; 
            padding: 1.25rem 1.5rem; 
            margin-bottom: 1.5rem; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        
        .btn-primary-custom {
            background: var(--primary-blue);
            color: white;
            border-radius: 25px;
            padding: 0.6rem 1.5rem;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-primary-custom:hover {
            background: var(--secondary-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30,60,114,0.3);
        }
        
        .scene-id-badge {
            background: #6c757d;
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-family: monospace;
            display: inline-block;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 border-bottom" style="border-color:rgba(255,255,255,0.2)!important">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-graduation-cap me-2"></i>Admin SMK 11
                    </h5>
                </div>
                <nav class="mt-3 p-2">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.panorama.index') }}" class="active">
                        <i class="fas fa-images"></i>
                        <span>Kelola Panorama</span>
                    </a>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Lihat Website</span>
                    </a>
                </nav>
                <div class="mt-auto p-3 border-top" style="border-color:rgba(255,255,255,0.2)!important">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10">
                <nav class="navbar-admin">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 style="color: var(--primary-blue); margin: 0;">
                            <i class="fas fa-images me-2"></i>Kelola Panorama
                        </h4>
                        <a href="{{ route('admin.panorama.create') }}" class="btn-primary-custom">
                            <i class="fas fa-plus"></i>Tambah Baru
                        </a>
                    </div>
                </nav>
                
                <div class="p-4">
                    <!-- Alert Messages -->
                    @if(session('success'))
                    <div class="alert-custom alert-success-custom">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert-custom alert-error-custom">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="alert-custom alert-error-custom">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Stats Cards -->
                    <div class="stats-row">
                        <div class="stat-card">
                            <div class="stat-icon blue">
                                <i class="fas fa-images"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">{{ $panoramas->total() ?? 0 }}</h3>
                                <p class="text-muted mb-0">Total Panorama</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon green">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">{{ \App\Models\Panorama::where('is_active', true)->count() }}</h3>
                                <p class="text-muted mb-0">Aktif</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon teal">
                                <i class="fas fa-vr-cardboard"></i>
                            </div>
                            <div>
                                <h3 class="mb-0">{{ \App\Models\Panorama::where('type', '360')->count() }}</h3>
                                <p class="text-muted mb-0">360°</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filter Bar -->
                    <div class="filter-bar">
                        <form method="GET" action="{{ route('admin.panorama.index') }}" class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama atau scene ID..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="type" class="form-select">
                                    <option value="">Semua Tipe</option>
                                    <option value="360" {{ request('type') == '360' ? 'selected' : '' }}>360° Virtual Tour</option>
                                    <option value="normal" {{ request('type') == 'normal' ? 'selected' : '' }}>Gambar Normal</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="fas fa-filter me-1"></i>Filter
                                </button>
                                @if(request()->anyFilled(['search', 'type', 'status']))
                                <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    
                    <!-- Table -->
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th width="120">Gambar</th>
                                        <th width="250">Nama</th>
                                        <th>Scene ID</th>
                                        <th width="120">Tipe</th>
                                        <th width="120">Status</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($panoramas as $panorama)
                                    @php
                                        // ✅ FIX: Handle hotspots yang bisa berupa string JSON atau array
                                        $hotspots = $panorama->hotspots;
                                        if (is_string($hotspots)) {
                                            $hotspots = json_decode($hotspots, true) ?? [];
                                        }
                                        $hotspotsCount = is_array($hotspots) ? count($hotspots) : 0;
                                    @endphp
                                    <tr>
                                        <td>
                                            @if($panorama->image_path && file_exists(public_path($panorama->image_path)))
                                                <img src="{{ asset($panorama->image_path) }}" 
                                                     alt="{{ $panorama->name }}" 
                                                     class="thumbnail-preview"
                                                     onerror="this.parentElement.innerHTML='<div class=\'thumbnail-placeholder\'><i class=\'fas fa-image\'></i></div>'">
                                            @else
                                                <div class="thumbnail-placeholder">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold" style="color: var(--primary-blue);">{{ $panorama->name }}</div>
                                            <small class="text-muted">ID: {{ $panorama->id }} • Order: {{ $panorama->order ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <span class="scene-id-badge" title="{{ $panorama->scene_id }}">
                                                {{ $panorama->scene_id }}
                                            </span>
                                            @if($hotspotsCount > 0)
                                            <div class="mt-1">
                                                <small class="text-muted">
                                                    <i class="fas fa-map-pin" style="color:var(--accent-teal)"></i> 
                                                    {{ $hotspotsCount }} hotspot
                                                </small>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $panorama->type }}">
                                                @if($panorama->type === '360')
                                                    <i class="fas fa-vr-cardboard me-1"></i>360°
                                                @else
                                                    <i class="fas fa-image me-1"></i>Normal
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" 
                                                    class="btn-toggle {{ $panorama->is_active ? 'active' : '' }}" 
                                                    onclick="toggleStatus({{ $panorama->id }}, {{ $panorama->is_active ? 'false' : 'true' }})">
                                                @if($panorama->is_active)
                                                    <i class="fas fa-check me-1"></i>Aktif
                                                @else
                                                    <i class="fas fa-times me-1"></i>Nonaktif
                                                @endif
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('admin.panorama.edit', $panorama->id) }}" 
                                                   class="btn-action btn-edit" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" 
                                                      action="{{ route('admin.panorama.destroy', $panorama->id) }}" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('Yakin ingin menghapus panorama ini?')">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn-action btn-delete" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                            <h5 class="text-muted">Belum ada panorama</h5>
                                            <p class="text-muted mb-3">Mulai tambahkan panorama pertama Anda</p>
                                            <a href="{{ route('admin.panorama.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-2"></i>Tambah Panorama
                                            </a>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @if($panoramas->hasPages())
                        <div class="p-3 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    Menampilkan {{ $panoramas->firstItem() }} - {{ $panoramas->lastItem() }} dari {{ $panoramas->total() }}
                                </span>
                                {{ $panoramas->links() }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        async function toggleStatus(id, newStatus) {
            if (!confirm('Ubah status panorama ini?')) return;
            
            try {
                const response = await fetch(`/admin/panorama/${id}/toggle-status`, { 
                    method: 'POST', 
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }, 
                    body: JSON.stringify({ is_active: newStatus }) 
                });
                
                if (response.ok) {
                    location.reload();
                } else {
                    const data = await response.json();
                    throw new Error(data.message || 'Gagal mengubah status');
                }
            } catch (error) { 
                alert('Error: ' + error.message); 
            }
        }
    </script>
</body>
</html>