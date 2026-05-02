<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Komentar - Admin</title>
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
        .section-card { border: none; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 1.5rem; }
        .badge-status-pending { background: #ffc107; color: #000; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .badge-status-aktif { background: #28a745; color: white; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; font-weight: 500; }
        .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; margin: 0 2px; border: none; cursor: pointer; transition: 0.2s; }
        .btn-action:hover { transform: translateY(-1px); }
        .btn-approve { background: #28a745; color: white; }
        .btn-delete { background: #dc3545; color: white; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="p-3 border-bottom" style="border-color: rgba(255,255,255,0.2)!important;">
                <h5 class="mb-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i>Admin SMK 11</h5>
            </div>
            <nav class="mt-3 p-2 flex-grow-1">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Dashboard</a>
                <a href="{{ route('admin.panorama.index') }}"><i class="fas fa-images me-2"></i>Kelola Panorama</a>
                <a href="{{ route('admin.achievements.index') }}"><i class="fas fa-trophy me-2"></i>Kelola Prestasi</a>
                <a href="{{ route('admin.program.index') }}"><i class="fas fa-layer-group me-2"></i>Kelola Program</a>
                <a href="{{ route('admin.gallery.index') }}"><i class="fas fa-images me-2"></i>Kelola Galeri</a>
                <a href="{{ route('admin.comments.index') }}" class="active"><i class="fas fa-comments me-2"></i>Kelola Komentar</a>
                <a href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt me-2"></i>Lihat Website</a>
            </nav>
            <div class="p-3 border-top mt-auto" style="border-color: rgba(255,255,255,0.2)!important;">
                <form method="POST" action="{{ route('admin.logout') }}">@csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <nav class="navbar-admin">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);">
                        <i class="fas fa-comments me-2"></i>Kelola Komentar
                    </h4>
                    <div class="d-flex align-items-center gap-3">
                        <span class="text-muted">Halo, {{ Auth::user()->name ?? 'Admin' }}!</span>
                    </div>
                </div>
            </nav>

            <div class="p-4">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="section-card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Pesan</th>
                                        <th width="120">Tanggal</th>
                                        <th width="100">Status</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($comments as $comment)
                                    <tr>
                                        <td class="fw-bold">{{ $comment->id }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $comment->name }}</div>
                                        </td>
                                        <td><small class="text-muted">{{ $comment->email }}</small></td>
                                        <td>{{ Str::limit($comment->message, 80) }}</td>
                                        <td><small>{{ $comment->created_at->format('d M Y, H:i') }}</small></td>
                                        <td>
                                            @if($comment->is_approved)
                                                <span class="badge-status-aktif">Disetujui</span>
                                            @else
                                                <span class="badge-status-pending">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.comments.toggle', $comment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn-action btn-approve" title="{{ $comment->is_approved ? 'Batalkan Persetujuan' : 'Setujui' }}">
                                                    <i class="fas fa-{{ $comment->is_approved ? 'undo' : 'check' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="fas fa-comments" style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mb-0 mt-3">Belum ada komentar masuk</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($comments->hasPages())
                    <div class="p-3 border-top">
                        {{ $comments->links('pagination::bootstrap-5') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>