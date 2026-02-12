<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Denah - {{ $map->room_name ?? 'SMK Negeri 11 Bandung' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            --success: #28a745;
            --shadow-sm: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-md: 0 10px 25px rgba(0,0,0,0.15);
            --shadow-lg: 0 15px 40px rgba(0,0,0,0.2);
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--gray-700);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            line-height: 1.6;
        }

        /* BACKGROUND CIRCLES */
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

        .circle-4 {
            width: 400px;
            height: 400px;
            bottom: 10%;
            left: -50px;
            background: radial-gradient(circle, rgba(255,255,255,0.4), transparent 70%);
            animation: float 18s infinite reverse linear;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(50px, -30px) rotate(90deg); }
            50% { transform: translate(100px, 0) rotate(180deg); }
            75% { transform: translate(50px, 30px) rotate(270deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        .container {
            max-width: 1200px;
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
            padding: 15px 0;
            border-radius: 0 0 30px 30px;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--primary-blue);
            text-decoration: none;
        }

        .nav-brand i {
            font-size: 1.6rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--gray-700);
            font-weight: 600;
            font-size: 1rem;
            padding: 5px 0;
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
            height: 3px;
            background: var(--accent-teal);
            transition: width 0.3s ease;
            border-radius: 5px;
        }

        .nav-menu a:hover::after,
        .nav-menu a.active::after {
            width: 100%;
        }

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-blue);
            cursor: pointer;
            border-radius: 50%;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .nav-toggle:hover {
            background: rgba(30, 60, 114, 0.1);
        }

        /* Back Button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 30px;
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            margin-bottom: 30px;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }

        /* Hero Section */
        .detail-hero {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 0;
            position: relative;
            z-index: 3;
        }

        .detail-hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .detail-text {
            color: var(--white);
            max-width: 600px;
        }

        .detail-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 201, 177, 0.2);
            color: var(--accent-teal);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            margin-bottom: 25px;
            border: 2px solid var(--accent-teal);
            font-size: 1.1rem;
        }

        .detail-hero h1 {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .detail-hero h1 span {
            color: var(--accent-teal);
            display: block;
            margin-top: 10px;
            font-size: 1.8rem;
        }

        .detail-subtitle {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.95;
            font-weight: 300;
            line-height: 1.6;
        }

        /* Map Image Section */
        .map-image-container {
            background: var(--white);
            border-radius: 30px;
            padding: 30px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .map-image-wrapper {
            position: relative;
            width: 100%;
            height: 450px;
            border-radius: 20px;
            overflow: hidden;
            cursor: zoom-in;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .map-image-wrapper:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .map-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .map-image-wrapper:hover .map-image {
            transform: scale(1.05);
        }

        .zoom-indicator {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(30, 60, 114, 0.8);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .map-image-wrapper:hover .zoom-indicator {
            opacity: 1;
            transform: translateY(0);
        }

        /* Detail Section */
        .detail-section {
            padding: 80px 0;
            background: var(--white);
            border-radius: 50px;
            margin-top: -50px;
            position: relative;
            z-index: 3;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 2.6rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .section-header h2 i {
            color: var(--accent-teal);
        }

        .section-header p {
            font-size: 1.2rem;
            color: var(--gray-600);
            max-width: 600px;
            margin: 0 auto;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            max-width: 800px;
            margin: 0 auto;
        }

        .info-card {
            background: var(--white);
            border: 3px solid var(--gray-300);
            border-radius: 30px;
            padding: 35px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .info-card:hover {
            border-color: var(--primary-blue);
            box-shadow: var(--shadow-md);
            transform: translateY(-5px);
        }

        .info-card i {
            font-size: 2rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }

        .info-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 10px;
        }

        .info-card p {
            font-size: 1.2rem;
            color: var(--gray-700);
            line-height: 1.8;
            font-weight: 500;
        }

        /* Footer */
        footer {
            background: var(--white);
            padding: 50px 0 30px;
            margin-top: 80px;
            border-top: 5px solid var(--primary-blue);
            border-radius: 30px 30px 0 0;
        }

        .footer-content {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-blue);
            text-decoration: none;
        }

        .footer-brand i {
            font-size: 2rem;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 25px;
            color: var(--gray-600);
            font-size: 1.1rem;
        }

        /* Responsive Design */
        @media (max-width: 968px) {
            .detail-hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .map-image-wrapper {
                height: 400px;
            }
        }

        @media (max-width: 768px) {
            .nav-toggle {
                display: block;
            }

            .nav-menu {
                position: fixed;
                top: 80px;
                right: -100%;
                flex-direction: column;
                background: var(--white);
                width: 280px;
                height: calc(100vh - 80px);
                padding: 40px 30px;
                box-shadow: -5px 0 25px rgba(0,0,0,0.15);
                transition: right 0.4s ease;
                border-radius: 0 0 40px 40px;
            }

            .nav-menu.active {
                right: 0;
            }

            .nav-menu li {
                margin-bottom: 25px;
            }

            .nav-menu a {
                font-size: 1.2rem;
                display: block;
            }

            .detail-hero h1 {
                font-size: 2.2rem;
            }

            .detail-hero h1 span {
                font-size: 1.6rem;
            }

            .map-image-wrapper {
                height: 350px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .detail-hero h1 {
                font-size: 1.9rem;
            }

            .detail-hero h1 span {
                font-size: 1.5rem;
            }

            .map-image-wrapper {
                height: 300px;
            }

            .info-card {
                padding: 25px;
                border-radius: 25px;
            }

            .info-card h3 {
                font-size: 1.3rem;
            }

            .info-card p {
                font-size: 1.1rem;
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
        <div class="circle circle-4"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-brand">
                <i class="fas fa-school"></i>
                SMK NEGERI 11 BANDUNG
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="#profile">Profil</a></li>
                <li><a href="#gallery">Galeri</a></li>
                <li><a href="#facilities">Fasilitas</a></li>
                <li><a href="{{ route('school.map') }}">Denah Sekolah</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
            <button class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Back Button -->
    <div class="container">
        <a href="{{ route('school.map') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Denah
        </a>
    </div>

    <!-- Hero Section -->
    <section class="detail-hero">
        <div class="container">
            <div class="detail-hero-grid">
                <div class="detail-text">
                    <div class="detail-badge">
                        <i class="fas fa-map-marked-alt"></i>
                        DENAH SEKOLAH
                    </div>
                    <h1>
                        {{ $map->room_name ?? 'Ruangan Sekolah' }}
                        <span>{{ $map->room_code ? '(' . $map->room_code . ')' : '' }}</span>
                    </h1>
                    <p class="detail-subtitle">
                        Lihat detail denah dan informasi lengkap ruangan di SMK Negeri 11 Bandung
                    </p>
                </div>
                <div class="map-image-container">
                    <div class="map-image-wrapper" id="mapWrapper">
                        <img 
                            src="{{ $map->image_url }}" 
                            alt="{{ $map->room_name }}"
                            class="map-image"
                            id="detailMapImage"
                        >
                        <div class="zoom-indicator">
                            <i class="fas fa-search-plus"></i>
                            Klik untuk Zoom
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detail Section -->
    <section class="detail-section">
        <div class="container">
            <div class="section-header">
                <h2>
                    <i class="fas fa-info-circle"></i>
                    Informasi Ruangan
                </h2>
                <p>Detail lengkap ruangan dan fasilitas yang tersedia</p>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <i class="fas fa-tag"></i>
                    <h3>Kode Ruangan</h3>
                    <p>{{ $map->room_code ?? '-' }}</p>
                </div>

                <div class="info-card">
                    <i class="fas fa-door-open"></i>
                    <h3>Nama Ruangan</h3>
                    <p>{{ $map->room_name ?? '-' }}</p>
                </div>

                <div class="info-card">
                    <i class="fas fa-school"></i>
                    <h3>Lokasi</h3>
                    <p>Gedung Utama SMK Negeri 11 Bandung</p>
                </div>

                <div class="info-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Alamat</h3>
                    <p>Jl. Raya Cilember, Bandung</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <a href="{{ route('home') }}" class="footer-brand">
                    <i class="fas fa-school"></i>
                    SMK NEGERI 11 BANDUNG
                </a>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SMK Negeri 11 Bandung | Sekolah Kejuruan Unggulan Berbasis Industri</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar Toggle
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.querySelector('.nav-menu');

        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // Zoom Image on Click
        const mapImage = document.getElementById('detailMapImage');
        const mapWrapper = document.getElementById('mapWrapper');
        let isZoomed = false;

        mapWrapper.addEventListener('click', function() {
            if (isZoomed) {
                // Zoom out
                mapImage.style.transform = 'scale(1)';
                mapWrapper.style.height = '450px';
                mapWrapper.style.cursor = 'zoom-in';
                this.querySelector('.zoom-indicator').innerHTML = '<i class="fas fa-search-plus"></i> Klik untuk Zoom';
                isZoomed = false;
            } else {
                // Zoom in
                mapImage.style.transform = 'scale(1.5)';
                mapWrapper.style.height = '600px';
                mapWrapper.style.cursor = 'zoom-out';
                this.querySelector('.zoom-indicator').innerHTML = '<i class="fas fa-search-minus"></i> Klik untuk Kecilkan';
                isZoomed = true;
            }
            mapImage.style.transition = 'transform 0.5s ease';
            mapWrapper.style.transition = 'height 0.5s ease';
        });

        // Close zoom on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isZoomed) {
                mapImage.style.transform = 'scale(1)';
                mapWrapper.style.height = '450px';
                mapWrapper.style.cursor = 'zoom-in';
                mapWrapper.querySelector('.zoom-indicator').innerHTML = '<i class="fas fa-search-plus"></i> Klik untuk Zoom';
                isZoomed = false;
                mapImage.style.transition = 'transform 0.5s ease';
                mapWrapper.style.transition = 'height 0.5s ease';
            }
        });
    </script>
</body>
</html>