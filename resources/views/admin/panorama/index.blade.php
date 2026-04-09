<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Panorama - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-blue: #1e3c72; --secondary-blue: #2a5298; --accent-teal: #00c9b1; }
        body { background: #f8f9fa; font-family: 'Poppins', sans-serif; }
        .sidebar { min-height: 100vh; background: var(--primary-blue); color: white; }
        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 4px 0; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: white; padding: 12px 20px; text-align: left; width: 100%; cursor: pointer; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; position: sticky; top: 0; z-index: 100; }
        .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: white; border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .stat-icon.blue { background: rgba(30,60,114,0.15); color: var(--primary-blue); }
        .stat-icon.green { background: rgba(40,167,69,0.15); color: #28a745; }
        .stat-icon.teal { background: rgba(0,201,177,0.15); color: var(--accent-teal); }
        .table-card { background: white; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); overflow: hidden; }
        .table-card .table { margin: 0; }
        .table-card .table th { background: #f8f9fa; font-weight: 600; color: #495057; padding: 1rem; }
        .table-card .table td { vertical-align: middle; padding: 1rem; }
        .thumbnail-preview { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; background: #e9ecef; border: 1px solid #dee2e6; }
        .btn-action { padding: 0.35rem 0.75rem; border-radius: 8px; font-size: 0.85rem; margin: 0 2px; }
        .btn-edit { background: #17a2b8; color: white; border: none; }
        .btn-edit:hover { background: #138496; color: white; }
        .btn-delete { background: #dc3545; color: white; border: none; }
        .btn-delete:hover { background: #bd2130; color: white; }
        .btn-toggle { background: #e9ecef; color: #6c757d; border: none; padding: 0.25rem 0.6rem; border-radius: 20px; font-size: 0.75rem; }
        .btn-toggle.active { background: #28a745; color: white; }
        .badge-360 { background: rgba(0,201,177,0.15); color: var(--accent-teal); padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.75rem; }
        .badge-normal { background: rgba(30,60,114,0.15); color: var(--primary-blue); padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.75rem; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; }
        .alert-success-custom { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .bulk-actions { display: none; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; background: rgba(30,60,114,0.05); border-radius: 10px; margin-bottom: 1rem; }
        .bulk-actions.show { display: flex; }
        .filter-bar { background: white; border-radius: 16px; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.08); display: flex; flex-wrap: wrap; gap: 1rem; }
        .filter-bar .form-control, .filter-bar .form-select { max-width: 250px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 border-bottom"><h5 class="mb-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i>Admin SMK 11</h5></div>
                <nav class="mt-3 p-2">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Dashboard</a>
                    <a href="{{ route('admin.panorama.index') }}" class="active"><i class="fas fa-images me-2"></i>Kelola Panorama</a>
                    <a href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt me-2"></i>Lihat Website</a>
                </nav>
                <div class="mt-auto p-3 border-top"><form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt me-2"></i>Logout</button></form></div>
            </div>
            <div class="col-md-10">
                <nav class="navbar-admin">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);"><i class="fas fa-images me-2"></i>Kelola Panorama</h4>
                        <a href="{{ route('admin.panorama.create') }}" class="btn" style="background: var(--primary-blue); color: white; border-radius: 25px; padding: 0.5rem 1.5rem;"><i class="fas fa-plus me-1"></i>Tambah Baru</a>
                    </div>
                </nav>
                <div class="p-4">
                    @if(session('success'))<div class="alert-custom alert-success-custom"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>@endif
                    @if(session('error'))<div class="alert-custom alert-error-custom"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}</div>@endif
                    <div class="stats-row">
                        <div class="stat-card"><div class="stat-icon blue"><i class="fas fa-images"></i></div><div><h3>{{ $panoramas->total() ?? 0 }}</h3><p class="text-muted mb-0">Total</p></div></div>
                        <div class="stat-card"><div class="stat-icon green"><i class="fas fa-check-circle"></i></div><div><h3>{{ \App\Models\Panorama::where('is_active', true)->count() }}</h3><p class="text-muted mb-0">Aktif</p></div></div>
                        <div class="stat-card"><div class="stat-icon teal"><i class="fas fa-vr-cardboard"></i></div><div><h3>{{ \App\Models\Panorama::where('type', '360')->count() }}</h3><p class="text-muted mb-0">360°</p></div></div>
                    </div>
                    <div class="filter-bar">
                        <form method="GET" action="{{ route('admin.panorama.index') }}" class="d-flex flex-wrap gap-2 w-100">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari..." value="{{ request('search') }}">
                            <select name="type" class="form-select form-select-sm"><option value="">Semua Tipe</option><option value="360" {{ request('type') == '360' ? 'selected' : '' }}>360°</option><option value="normal" {{ request('type') == 'normal' ? 'selected' : '' }}>Normal</option></select>
                            <button type="submit" class="btn btn-sm" style="background: var(--primary-blue); color: white;"><i class="fas fa-filter me-1"></i>Filter</button>
                            @if(request()->anyFilled(['search', 'type']))<a href="{{ route('admin.panorama.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-times me-1"></i>Reset</a>@endif
                        </form>
                    </div>
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead><tr><th width="80">Gambar</th><th>Nama</th><th>Scene ID</th><th>Tipe</th><th>Status</th><th width="120">Aksi</th></tr></thead>
                                <tbody>
                                    @forelse($panoramas as $panorama)
                                    <tr>
                                        <td>
                                            @if($panorama->image_path)
                                                {{-- ✅ FIX: Pakai path langsung /panoramas/ + basename() --}}
                                                @php
                                                    $fileName = basename(str_replace('storage/', '', $panorama->image_path));
                                                @endphp
                                                <img src="/panoramas/{{ $fileName }}" alt="{{ $panorama->name }}" class="thumbnail-preview">
                                            @else
                                                <div class="thumbnail-preview d-flex align-items-center justify-content-center"><i class="fas fa-image text-muted"></i></div>
                                            @endif
                                        </td>
                                        <td><div class="fw-semibold">{{ $panorama->name }}</div><small class="text-muted">#{{ $panorama->id }}</small></td>
                                        <td><span class="badge bg-secondary">{{ $panorama->scene_id }}</span></td>
                                        <td><span class="badge badge-{{ $panorama->type == '360' ? '360' : 'normal' }}">{{ $panorama->type == '360' ? '360°' : 'Normal' }}</span></td>
                                        <td><button type="button" class="btn-toggle {{ $panorama->is_active ? 'active' : '' }}" onclick="toggleStatus({{ $panorama->id }}, {{ $panorama->is_active ? 'false' : 'true' }})">{{ $panorama->is_active ? '✓ Aktif' : '✗ Nonaktif' }}</button></td>
                                        <td>
                                            <a href="{{ route('admin.panorama.edit', $panorama->id) }}" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{ route('admin.panorama.destroy', $panorama->id) }}" class="d-inline" onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i></button></form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada panorama</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($panoramas->hasPages())<div class="p-3">{{ $panoramas->links() }}</div>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        async function toggleStatus(id, newStatus) {
            if (!confirm('Ubah status?')) return;
            try {
                const response = await fetch(`/admin/panorama/${id}/toggle-status`, { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken }, body: JSON.stringify({ is_active: newStatus }) });
                if (response.ok) location.reload();
            } catch (error) { alert('Gagal mengubah status'); }
        }
    </script>
</body>
</html>