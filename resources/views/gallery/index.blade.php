<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri - SMK Negeri 11 Bandung</title>
    <link rel="icon" type="image/png" href="{{ asset('image/b/SMK11.jpeg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* === RESET & VARIABLES - SAMA PERSIS DENGAN PRESTASI === */
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
            --success: #28a745;
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
        .circle-3 {
            width: 350px; height: 350px; top: 40%; right: -100px;
            background: radial-gradient(circle, rgba(255,255,255,0.5), transparent 70%);
            animation: float 15s infinite linear;
        }
        .circle-4 {
            width: 400px; height: 400px; bottom: 10%; left: -50px;
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
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 2; }
        
        /* ✅ NAVBAR - Sama persis dengan home & prestasi */
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
            transition: color 0.3s;
        }
        .nav-menu a:hover, .nav-menu a.active { color: var(--primary-blue); }
        .nav-menu a::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0; height: 2px; background: var(--accent-teal);
            transition: width 0.3s ease; border-radius: 3px;
        }
        .nav-menu a:hover::after, .nav-menu a.active::after { width: 100%; }
        
        .nav-toggle {
            display: none; background: none; border: none;
            font-size: 1.4rem; color: var(--primary-blue);
            cursor: pointer; border-radius: 50%; padding: 6px;
            transition: all 0.3s ease;
        }
        .nav-toggle:hover { background: rgba(30, 60, 114, 0.1); }
        
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
        
        /* Page Header - Sama dengan prestasi */
        .page-header {
            padding: 80px 0 50px;
            text-align: center;
            color: var(--white);
        }
        .page-header h1 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 15px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        .page-header h1 i { color: var(--accent-teal); }
        .page-header p {
            font-size: 1.2rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
            font-weight: 300;
        }
        
        /* Filter Buttons - Sama dengan prestasi */
        .filter-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        .filter-btn {
            padding: 10px 24px;
            border: 2px solid var(--white);
            background: transparent;
            color: var(--white);
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
        }
        .filter-btn:hover, .filter-btn.active {
            background: var(--accent-teal);
            border-color: var(--accent-teal);
            color: var(--primary-blue);
            transform: translateY(-2px);
        }
        
        /* Gallery Section */
        .gallery-section { padding: 40px 0 80px; }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        /* Gallery Card - Sama style dengan prestasi card */
        .gallery-card {
            background: var(--white);
            border-radius: 25px;
            padding: 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .gallery-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-teal));
        }
        .gallery-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        }
        
        .gallery-image {
            width: 100%;
            height: 220px;
            overflow: hidden;
        }
        .gallery-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .gallery-card:hover .gallery-image img { transform: scale(1.1); }
        
        .category-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--accent-teal);
            color: var(--primary-blue);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        
        .gallery-content { padding: 20px; flex: 1; display: flex; flex-direction: column; }
        .gallery-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 10px;
            line-height: 1.4;
        }
        .gallery-desc {
            color: var(--gray-700);
            line-height: 1.6;
            font-size: 0.9rem;
            margin-bottom: 15px;
            flex: 1;
        }
        
        .gallery-meta {
            padding-top: 12px;
            border-top: 1px solid var(--gray-200);
            font-size: 0.85rem;
            color: var(--gray-600);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* No Data */
        .no-data {
            text-align: center;
            padding: 60px 20px;
            grid-column: 1 / -1;
        }
        .no-data i { font-size: 4rem; color: var(--gray-300); margin-bottom: 15px; }
        .no-data p { color: var(--white); font-size: 1.1rem; opacity: 0.9; }
        
        /* Pagination - Sama dengan prestasi */
        .pagination-container { margin-top: 40px; display: flex; justify-content: center; }
        .pagination { display: flex; gap: 5px; list-style: none; }
        .pagination li a, .pagination li span {
            padding: 8px 14px;
            border-radius: 8px;
            background: var(--white);
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        .pagination li.active span { background: var(--primary-blue); color: var(--white); }
        .pagination li a:hover { background: var(--accent-teal); color: var(--primary-blue); }
        
        /* Footer - Sama persis */
        footer {
            background: var(--white); padding: 40px 0 25px;
            margin-top: 40px;
            border-top: 4px solid var(--primary-blue);
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
        .footer-brand i { font-size: 1.8rem; }
        .footer-bottom {
            text-align: center; padding-top: 20px;
            color: var(--gray-600); font-size: 1rem;
        }
        
        /* Responsive - Sama dengan prestasi */
        @media (max-width: 968px) { .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); } }
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
            }
            .nav-menu.active { right: 0; }
            .nav-menu li { margin-bottom: 20px; }
            .nav-menu a { font-size: 1.1rem; display: block; }
            .page-header h1 { font-size: 2rem; }
            .gallery-grid { grid-template-columns: 1fr; }
            .nav-login-btn span { display: none; }
            .nav-login-btn { padding: 10px 16px; }
            .nav-login-btn i { font-size: 1.1rem; }
        }
        @media (max-width: 480px) {
            .page-header h1 { font-size: 1.7rem; }
            .gallery-card { border-radius: 20px; }
            .gallery-title { font-size: 1.1rem; }
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

    <!-- Navbar - Sama persis -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SMK NEGERI 11 BANDUNG</span>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('home') }}#profile">Profil Sekolah</a></li>
                <li><a href="{{ route('program.keahlian') }}">Program Keahlian</a></li>
                <li><a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'active' : '' }}">Galeri</a></li>
                <li><a href="{{ route('prestasi') }}">Prestasi</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
                <li><a href="{{ route('denah') }}">Denah 360°</a></li>
            </ul>
            <a href="{{ route('admin.login') }}" class="nav-login-btn">
                <i class="fas fa-user-shield"></i>
                <span>Login Admin</span>
            </a>
            <button class="nav-toggle"><i class="fas fa-bars"></i></button>
        </div>
    </nav>

    <!-- Page Header - Sama dengan prestasi -->
    <section class="page-header">
        <div class="container">
            <h1><i class="fas fa-images"></i> Galeri Sekolah</h1>
            <p>Dokumentasi kegiatan, fasilitas, dan momen berharga di SMK Negeri 11 Bandung</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <!-- Filter Kategori -->
            @if(isset($categories) && $categories->isNotEmpty())
            <div class="filter-container">
                <button class="filter-btn active" data-filter="all">Semua</button>
                @foreach($categories as $cat)
                <button class="filter-btn" data-filter="{{ $cat }}">{{ ucfirst($cat) }}</button>
                @endforeach
            </div>
            @endif

            <!-- Gallery Grid -->
            <div class="gallery-grid">
                @forelse($galleries as $item)
                <div class="gallery-card" data-category="{{ $item->category ?? 'uncategorized' }}">
                    <!-- Category Badge -->
                    @if($item->category)
                    <span class="category-badge">{{ ucfirst($item->category) }}</span>
                    @endif
                    
                    <!-- Image -->
                    <div class="gallery-image">
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             alt="{{ $item->title ?? 'Galeri' }}"
                             onerror="this.src='https://via.placeholder.com/400x300/1e3c72/ffffff?text=No+Image'">
                    </div>
                    
                    <!-- Content -->
                    <div class="gallery-content">
                        @if($item->title)
                        <h3 class="gallery-title">{{ $item->title }}</h3>
                        @endif
                        
                        @if($item->description)
                        <p class="gallery-desc">{{ Str::limit($item->description, 100) }}</p>
                        @endif
                        
                        <div class="gallery-meta">
                            <span><i class="fas fa-calendar me-1"></i>{{ $item->created_at->format('d M Y') }}</span>
                            @if($item->category)
                            <span class="badge bg-secondary">{{ ucfirst($item->category) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="no-data">
                    <i class="fas fa-images"></i>
                    <p>Belum ada galeri yang tersedia</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($galleries) && $galleries->hasPages())
            <div class="pagination-container">
                {{ $galleries->links() }}
            </div>
            @endif
        </div>
    </section>

    <!-- Footer - Sama persis -->
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
        // ✅ Mobile Navigation Toggle - Sama dengan home & prestasi
        document.querySelector('.nav-toggle')?.addEventListener('click', function() {
            document.querySelector('.nav-menu')?.classList.toggle('active');
        });
        
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelector('.nav-menu')?.classList.remove('active');
            });
        });

        // Filter Galeri by Kategori
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                const cards = document.querySelectorAll('.gallery-card');
                
                cards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    
                    if (filter === 'all' || category === filter) {
                        card.style.display = 'flex';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    </script>
</body>
</html>