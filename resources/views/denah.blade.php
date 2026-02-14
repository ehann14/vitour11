<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Denah Sekolah - SMK Negeri 11 Bandung</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Pannellum 360° Viewer CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
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
            --shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--gray-700);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }
        /* Background Circles */
        .circle-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        .circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.3;
        }
        .circle-1 {
            width: 500px;
            height: 500px;
            top: -200px;
            left: -100px;
            background: radial-gradient(circle, var(--accent-teal), transparent 70%);
            animation: float 20s infinite linear;
        }
        .circle-2 {
            width: 600px;
            height: 600px;
            bottom: -250px;
            right: -150px;
            background: radial-gradient(circle, var(--accent-teal), transparent 70%);
            animation: float 25s infinite reverse linear;
        }
        .circle-3 {
            width: 350px;
            height: 350px;
            top: 40%;
            right: -100px;
            background: radial-gradient(circle, rgba(255,255,255,0.5), transparent 70%);
            animation: float 15s infinite linear;
        }
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(50px, -30px) rotate(90deg); }
            50% { transform: translate(100px, 0) rotate(180deg); }
            75% { transform: translate(50px, 30px) rotate(270deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }
        /* Navigation */
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
        }
        .nav-brand i {
            font-size: 1.4rem;
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
            font-size: 0.95rem;
            padding: 4px 0;
            position: relative;
        }
        .nav-menu a:hover,
        .nav-menu a.active {
            color: var(--primary-blue);
        }
        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-teal);
            transition: width 0.3s ease;
            border-radius: 3px;
        }
        .nav-menu a:hover::after,
        .nav-menu a.active::after {
            width: 100%;
        }
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: var(--primary-blue);
            cursor: pointer;
            border-radius: 50%;
            padding: 6px;
            transition: all 0.3s ease;
        }
        .nav-toggle:hover {
            background: rgba(30, 60, 114, 0.1);
        }
        /* Header Section */
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
            text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .header p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.7;
        }
        /* 360° Viewer Container */
        .viewer-container {
            background: var(--white);
            border-radius: 30px;
            padding: 30px;
            box-shadow: var(--shadow);
            margin: 0 auto 40px;
            position: relative;
            overflow: hidden;
        }
        .viewer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--gray-300);
        }
        .viewer-header h2 {
            font-size: 1.8rem;
            color: var(--primary-blue);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .viewer-header h2 i {
            color: var(--accent-teal);
        }
        .viewer-subtitle {
            font-size: 1rem;
            color: var(--gray-600);
            margin-top: 5px;
        }
        /* Pannellum Container */
        #panorama {
            width: 100%;
            height: 70vh;
            min-height: 500px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            background: #f0f0f0;
            position: relative;
        }
        /* Loading Spinner */
        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            z-index: 10;
        }
        .spinner {
            width: 60px;
            height: 60px;
            border: 5px solid rgba(30, 60, 114, 0.2);
            border-top-color: var(--accent-teal);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        .loading-text {
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 1.1rem;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        /* Info Panel */
        .info-panel {
            background: var(--white);
            border-radius: 25px;
            padding: 25px;
            box-shadow: var(--shadow);
            margin: 0 auto;
            max-width: 800px;
        }
        .info-panel h3 {
            font-size: 1.5rem;
            color: var(--primary-blue);
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-panel h3 i {
            color: var(--accent-teal);
        }
        .info-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px;
            background: var(--gray-100);
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        .info-item:hover {
            background: rgba(30, 60, 114, 0.08);
            transform: translateX(5px);
        }
        .info-item i {
            font-size: 1.3rem;
            color: var(--primary-blue);
            min-width: 25px;
            display: flex;
            align-items: center;
        }
        .info-text {
            font-size: 0.95rem;
            color: var(--gray-700);
            line-height: 1.6;
        }
        .info-label {
            font-weight: 600;
            color: var(--primary-blue);
            display: block;
            margin-bottom: 3px;
        }
        /* Back Button */
        .back-container {
            text-align: center;
            margin-top: 40px;
        }
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
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(30, 60, 114, 0.4);
            border: none;
            cursor: pointer;
        }
        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(30, 60, 114, 0.5);
        }
        .btn-back i {
            font-size: 1.1rem;
        }
        /* Footer */
        footer {
            background: var(--white);
            padding: 30px 0;
            margin-top: 40px;
            border-top: 4px solid var(--primary-blue);
            border-radius: 25px 25px 0 0;
            text-align: center;
        }
        .footer-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }
        .footer-brand i {
            font-size: 1.8rem;
        }
        .footer-text {
            color: var(--gray-600);
            font-size: 1rem;
        }
        /* Hotspots Styling */
        .pnlm-hotspot {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .pnlm-hotspot:hover {
            transform: scale(1.2);
        }
        /* Controls Styling */
        .pnlm-controls {
            border-radius: 30px !important;
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px) !important;
        }
        .pnlm-zoom-controls {
            border-radius: 30px !important;
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px) !important;
        }
        /* Responsive Design */
        @media (max-width: 968px) {
            .header h1 {
                font-size: 2.1rem;
            }
            #panorama {
                height: 60vh;
                min-height: 450px;
            }
            .info-list {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 768px) {
            .nav-toggle {
                display: block;
            }
            .nav-menu {
                position: fixed;
                top: 70px;
                right: -100%;
                flex-direction: column;
                background: var(--white);
                width: 260px;
                height: calc(100vh - 70px);
                padding: 35px 25px;
                box-shadow: -5px 0 20px rgba(0,0,0,0.15);
                transition: right 0.4s ease;
                border-radius: 0 0 35px 35px;
            }
            .nav-menu.active {
                right: 0;
            }
            .nav-menu li {
                margin-bottom: 20px;
            }
            .nav-menu a {
                font-size: 1.1rem;
                display: block;
            }
            .header h1 {
                font-size: 1.9rem;
            }
            .header p {
                font-size: 1rem;
            }
            #panorama {
                height: 55vh;
                min-height: 400px;
            }
            .viewer-header h2 {
                font-size: 1.6rem;
            }
            .info-panel {
                padding: 20px;
            }
            .btn-back {
                width: 100%;
                max-width: 280px;
                padding: 12px;
                font-size: 0.95rem;
            }
        }
        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.7rem;
            }
            .header p {
                font-size: 0.95rem;
            }
            #panorama {
                height: 50vh;
                min-height: 350px;
            }
            .viewer-header h2 {
                font-size: 1.4rem;
            }
            .viewer-subtitle {
                font-size: 0.9rem;
            }
            .info-panel h3 {
                font-size: 1.3rem;
            }
            .btn-back {
                padding: 10px 25px;
                font-size: 0.9rem;
            }
            .footer-brand {
                font-size: 1.2rem;
            }
            .footer-text {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Background Circles -->
    <div class="circle-bg">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="/" class="nav-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SMK NEGERI 11 BANDUNG</span>
            </a>
            <ul class="nav-menu">
                <li><a href="/">Beranda</a></li>
                <li><a href="/#profile">Profil</a></li>
                <li><a href="/#gallery">Galeri</a></li>
                <li><a href="/#contact">Kontak</a></li>
                <li><a href="/denah" class="active">Denah Sekolah</a></li>
            </ul>
            <button class="nav-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Header -->
    <section class="header">
        <div class="container">
            <h1><i class="fas fa-map-marked-alt"></i> Denah Sekolah SMK Negeri 11 Bandung</h1>
            <p>Explore lingkungan sekolah kami dengan pengalaman 360° yang interaktif. Putar, zoom, dan jelajahi setiap sudut kampus kami secara virtual!</p>
        </div>
    </section>

    <!-- 360° Viewer Section -->
    <section class="viewer-section">
        <div class="container">
            <div class="viewer-container">
                <div class="viewer-header">
                    <div>
                        <h2><i class="fas fa-compass"></i> Virtual Tour 360°</h2>
                        <p class="viewer-subtitle">Klik dan drag untuk memutar | Scroll untuk zoom</p>
                    </div>
                </div>
                
                <!-- Pannellum 360° Viewer -->
                <div id="panorama">
                    <div class="loading">
                        <div class="spinner"></div>
                        <div class="loading-text">Memuat Virtual Tour...</div>
                    </div>
                </div>
            </div>

            <!-- Info Panel -->
            <div class="info-panel">
                <h3><i class="fas fa-info-circle"></i> Informasi & Tips Navigasi</h3>
                <ul class="info-list">
                    <li class="info-item">
                        <i class="fas fa-mouse-pointer"></i>
                        <div>
                            <span class="info-label">Klik & Drag</span>
                            <span class="info-text">Putar pandangan dengan klik dan drag mouse</span>
                        </div>
                    </li>
                    <li class="info-item">
                        <i class="fas fa-scroll"></i>
                        <div>
                            <span class="info-label">Scroll Mouse</span>
                            <span class="info-text">Zoom in/out dengan scroll mouse</span>
                        </div>
                    </li>
                    <li class="info-item">
                        <i class="fas fa-arrows-alt"></i>
                        <div>
                            <span class="info-label">Touch Screen</span>
                            <span class="info-text">Swipe untuk memutar, pinch untuk zoom</span>
                        </div>
                    </li>
                    <li class="info-item">
                        <i class="fas fa-location-arrow"></i>
                        <div>
                            <span class="info-label">Hotspots</span>
                            <span class="info-text">Klik icon untuk informasi lebih detail</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Back Button -->
            <div class="back-container">
                <a href="/" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SMK NEGERI 11 BANDUNG</span>
            </div>
            <p class="footer-text">© {{ date('Y') }} SMK Negeri 11 Bandung | Sekolah Kejuruan Unggulan</p>
        </div>
    </footer>

    <!-- Pannellum 360° Viewer JS -->
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    
    <script>
        // Mobile Navigation Toggle
        document.querySelector('.nav-toggle').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelector('.nav-menu').classList.remove('active');
            });
        });

        // Initialize Pannellum 360° Viewer
        document.addEventListener('DOMContentLoaded', function() {
            // Remove loading spinner after viewer loads
            setTimeout(() => {
                const loading = document.querySelector('.loading');
                if (loading) {
                    loading.style.display = 'none';
                }
            }, 2000);

            // Initialize Pannellum
            pannellum.viewer('panorama', {
                "type": "equirectangular",
                "panorama": "https://pannellum.org/images/alma.jpg", // Ganti dengan URL foto 360° kamu
                "autoLoad": true,
                "showZoomCtrl": true,
                "showFullscreenCtrl": true,
                "showControls": true,
                "compass": true,
                "horizonPitch": 0,
                "horizonRoll": 0,
                "autoRotate": -2, // Auto rotate perlahan
                "autoRotateInactivityDelay": 3000,
                "mouseZoom": true,
                "doubleClickZoom": true,
                "keyboardZoom": true,
                "friction": 0.15,
                "acceleration": 0.05,
                "draggable": true,
                "disableKeyboardCtrl": false,
                
                // Hotspots (optional - tambahkan titik informasi)
                "hotSpots": [
                    {
                        "pitch": 0,
                        "yaw": 0,
                        "type": "info",
                        "text": "Lobi Utama",
                        "id": "hs1"
                    },
                    {
                        "pitch": 10,
                        "yaw": 90,
                        "type": "info",
                        "text": "Ruang Kelas",
                        "id": "hs2"
                    },
                    {
                        "pitch": -5,
                        "yaw": -90,
                        "type": "info",
                        "text": "Laboratorium",
                        "id": "hs3"
                    }
                ]
            });

            // Add custom hotspot click handler
            const viewer = document.querySelector('#panorama');
            viewer.addEventListener('mousedown', function(e) {
                // Prevent default on hotspots
                if (e.target.classList.contains('pnlm-hotspot')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>