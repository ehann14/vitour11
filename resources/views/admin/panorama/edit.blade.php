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
            --white: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
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
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 1rem 2rem;
        }
        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .form-label {
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 0.5rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(30,60,114,0.25);
        }
        .btn-primary-custom {
            background: var(--primary-blue);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary-custom:hover {
            background: var(--secondary-blue);
            transform: translateY(-2px);
            color: white;
        }
        .btn-secondary-custom {
            background: var(--gray-200);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            color: var(--gray-600);
            transition: all 0.3s;
        }
        .btn-secondary-custom:hover {
            background: var(--gray-300);
            color: var(--gray-700);
        }
        .btn-danger-custom {
            background: var(--danger);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            color: white;
            transition: all 0.3s;
        }
        .btn-danger-custom:hover {
            background: #bd2130;
            color: white;
        }
        .btn-teal {
            background: var(--accent-teal);
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            color: white;
            transition: all 0.3s;
        }
        .btn-teal:hover {
            background: #00b39d;
            color: white;
        }
        .preview-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 12px;
            display: none;
            margin-top: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .preview-image.show {
            display: block;
        }
        .current-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .alert-custom {
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        .alert-success-custom {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .alert-error-custom {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .form-text {
            font-size: 0.85rem;
            color: var(--gray-600);
        }
        .file-size-error {
            color: var(--danger);
            font-weight: 600;
            display: none;
            margin-top: 0.5rem;
        }
        .file-size-error.show {
            display: block;
        }
        
        /* Hotspot JSON Editor Styles */
        .hotspot-editor {
            background: var(--gray-100);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 1rem;
        }
        .hotspot-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .hotspot-item {
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 10px;
            padding: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: flex-start;
        }
        .hotspot-item .form-control {
            flex: 1;
            min-width: 120px;
        }
        .hotspot-item .form-control-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
        }
        .hotspot-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .hotspot-preview {
            background: var(--gray-200);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
            font-family: monospace;
            font-size: 0.85rem;
            max-height: 200px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-break: break-all;
        }
        .json-error {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: none;
        }
        .json-error.show {
            display: block;
        }
        .badge-hotspot {
            background: var(--accent-teal);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--gray-600);
        }
        .empty-state i {
            font-size: 3rem;
            opacity: 0.3;
            margin-bottom: 1rem;
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
                <nav class="mt-3 p-2">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.panorama.index') }}" class="active">
                        <i class="fas fa-images me-2"></i>Kelola Panorama
                    </a>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                    </a>
                </nav>
                <div class="mt-auto p-3 border-top" style="border-color: rgba(255,255,255,0.2) !important;">
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
                        <h4 class="mb-0 fw-bold" style="color: var(--primary-blue);">
                            <i class="fas fa-edit me-2"></i>Edit Panorama
                        </h4>
                        <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary-custom btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </nav>

                <!-- Form Content -->
                <div class="p-4">
                    @if(session('success'))
                        <div class="alert-custom alert-success-custom">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert-custom alert-error-custom">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-card">
                        <form method="POST" action="{{ route('admin.panorama.update', $panorama->id) }}" enctype="multipart/form-data" id="panoramaForm">
                            @csrf
                            @method('PUT')

                            <!-- Hidden ID -->
                            <input type="hidden" name="id" value="{{ $panorama->id }}">

                            <div class="row g-4">
                                <!-- Nama Panorama -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Panorama <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $panorama->name) }}" 
                                           placeholder="Contoh: Gerbang Utama"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Nama yang akan ditampilkan di website</small>
                                </div>

                                <!-- Scene ID (Read-only saat edit) -->
                                <div class="col-md-6">
                                    <label for="scene_id" class="form-label">Scene ID</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="scene_id" 
                                           value="{{ $panorama->scene_id }}" 
                                           readonly
                                           style="background: var(--gray-100); cursor: not-allowed;">
                                    <small class="form-text">Scene ID tidak dapat diubah setelah dibuat</small>
                                </div>

                                <!-- Tipe Panorama -->
                                <div class="col-md-6">
                                    <label for="type" class="form-label">Tipe Panorama <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            required>
                                        <option value="360" {{ old('type', $panorama->type) == '360' ? 'selected' : '' }}>360° Virtual Tour</option>
                                        <option value="normal" {{ old('type', $panorama->type) == 'normal' ? 'selected' : '' }}>Gambar Normal</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Order / Urutan -->
                                <div class="col-md-6">
                                    <label for="order" class="form-label">Urutan Tampil</label>
                                    <input type="number" 
                                           class="form-control @error('order') is-invalid @enderror" 
                                           id="order" 
                                           name="order" 
                                           value="{{ old('order', $panorama->order) }}" 
                                           min="0"
                                           placeholder="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Semakin kecil angka, semakin awal ditampilkan</small>
                                </div>

                                <!-- Upload Gambar (MAX 10 MB) -->
                                <div class="col-12">
                                    <label class="form-label">Gambar Saat Ini</label>
                                    @if($panorama->image_path)
                                        <img src="{{ asset($panorama->image_path) }}" alt="{{ $panorama->name }}" class="current-image">
                                    @else
                                        <div class="current-image d-flex align-items-center justify-content-center" style="background: var(--gray-200);">
                                            <i class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    
                                    <label for="image_path" class="form-label mt-3">Ganti Gambar (Opsional)</label>
                                    <input type="file" 
                                           class="form-control @error('image_path') is-invalid @enderror" 
                                           id="image_path" 
                                           name="image_path" 
                                           accept="image/*"
                                           data-max-size="10485760">
                                    @error('image_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Kosongkan jika tidak ingin mengganti. Format: JPG, PNG, JPEG. <strong>Maksimal 10 MB</strong></small>
                                    <div id="fileSizeError" class="file-size-error">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        Ukuran file melebihi 10 MB!
                                    </div>
                                    <img id="imagePreview" class="preview-image" alt="Preview">
                                </div>

                                <!-- Icon -->
                                <div class="col-md-6">
                                    <label for="icon" class="form-label">Icon (Font Awesome)</label>
                                    <input type="text" 
                                           class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" 
                                           name="icon" 
                                           value="{{ old('icon', $panorama->icon) }}" 
                                           placeholder="fas fa-building">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Contoh: fas fa-building, fas fa-tree <a href="https://fontawesome.com/icons" target="_blank">Lihat semua icon</a></small>
                                </div>

                                <!-- Status Aktif -->
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_active" 
                                               name="is_active" 
                                               value="1"
                                               {{ old('is_active', $panorama->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Aktifkan panorama ini</label>
                                    </div>
                                </div>

                                <!-- HOTSPOTS JSON EDITOR -->
                                <div class="col-12">
                                    <label class="form-label d-flex align-items-center gap-2">
                                        <i class="fas fa-map-marked-alt"></i>
                                        Hotspots Interaktif
                                        <span class="badge-hotspot">{{ count(json_decode($panorama->hotspots ?? '[]', true)) }} item</span>
                                    </label>
                                    <small class="form-text d-block mb-3">Tambahkan titik interaktif yang muncul saat user menjelajahi panorama 360°</small>
                                    
                                    <!-- Visual Hotspot Editor -->
                                    <div class="hotspot-editor">
                                        <div id="hotspotList" class="hotspot-list">
                                            <!-- Hotspot items will be rendered here by JS -->
                                        </div>
                                        
                                        <button type="button" class="btn btn-teal btn-sm" id="addHotspotBtn">
                                            <i class="fas fa-plus me-1"></i>Tambah Hotspot
                                        </button>
                                        
                                        <!-- JSON Preview (Read-only) -->
                                        <div class="mt-3">
                                            <small class="form-text fw-semibold">Preview JSON:</small>
                                            <div id="jsonPreview" class="hotspot-preview"></div>
                                            <div id="jsonError" class="json-error">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                Format JSON tidak valid!
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Hidden textarea for form submission -->
                                    <textarea class="d-none" id="hotspots" name="hotspots">{{ old('hotspots', $panorama->hotspots ?? '[]') }}</textarea>
                                    
                                    @error('hotspots')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text mt-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Setiap hotspot memiliki: <strong>x</strong> (posisi horizontal %), <strong>y</strong> (posisi vertikal %), <strong>text</strong> (teks tooltip), <strong>link</strong> (opsional)
                                    </small>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex gap-3 mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                                    <i class="fas fa-save me-2"></i>Update Panorama
                                </button>
                                <a href="{{ route('admin.panorama.index') }}" class="btn btn-secondary-custom">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <form method="POST" action="{{ route('admin.panorama.destroy', $panorama->id) }}" class="ms-auto" onsubmit="return confirm('Yakin ingin menghapus panorama ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-custom">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Format ukuran file ke human-readable
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Format JSON dengan indentasi
        function formatJSON(json) {
            try {
                return JSON.stringify(JSON.parse(json), null, 2);
            } catch (e) {
                return json;
            }
        }

        // Parse hotspots dari JSON string ke array
        function parseHotspots(jsonString) {
            try {
                const parsed = JSON.parse(jsonString);
                return Array.isArray(parsed) ? parsed : [];
            } catch (e) {
                return [];
            }
        }

        // Render hotspot list dari array
        function renderHotspots(hotspots) {
            const container = document.getElementById('hotspotList');
            
            if (!hotspots || hotspots.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-map-pin"></i>
                        <p>Belum ada hotspot. Klik "Tambah Hotspot" untuk menambahkan.</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = hotspots.map((hotspot, index) => `
                <div class="hotspot-item" data-index="${index}">
                    <input type="number" class="form-control form-control-sm hotspot-x" 
                           placeholder="X (%)" value="${hotspot.x ?? 50}" min="0" max="100" step="0.1"
                           style="max-width: 80px;">
                    <input type="number" class="form-control form-control-sm hotspot-y" 
                           placeholder="Y (%)" value="${hotspot.y ?? 50}" min="0" max="100" step="0.1"
                           style="max-width: 80px;">
                    <input type="text" class="form-control form-control-sm hotspot-text" 
                           placeholder="Teks tooltip" value="${hotspot.text ?? ''}">
                    <input type="text" class="form-control form-control-sm hotspot-link" 
                           placeholder="Link (opsional)" value="${hotspot.link ?? ''}">
                    <div class="hotspot-actions">
                        <button type="button" class="btn btn-danger-custom btn-sm remove-hotspot" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `).join('');
            
            // Update badge count
            document.querySelector('.badge-hotspot').textContent = `${hotspots.length} item`;
            
            // Update JSON preview
            updateJSONPreview();
        }

        // Update JSON preview dan hidden textarea
        function updateJSONPreview() {
            const hotspots = getHotspotsFromUI();
            const jsonString = JSON.stringify(hotspots, null, 2);
            
            document.getElementById('jsonPreview').textContent = jsonString;
            document.getElementById('hotspots').value = jsonString;
            
            // Validate JSON
            const jsonError = document.getElementById('jsonError');
            try {
                JSON.parse(jsonString);
                jsonError.classList.remove('show');
                document.getElementById('submitBtn').disabled = false;
            } catch (e) {
                jsonError.classList.add('show');
                document.getElementById('submitBtn').disabled = true;
            }
        }

        // Get hotspots array from UI inputs
        function getHotspotsFromUI() {
            const items = document.querySelectorAll('.hotspot-item');
            const hotspots = [];
            
            items.forEach(item => {
                const x = parseFloat(item.querySelector('.hotspot-x').value) || 50;
                const y = parseFloat(item.querySelector('.hotspot-y').value) || 50;
                const text = item.querySelector('.hotspot-text').value || '';
                const link = item.querySelector('.hotspot-link').value || '';
                
                if (text.trim()) {
                    hotspots.push({ x, y, text, link: link || null });
                }
            });
            
            return hotspots;
        }

        // Add new hotspot
        function addHotspot() {
            const hotspots = getHotspotsFromUI();
            hotspots.push({ x: 50, y: 50, text: '', link: '' });
            renderHotspots(hotspots);
            
            // Focus on new text input
            const newItem = document.querySelector('.hotspot-item:last-child .hotspot-text');
            if (newItem) newItem.focus();
        }

        // Remove hotspot
        function removeHotspot(btn) {
            const item = btn.closest('.hotspot-item');
            item.remove();
            updateJSONPreview();
            
            // Update badge
            const count = document.querySelectorAll('.hotspot-item').length;
            document.querySelector('.badge-hotspot').textContent = `${count} item`;
            
            // Show empty state if no items
            if (count === 0) {
                document.getElementById('hotspotList').innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-map-pin"></i>
                        <p>Belum ada hotspot. Klik "Tambah Hotspot" untuk menambahkan.</p>
                    </div>
                `;
            }
        }

        // Image Preview + File Size Validation (MAX 10 MB)
        document.getElementById('image_path').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const fileSizeError = document.getElementById('fileSizeError');
            const submitBtn = document.getElementById('submitBtn');
            const file = e.target.files[0];
            const maxSize = 10485760; // 10 MB in bytes
            
            // Reset error
            fileSizeError.classList.remove('show');
            submitBtn.disabled = false;
            
            if (file) {
                // Validasi ukuran file
                if (file.size > maxSize) {
                    fileSizeError.classList.add('show');
                    fileSizeError.innerHTML = 
                        '<i class="fas fa-exclamation-triangle me-1"></i>' +
                        'Ukuran file (' + formatFileSize(file.size) + ') melebihi batas maksimal 10 MB!';
                    submitBtn.disabled = true;
                    preview.classList.remove('show');
                    this.value = '';
                    return;
                }
                
                // Preview gambar
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.classList.add('show');
                }
                reader.readAsDataURL(file);
            } else {
                preview.classList.remove('show');
            }
        });

        // Auto-format scene_id display (read-only)
        document.getElementById('scene_id').addEventListener('input', function(e) {
            this.value = this.value.toLowerCase().replace(/\s+/g, '-');
        });

        // Hotspot event listeners
        document.getElementById('addHotspotBtn').addEventListener('click', addHotspot);
        
        document.getElementById('hotspotList').addEventListener('click', function(e) {
            if (e.target.closest('.remove-hotspot')) {
                removeHotspot(e.target.closest('.remove-hotspot'));
            }
        });
        
        // Real-time update on input change
        document.getElementById('hotspotList').addEventListener('input', function(e) {
            if (e.target.classList.contains('hotspot-x') || 
                e.target.classList.contains('hotspot-y') ||
                e.target.classList.contains('hotspot-text') ||
                e.target.classList.contains('hotspot-link')) {
                updateJSONPreview();
            }
        });

        // Prevent form submit if JSON is invalid
        document.getElementById('panoramaForm').addEventListener('submit', function(e) {
            const hotspotsValue = document.getElementById('hotspots').value;
            try {
                JSON.parse(hotspotsValue);
            } catch (err) {
                e.preventDefault();
                alert('Format hotspot JSON tidak valid. Silakan periksa kembali.');
                document.getElementById('jsonError').classList.add('show');
            }
            
            // Check file size again (backup validation)
            const fileInput = document.getElementById('image_path');
            const file = fileInput.files[0];
            const maxSize = 10485760;
            
            if (file && file.size > maxSize) {
                e.preventDefault();
                alert('Ukuran file gambar melebihi 10 MB. Silakan pilih file yang lebih kecil.');
                fileInput.focus();
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            const initialHotspots = parseHotspots(document.getElementById('hotspots').value);
            renderHotspots(initialHotspots);
            
            // Show current image if exists
            const currentImg = document.querySelector('.current-image');
            if (currentImg && currentImg.src && !currentImg.src.includes('fa-image')) {
                // Image already loaded via src attribute
            }
        });
    </script>
</body>
</html>