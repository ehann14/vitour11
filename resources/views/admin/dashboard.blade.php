<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Virtual Tour</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hotspot-marker {
            position: absolute;
            width: 35px;
            height: 35px;
            background: #ef4444;
            border: 3px solid white;
            border-radius: 50%;
            cursor: pointer;
            transform: translate(-50%, -50%);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
        }
        .hotspot-marker:hover {
            background: #3b82f6;
            transform: translate(-50%, -50%) scale(1.2);
        }
        .preview-container {
            width: 100%;
            height: 400px;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            background: #f3f4f6;
        }
        .preview-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                    <h1 class="text-2xl font-bold text-blue-600">
                        <i class="fas fa-cog"></i> Admin Dashboard
                    </h1>
                    <div class="flex gap-3">
                        <a href="{{ route('denah') }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            <i class="fas fa-eye"></i> Lihat Viewer
                        </a>
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto px-4 py-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl mb-6 shadow">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl mb-6 shadow">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Upload Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                <h2 class="text-2xl font-bold mb-6 text-blue-600">
                    <i class="fas fa-upload"></i> Upload Scene Baru
                </h2>
                <form action="{{ route('admin.panorama.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Nama Scene</label>
                            <input type="text" name="name" required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                placeholder="Contoh: Gerbang Utama">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Scene ID</label>
                            <input type="text" name="scene_id" required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                placeholder="Contoh: gerbang">
                            <p class="text-xs text-gray-500 mt-1">Huruf kecil, tanpa spasi</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Tipe</label>
                            <select name="type" required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                                <option value="360">360° Panorama</option>
                                <option value="normal">Gambar Biasa</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Icon</label>
                            <select name="icon" required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                                <option value="fa-home">🏠 Home</option>
                                <option value="fa-field">🏟️ Lapangan</option>
                                <option value="fa-utensils">🍴 Kantin</option>
                                <option value="fa-parking">🅿️ Parkiran</option>
                                <option value="fa-restroom">🚻 WC</option>
                                <option value="fa-stairs">🪜 Tangga</option>
                                <option value="fa-road">🛣️ Koridor</option>
                                <option value="fa-door-open">🚪 Ruang</option>
                                <option value="fa-flask">🧪 Lab</option>
                                <option value="fa-book">📚 Perpustakaan</option>
                                <option value="fa-image">🖼️ Default</option>
                            </select>
                        </div>
                        <div class="lg:col-span-4">
                            <label class="block text-sm font-semibold mb-2">File Gambar</label>
                            <input type="file" name="image" accept="image/*" required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                        </div>
                    </div>
                    <button type="submit" class="mt-6 bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 font-semibold shadow-lg hover:shadow-xl transition">
                        <i class="fas fa-plus"></i> Upload Scene
                    </button>
                </form>
            </div>

            <!-- Scene List -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold mb-6 text-blue-600">
                    <i class="fas fa-list"></i> Daftar Scene ({{ $panoramas->count() }})
                </h2>
                
                <div class="grid grid-cols-1 gap-6">
                    @foreach($panoramas as $panorama)
                        <div class="border-2 border-gray-200 rounded-2xl p-6 hover:border-blue-300 transition" data-id="{{ $panorama->id }}">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">
                                        <i class="fas {{ $panorama->icon }}"></i> {{ $panorama->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500">Scene ID: <code>{{ $panorama->scene_id }}</code></p>
                                    <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold {{ $panorama->type === '360' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $panorama->type === '360' ? '360°' : 'Normal' }}
                                    </span>
                                    @if($panorama->is_active)
                                        <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            <i class="fas fa-check"></i> Aktif
                                        </span>
                                    @else
                                        <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            <i class="fas fa-times"></i> Nonaktif
                                        </span>
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="toggleEdit({{ $panorama->id }})" 
                                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.panorama.destroy', $panorama->id) }}" method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus scene ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Preview -->
                            <div class="preview-container mb-4" id="preview-{{ $panorama->id }}">
                                <img src="{{ asset('storage/' . $panorama->image_path) }}" alt="{{ $panorama->name }}">
                                @if($panorama->hotspots)
                                    @foreach($panorama->hotspots as $index => $hotspot)
                                        <div class="hotspot-marker" 
                                            style="left: {{ $hotspot['x'] }}%; top: {{ $hotspot['y'] }}%;"
                                            title="Ke: {{ $hotspot['target_name'] ?? 'Unknown' }}">
                                            {{ $index + 1 }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Edit Form -->
                            <div id="edit-form-{{ $panorama->id }}" class="hidden mt-6 p-6 bg-gray-50 rounded-xl">
                                <h4 class="font-bold mb-4 text-blue-600">
                                    <i class="fas fa-sliders-h"></i> Edit Scene & Hotspots
                                </h4>
                                
                                <form action="{{ route('admin.panorama.update', $panorama->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Nama Scene</label>
                                            <input type="text" name="name" value="{{ $panorama->name }}" required 
                                                class="w-full px-3 py-2 border rounded-lg">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Tipe</label>
                                            <select name="type" required class="w-full px-3 py-2 border rounded-lg">
                                                <option value="360" {{ $panorama->type === '360' ? 'selected' : '' }}>360°</option>
                                                <option value="normal" {{ $panorama->type === 'normal' ? 'selected' : '' }}>Normal</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Icon</label>
                                            <select name="icon" required class="w-full px-3 py-2 border rounded-lg">
                                                <option value="fa-home" {{ $panorama->icon === 'fa-home' ? 'selected' : '' }}>🏠 Home</option>
                                                <option value="fa-field" {{ $panorama->icon === 'fa-field' ? 'selected' : '' }}>🏟️ Lapangan</option>
                                                <option value="fa-utensils" {{ $panorama->icon === 'fa-utensils' ? 'selected' : '' }}>🍴 Kantin</option>
                                                <option value="fa-parking" {{ $panorama->icon === 'fa-parking' ? 'selected' : '' }}>🅿️ Parkiran</option>
                                                <option value="fa-restroom" {{ $panorama->icon === 'fa-restroom' ? 'selected' : '' }}>🚻 WC</option>
                                                <option value="fa-stairs" {{ $panorama->icon === 'fa-stairs' ? 'selected' : '' }}>🪜 Tangga</option>
                                                <option value="fa-road" {{ $panorama->icon === 'fa-road' ? 'selected' : '' }}>🛣️ Koridor</option>
                                                <option value="fa-door-open" {{ $panorama->icon === 'fa-door-open' ? 'selected' : '' }}>🚪 Ruang</option>
                                                <option value="fa-flask" {{ $panorama->icon === 'fa-flask' ? 'selected' : '' }}>🧪 Lab</option>
                                                <option value="fa-book" {{ $panorama->icon === 'fa-book' ? 'selected' : '' }}>📚 Perpustakaan</option>
                                                <option value="fa-image" {{ $panorama->icon === 'fa-image' ? 'selected' : '' }}>🖼️ Default</option>
                                            </select>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" name="is_active" value="1" {{ $panorama->is_active ? 'checked' : '' }} 
                                                class="w-5 h-5 text-blue-600">
                                            <label class="text-sm font-medium">Aktifkan Scene</label>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium mb-1">Ganti Gambar (opsional)</label>
                                            <input type="file" name="image" accept="image/*" 
                                                class="w-full px-3 py-2 border rounded-lg">
                                        </div>
                                    </div>

                                    <!-- Hotspots Manager -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-3">
                                            <label class="block text-sm font-bold">Hotspots Navigasi</label>
                                            <button type="button" onclick="enableHotspotMode({{ $panorama->id }})" 
                                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 text-sm">
                                                <i class="fas fa-plus"></i> Mode Tambah Hotspot
                                            </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-3">Klik pada gambar untuk menambah titik navigasi ke scene lain</p>
                                        
                                        <input type="hidden" name="hotspots" id="hotspots-input-{{ $panorama->id }}" 
                                            value='@json($panorama->hotspots ?? [])'>
                                        
                                        <div id="hotspots-list-{{ $panorama->id }}" class="space-y-2 mb-4">
                                            @if($panorama->hotspots)
                                                @foreach($panorama->hotspots as $index => $hotspot)
                                                    <div class="flex gap-2 items-center p-3 bg-white rounded-lg border">
                                                        <span class="text-sm font-semibold">Hotspot {{ $index + 1 }}:</span>
                                                        <select name="hotspots[{{ $index }}][target_id]" class="border rounded px-3 py-1 text-sm flex-1" data-scene-select>
                                                            @foreach($panoramas as $target)
                                                                <option value="{{ $target->id }}" {{ $hotspot['target_id'] == $target->id ? 'selected' : '' }}>
                                                                    {{ $target->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="hotspots[{{ $index }}][x]" value="{{ $hotspot['x'] }}">
                                                        <input type="hidden" name="hotspots[{{ $index }}][y]" value="{{ $hotspot['y'] }}">
                                                        <input type="hidden" name="hotspots[{{ $index }}][target_name]" value="{{ $hotspot['target_name'] ?? '' }}">
                                                        <button type="button" onclick="removeHotspot({{ $panorama->id }}, {{ $index }})" 
                                                            class="text-red-500 hover:text-red-700 text-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-sm text-gray-500 italic">Belum ada hotspot</p>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 font-semibold shadow">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        let hotspotMode = {};
        let allScenes = [];

        // Load all scenes for target selection
        async function loadScenes() {
            const response = await fetch("{{ route('admin.panorama.scenes') }}");
            allScenes = await response.json();
        }
        loadScenes();

        function toggleEdit(id) {
            document.getElementById(`edit-form-${id}`).classList.toggle('hidden');
        }

        function enableHotspotMode(id) {
            hotspotMode[id] = true;
            document.getElementById(`preview-${id}`).style.cursor = 'crosshair';
            alert('Klik pada gambar untuk menambah hotspot navigasi');
        }

        // Add click event to all previews
        document.querySelectorAll('.preview-container').forEach(preview => {
            preview.addEventListener('click', function(e) {
                const id = parseInt(this.id.replace('preview-', ''));
                if (hotspotMode[id] && e.target === this.querySelector('img')) {
                    const rect = this.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;
                    addHotspot(id, x, y);
                }
            });
        });

        function addHotspot(id, x, y) {
            const hotspotsInput = document.getElementById(`hotspots-input-${id}`);
            const hotspotsList = document.getElementById(`hotspots-list-${id}`);
            let hotspots = JSON.parse(hotspotsInput.value || '[]');
            
            const index = hotspots.length;
            const targetId = allScenes[0]?.id || id;
            const targetName = allScenes[0]?.name || 'Unknown';
            
            hotspots.push({ x, y, target_id: targetId, target_name: targetName });
            hotspotsInput.value = JSON.stringify(hotspots);
            
            // Add to list
            const div = document.createElement('div');
            div.className = 'flex gap-2 items-center p-3 bg-white rounded-lg border';
            div.innerHTML = `
                <span class="text-sm font-semibold">Hotspot ${index + 1}:</span>
                <select name="hotspots[${index}][target_id]" class="border rounded px-3 py-1 text-sm flex-1" data-scene-select>
                    ${allScenes.map(s => `<option value="${s.id}">${s.name}</option>`).join('')}
                </select>
                <input type="hidden" name="hotspots[${index}][x]" value="${x}">
                <input type="hidden" name="hotspots[${index}][y]" value="${y}">
                <input type="hidden" name="hotspots[${index}][target_name]" value="${targetName}">
                <button type="button" onclick="removeHotspot(${id}, ${index})" class="text-red-500 hover:text-red-700 text-sm">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            hotspotsList.appendChild(div);
            
            // Remove "Belum ada hotspot" message if exists
            const emptyMsg = hotspotsList.querySelector('.text-gray-500');
            if (emptyMsg) emptyMsg.remove();
            
            // Add marker to preview
            const marker = document.createElement('div');
            marker.className = 'hotspot-marker';
            marker.style.left = x + '%';
            marker.style.top = y + '%';
            marker.textContent = index + 1;
            this.document.getElementById(`preview-${id}`).appendChild(marker);
            
            hotspotMode[id] = false;
            document.getElementById(`preview-${id}`).style.cursor = 'default';
        }

        function removeHotspot(id, index) {
            const hotspotsInput = document.getElementById(`hotspots-input-${id}`);
            let hotspots = JSON.parse(hotspotsInput.value || '[]');
            hotspots.splice(index, 1);
            hotspotsInput.value = JSON.stringify(hotspots);
            
            // Remove from DOM
            document.querySelector(`#preview-${id} .hotspot-marker:nth-child(${index + 2})`)?.remove();
            
            // Reload page to refresh
            location.reload();
        }
    </script>
</body>
</html>