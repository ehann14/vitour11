<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Galeri - Admin</title>
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
        .section-card { border: none; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 1.5rem; overflow: hidden; background: white; }
        .section-card .table { margin: 0; }
        .section-card .table th { background: #f8f9fa; font-weight: 600; color: #495057; padding: 1rem; border-bottom: 1px solid #dee2e6; }
        .section-card .table td { vertical-align: middle; padding: 1rem; }
        .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; margin: 0 2px; border: none; cursor: pointer; transition: 0.2s; }
        .btn-action:hover { transform: translateY(-1px); }
        .btn-edit { background: #17a2b8; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-toggle { background: #6c757d; color: white; }
        .btn-toggle.active { background: #28a745; }
        .badge-status-aktif { background: #28a745; color: white; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .badge-status-nonaktif { background: #6c757d; color: white; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .btn-primary-custom { background: var(--primary-blue); color: white; border-radius: 25px; padding: 0.6rem 1.5rem; border: none; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; transition: 0.3s; }
        .btn-primary-custom:hover { background: var(--secondary-blue); color: white; }
        .preview-img { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #dee2e6; background: #f8f9fa; transition: transform 0.2s; }
        .preview-img:hover { transform: scale(1.1); }
        .empty-state { text-align: center; padding: 3rem 1rem; color: #6c757d; }
        .empty-state i { font-size: 3rem; opacity: 0.3; margin-bottom: 1rem; display: block; }
        .pagination { gap: 6px; }
        .pagination .page-item .page-link { min-width: 38px; height: 38px; border-radius: 8px; border: 1px solid #dee2e6; display: flex; align-items: center; justify-content: center; color: var(--primary-blue); font-weight: 500; transition: 0.2s; padding: 0 12px; background: white; }
        .pagination .page-item .page-link:hover { background: #f1f3f5; color: var(--secondary-blue); }
        .pagination .page-item.active .page-link { background: var(--primary-blue); border-color: var(--primary-blue); color: white; }
        .pagination .page-item.disabled .page-link { opacity: 0.5; cursor: not-allowed; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- ✅ SIDEBAR KONSISTEN (SEMUA HALAMA SAMA) -->
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

        <!-- Main Content -->
        <div class="col-md-10">
            <nav class="navbar-admin">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);"><i class="fas fa-images me-2"></i>Kelola Galeri</h4>
                    <a href="{{ route('admin.gallery.create') }}" class="btn-primary-custom"><i class="fas fa-plus"></i>Tambah Baru</a>
                </div>
            </nav>
            <div class="p-4">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                <div class="section-card">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="90">Preview</th>
                                    <th>Judul Galeri</th>
                                    <th width="120">Kategori</th>
                                    <th width="80">Urutan</th>
                                    <th width="100">Status</th>
                                    <th width="140">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($galleries as $item)
                                <tr>
                                    <td>
                                        @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="preview-img">
                                        @else
                                        <div class="preview-img d-flex align-items-center justify-content-center bg-light"><i class="fas fa-image text-muted"></i></div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $item->title ?? 'Tanpa Judul' }}</div>
                                        @if($item->description)<small class="text-muted">{{ Str::limit($item->description, 40) }}</small>@endif
                                    </td>
                                    <td>@if($item->category)<span class="badge bg-secondary">{{ ucfirst($item->category) }}</span>@else<span class="text-muted">-</span>@endif</td>
                                    <td class="text-center fw-bold">{{ $item->urutan ?? 0 }}</td>
                                    <td>@if($item->is_active)<span class="badge-status-aktif">Aktif</span>@else<span class="badge-status-nonaktif">Nonaktif</span>@endif</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.gallery.edit', $item) }}" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.gallery.toggle-status', $item) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn-action btn-toggle {{ $item->is_active ? 'active' : '' }}" title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    <i class="fas fa-toggle-{{ $item->is_active ? 'on' : 'off' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus galeri ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-images"></i>
                                        <p class="mb-0">Belum ada data galeri</p>
                                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm mt-3">Tambah Pertama</a>
                                    </div>
                                </td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($galleries->hasPages())
                <div class="d-flex justify-content-center mt-4">{{ $galleries->onEachSide(1)->links('pagination::bootstrap-5') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => { const bsAlert = new bootstrap.Alert(alert); bsAlert.close(); }, 5000);
    });
});
</script>
</body>
</html>