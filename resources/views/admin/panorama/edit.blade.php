<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Panorama - Admin SMK Negeri 11 Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #1e3c72;
            --secondary-blue: #2a5298;
            --accent-teal: #00c9b1;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --danger: #dc3545;
        }
        body { background: #f8f9fa; font-family: 'Poppins', 'Segoe UI', sans-serif; }
        .sidebar { min-height: 100vh; background: var(--primary-blue); color: white; }
        .sidebar a { color: rgba(255,255,255,0.9); text-decoration: none; padding: 12px 20px; display: block; border-radius: 8px; margin: 4px 0; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: var(--secondary-blue); color: white; }
        .sidebar .logout-btn { background: none; border: none; color: rgba(255,255,255,0.9); padding: 12px 20px; text-align: left; width: 100%; font-size: 1rem; cursor: pointer; }
        .navbar-admin { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 2rem; }
        .form-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2rem; margin-bottom: 2rem; }
        .form-label { font-weight: 600; color: var(--gray-600); margin-bottom: 0.5rem; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 0.25rem rgba(30,60,114,0.25); }
        .btn-primary-custom { background: var(--primary-blue); border: none; padding: 0.75rem 2rem; border-radius: 25px; font-weight: 600; color: white; transition: all 0.3s; }
        .btn-primary-custom:hover { background: var(--secondary-blue); transform: translateY(-2px); color: white; }
        .btn-secondary-custom { background: var(--gray-200); border: none; padding: 0.75rem 2rem; border-radius: 25px; font-weight: 600; color: var(--gray-600); transition: all 0.3s; }
        .btn-secondary-custom:hover { background: var(--gray-300); color: var(--gray-700); }
        .btn-danger-custom { background: var(--danger); border: none; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 500; color: white; transition: all 0.3s; }
        .btn-danger-custom:hover { background: #bd2130; color: white; }
        .btn-teal { background: var(--accent-teal); border: none; padding: 0.4rem 1rem; border-radius: 8px; font-weight: 500; color: white; transition: all 0.3s; }
        .btn-teal:hover { background: #00b39d; color: white; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; }
        .alert-success-custom { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .form-text { font-size: 0.85rem; color: var(--gray-600); }
        .file-size-error { color: var(--danger); font-weight: 600; display: none; margin-top: 0.5rem; }
        .file-size-error.show { display: block; }

        /* ── IMAGE HOTSPOT CANVAS ── */
        .image-canvas-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            cursor: crosshair;
            background: var(--gray-200);
            min-height: 200px;
        }
        .image-canvas-wrapper img {
            width: 100%;
            display: block;
            border-radius: 12px;
            user-select: none;
            pointer-events: none;
        }
        .canvas-placeholder {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            min-height: 220px;
            color: var(--gray-600); gap: 0.75rem;
        }
        .canvas-placeholder i { font-size: 3rem; opacity: 0.35; }

        /* hotspot pin */
        .hotspot-pin {
            position: absolute;
            transform: translate(-50%, -100%);
            cursor: pointer;
            z-index: 10;
            display: flex; flex-direction: column; align-items: center;
            transition: transform 0.15s;
        }
        .hotspot-pin:hover { transform: translate(-50%, -100%) scale(1.15); }
        .hotspot-pin .pin-head {
            width: 28px; height: 28px;
            background: var(--accent-teal);
            border: 3px solid white;
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            box-shadow: 0 2px 8px rgba(0,0,0,0.35);
            display: flex; align-items: center; justify-content: center;
        }
        .hotspot-pin .pin-head i { transform: rotate(45deg); font-size: 11px; color: white; }
        .hotspot-pin .pin-line { width: 2px; height: 6px; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.3); }
        .hotspot-pin .pin-label {
            background: rgba(0,0,0,0.75); color: white;
            font-size: 11px; padding: 2px 7px; border-radius: 4px;
            white-space: nowrap; max-width: 120px;
            overflow: hidden; text-overflow: ellipsis;
            margin-top: 3px; pointer-events: none;
        }
        .hotspot-pin .pin-remove {
            position: absolute; top: -6px; right: -6px;
            width: 16px; height: 16px;
            background: var(--danger); border-radius: 50%; border: none;
            color: white; font-size: 9px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; z-index: 20;
            opacity: 0; transition: opacity 0.2s;
        }
        .hotspot-pin:hover .pin-remove { opacity: 1; }

        .click-ripple {
            position: absolute;
            width: 30px; height: 30px;
            border: 2px solid var(--accent-teal);
            border-radius: 50%;
            transform: translate(-50%,-50%) scale(0);
            animation: ripple 0.4s ease-out forwards;
            pointer-events: none; z-index: 5;
        }
        @keyframes ripple { to { transform: translate(-50%,-50%) scale(2.5); opacity: 0; } }

        /* hotspot modal */
        .hotspot-modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none; transition: opacity 0.2s;
        }
        .hotspot-modal-overlay.show { opacity: 1; pointer-events: all; }
        .hotspot-modal {
            background: white; border-radius: 16px; padding: 1.75rem;
            width: 440px; max-width: 95vw;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            transform: translateY(20px); transition: transform 0.2s;
        }
        .hotspot-modal-overlay.show .hotspot-modal { transform: translateY(0); }
        .hotspot-modal h6 { font-weight: 700; color: var(--primary-blue); margin-bottom: 1.25rem; }
        .modal-btn-row { display: flex; gap: 0.75rem; margin-top: 1.25rem; }

        /* hotspot table */
        .hotspot-table { width: 100%; border-collapse: collapse; font-size: 0.875rem; margin-top: 0.75rem; }
        .hotspot-table th { background: var(--gray-100); padding: 8px 12px; text-align: left; font-weight: 600; color: var(--gray-700); border-bottom: 1px solid var(--gray-300); }
        .hotspot-table td { padding: 8px 12px; border-bottom: 1px solid var(--gray-200); vertical-align: middle; }
        .hotspot-table tr:last-child td { border-bottom: none; }
        .badge-hotspot { background: var(--accent-teal); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }

        .canvas-tip { font-size: 0.8rem; color: var(--gray-600); margin-top: 0.5rem; display: flex; align-items: center; gap: 0.4rem; }

        /* image replace section */
        .image-replace-toggle { font-size: 0.85rem; color: var(--primary-blue); cursor: pointer; font-weight: 600; }
        .image-replace-toggle:hover { text-decoration: underline; }
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
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Dashboard</a>
                <a href="{{ route('admin.panorama.index') }}" class="active"><i class="fas fa-images me-2"></i>Kelola Panorama</a>
                <a href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt me-2"></i>Lihat Website</a>
            </nav>
            <div class="mt-auto p-3 border-top" style="border-color:rgba(255,255,255,0.2)!important">
                <form method="POST" action="{{ route('admin.logout') }}">@csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <nav class="navbar-admin">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold" style="color:var(--primary-blue)"><i class="fas fa-edit me-2"></i>Edit Panorama</h4>
                    <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary-custom btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
                </div>
            </nav>

            <div class="p-4">
                @if(session('success'))
                    <div class="alert-custom alert-success-custom"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert-custom alert-error-custom"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert-custom alert-error-custom">
                        <i class="fas fa-exclamation-circle me-2"></i><strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <div class="form-card">
                    <form method="POST" action="{{ route('admin.panorama.update', $panorama->id) }}" enctype="multipart/form-data" id="panoramaForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $panorama->id }}">

                        <div class="row g-4">
                            <!-- Nama -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Panorama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', $panorama->name) }}" required placeholder="Contoh: Gerbang Utama">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <!-- Scene ID (readonly) -->
                            <div class="col-md-6">
                                <label class="form-label">Scene ID</label>
                                <input type="text" class="form-control" value="{{ $panorama->scene_id }}" readonly
                                       style="background:var(--gray-100);cursor:not-allowed">
                                <small class="form-text">Scene ID tidak dapat diubah setelah dibuat</small>
                            </div>
                            <!-- Tipe -->
                            <div class="col-md-6">
                                <label class="form-label">Tipe Panorama <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                                    <option value="360" {{ old('type', $panorama->type) == '360' ? 'selected' : '' }}>360° Virtual Tour</option>
                                    <option value="normal" {{ old('type', $panorama->type) == 'normal' ? 'selected' : '' }}>Gambar Normal</option>
                                </select>
                                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <!-- Order -->
                            <div class="col-md-6">
                                <label class="form-label">Urutan Tampil</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       name="order" value="{{ old('order', $panorama->order) }}" min="0">
                                @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text">Semakin kecil angka, semakin awal ditampilkan</small>
                            </div>

                            <!-- Gambar + Hotspot Canvas (gabung jadi satu area) -->
                            <div class="col-12">
                                <label class="form-label d-flex align-items-center gap-2">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Gambar &amp; Hotspots
                                    <span class="badge-hotspot" id="hotspotCount">0 item</span>
                                </label>
                                <small class="form-text d-block mb-2">
                                    <strong>Klik langsung di gambar</strong> untuk menambah hotspot. Hover pin untuk menghapus.
                                </small>

                                <!-- Canvas -->
                                <div class="image-canvas-wrapper has-image" id="imageCanvas">
                                    @if($panorama->image_path)
                                        <img src="{{ '/' . $panorama->image_path }}" id="canvasImg" alt="{{ $panorama->name }}" draggable="false">
                                    @else
                                        <div class="canvas-placeholder" id="canvasPlaceholder">
                                            <i class="fas fa-image"></i>
                                            <p>Belum ada gambar</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="canvas-tip">
                                    <i class="fas fa-info-circle" style="color:var(--accent-teal)"></i>
                                    Klik pada gambar = tambah hotspot &nbsp;|&nbsp; Hover pin = hapus
                                </div>

                                <!-- Hotspot table -->
                                <div id="hotspotTableWrapper" style="display:none; margin-top:1rem;">
                                    <table class="hotspot-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Posisi (X%, Y%)</th>
                                                <th>Teks Tooltip</th>
                                                <th>Link Scene</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="hotspotTableBody"></tbody>
                                    </table>
                                </div>

                                <!-- Hidden hotspots textarea -->
                                <textarea class="d-none" id="hotspots" name="hotspots">{{ old('hotspots', $panorama->hotspots ?? '[]') }}</textarea>
                                @error('hotspots')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror

                                <!-- Ganti gambar (collapsible) -->
                                <div class="mt-3">
                                    <span class="image-replace-toggle" id="replaceToggle">
                                        <i class="fas fa-sync me-1"></i>Ganti Gambar (opsional)
                                    </span>
                                    <div id="replaceSection" style="display:none; margin-top:0.75rem;">
                                        <input type="file" class="form-control @error('image_path') is-invalid @enderror"
                                               id="image_path" name="image_path" accept="image/*">
                                        @error('image_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="form-text">Format: JPG, PNG, JPEG. <strong>Maksimal 10 MB.</strong> Hotspot akan tetap tersimpan.</small>
                                        <div id="fileSizeError" class="file-size-error">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Ukuran file melebihi 10 MB!
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Icon -->
                            <div class="col-md-6">
                                <label class="form-label">Icon (Font Awesome)</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                       name="icon" value="{{ old('icon', $panorama->icon) }}" placeholder="fas fa-building">
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="form-text"><a href="https://fontawesome.com/icons" target="_blank">Lihat semua icon →</a></small>
                            </div>
                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $panorama->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Aktifkan panorama ini</label>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Panorama
                            </button>
                            <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary-custom">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="button" class="btn btn-danger-custom" id="deleteBtn" data-id="{{ $panorama->id }}">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DELETE form (separate) -->
<form id="deleteForm" method="POST" style="display:none">@csrf @method('DELETE')</form>

<!-- Hotspot Modal -->
<div class="hotspot-modal-overlay" id="hotspotModal">
    <div class="hotspot-modal">
        <h6><i class="fas fa-map-pin me-2" style="color:var(--accent-teal)"></i>Tambah Hotspot</h6>
        <div class="mb-3">
            <label class="form-label">Teks Tooltip <span class="text-danger">*</span></label>
            <input type="text" id="modalText" class="form-control" placeholder="Contoh: Menuju Lapangan">
        </div>
        <div class="mb-2">
            <label class="form-label">Link ke Scene (Scene ID)</label>
            <select id="modalLink" class="form-select">
                <option value="">— Tidak ada link —</option>
                {{-- List semua panorama kecuali diri sendiri --}}
                @foreach($allPanoramas ?? [] as $p)
                    @if($p->id !== $panorama->id)
                        <option value="{{ $p->scene_id }}">{{ $p->name }} ({{ $p->scene_id }})</option>
                    @endif
                @endforeach
            </select>
            <small class="form-text text-muted">Pilih panorama tujuan saat hotspot ini diklik</small>
        </div>
        <div class="modal-btn-row">
            <button class="btn btn-primary-custom btn-sm" id="modalSaveBtn"><i class="fas fa-check me-1"></i>Simpan Hotspot</button>
            <button class="btn btn-secondary-custom btn-sm" id="modalCancelBtn">Batal</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ── State: load existing hotspots ──
let hotspots = [];
let pendingX = 0, pendingY = 0;

function parseHotspots(str) {
    try { const p = JSON.parse(str); return Array.isArray(p) ? p : []; }
    catch(e) { return []; }
}

// ── Canvas click → add hotspot ──
document.getElementById('imageCanvas').addEventListener('click', function(e) {
    if (!document.getElementById('canvasImg')) return;
    // Don't trigger if clicking the remove button
    if (e.target.closest('.pin-remove')) return;

    const rect = this.getBoundingClientRect();
    const x = parseFloat(((e.clientX - rect.left) / rect.width * 100).toFixed(1));
    const y = parseFloat(((e.clientY - rect.top) / rect.height * 100).toFixed(1));
    pendingX = x; pendingY = y;

    const ripple = document.createElement('div');
    ripple.className = 'click-ripple';
    ripple.style.left = x + '%';
    ripple.style.top = y + '%';
    this.appendChild(ripple);
    setTimeout(() => ripple.remove(), 500);

    openModal();
});

// ── Modal ──
function openModal() {
    document.getElementById('modalText').value = '';
    document.getElementById('modalLink').value = '';
    document.getElementById('hotspotModal').classList.add('show');
    setTimeout(() => document.getElementById('modalText').focus(), 100);
}
function closeModal() {
    document.getElementById('hotspotModal').classList.remove('show');
}
document.getElementById('modalCancelBtn').addEventListener('click', closeModal);
document.getElementById('hotspotModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
document.getElementById('modalSaveBtn').addEventListener('click', function() {
    const text = document.getElementById('modalText').value.trim();
    if (!text) { document.getElementById('modalText').focus(); return; }
    const link = document.getElementById('modalLink').value;
    hotspots.push({ x: pendingX, y: pendingY, text, link: link || null });
    closeModal();
    renderPins();
    renderTable();
    syncJSON();
});
document.getElementById('modalText').addEventListener('keydown', e => {
    if (e.key === 'Enter') document.getElementById('modalSaveBtn').click();
});

// ── Render pins ──
function renderPins() {
    const canvas = document.getElementById('imageCanvas');
    canvas.querySelectorAll('.hotspot-pin').forEach(p => p.remove());

    hotspots.forEach((hs, i) => {
        const pin = document.createElement('div');
        pin.className = 'hotspot-pin';
        pin.style.left = hs.x + '%';
        pin.style.top = hs.y + '%';
        pin.innerHTML = `
            <button class="pin-remove" data-index="${i}" title="Hapus hotspot"><i class="fas fa-times"></i></button>
            <div class="pin-head"><i class="fas fa-map-pin"></i></div>
            <div class="pin-line"></div>
            ${hs.text ? `<div class="pin-label">${hs.text}</div>` : ''}
        `;
        pin.querySelector('.pin-remove').addEventListener('click', function(e) {
            e.stopPropagation();
            hotspots.splice(+this.dataset.index, 1);
            renderPins(); renderTable(); syncJSON();
        });
        canvas.appendChild(pin);
    });

    document.getElementById('hotspotCount').textContent = hotspots.length + ' item';
}

// ── Render table ──
function renderTable() {
    const wrapper = document.getElementById('hotspotTableWrapper');
    const tbody = document.getElementById('hotspotTableBody');
    if (hotspots.length === 0) { wrapper.style.display = 'none'; return; }
    wrapper.style.display = 'block';
    tbody.innerHTML = hotspots.map((hs, i) => `
        <tr>
            <td>${i + 1}</td>
            <td><span style="font-family:monospace;font-size:0.8rem">${hs.x}%, ${hs.y}%</span></td>
            <td>${hs.text}</td>
            <td>${hs.link
                ? `<span style="color:var(--accent-teal);font-weight:600">${hs.link}</span>`
                : '<span style="color:#aaa">—</span>'}</td>
            <td>
                <button type="button"
                    style="background:var(--danger);color:white;border:none;border-radius:6px;padding:2px 8px;cursor:pointer"
                    onclick="removeHotspot(${i})">
                    <i class="fas fa-trash" style="font-size:11px"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function removeHotspot(i) {
    hotspots.splice(i, 1);
    renderPins(); renderTable(); syncJSON();
}

function syncJSON() {
    document.getElementById('hotspots').value = JSON.stringify(hotspots);
}

// ── Replace image → refresh canvas + keep pins ──
document.getElementById('replaceToggle').addEventListener('click', function() {
    const section = document.getElementById('replaceSection');
    section.style.display = section.style.display === 'none' ? 'block' : 'none';
});

document.getElementById('image_path').addEventListener('change', function() {
    const fileSizeError = document.getElementById('fileSizeError');
    const file = this.files[0];
    fileSizeError.classList.remove('show');

    if (!file) return;
    if (file.size > 10485760) {
        fileSizeError.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i>Ukuran file (' + formatFileSize(file.size) + ') melebihi 10 MB!';
        fileSizeError.classList.add('show');
        this.value = ''; return;
    }
    const reader = new FileReader();
    reader.onload = e => {
        const canvas = document.getElementById('imageCanvas');
        // keep or create img element
        let img = document.getElementById('canvasImg');
        if (!img) {
            canvas.innerHTML = '';
            img = document.createElement('img');
            img.id = 'canvasImg';
            img.draggable = false;
            canvas.appendChild(img);
            canvas.classList.add('has-image');
        }
        img.src = e.target.result;
        renderPins(); // re-add pins on new image
    };
    reader.readAsDataURL(file);
});

function formatFileSize(bytes) {
    const k = 1024, sizes = ['Bytes','KB','MB','GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// ── Delete ──
document.getElementById('deleteBtn').addEventListener('click', function() {
    if (confirm('Yakin ingin menghapus panorama ini? Tindakan ini tidak dapat dibatalkan.')) {
        const id = this.dataset.id;
        const form = document.getElementById('deleteForm');
        form.action = `/admin/panorama/${id}`;
        form.submit();
    }
});

// ── Form submit guard ──
document.getElementById('panoramaForm').addEventListener('submit', function(e) {
    const file = document.getElementById('image_path').files[0];
    if (file && file.size > 10485760) {
        e.preventDefault();
        alert('Ukuran file gambar melebihi 10 MB.');
    }
});

// ── Init: load existing hotspots ──
document.addEventListener('DOMContentLoaded', function() {
    hotspots = parseHotspots(document.getElementById('hotspots').value);
    renderPins();
    renderTable();
});
</script>
</body>
</html>