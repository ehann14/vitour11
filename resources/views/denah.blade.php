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
        
        /* Navbar */
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
        .nav-menu { display: flex; list-style: none; gap: 20px; }
        .nav-menu a {
            text-decoration: none; color: var(--gray-700);
            font-weight: 600; padding: 4px 0; transition: color 0.3s;
        }
        .nav-menu a:hover, .nav-menu a.active { color: var(--primary-blue); }
        
        /* Header */
        .header { text-align: center; padding: 40px 0; margin-bottom: 30px; }
        .header h1 {
            font-size: 2.5rem; font-weight: 800; color: var(--white);
            margin-bottom: 15px; display: flex; align-items: center;
            justify-content: center; gap: 15px;
        }
        .header h1 i { color: var(--accent-teal); }
        .header p {
            font-size: 1.1rem; color: rgba(255, 255, 255, 0.9);
            max-width: 700px; margin: 0 auto;
        }
        
        /* Scene Selector */
        .scene-selector {
            background: var(--white); border-radius: 30px;
            padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            margin-bottom: 25px;
        }
        .scene-selector-header h3 {
            font-size: 1.5rem; color: var(--primary-blue);
            font-weight: 700; margin-bottom: 20px;
        }
        .scene-buttons {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px; max-height: 400px; overflow-y: auto; padding: 10px;
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
        
        /* Viewer */
        .viewer-container {
            background: var(--white); border-radius: 30px;
            padding: 30px; box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }
        .viewer-header h2 {
            font-size: 1.8rem; color: var(--primary-blue);
            font-weight: 700; margin-bottom: 10px;
        }
        #panorama {
            width: 100%; height: 70vh; min-height: 500px;
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
        
        /* Back Button */
        .btn-back {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 14px 35px;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white); text-decoration: none;
            border-radius: 40px; font-weight: 700;
            margin-top: 30px; transition: transform 0.3s;
        }
        .btn-back:hover { transform: translateY(-3px); }
        
        /* Hotspot Debug Badge */
        .hotspot-debug {
            position: absolute; bottom: 10px; right: 10px;
            background: rgba(0,201,177,0.9); color: white;
            padding: 5px 12px; border-radius: 20px;
            font-size: 0.75rem; z-index: 100;
        }
        
        @media (max-width: 768px) {
            .header h1 { font-size: 1.9rem; }
            .scene-buttons { grid-template-columns: repeat(3, 1fr); }
            #panorama { height: 55vh; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="/" class="nav-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SMK NEGERI 11 BANDUNG</span>
            </a>
            <ul class="nav-menu">
                <li><a href="/">Beranda</a></li>
                <li><a href="/denah" class="active">Denah 360°</a></li>
            </ul>
        </div>
    </nav>

    <section class="header">
        <div class="container">
            <h1><i class="fas fa-compass"></i> Denah Sekolah 360°</h1>
            <p>Jelajahi lingkungan sekolah dengan virtual tour interaktif</p>
        </div>
    </section>

    <div class="container">
        <div class="scene-selector">
            <div class="scene-selector-header">
                <h3><i class="fas fa-map-marked-alt"></i> Pilih Lokasi</h3>
            </div>
            <div class="scene-buttons" id="sceneButtons">
                @forelse($panoramas as $panorama)
                    <button class="scene-btn {{ $loop->first ? 'active' : '' }}" 
                        data-scene="{{ $panorama->scene_id }}">
                        <i class="fas {{ $panorama->icon ?? 'fa-image' }}"></i>
                        <span>{{ $panorama->name }}</span>
                        @if(is_array($panorama->hotspots) && count($panorama->hotspots) > 0)
                            <span class="badge bg-teal ms-1" style="background:var(--accent-teal);color:white;font-size:0.7rem;">
                                {{ count($panorama->hotspots) }}
                            </span>
                        @endif
                    </button>
                @empty
                    <p class="text-muted">Belum ada lokasi tersedia</p>
                @endforelse
            </div>
        </div>

        <div class="viewer-container">
            <div class="viewer-header">
                <h2><i class="fas fa-vr-cardboard"></i> Virtual Tour 360°</h2>
                <p class="scene-title" id="current-scene-title">
                    {{ $panoramas->first()->name ?? 'Memuat...' }}
                </p>
            </div>
            <div id="panorama">
                <div class="loading">
                    <div class="spinner"></div>
                    <p>Memuat Virtual Tour...</p>
                </div>
            </div>
            <!-- Hotspot Counter Badge -->
            <div class="hotspot-debug" id="hotspotCounter">Hotspot: 0</div>
        </div>

        <div style="text-align: center;">
            <a href="/" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <script>
    let viewer = null;
    
    // ✅ FIX: Parse & transform hotspots di Laravel sebelum dikirim ke JS
    @php
        $panoramasWithUrl = $panoramas->map(function($p) {
            // Path gambar: pastikan relatif ke public/
            $imgPath = $p->image_path ?? '';
            if (str_starts_with($imgPath, 'storage/')) {
                $p->image_url = '/' . $imgPath;
            } elseif (str_starts_with($imgPath, 'panoramas/')) {
                $p->image_url = '/' . $imgPath;
            } else {
                $p->image_url = asset($imgPath);
            }
            
            // Parse hotspots dari JSON string ke array
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

    // ✅ Build scenes config for Pannellum dengan mapping hotspot yang benar
    const scenesConfig = {};
    
    panoramas.forEach(p => {
        console.log('📦 Loading scene:', p.scene_id);
        
        const hotspots = p.hotspots_array || [];
        console.log('📍 Hotspots raw:', hotspots);
        
        // Transform hotspots dari format admin (x,y %) ke format Pannellum (pitch,yaw derajat)
        const pannellumHotspots = hotspots.map(h => {
            // Jika sudah ada pitch/yaw (format 360°), gunakan itu
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
            
            // Jika hanya ada x/y % (format admin), konversi ke pitch/yaw estimasi
            // ⚠️ Ini hanya estimasi - untuk hasil akurat, simpan pitch/yaw langsung di admin
            const x = typeof h.x === 'number' ? h.x : 50;
            const y = typeof h.y === 'number' ? h.y : 50;
            
            // Konversi sederhana: x% → yaw (-180 to 180), y% → pitch (-90 to 90)
            const yaw = (x - 50) * 3.6;  // 0-100% → -180 to 180
            const pitch = (50 - y) * 1.8; // 0-100% → 90 to -90 (inverted)
            
            console.log(`🔄 Converted hotspot: x:${x}% y:${y}% → yaw:${yaw}° pitch:${pitch}°`);
            
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
            // Untuk gambar normal (non-360), gunakan config khusus
            ...(p.type !== '360' && {
                hfov: 100,
                minHfov: 50,
                maxHfov: 100
            })
        };
        
        console.log('✅ Scene config:', scenesConfig[p.scene_id]);
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (!panoramas || panoramas.length === 0) {
            document.getElementById('panorama').innerHTML = 
                '<div style="padding: 50px; text-align: center;"><h3>📭 Belum ada scene tersedia</h3></div>';
            document.getElementById('hotspotCounter').style.display = 'none';
            return;
        }

        // ✅ Inisialisasi Pannellum Viewer
        viewer = pannellum.viewer('panorama', {
            default: {
                firstScene: panoramas[0].scene_id,
                sceneFadeDuration: 800,
                autoLoad: true,
                showZoomCtrl: true,
                showFullscreenCtrl: true,
                compass: true,
                // Custom hotspot styling
                hotSpotDebug: false
            },
            scenes: scenesConfig
        });

        // ✅ Event: saat hotspot diklik (navigasi antar scene)
        viewer.on('scenechangefailed', function(e) {
            console.error('❌ Scene change failed:', e);
        });
        
        // ✅ Event: saat hotspot scene diklik
        viewer.on('scenechange', function(sceneId) {
            console.log('🔄 Scene changed to:', sceneId);
            
            // Update UI: active button & title
            document.querySelectorAll('.scene-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.scene === sceneId);
            });
            document.getElementById('current-scene-title').textContent = 
                scenesConfig[sceneId]?.title || sceneId;
            
            // Update hotspot counter
            const hs = scenesConfig[sceneId]?.hotSpots || [];
            document.getElementById('hotspotCounter').textContent = `Hotspot: ${hs.length}`;
        });

        // ✅ Hide loading spinner
        setTimeout(() => {
            const loadingEl = document.querySelector('.loading');
            if (loadingEl) loadingEl.style.opacity = '0';
            setTimeout(() => { if (loadingEl) loadingEl.remove(); }, 300);
        }, 1500);

        // ✅ Scene button clicks
        document.querySelectorAll('.scene-btn').forEach(button => {
            button.addEventListener('click', function() {
                const sceneId = this.getAttribute('data-scene');
                if (!sceneId || sceneId === viewer.getScene()) return;
                
                // Update active state
                document.querySelectorAll('.scene-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Load scene with fade
                viewer.loadScene(sceneId);
            });
        });
        
        // ✅ Keyboard navigation (opsional)
        document.addEventListener('keydown', (e) => {
            if (!viewer) return;
            const scenes = Array.from(document.querySelectorAll('.scene-btn'));
            const activeIdx = scenes.findIndex(btn => btn.classList.contains('active'));
            
            if (e.key === 'ArrowRight' && activeIdx < scenes.length - 1) {
                scenes[activeIdx + 1].click();
            } else if (e.key === 'ArrowLeft' && activeIdx > 0) {
                scenes[activeIdx - 1].click();
            }
        });
        
        // ✅ Initial hotspot counter
        const firstScene = panoramas[0].scene_id;
        const firstHs = scenesConfig[firstScene]?.hotSpots || [];
        document.getElementById('hotspotCounter').textContent = `Hotspot: ${firstHs.length}`;
    });
    </script>
</body>
</html>