<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>360° Viewer - Ehanz Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://aframe.io/releases/1.4.0/aframe.min.js"></script>
    <style>
        .viewer-container {
            width: 100%;
            height: 100vh;
            position: relative;
        }
        .hotspot-btn {
            position: absolute;
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border: 3px solid white;
            border-radius: 50%;
            cursor: pointer;
            transform: translate(-50%, -50%);
            z-index: 100;
            animation: pulse 2s infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
        }
        .hotspot-btn:hover {
            background: #ef4444;
            transform: translate(-50%, -50%) scale(1.2);
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            50% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
        }
        .nav-controls {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: rgba(0,0,0,0.7);
            padding: 1rem;
            border-radius: 50px;
            display: flex;
            gap: 1rem;
        }
        .nav-btn {
            background: white;
            color: #333;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }
        .nav-btn:hover {
            background: #3b82f6;
            color: white;
        }
        .nav-btn.active {
            background: #3b82f6;
            color: white;
        }
        .scene {
            display: none;
        }
        .scene.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-900">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">Ehanz Store</a>
            <div class="flex gap-4">
                <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600">Home</a>
                <a href="{{ route('denah') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600">Denah</a>
            </div>
        </div>
    </nav>

    <!-- Viewer -->
    <div class="viewer-container pt-16">
        @foreach($panoramas as $index => $panorama)
            <div class="scene {{ $index === 0 ? 'active' : '' }}" 
                 data-id="{{ $panorama->id }}" 
                 data-index="{{ $index }}"
                 id="scene-{{ $index }}">
                
                @if($panorama->type === '360')
                    <!-- 360° Viewer -->
                    <a-scene embedded>
                        <a-sky src="{{ asset('storage/' . $panorama->image_path) }}" rotation="0 -90 0"></a-sky>
                        <a-camera look-controls wasd-controls="enabled: false"></a-camera>
                    </a-scene>
                @else
                    <!-- Normal Image -->
                    <img src="{{ asset('storage/' . $panorama->image_path) }}" 
                         class="w-full h-full object-cover">
                @endif

                <!-- Hotspots -->
                @if($panorama->hotspots)
                    @foreach($panorama->hotspots as $hIndex => $hotspot)
                        @php
                            $targetIndex = $panoramas->search(fn($p) => $p->id == $hotspot['target_id']);
                            if ($targetIndex === false) $targetIndex = 0;
                        @endphp
                        <button class="hotspot-btn" 
                                style="left: {{ $hotspot['x'] }}%; top: {{ $hotspot['y'] }}%;"
                                onclick="goToScene({{ $targetIndex }})"
                                title="Ke {{ $panoramas[$targetIndex]->name }}">
                            →
                        </button>
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>

    <!-- Navigation Controls -->
    @if($panoramas->count() > 1)
        <div class="nav-controls">
            <button class="nav-btn" onclick="previousScene()">← Sebelumnya</button>
            <div class="flex gap-2 items-center">
                @foreach($panoramas as $index => $panorama)
                    <button class="nav-btn {{ $index === 0 ? 'active' : '' }}" 
                            onclick="goToScene({{ $index }})"
                            id="nav-btn-{{ $index }}">
                        {{ $index + 1 }}
                    </button>
                @endforeach
            </div>
            <button class="nav-btn" onclick="nextScene()">Selanjutnya →</button>
        </div>
    @endif

    <script>
        let currentScene = 0;
        const totalScenes = {{ $panoramas->count() }};

        function goToScene(index) {
            // Hide current
            document.getElementById(`scene-${currentScene}`).classList.remove('active');
            document.getElementById(`nav-btn-${currentScene}`).classList.remove('active');
            
            // Show new
            currentScene = index;
            document.getElementById(`scene-${currentScene}`).classList.add('active');
            document.getElementById(`nav-btn-${currentScene}`).classList.add('active');
        }

        function nextScene() {
            const next = (currentScene + 1) % totalScenes;
            goToScene(next);
        }

        function previousScene() {
            const prev = (currentScene - 1 + totalScenes) % totalScenes;
            goToScene(prev);
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') nextScene();
            if (e.key === 'ArrowLeft') previousScene();
        });
    </script>
</body>
</html>