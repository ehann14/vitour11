<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Denah Sekolah 360° - SMK Negeri 11 Bandung</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
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
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--gray-700);
            min-height: 100vh;
        }
        .container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 12px 0;
            border-radius: 0 0 25px 25px;
        }
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary-blue);
            text-decoration: none;
        }
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 20px;
        }
        .nav-menu a {
            text-decoration: none;
            color: var(--gray-700);
            font-weight: 600;
            padding: 4px 0;
            transition: color 0.3s;
        }
        .nav-menu a:hover, .nav-menu a.active { color: var(--primary-blue); }
        .header {
            text-align: center;
            padding: 40px 0;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        .header h1 i { color: var(--accent-teal); }
        .header p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto;
        }
        .scene-selector {
            background: var(--white);
            border-radius: 30px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            margin-bottom: 25px;
        }
        .scene-selector-header h3 {
            font-size: 1.5rem;
            color: var(--primary-blue);
            font-weight: 700;
            margin-bottom: 20px;
        }
        .scene-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            max-height: 400px;
            overflow-y: auto;
            padding: 10px;
        }
        .scene-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 12px;
            background: var(--gray-100);
            border: 2px solid transparent;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .scene-btn:hover {
            transform: translateY(-2px);
            border-color: var(--accent-teal);
        }
        .scene-btn.active {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
        }
        .viewer-container {
            background: var(--white);
            border-radius: 30px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }
        .viewer-header h2 {
            font-size: 1.8rem;
            color: var(--primary-blue);
            font-weight: 700;
            margin-bottom: 10px;
        }
        #panorama {
            width: 100%;
            height: 70vh;
            min-height: 500px;
            border-radius: 20px;
            background: #f0f0f0;
        }
        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .spinner {
            width: 60px;
            height: 60px;
            border: 5px solid rgba(30, 60, 114, 0.2);
            border-top-color: var(--accent-teal);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 35px;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            text-decoration: none;
            border-radius: 40px;
            font-weight: 700;
            margin-top: 30px;
            transition: transform 0.3s;
        }
        .btn-back:hover { transform: translateY(-3px); }
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
                @foreach($panoramas as $panorama)
                    <button class="scene-btn {{ $loop->first ? 'active' : '' }}" 
                        data-scene="{{ $panorama->scene_id }}">
                        <i class="fas {{ $panorama->icon }}"></i>
                        <span>{{ $panorama->name }}</span>
                    </button>
                @endforeach
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
        
        // ✅ FIX: Parse hotspots di Laravel sebelum dikirim ke JS
        @php
            $panoramasWithUrl = $panoramas->map(function($p) {
                // Path gambar langsung ke /panoramas/filename.jpg
                $p->image_url = '/' . ($p->image_path ?? '');
                
                // ✅ FIX: Parse hotspots dari JSON string ke array
                $hotspotsRaw = $p->hotspots ?? '[]';
                if (is_string($hotspotsRaw)) {
                    try {
                        $p->hotspots_array = json_decode($hotspotsRaw, true);
                        if (!is_array($p->hotspots_array)) {
                            $p->hotspots_array = [];
                        }
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

        const scenesConfig = {};
        panoramas.forEach(p => {
            console.log('Loading scene:', p.scene_id, 'with URL:', p.image_url);
            
            // ✅ FIX: Gunakan hotspots_array yang sudah diparse
            const hotspots = p.hotspots_array || [];
            
            scenesConfig[p.scene_id] = {
                title: p.name,
                type: p.type === '360' ? 'equirectangular' : 'flat',
                panorama: p.image_url,
                hotSpots: hotspots.map(h => ({
                    pitch: h.pitch ?? h.x ?? 0,
                    yaw: h.yaw ?? h.y ?? 0,
                    type: 'scene',
                    text: 'Ke ' + (h.target_name || h.text || 'Lokasi'),
                    sceneId: panoramas.find(p2 => p2.id == (h.target_id || h.sceneId))?.scene_id || p.scene_id,
                    targetYaw: h.targetYaw ?? h.yaw ?? 0
                }))
            };
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (panoramas.length === 0) {
                document.getElementById('panorama').innerHTML = 
                    '<div style="padding: 50px; text-align: center;"><h3>Belum ada scene tersedia</h3></div>';
                return;
            }

            viewer = pannellum.viewer('panorama', {
                default: {
                    firstScene: panoramas[0].scene_id,
                    sceneFadeDuration: 1000,
                    autoLoad: true,
                    showZoomCtrl: true,
                    showFullscreenCtrl: true,
                    compass: true
                },
                scenes: scenesConfig
            });

            setTimeout(() => {
                document.querySelector('.loading').style.display = 'none';
            }, 2000);

            document.querySelectorAll('.scene-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const sceneId = this.getAttribute('data-scene');
                    document.querySelectorAll('.scene-btn').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    viewer.loadScene(sceneId);
                    document.getElementById('current-scene-title').textContent = 
                        scenesConfig[sceneId].title;
                });
            });
        });
    </script>
</body>
</html>