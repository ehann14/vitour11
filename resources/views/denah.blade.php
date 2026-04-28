<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Denah Sekolah 360° - SMK Negeri 11 Bandung</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-blue: #1e3c72; --secondary-blue: #2a5298; --accent-teal: #00c9b1;
            --white: #ffffff; --gray-100: #f8f9fa; --gray-200: #e9ecef;
            --gray-300: #dee2e6; --gray-600: #6c757d; --gray-700: #495057;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--gray-700); min-height: 100vh;
        }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }
        
        /* ✅ NAVBAR - Sama dengan home.blade.php */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky; top: 0; z-index: 1000;
            padding: 12px 0; border-radius: 0 0 25px 25px;
        }
        .navbar .container {
            display: flex; justify-content: space-between; align-items: center;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 8px;
            font-weight: 700; font-size: 1.2rem;
            color: var(--primary-blue); text-decoration: none;
        }
        .nav-brand i { font-size: 1.4rem; }
        .nav-menu { display: flex; list-style: none; gap: 20px; }
        .nav-menu a {
            text-decoration: none; color: var(--gray-700);
            font-weight: 600; font-size: 0.95rem; padding: 4px 0; position: relative;
            transition: color 0.3s;
        }
        .nav-menu a:hover, .nav-menu a.active { color: var(--primary-blue); }
        .nav-menu a::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0; height: 2px; background: var(--accent-teal);
            transition: width 0.3s ease; border-radius: 3px;
        }
        .nav-menu a:hover::after, .nav-menu a.active::after { width: 100%; }
        
        /* ✅ Login Button */
        .nav-login-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(30, 60, 114, 0.25);
        }
        .nav-login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 60, 114, 0.4);
            color: var(--white);
        }
        .nav-login-btn i { font-size: 0.95rem; }
        
        /* ✅ Mobile Toggle */
        .nav-toggle {
            display: none; background: none; border: none;
            font-size: 1.4rem; color: var(--primary-blue);
            cursor: pointer; border-radius: 50%; padding: 6px;
            transition: all 0.3s ease;
        }
        .nav-toggle:hover { background: rgba(30, 60, 114, 0.1); }
        
        /* Header - Lebih Compact */
        .header { text-align: center; padding: 20px 0; margin-bottom: 20px; }
        .header h1 {
            font-size: 2rem; font-weight: 800; color: var(--white);
            margin-bottom: 10px; display: flex; align-items: center;
            justify-content: center; gap: 15px;
        }
        .header h1 i { color: var(--accent-teal); }
        .header p {
            font-size: 1rem; color: rgba(255, 255, 255, 0.9);
            max-width: 600px; margin: 0 auto;
        }
        
        /* ✅ Viewer Container - Full Screen Style */
        .viewer-container {
            background: var(--white); border-radius: 30px;
            padding: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            margin-bottom: 30px; position: relative;
        }
        .viewer-header {
            text-align: center; margin-bottom: 15px;
        }
        .viewer-header h2 {
            font-size: 1.5rem; color: var(--primary-blue);
            font-weight: 700; margin-bottom: 5px;
        }
        .current-location {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white; padding: 8px 20px; border-radius: 25px;
            font-weight: 600; font-size: 1rem;
        }
        #panorama {
            width: 100%; height: 75vh; min-height: 500px;
            border-radius: 20px; background: #f0f0f0; position: relative;
        }
        .loading {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%); text-align: center; z-index: 10;
        }
        .spinner {
            width: 60px; height: 60px;
            border: 5px solid rgba(30, 60, 114, 0.2);
            border-top-color: var(--accent-teal);
            border-radius: 50%; animation: spin 1s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        
        /* ✅ Floating Location Button - Untuk Buka Pilihan Lokasi */
        .location-toggle-btn {
            position: absolute;
            top: 30px;
            left: 30px;
            z-index: 100;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            transition: all 0.3s;
        }
        .location-toggle-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }
        
        /* ✅ Scene Selector Modal/Overlay - Hidden by Default */
        .scene-selector-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .scene-selector-overlay.active {
            display: flex;
        }
        .scene-selector-modal {
            background: var(--white);
            border-radius: 30px;
            padding: 30px;
            max-width: 900px;
            width: 100%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.3s ease;
        }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .scene-selector-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gray-200);
        }
        .scene-selector-header h3 {
            font-size: 1.5rem; color: var(--primary-blue);
            font-weight: 700;
        }
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--gray-600);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        .close-modal:hover {
            background: var(--gray-100);
            color: var(--primary-blue);
        }
        .scene-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
        }
        .scene-btn {
            display: flex; align-items: center; justify-content: center;
            gap: 10px; padding: 14px 12px; background: var(--gray-100);
            border: 2px solid transparent; border-radius: 20px;
            font-weight: 600; cursor: pointer; transition: all 0.3s;
        }
        .scene-btn:hover { transform: translateY(-2px); border-color: var(--accent-teal); }
        .scene-btn.active {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
        }
        
        /* Hotspot Counter Badge */
        .hotspot-debug {
            position: absolute; bottom: 30px; right: 30px;
            background: rgba(0,201,177,0.9); color: white;
            padding: 8px 16px; border-radius: 20px;
            font-size: 0.85rem; z-index: 100;
            font-weight: 600;
        }
        
        /* Back Button */
        .btn-back {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 12px 25px;
            background: rgba(255,255,255,0.2);
            color: var(--white); text-decoration: none;
            border-radius: 25px; font-weight: 600;
            margin-top: 20px; transition: all 0.3s;
            border: 2px solid var(--white);
        }
        .btn-back:hover { 
            background: var(--white);
            color: var(--primary-blue);
            transform: translateY(-2px);
        }
        
        /* ✅ Responsive Navbar */
        @media (max-width: 768px) {
            .nav-toggle { display: block; }
            .nav-menu {
                position: fixed; top: 70px; right: -100%;
                flex-direction: column; background: var(--white);
                width: 260px; height: calc(100vh - 70px);
                padding: 35px 25px;
                box-shadow: -5px 0 20px rgba(0,0,0,0.15);
                transition: right 0.4s ease;
                border-radius: 0 0 35px 35px;
                z-index: 999;
            }
            .nav-menu.active { right: 0; }
            .nav-menu li { margin-bottom: 20px; }
            .nav-menu a { font-size: 1.1rem; display: block; }
            .nav-login-btn span { display: none; }
            .nav-login-btn { padding: 10px 16px; }
            .nav-login-btn i { font-size: 1.1rem; }
            
            .header h1 { font-size: 1.5rem; }
            .header p { font-size: 0.9rem; }
            #panorama { height: 65vh; min-height: 400px; }
            .location-toggle-btn {
                top: 10px;
                left: 10px;
                padding: 10px 15px;
                font-size: 0.9rem;
            }
            .scene-buttons { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <!-- ✅ NAVBAR LENGKAP -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SMK NEGERI 11 BANDUNG</span>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('home') }}#profile">Profil Sekolah</a></li>
                <li><a href="{{ route('program.keahlian') }}">Program</a></li>
                <li><a href="{{ route('home') }}#gallery">Galeri</a></li>
                <li><a href="{{ route('prestasi') }}">Prestasi</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
                <li><a href="{{ route('denah') }}" class="active">Denah 360°</a></li>
            </ul>
            <a href="{{ route('admin.login') }}" class="nav-login-btn">
                <i class="fas fa-user-shield"></i>
                <span>Login Admin</span>
            </a>
            <button class="nav-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Header - Lebih Compact -->
    <section class="header">
        <div class="container">
            <h1><i class="fas fa-compass"></i> Denah Sekolah 360°</h1>
            <p>Jelajahi lingkungan sekolah dengan virtual tour interaktif</p>
        </div>
    </section>

    <div class="container">
        <!-- ✅ Viewer Container dengan Floating Button -->
        <div class="viewer-container">
            <!-- Floating Button untuk Buka Pilihan Lokasi -->
            <button class="location-toggle-btn" onclick="toggleSceneSelector()">
                <i class="fas fa-map-marker-alt"></i>
                <span>Pilih Lokasi</span>
            </button>
            
            <div class="viewer-header">
                <h2><i class="fas fa-vr-cardboard"></i> Virtual Tour 360°</h2>
                <div class="current-location" id="currentLocationDisplay">
                    <i class="fas fa-location-arrow"></i>
                    <span id="current-scene-title">{{ $panoramas->first()->name ?? 'Memuat...' }}</span>
                </div>
            </div>
            
            <div id="panorama">
                <div class="loading">
                    <div class="spinner"></div>
                    <p>Memuat Virtual Tour...</p>
                </div>
            </div>
            
            <!-- Hotspot Counter Badge -->
            <div class="hotspot-debug" id="hotspotCounter">
                <i class="fas fa-map-signs"></i> Hotspot: 0
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('home') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- ✅ Scene Selector Modal/Overlay (Hidden by Default) -->
    <div class="scene-selector-overlay" id="sceneSelectorOverlay" onclick="closeSceneSelectorOnOverlay(event)">
        <div class="scene-selector-modal" onclick="event.stopPropagation()">
            <div class="scene-selector-header">
                <h3><i class="fas fa-map-marked-alt"></i> Pilih Lokasi</h3>
                <button class="close-modal" onclick="toggleSceneSelector()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="scene-buttons" id="sceneButtons">
                @forelse($panoramas as $panorama)
                    <button class="scene-btn {{ $loop->first ? 'active' : '' }}" 
                        data-scene="{{ $panorama->scene_id }}"
                        onclick="selectScene('{{ $panorama->scene_id }}', '{{ $panorama->name }}')">
                        <i class="fas {{ $panorama->icon ?? 'fa-image' }}"></i>
                        <span>{{ $panorama->name }}</span>
                        @if(is_array($panorama->hotspots) && count($panorama->hotspots) > 0)
                            <span class="badge bg-teal ms-1" style="background:var(--accent-teal);color:white;font-size:0.7rem;padding:2px 6px;border-radius:10px;">
                                {{ count($panorama->hotspots) }}
                            </span>
                        @endif
                    </button>
                @empty
                    <p class="text-muted" style="grid-column: 1/-1; text-align: center; padding: 20px;">Belum ada lokasi tersedia</p>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <script>
    // ✅ Mobile Navigation Toggle
    document.querySelector('.nav-toggle')?.addEventListener('click', function() {
        document.querySelector('.nav-menu')?.classList.toggle('active');
    });
    
    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', function() {
            document.querySelector('.nav-menu')?.classList.remove('active');
        });
    });

    // ✅ Toggle Scene Selector Modal
    function toggleSceneSelector() {
        document.getElementById('sceneSelectorOverlay').classList.toggle('active');
        document.body.style.overflow = document.getElementById('sceneSelectorOverlay').classList.contains('active') ? 'hidden' : '';
    }
    
    function closeSceneSelectorOnOverlay(event) {
        if (event.target === event.currentTarget) {
            toggleSceneSelector();
        }
    }
    
    // ✅ Select Scene Function
    function selectScene(sceneId, sceneName) {
        if (!viewer || sceneId === viewer.getScene()) {
            toggleSceneSelector();
            return;
        }
        
        // Update active button
        document.querySelectorAll('.scene-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.scene === sceneId);
        });
        
        // Update current location display
        document.getElementById('current-scene-title').textContent = sceneName;
        
        // Load scene
        viewer.loadScene(sceneId);
        
        // Close modal after short delay
        setTimeout(() => {
            toggleSceneSelector();
        }, 300);
    }

    let viewer = null;
    
    // ✅ Parse panoramas data
    @php
        $panoramasWithUrl = $panoramas->map(function($p) {
            $imgPath = $p->image_path ?? '';
            if (str_starts_with($imgPath, 'storage/')) {
                $p->image_url = '/' . $imgPath;
            } elseif (str_starts_with($imgPath, 'panoramas/')) {
                $p->image_url = '/' . $imgPath;
            } else {
                $p->image_url = asset($imgPath);
            }
            
            $hotspotsRaw = $p->hotspots ?? '[]';
            if (is_string($hotspotsRaw)) {
                try {
                    $decoded = json_decode($hotspotsRaw, true);
                    $p->hotspots_array = is_array($decoded) ? $decoded : [];
                } catch (\Exception $e) {
                    $p->hotspots_array = [];
                }
            } else {
                $p->hotspots_array = is_array($hotspotsRaw) ? $hotspotsRaw : [];
            }
            
            return $p;
        });
    @endphp
    const panoramas = @json($panoramasWithUrl);

    // ✅ Build scenes config
    const scenesConfig = {};
    
    panoramas.forEach(p => {
        const hotspots = p.hotspots_array || [];
        
        const pannellumHotspots = hotspots.map(h => {
            if (typeof h.pitch === 'number' && typeof h.yaw === 'number') {
                return {
                    pitch: h.pitch,
                    yaw: h.yaw,
                    type: h.link ? 'scene' : 'info',
                    text: h.text || '',
                    sceneId: h.link || null,
                    CSSclass: 'custom-hotspot'
                };
            }
            
            const x = typeof h.x === 'number' ? h.x : 50;
            const y = typeof h.y === 'number' ? h.y : 50;
            const yaw = (x - 50) * 3.6;
            const pitch = (50 - y) * 1.8;
            
            return {
                pitch: pitch,
                yaw: yaw,
                type: h.link ? 'scene' : 'info',
                text: h.text || 'Lokasi',
                sceneId: h.link || null,
                CSSclass: 'custom-hotspot'
            };
        });
        
        scenesConfig[p.scene_id] = {
            title: p.name,
            type: p.type === '360' ? 'equirectangular' : 'flat',
            panorama: p.image_url,
            hotSpots: pannellumHotspots,
            ...(p.type !== '360' && {
                hfov: 100,
                minHfov: 50,
                maxHfov: 100
            })
        };
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (!panoramas || panoramas.length === 0) {
            document.getElementById('panorama').innerHTML = 
                '<div style="padding: 50px; text-align: center;"><h3>📭 Belum ada scene tersedia</h3></div>';
            document.getElementById('hotspotCounter').style.display = 'none';
            return;
        }

        // ✅ Initialize Pannellum Viewer
        viewer = pannellum.viewer('panorama', {
            default: {
                firstScene: panoramas[0].scene_id,
                sceneFadeDuration: 800,
                autoLoad: true,
                showZoomCtrl: true,
                showFullscreenCtrl: true,
                compass: true,
                hotSpotDebug: false
            },
            scenes: scenesConfig
        });

        // ✅ Event: scene change
        viewer.on('scenechange', function(sceneId) {
            // Update active button in modal
            document.querySelectorAll('.scene-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.scene === sceneId);
            });
            
            // Update current location display
            const sceneName = scenesConfig[sceneId]?.title || sceneId;
            document.getElementById('current-scene-title').textContent = sceneName;
            
            // Update hotspot counter
            const hs = scenesConfig[sceneId]?.hotSpots || [];
            document.getElementById('hotspotCounter').innerHTML = 
                `<i class="fas fa-map-signs"></i> Hotspot: ${hs.length}`;
        });

        // ✅ Hide loading spinner
        setTimeout(() => {
            const loadingEl = document.querySelector('.loading');
            if (loadingEl) loadingEl.style.opacity = '0';
            setTimeout(() => { if (loadingEl) loadingEl.remove(); }, 300);
        }, 1500);
        
        // ✅ Initial hotspot counter
        const firstScene = panoramas[0].scene_id;
        const firstHs = scenesConfig[firstScene]?.hotSpots || [];
        document.getElementById('hotspotCounter').innerHTML = 
            `<i class="fas fa-map-signs"></i> Hotspot: ${firstHs.length}`;
        
        // ✅ Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const overlay = document.getElementById('sceneSelectorOverlay');
                if (overlay.classList.contains('active')) {
                    toggleSceneSelector();
                }
            }
        });
    });
    </script>
</body>
</html>