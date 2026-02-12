<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMK Negeri 11 Bandung - Sekolah Unggulan</title>
    
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

        /* Hero Section */
        .hero {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 0;
            position: relative;
            z-index: 3;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .hero-text {
            color: var(--white);
            max-width: 600px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 201, 177, 0.2);
            color: var(--accent-teal);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            margin-bottom: 25px;
            border: 2px solid var(--accent-teal);
        }

        .hero h1 {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 25px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .hero h1 span {
            color: var(--accent-teal);
            display: block;
            margin-top: 10px;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            margin-bottom: 40px;
            opacity: 0.95;
            font-weight: 300;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-align: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(30, 60, 114, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-secondary:hover {
            background: var(--white);
            color: var(--primary-blue);
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(255,255,255,0.3);
        }

        .hero-images {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 15px;
            position: relative;
        }

        .hero-img {
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: all 0.4s ease;
            height: 250px;
            position: relative;
        }

        .hero-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .hero-img:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        .hero-img:hover img {
            transform: scale(1.1);
        }

        .hero-img-1 {
            grid-column: 1 / 2;
            grid-row: 1 / 3;
            height: 515px;
        }

        /* School Profile Section */
        .school-profile {
            padding: 80px 0;
            background: var(--white);
            border-radius: 50px;
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

        .profile-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .school-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white);
            padding: 35px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .stat-info h3 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .stat-info p {
            font-size: 1rem;
            opacity: 0.95;
            font-weight: 500;
        }

        .vision-mission {
            display: flex;
            flex-direction: column;
            gap: 35px;
        }

        .vision-card,
        .mission-card {
            background: var(--white);
            border: 3px solid var(--primary-blue);
            border-radius: 50px;
            padding: 45px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .vision-card:hover,
        .mission-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--accent-teal);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--primary-blue);
        }

        .card-header i {
            font-size: 2rem;
            color: var(--primary-blue);
        }

        .card-header h3 {
            font-size: 1.7rem;
            color: var(--primary-blue);
            font-weight: 700;
        }

        .vision-text {
            font-size: 1.15rem;
            line-height: 2.0;
            color: var(--gray-700);
            font-weight: 400;
            padding-top: 10px;
        }

        .mission-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding-left: 10px;
        }

        .mission-list li {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            font-size: 1.1rem;
            line-height: 1.9;
            color: var(--gray-700);
            padding: 8px 0;
        }

        .mission-list li i {
            color: var(--accent-teal);
            font-size: 1.3rem;
            margin-top: 6px;
            flex-shrink: 0;
        }

        .school-info-card {
            background: var(--white);
            border-radius: 50px;
            padding: 50px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 35px;
            border: 3px solid var(--gray-300);
            transition: var(--transition);
        }

        .school-info-card:hover {
            border-color: var(--primary-blue);
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 35px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--primary-blue);
        }

        .info-header i {
            font-size: 2rem;
            color: var(--primary-blue);
        }

        .info-header h3 {
            font-size: 1.7rem;
            color: var(--primary-blue);
            font-weight: 700;
        }

        .info-grid {
            display: grid;
            gap: 30px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 25px 0;
            border-bottom: 2px solid var(--gray-300);
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: var(--gray-600);
            font-size: 1.15rem;
            min-width: 150px;
        }

        .info-value {
            font-weight: 600;
            color: var(--primary-blue);
            font-size: 1.25rem;
            text-align: right;
            max-width: 70%;
        }

        .info-badge {
            display: inline-block;
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .badge-success {
            background: rgba(40, 167, 69, 0.18);
            color: var(--success);
        }

        .address-card {
            background: var(--white);
            border-radius: 50px;
            padding: 50px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 35px;
            border: 3px solid var(--gray-300);
            transition: var(--transition);
        }

        .address-card:hover {
            border-color: var(--accent-teal);
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }

        .address-grid {
            display: flex;
            flex-direction: column;
            gap: 28px;
            margin-top: 20px;
        }

        .address-item {
            display: flex;
            gap: 20px;
            padding: 25px;
            background: var(--gray-100);
            border-radius: 30px;
            transition: var(--transition);
        }

        .address-item:hover {
            background: rgba(30, 60, 114, 0.08);
            transform: translateX(8px);
        }

        .address-item i {
            font-size: 1.7rem;
            color: var(--primary-blue);
            min-width: 40px;
            display: flex;
            align-items: center;
        }

        .address-label {
            display: block;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 10px;
            font-size: 1.15rem;
        }

        .address-text {
            margin: 0;
            color: var(--primary-blue);
            font-weight: 500;
            font-size: 1.2rem;
            line-height: 1.6;
        }

        .map-card {
            background: var(--white);
            border-radius: 50px;
            padding: 40px;
            box-shadow: var(--shadow-sm);
            border: 3px solid var(--gray-300);
            transition: var(--transition);
        }

        .map-card:hover {
            border-color: var(--primary-blue);
            box-shadow: var(--shadow-md);
        }

        .map-card .card-header {
            margin-bottom: 25px;
        }

        .map-container {
            height: 350px;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        /* Gallery Section */
        .gallery {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 50px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .gallery-item {
            position: relative;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            height: 300px;
            transition: all 0.4s ease;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(30, 60, 114, 0.9), transparent);
            padding: 30px 20px;
            color: var(--white);
            transform: translateY(100%);
            transition: transform 0.4s ease;
        }

        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item h4 {
            font-size: 1.4rem;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .gallery-item p {
            font-size: 0.95rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Footer */
        footer {
            background: var(--white);
            padding: 50px 0 30px;
            margin-top: 50px;
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
            .profile-container {
                grid-template-columns: 1fr;
            }

            .school-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-buttons {
                justify-content: center;
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

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
                border-radius: 30px;
            }

            .hero-img-1 {
                height: 250px;
            }

            .profile-grid,
            .facilities-grid,
            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .school-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .school-info-card,
            .address-card,
            .map-card,
            .vision-card,
            .mission-card {
                border-radius: 40px;
                padding: 35px;
            }

            .info-grid {
                gap: 20px;
            }

            .info-item {
                padding: 20px 0;
                flex-direction: column;
                align-items: flex-start;
            }

            .info-label {
                margin-bottom: 8px;
            }

            .info-value {
                text-align: left;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 1.9rem;
            }

            .hero h1 span {
                font-size: 2.1rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-header h2 {
                font-size: 2.2rem;
            }

            .btn {
                padding: 14px;
                font-size: 1rem;
            }

            .school-stats {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 30px;
                border-radius: 40px;
            }

            .vision-mission {
                gap: 25px;
            }

            .vision-card,
            .mission-card {
                padding: 30px;
                border-radius: 40px;
            }

            .school-info-card,
            .address-card {
                padding: 30px;
                border-radius: 40px;
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
                <li><a href="#home" class="active">Beranda</a></li>
                <li><a href="#profile">Profil</a></li>
                <li><a href="#gallery">Galeri</a></li>
                <li><a href="#facilities">Fasilitas</a></li>
                <li><a href="#achievement">Prestasi</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
            <button class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-text">
                    <div class="hero-badge">
                        <i class="fas fa-crown"></i>
                        SEKOLAH UNGGULAN
                    </div>
                    <h1>
                        Selamat Datang di SMK Negeri 11 Bandung
                        <span>Sekolah unggulan yang memadukan tradisi pendidikan berkualitas dengan inovasi pembelajaran modern</span>
                    </h1>
                    <div class="hero-buttons">
                        <a href="#profile" class="btn btn-primary">
                            <i class="fas fa-book-open"></i>
                            Pelajari Lebih Lanjut
                        </a>
                        <a href="{{ route('school.map') }}" class="btn btn-secondary">
                            <i class="fas fa-map-marked-alt"></i>
                            Lihat Denah Sekolah
                        </a>
                    </div>
                </div>
                <div class="hero-images">
                    <div class="hero-img hero-img-1">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=600&fit=crop" alt="Kegiatan Upacara">
                    </div>
                    <div class="hero-img">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop" alt="Laboratorium Komputer">
                    </div>
                    <div class="hero-img">
                        <img src="https://images.unsplash.com/photo-1503549455944-6b6636e25783?w=800&h=600&fit=crop" alt="Ekstrakurikuler">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Profile Section -->
    <section class="school-profile" id="profile">
        <div class="container">
            <div class="section-header">
                <h2>
                    <i class="fas fa-school"></i>
                    Profil Sekolah
                </h2>
                <p>Menjelajahi sejarah, visi, dan misi SMK Negeri 11 Bandung</p>
            </div>

            <div class="profile-container">
                <div>
                    <div class="school-stats">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-info">
                                <h3>1980</h3>
                                <p>Tahun Berdiri</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="stat-info">
                                <h3>A</h3>
                                <p>Akreditasi Unggul</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="stat-info">
                                <h3>1.648</h3>
                                <p>Siswa Aktif</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="stat-info">
                                <h3>95</h3>
                                <p>Tenaga Pendidik</p>
                            </div>
                        </div>
                    </div>

                    <div class="vision-mission">
                        <div class="vision-card">
                            <div class="card-header">
                                <i class="fas fa-bullseye"></i>
                                <h3>Visi Sekolah</h3>
                            </div>
                            <p class="vision-text">
                                Menjadi lembaga pendidikan kejuruan yang unggul dalam prestasi, inovatif dalam pembelajaran, dan berwawasan global untuk menghasilkan lulusan yang kompeten dan berakhlak mulia.
                            </p>
                        </div>
                        <div class="mission-card">
                            <div class="card-header">
                                <i class="fas fa-tasks"></i>
                                <h3>Misi Sekolah</h3>
                            </div>
                            <ul class="mission-list">
                                <li><i class="fas fa-check-circle"></i> Menyelenggarakan pendidikan kejuruan yang berkualitas dan relevan dengan kebutuhan industri</li>
                                <li><i class="fas fa-check-circle"></i> Mengembangkan kompetensi peserta didik sesuai standar kompetensi kerja nasional</li>
                                <li><i class="fas fa-check-circle"></i> Membentuk karakter peserta didik yang berakhlak mulia dan berjiwa wirausaha</li>
                                <li><i class="fas fa-check-circle"></i> Menjalin kerjasama dengan dunia usaha dan dunia industri untuk peningkatan mutu pendidikan</li>
                                <li><i class="fas fa-check-circle"></i> Mengembangkan budaya mutu dan inovasi dalam penyelenggaraan pendidikan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="school-info-card">
                        <div class="info-header">
                            <i class="fas fa-id-card"></i>
                            <h3>Identitas Sekolah</h3>
                        </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Nama Sekolah</span>
                                <span class="info-value">SMK Negeri 11 Bandung</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">NPSN</span>
                                <span class="info-value">20216789</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status</span>
                                <span class="info-value">Negeri</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Akreditasi</span>
                                <span class="info-value">
                                    <span class="info-badge badge-success">A (Unggul)</span>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tahun Berdiri</span>
                                <span class="info-value">1985</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Kepala Sekolah</span>
                                <span class="info-value">Eka Rachman, S. Kom., M. M. Pd.</span>
                            </div>
                        </div>
                    </div>

                    <div class="address-card">
                        <div class="info-header">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3>Alamat & Kontak</h3>
                        </div>
                        <div class="address-grid">
                            <div class="address-item">
                                <i class="fas fa-map-marked-alt"></i>
                                <div>
                                    <span class="address-label">Alamat</span>
                                    <p class="address-text">Jl. Raya Cilember, RT.01/RW.04, Sukaraja, Kec. Cicendo, Kota Bandung, Jawa Barat 40136</p>
                                </div>
                            </div>
                            <div class="address-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <span class="address-label">Telepon</span>
                                    <p class="address-text">(022) 6652442</p>
                                </div>
                            </div>
                            <div class="address-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <span class="address-label">Email</span>
                                    <p class="address-text">info@smkn11bandung.sch.id</p>
                                </div>
                            </div>
                            <div class="address-item">
                                <i class="fas fa-globe"></i>
                                <div>
                                    <span class="address-label">Website</span>
                                    <p class="address-text">www.smkn11bandung.sch.id</p>
                                </div>
                            </div>
                            <div class="address-item">
                                <i class="fab fa-instagram"></i>
                                <div>
                                    <span class="address-label">Instagram</span>
                                    <p class="address-text">@smkn11bandung</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="map-card">
                        <div class="card-header">
                            <i class="fas fa-map"></i>
                            <h3>Lokasi Sekolah</h3>
                        </div>
                        <div class="map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.896734132245!2d107.58698231477234!3d-6.914744394999081!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e5c9d3f9b1b7%3A0x4027a76e38262e0!2sSMK%20Negeri%2011%20Bandung!5e0!3m2!1sid!2sid!4v1683000000000!5m2!1sid!2sid" 
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery" id="gallery">
        <div class="container">
            <div class="section-header">
                <h2>
                    <i class="fas fa-images"></i>
                    Galeri Kegiatan
                </h2>
                <p>Momen berharga di SMK Negeri 11 Bandung</p>
            </div>

            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=600&fit=crop" alt="Kegiatan Upacara">
                    <div class="gallery-overlay">
                        <h4>Kegiatan Upacara</h4>
                        <p>Siswa aktif dalam proses pembelajaran</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop" alt="Laboratorium Komputer">
                    <div class="gallery-overlay">
                        <h4>Laboratorium Komputer</h4>
                        <p>Fasilitas komputer terbaru</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1503549455944-6b6636e25783?w=800&h=600&fit=crop" alt="Ekstrakurikuler">
                    <div class="gallery-overlay">
                        <h4>Ekstrakurikuler</h4>
                        <p>Pengembangan minat dan bakat siswa</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=600&fit=crop" alt="Perpustakaan">
                    <div class="gallery-overlay">
                        <h4>Perpustakaan</h4>
                        <p>Sumber belajar yang lengkap</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
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

        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu jika terbuka
                    navMenu.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>