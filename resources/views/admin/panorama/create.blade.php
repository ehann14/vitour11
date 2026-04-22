<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Panorama - Admin SMK Negeri 11 Bandung</title>
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
        .btn-teal { background: var(--accent-teal); border: none; padding: 0.4rem 1rem; border-radius: 8px; font-weight: 500; color: white; transition: all 0.3s; }
        .btn-teal:hover { background: #00b39d; color: white; }
        .alert-custom { border-radius: 12px; padding: 1rem 1.5rem; margin-bottom: 1.5rem; }
        .alert-error-custom { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }

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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 220px;
            color: var(--gray-600);
            gap: 0.75rem;
        }
        .canvas-placeholder i { font-size: 3rem; opacity: 0.35; }
        .canvas-placeholder p { margin: 0; font-size: 0.9rem; }

        /* hotspot pin */
        .hotspot-pin {
            position: absolute;
            transform: translate(-50%, -100%);
            cursor: pointer;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
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
        .hotspot-pin .pin-head i {
            transform: rotate(45deg);
            font-size: 11px;
            color: white;
        }
        .hotspot-pin .pin-line {
            width: 2px; height: 6px;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }
        .hotspot-pin .pin-label {
            background: rgba(0,0,0,0.75);
            color: white;
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 4px;
            white-space: nowrap;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 3px;
            pointer-events: none;
        }
        .hotspot-pin .pin-remove {
            position: absolute;
            top: -6px; right: -6px;
            width: 16px; height: 16px;
            background: var(--danger);
            border-radius: 50%;
            border: none;
            color: white;
            font-size: 9px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            z-index: 20;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .hotspot-pin:hover .pin-remove { opacity: 1; }
        .image-canvas-wrapper.has-image { cursor: crosshair; }
        .image-canvas-wrapper.no-image { cursor: default; }

        /* click ripple */
        .click-ripple {
            position: absolute;
            width: 30px; height: 30px;
            border: 2px solid var(--accent-teal);
            border-radius: 50%;
            transform: translate(-50%,-50%) scale(0);
            animation: ripple 0.4s ease-out forwards;
            pointer-events: none;
            z-index: 5;
        }
        @keyframes ripple {
            to { transform: translate(-50%,-50%) scale(2.5); opacity: 0; }
        }

        /* hotspot modal */
        .hotspot-modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none;
            transition: opacity 0.2s;
        }
        .hotspot-modal-overlay.show { opacity: 1; pointer-events: all; }
        .hotspot-modal {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            width: 440px;
            max-width: 95vw;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            transform: translateY(20px);
            transition: transform 0.2s;
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

        /* canvas tip */
        .canvas-tip {
            font-size: 0.8rem;
            color: var(--gray-600);
            margin-top: 0.5rem;
            display: flex; align-items: center; gap: 0.4rem;
        }
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
                    <h4 class="mb-0 fw-bold" style="color:var(--primary-blue)"><i class="fas fa-plus-circle me-2"></i>Tambah Panorama Baru</h4>
                    <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary-custom btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
                </div>
            </nav>

            <div class="p-4">
                @if($errors->any())
                    <div class="alert-custom alert-error-custom">
                        <i class="fas fa-exclamation-circle me-2"></i><strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <div class="form-card">
                    <form method="POST" action="{{ route('admin.panorama.store') }}" enctype="multipart/form-data" id="panoramaForm">
                        @csrf
                        <div class="row g-4">
                            <!-- Nama -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Panorama <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Contoh: Gerbang Utama">
                            </div>
                            <!-- Scene ID -->
                            <div class="col-md-6">
                                <label class="form-label">Scene ID <span class="text-danger">*</span></label>
                                <input type="text" name="scene_id" id="scene_id" class="form-control" value="{{ old('scene_id') }}" required placeholder="gerbang-utama">
                                <small class="form-text text-muted">Huruf kecil, tanpa spasi. Digunakan sebagai link antar panorama.</small>
                            </div>
                            <!-- Tipe -->
                            <div class="col-md-6">
                                <label class="form-label">Tipe <span class="text-danger">*</span></label>
                                <select name="type" class="form-select" required>
                                    <option value="360">360° Virtual Tour</option>
                                    <option value="normal">Gambar Normal</option>
                                </select>
                            </div>
                            <!-- Order -->
                            <div class="col-md-6">
                                <label class="form-label">Urutan Tampil</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                                <small class="form-text text-muted">Semakin kecil angka, semakin awal ditampilkan</small>
                            </div>

                            <!-- Upload Gambar -->
                            <div class="col-12">
                                <label class="form-label">Upload Gambar <span class="text-danger">*</span></label>
                                <input type="file" name="image_path" id="image_path" class="form-control" accept="image/*" required>
                                <small class="form-text text-muted">Format: JPG, PNG, WebP. Maksimal 10 MB.</small>
                            </div>

                            <!-- ── HOTSPOT CANVAS ── -->
                            <div class="col-12">
                                <label class="form-label d-flex align-items-center gap-2">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Hotspots Interaktif
                                    <span class="badge-hotspot" id="hotspotCount">0 item</span>
                                </label>
                                <small class="form-text text-muted d-block mb-2">Upload gambar dulu, lalu <strong>klik langsung di gambar</strong> untuk menambah hotspot.</small>

                                <!-- Canvas area -->
                                <div class="image-canvas-wrapper no-image" id="imageCanvas">
                                    <div class="canvas-placeholder" id="canvasPlaceholder">
                                        <i class="fas fa-image"></i>
                                        <p>Gambar akan muncul di sini setelah upload</p>
                                        <p style="font-size:0.8rem">Kemudian klik gambar untuk menambah hotspot</p>
                                    </div>
                                </div>
                                <div class="canvas-tip">
                                    <i class="fas fa-info-circle" style="color:var(--accent-teal)"></i>
                                    Klik pada gambar = tambah hotspot &nbsp;|&nbsp; Hover pin = hapus
                                </div>

                                <!-- Hotspot list table -->
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

                                <textarea class="d-none" id="hotspots" name="hotspots">[]</textarea>
                            </div>

                            <!-- Icon -->
                            <div class="col-md-6">
                                <label class="form-label">Icon (Font Awesome)</label>
                                <input type="text" name="icon" class="form-control" value="{{ old('icon', 'fas fa-image') }}" placeholder="fas fa-building">
                                <small class="form-text"><a href="https://fontawesome.com/icons" target="_blank">Lihat semua icon →</a></small>
                            </div>
                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                    <label class="form-check-label">Aktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary-custom" id="submitBtn"><i class="fas fa-save me-2"></i>Simpan Panorama</button>
                            <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary-custom">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hotspot Modal -->
<div class="hotspot-modal-overlay" id="hotspotModal">
    <div class="hotspot-modal">
        <h6><i class="fas fa-map-pin me-2" style="color:var(--accent-teal)"></i>Tambah Hotspot</h6>
        <div class="mb-3">
            <label class="form-label">Teks Tooltip <span class="text-danger">*</span></label>
            <input type="text" id="modalText" class="form-control" placeholder="Contoh: Gerbang Utama">
        </div>
        <div class="mb-2">
            <label class="form-label">Link ke Scene (Scene ID)</label>
            <select id="modalLink" class="form-select">
                <option value="">— Tidak ada link —</option>
                {{-- Daftar scene dari database --}}
                @foreach($panoramas ?? [] as $p)
                    <option value="{{ $p->scene_id }}">{{ $p->name }} ({{ $p->scene_id }})</option>
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
// ── State ──
let hotspots = [];
let pendingX = 0, pendingY = 0;

// ── Image Upload → show in canvas ──
document.getElementById('image_path').addEventListener('change', function() {
    if (!this.files[0]) return;
    if (this.files[0].size > 10485760) {
        alert('Ukuran file melebihi 10 MB!');
        this.value = '';
        return;
    }
    const reader = new FileReader();
    reader.onload = e => {
        const canvas = document.getElementById('imageCanvas');
        canvas.innerHTML = `<img src="${e.target.result}" id="canvasImg" draggable="false">`;
        canvas.classList.replace('no-image','has-image');
        renderPins();
    };
    reader.readAsDataURL(this.files[0]);
});

// ── Canvas click → open modal ──
document.getElementById('imageCanvas').addEventListener('click', function(e) {
    if (!document.getElementById('canvasImg')) return;
    const rect = this.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width * 100).toFixed(1);
    const y = ((e.clientY - rect.top) / rect.height * 100).toFixed(1);
    pendingX = parseFloat(x);
    pendingY = parseFloat(y);

    // ripple effect
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

// Enter key in modal
document.getElementById('modalText').addEventListener('keydown', e => {
    if (e.key === 'Enter') document.getElementById('modalSaveBtn').click();
});

// ── Render pins on image ──
function renderPins() {
    const canvas = document.getElementById('imageCanvas');
    // remove old pins
    canvas.querySelectorAll('.hotspot-pin').forEach(p => p.remove());
    hotspots.forEach((hs, i) => {
        const pin = document.createElement('div');
        pin.className = 'hotspot-pin';
        pin.style.left = hs.x + '%';
        pin.style.top = hs.y + '%';
        pin.innerHTML = `
            <button class="pin-remove" data-index="${i}" title="Hapus"><i class="fas fa-times"></i></button>
            <div class="pin-head"><i class="fas fa-map-pin"></i></div>
            <div class="pin-line"></div>
            ${hs.text ? `<div class="pin-label">${hs.text}</div>` : ''}
        `;
        pin.querySelector('.pin-remove').addEventListener('click', function(e) {
            e.stopPropagation();
            hotspots.splice(+this.dataset.index, 1);
            renderPins();
            renderTable();
            syncJSON();
        });
        canvas.appendChild(pin);
    });
    document.getElementById('hotspotCount').textContent = hotspots.length + ' item';
}

// ── Render table list ──
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
            <td>${hs.link ? `<span style="color:var(--accent-teal);font-weight:600">${hs.link}</span>` : '<span style="color:#aaa">—</span>'}</td>
            <td>
                <button type="button" class="btn btn-sm" style="background:var(--danger);color:white;border-radius:6px;padding:2px 8px" onclick="removeHotspot(${i})">
                    <i class="fas fa-trash" style="font-size:11px"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

function removeHotspot(i) {
    hotspots.splice(i, 1);
    renderPins();
    renderTable();
    syncJSON();
}

// ── Sync to hidden textarea ──
function syncJSON() {
    document.getElementById('hotspots').value = JSON.stringify(hotspots);
}

// ── Scene ID auto-format ──
document.getElementById('scene_id').addEventListener('input', function() {
    this.value = this.value.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
});
</script>
</body>
</html>