<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Konsentrasi - Admin</title>
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
        .table-card { background: white; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); overflow: hidden; }
        .table-card .table { margin: 0; }
        .table-card .table th { background: #f8f9fa; font-weight: 600; color: #495057; padding: 1rem; }
        .table-card .table td { vertical-align: middle; padding: 1rem; }
        .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; margin: 0 2px; border: none; cursor: pointer; }
        .btn-edit { background: #17a2b8; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .badge-aktif { background: #28a745; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; }
        .badge-nonaktif { background: #6c757d; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; }
        .alert-success-custom { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .btn-primary-custom { background: var(--primary-blue); color: white; border-radius: 25px; padding: 0.6rem 1.5rem; border: none; display: inline-flex; align-items: center; gap: 0.5rem; }
        .btn-primary-custom:hover { background: var(--secondary-blue); color: white; }
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
                    <a href="{{ route('admin.program.index') }}"><i class="fas fa-layer-group"></i><span>Kelola Program</span></a>
                    <a href="{{ route('admin.konsentrasi.index') }}" class="{{ request()->routeIs('admin.konsentrasi.*') ? 'active' : '' }}"><i class="fas fa-sitemap"></i><span>Kelola Konsentrasi</span></a>
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
                        <h4 style="color: var(--primary-blue); margin: 0;"><i class="fas fa-sitemap me-2"></i>Kelola Konsentrasi Keahlian</h4>
                        <a href="{{ route('admin.konsentrasi.create') }}" class="btn-primary-custom"><i class="fas fa-plus"></i>Tambah Baru</a>
                    </div>
                </nav>
                
                <div class="p-4">
                    @if(session('success'))
                    <div class="alert-custom alert-success-custom"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span></div>
                    @endif
                    @if($errors->any())
                    <div class="alert-custom alert-error-custom"><i class="fas fa-exclamation-triangle"></i><div><strong>Error:</strong><ul class="mb-0 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>
                    @endif
                    
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama Konsentrasi</th>
                                        <th>Program Induk</th>
                                        <th width="100">Status</th>
                                        <th width="120">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($konsentrasi as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $item->nama }}</div>
                                            <small class="text-muted">#{{ $item->id }}</small>
                                        </td>
                                        <td>{{ $item->program->nama ?? '-' }}</td>
                                        <td>
                                            @if($item->is_active)<span class="badge-aktif">Aktif</span>@else<span class="badge-nonaktif">Nonaktif</span>@endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('admin.konsentrasi.edit', $item) }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.konsentrasi.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus konsentrasi ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center py-5 text-muted"><i class="fas fa-sitemap fa-3x mb-3 d-block opacity-25"></i>Belum ada konsentrasi keahlian<br><a href="{{ route('admin.konsentrasi.create') }}" class="btn btn-sm btn-primary mt-3">Tambah Pertama</a></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.alert-custom').forEach(alert => {
            setTimeout(() => { alert.style.opacity = '0'; setTimeout(() => alert.remove(), 300); }, 5000);
        });
    </script>
</body>
</html>