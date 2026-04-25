<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Program Keahlian - SMK Negeri 11 Bandung</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            overflow-x: hidden;
            line-height: 1.6;
        }
        .circle-bg {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;
        }
        .circle {
            position: absolute; border-radius: 50%; filter: blur(40px); opacity: 0.3;
        }
        .circle-1 {
            width: 500px; height: 500px; top: -200px; left: -100px;
            background: radial-gradient(circle, var(--accent-teal), transparent 70%);
            animation: float 20s infinite linear;
        }
        .circle-2 {
            width: 600px; height: 600px; bottom: -250px; right: -150px;
            background: radial-gradient(circle, var(--accent-teal), transparent 70%);
            animation: float 25s infinite reverse linear;
        }
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(50px, -30px) rotate(90deg); }
            50% { transform: translate(100px, 0) rotate(180deg); }
            75% { transform: translate(50px, 30px) rotate(270deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 2; }
        
        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky; top: 0; z-index: 1000;
            padding: 12px 0;
            border-radius: 0 0 25px 25px;
        }
        .navbar .container {
            display: flex; justify-content: space-between; align-items: center;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 8px;
            font-weight: 700; font-size: 1.2rem; color: var(--primary-blue);
        }
        .nav-brand i { font-size: 1.4rem; }
        .nav-menu { display: flex; list-style: none; gap: 20px; }
        .nav-menu a {
            text-decoration: none; color: var(--gray-700);
            font-weight: 600; font-size: 0.95rem; padding: 4px 0; position: relative;
        }
        .nav-menu a:hover, .nav-menu a.active { color: var(--primary-blue); }
        .nav-menu a::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0; height: 2px; background: var(--accent-teal);
            transition: width 0.3s ease; border-radius: 3px;
        }
        .nav-menu a:hover::after, .nav-menu a.active::after { width: 100%; }
        
        /* Dropdown */
        .nav-menu li.dropdown { position: relative; }
        .nav-menu li.dropdown > a { display: flex; align-items: center; gap: 4px; cursor: pointer; }
        .nav-menu li.dropdown > a::after {
            content: '\f107'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            font-size: 0.8rem; position: static; width: auto; height: auto; background: none;
        }
        .nav-menu li.dropdown:hover > .dropdown-menu {
            opacity: 1; visibility: visible; transform: translateY(0);
        }
        .dropdown-menu {
            position: absolute; top: 100%; left: 0; min-width: 220px;
            background: var(--white); border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15); padding: 10px 0;
            margin-top: 8px; opacity: 0; visibility: hidden;
            transform: translateY(-10px); transition: all 0.3s ease;
            z-index: 1001; border: 1px solid var(--gray-200);
        }
        .dropdown-menu a {
            display: block; padding: 10px 20px; color: var(--gray-700);
            font-weight: 500; font-size: 0.9rem; text-decoration: none;
            transition: all 0.2s ease;
        }
        .dropdown-menu a:hover {
            background: rgba(0,201,177,0.1); color: var(--primary-blue); padding-left: 25px;
        }
        .dropdown-menu a i { width: 20px; color: var(--accent-teal); }
        
        .nav-toggle {
            display: none; background: none; border: none;
            font-size: 1.4rem; color: var(--primary-blue);
            cursor: pointer; border-radius: 50%; padding: 6px;
        }
        .nav-login-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--white); border-radius: 25px;
            text-decoration: none; font-weight: 600; font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        /* Page Header */
        .page-header {
            padding: 80px 0 40px; text-align: center; color: var(--white);
        }
        .page-header h1 {
            font-size: 2.5rem; font-weight: 800; margin-bottom: 15px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.3);
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }
        .page-header h1 i { color: var(--accent-teal); }
        .page-header p {
            font-size: 1.1rem; opacity: 0.95; max-width: 600px; margin: 0 auto;
        }
        .breadcrumb {
            display: flex; justify-content: center; gap: 8px;
            margin-top: 15px; font-size: 0.9rem; opacity: 0.9;
        }
        .breadcrumb a { color: var(--accent-teal); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        
        /* Program Grid */
        .program-section { padding: 40px 0 80px; }
        .program-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
        }
        .program-card {
            background: var(--white); border-radius: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            overflow: hidden; transition: all 0.4s ease;
            display: flex; flex-direction: column;
        }
        .program-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        }
        .program-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            padding: 25px; color: var(--white);
            display: flex; align-items: center; gap: 15px;
        }
        .program-icon {
            width: 60px; height: 60px; border-radius: 15px;
            background: rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem;
        }
        .program-title {
            font-size: 1.3rem; font-weight: 700; margin-bottom: 5px;
        }
        .program-abbreviation {
            font-size: 0.85rem; opacity: 0.9;
            background: rgba(255,255,255,0.2);
            padding: 4px 12px; border-radius: 20px;
            display: inline-block;
        }
        .program-body {
            padding: 25px; flex: 1; display: flex; flex-direction: column;
        }
        .program-desc {
            color: var(--gray-700); line-height: 1.7;
            font-size: 0.95rem; margin-bottom: 20px; flex: 1;
        }
        .program-stats {
            display: flex; gap: 20px; margin-bottom: 20px;
            padding: 15px; background: var(--gray-100);
            border-radius: 15px;
        }
        .stat-item { text-align: center; }
        .stat-value {
            font-size: 1.5rem; font-weight: 700; color: var(--primary-blue);
        }
        .stat-label { font-size: 0.8rem; color: var(--gray-600); }
        .program-footer {
            padding-top: 15px; border-top: 1px solid var(--gray-200);
        }
        .btn-view {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; background: var(--primary-blue);
            color: var(--white); border-radius: 25px;
            text-decoration: none; font-weight: 600; font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .btn-view:hover {
            background: var(--secondary-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30,60,114,0.3);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center; padding: 60px 20px;
            grid-column: 1 / -1; color: var(--white);
        }
        .empty-state i {
            font-size: 4rem; opacity: 0.3; margin-bottom: 15px;
        }
        .empty-state p { font-size: 1.1rem; opacity: 0.9; }
        
        /* Footer */
        footer {
            background: var(--white); padding: 40px 0 25px;
            margin-top: 40px; border-top: 4px solid var(--primary-blue);
            border-radius: 25px 25px 0 0;
        }
        .footer-content {
            display: flex; justify-content: center; align-items: center;
            padding-bottom: 25px; border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        .footer-brand {
            display: flex; align-items: center; gap: 10px;
            font-weight: 800; font-size: 1.4rem; color: var(--primary-blue);
        }
        .footer-bottom {
            text-align: center; padding-top: 20px;
            color: var(--gray-600); font-size: 1rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-toggle { display: block; }
            .nav-menu {
                position: fixed; top: 70px; right: -100%;
                flex-direction: column; background: var(--white);
                width: 260px; height: calc(100vh - 70px);
                padding: 35px 25px; box-shadow: -5px 0 20px rgba(0,0,0,0.15);
                transition: right 0.4s ease; border-radius: 0 0 35px 35px;
            }
            .nav-menu.active { right: 0; }
            .nav-menu li { margin-bottom: 20px; }
            .nav-menu a { font-size: 1.1rem; display: block; }
            .nav-menu li.dropdown .dropdown-menu {
                position: static; opacity: 1; visibility: visible;
                transform: none; box-shadow: none; border: none;
                padding: 0; margin: 0; max-height: 0; overflow: hidden;
                transition: max-height 0.3s ease; background: rgba(0,201,177,0.05);
                border-radius: 8px; margin-left: 20px;
            }
            .nav-menu li.dropdown.active .dropdown-menu { max-height: 200px; padding: 10px 0; }
            .page-header h1 { font-size: 1.8rem; }
            .program-grid { grid-template-columns: 1fr; }
            .nav-login-btn span { display: none; }
            .nav-login-btn { padding: 10px 16px; }
        }
    </style>
</head>
<body>
    <!-- Background Circles -->
    <div class="circle-bg">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SMK NEGERI 11 BANDUNG</span>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('home') }}#profile">Profil Sekolah</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)"> Program</a>
                    <div class="dropdown-menu">
                        <a href="{{ route('program.keahlian') }}"> Program Keahlian</a>
                        <a href="{{ route('konsentrasi.keahlian') }}"> Konsentrasi Keahlian</a>
                    </div>
                </li>
                <li><a href="{{ route('home') }}#gallery">Galeri</a></li>
                <li><a href="{{ route('prestasi') }}">Prestasi</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
            </ul>
            <a href="{{ route('admin.login') }}" class="nav-login-btn">
                <i class="fas fa-user-shield"></i><span>Login Admin</span>
            </a>
            <button class="nav-toggle"><i class="fas fa-bars"></i></button>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1><i class="fas fa-layer-group"></i> Program Keahlian</h1>
            <p>Pilih jurusan yang sesuai dengan minat dan bakatmu untuk masa depan yang cerah</p>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <span>Program Keahlian</span>
            </div>
        </div>
    </section>

    <!-- Program Grid -->
    <section class="program-section">
        <div class="container">
            @if($programs->count() > 0)
            <div class="program-grid">
                @foreach($programs as $program)
                <div class="program-card">
                    <div class="program-header">
                        <div class="program-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div>
                            <h3 class="program-title">{{ $program->nama }}</h3>
                            <span class="program-abbreviation">{{ $program->singkatan }}</span>
                        </div>
                    </div>
                    <div class="program-body">
                        <p class="program-desc">
                            {{ Str::limit($program->deskripsi ?? 'Program keahlian unggulan dengan kurikulum berbasis industri dan pembelajaran praktik.', 120) }}
                        </p>
                        <div class="program-stats">
                            <div class="stat-item">
                                <div class="stat-value">{{ $program->konsentrasi_count ?? 0 }}</div>
                                <div class="stat-label">Konsentrasi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">✓</div>
                                <div class="stat-label">Akreditasi A</div>
                            </div>
                        </div>
                        <div class="program-footer">
                            <a href="{{ route('program.detail', $program->slug) }}" class="btn-view">
                                Lihat Detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-layer-group"></i>
                <p>Belum ada program keahlian yang tersedia</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <i class="fas fa-graduation-cap"></i>
                    <span>SMK NEGERI 11 BANDUNG</span>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© {{ date('Y') }} SMK Negeri 11 Bandung | Sekolah Kejuruan Unggulan Berbasis Industri</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Navigation Toggle
        document.querySelector('.nav-toggle')?.addEventListener('click', function() {
            document.querySelector('.nav-menu')?.classList.toggle('active');
        });
        
        // Close mobile menu when clicking a link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-menu li.dropdown').forEach(dd => dd.classList.remove('active'));
                document.querySelector('.nav-menu')?.classList.remove('active');
            });
        });
        
        // Mobile Dropdown Toggle
        document.querySelectorAll('.nav-menu li.dropdown > a').forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    const dropdown = this.parentElement;
                    document.querySelectorAll('.nav-menu li.dropdown').forEach(dd => {
                        if (dd !== dropdown) dd.classList.remove('active');
                    });
                    dropdown.classList.toggle('active');
                }
            });
        });
    </script>
</body>
</html>