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
        /* === RESET & VARIABLES === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary-blue: #1e3c72;
            --secondary-blue: #2a5298;
            --accent-teal: #00c9b1;
            --white: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
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
        .container { max-width: 1100px; margin: 0 auto; padding: 0 20px; }

        /* === NAVBAR === */
        .navbar {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: sticky; top: 0; z-index: 1000;
            padding: 15px 0;
            border-radius: 0 0 20px 20px;
        }
        .navbar .container {
            display: flex; justify-content: space-between; align-items: center;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 12px;
            font-weight: 700; font-size: 1.3rem; color: var(--primary-blue);
            text-decoration: none;
        }
        .nav-brand i { font-size: 1.8rem; color: var(--accent-teal); }
        .nav-menu { display: flex; list-style: none; gap: 25px; }
        .nav-menu a {
            text-decoration: none; color: var(--gray-700);
            font-weight: 600; font-size: 0.95rem;
            transition: color 0.3s ease;
        }
        .nav-menu a:hover { color: var(--primary-blue); }
        .nav-login-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 24px;
            background: var(--primary-blue);
            color: var(--white); border-radius: 25px;
            text-decoration: none; font-weight: 600;
            transition: all 0.3s ease;
        }
        .nav-login-btn:hover { 
            background: var(--secondary-blue);
            transform: translateY(-2px);
        }

        /* === PAGE HEADER === */
        .page-header {
            padding: 60px 0 40px; text-align: center; color: var(--white);
        }
        .page-header h1 {
            font-size: 2.5rem; font-weight: 800; margin-bottom: 10px;
        }
        .breadcrumb {
            font-size: 0.95rem; opacity: 0.9;
        }
        .breadcrumb a { color: var(--accent-teal); text-decoration: none; }

        /* === PROGRAM GRID === */
        .program-section { padding: 40px 0 80px; }
        .program-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            justify-content: center;
        }

        /* === PROGRAM CARD === */
        .program-card {
            background: var(--white);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            max-width: 340px;
            width: 100%;
            margin: 0 auto;
        }
        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        /* Top Section: Logo, Title, Badge */
        .card-top {
            padding: 25px 20px 15px;
            text-align: center;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }
        .logo-box {
            width: 110px;
            height: 110px;
            margin: 0 auto 15px;
            background: var(--white);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
            border: 1px solid var(--gray-200);
            padding: 8px;
        }
        .program-logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .logo-placeholder {
            font-size: 2.5rem;
            color: var(--gray-400);
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 10px;
            line-height: 1.4;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-badge {
            display: inline-block;
            background: #e0f2fe;
            color: #0369a1;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-top: 5px;
        }

        /* Bottom Section: Desc, Stats, Button */
        .card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        .card-desc {
            font-size: 0.9rem;
            color: var(--gray-600);
            margin-bottom: 18px;
            flex: 1;
            line-height: 1.6;
        }
        .card-stats {
            display: flex;
            justify-content: space-around;
            background: var(--gray-100);
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 18px;
        }
        .stat-item { display: flex; flex-direction: column; align-items: center; }
        .stat-num { font-size: 1.3rem; font-weight: 700; color: var(--primary-blue); }
        .stat-label { font-size: 0.75rem; color: var(--gray-600); margin-top: 2px; }
        .stat-check { font-size: 1.3rem; color: var(--accent-teal); }

        .card-btn {
            width: 100%;
            padding: 12px;
            background: var(--primary-blue);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }
        .card-btn:hover {
            background: var(--secondary-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30,60,114,0.2);
        }

        /* === EMPTY STATE === */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--white);
        }
        .empty-state i {
            font-size: 4rem;
            opacity: 0.3;
            margin-bottom: 15px;
        }
        .empty-state p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* === FOOTER === */
        footer {
            background: var(--white);
            padding: 40px 0 25px;
            margin-top: 40px;
            border-top: 4px solid var(--primary-blue);
            border-radius: 25px 25px 0 0;
        }
        .footer-content {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--primary-blue);
        }
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            color: var(--gray-600);
            font-size: 1rem;
        }

        /* === MODAL === */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 2000;
            display: none;
            justify-content: center;
            align-items: center;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }
        .modal-content {
            background: var(--white);
            border-radius: 20px;
            max-width: 650px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }
        .modal-overlay.active .modal-content {
            transform: scale(1);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            padding: 30px;
            color: var(--white);
            border-radius: 20px 20px 0 0;
            position: relative;
        }
        .modal-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .modal-singkatan {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.9rem;
        }
        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            border: none;
            color: var(--white);
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .modal-close:hover {
            background: rgba(255,255,255,0.4);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px;
        }
        .modal-section {
            margin-bottom: 25px;
        }
        .modal-section:last-child {
            margin-bottom: 0;
        }
        
        .modal-section-label {
            font-size: 0.9rem;
            color: var(--primary-blue);
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .modal-section-value {
            font-size: 0.95rem;
            color: var(--gray-700);
            line-height: 1.8;
            background: var(--gray-100);
            padding: 15px;
            border-radius: 10px;
        }
        .modal-logo-container {
            text-align: center;
            margin-bottom: 25px;
        }
        .modal-logo {
            max-width: 150px;
            max-height: 150px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 10px;
            background: #fff;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .page-header h1 { font-size: 1.8rem; }
            .program-grid { grid-template-columns: 1fr; }
            .program-card { max-width: 100%; }
            .modal-header { padding: 20px; }
            .modal-body { padding: 20px; }
        }
    </style>
</head>
<body>
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
                <li><a href="{{ route('program.keahlian') }}">Program</a></li>
                <li><a href="{{ route('home') }}#gallery">Galeri</a></li>
                <li><a href="{{ route('prestasi') }}">Prestasi</a></li>
                <li><a href="{{ route('home') }}#contact">Kontak</a></li>
            </ul>
            <a href="{{ route('admin.login') }}" class="nav-login-btn">
                <i class="fas fa-user-shield"></i>Login Admin
            </a>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1><i class="fas fa-layer-group"></i> Program Keahlian</h1>
        </div>
    </section>

    <!-- Program Grid -->
    <section class="program-section">
        <div class="container">
            @if($programs->count() > 0)
            <div class="program-grid">
                @foreach($programs as $program)
                <div class="program-card">
                    <!-- Top: Logo Centered -->
                    <div class="card-top">
                        <div class="logo-box">
                            @if($program->logo && file_exists(public_path('storage/' . $program->logo)))
                                <img src="{{ asset('storage/' . $program->logo) }}" alt="{{ $program->nama }}" class="program-logo">
                            @else
                                <i class="fas fa-laptop-code logo-placeholder"></i>
                            @endif
                        </div>
                        
                        <!-- JUDUL LENGKAP (MENGGUNAKAN KOLOM 'nama') -->
                        <h3 class="card-title">{{ $program->nama }}</h3>
                        
                        <!-- BADGE SINGKATAN -->
                        <span class="card-badge">{{ $program->singkatan }}</span>
                    </div>
                    
                    <!-- Bottom: Info & Button -->
                    <div class="card-body">
                        <p class="card-desc">
                            {{ Str::limit(strip_tags($program->deskripsi), 90) }}
                        </p>
                        <button class="card-btn btn-modal" 
                            data-nama="{{ $program->nama }}"
                            data-singkatan="{{ $program->singkatan }}"
                            data-deskripsi="{{ strip_tags($program->deskripsi) }}"
                            data-visi="{{ strip_tags($program->visi ?? '') }}"
                            data-misi="{{ strip_tags($program->misi ?? '') }}"
                            data-logo="{{ $program->logo ? asset('storage/' . $program->logo) : '' }}">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
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

    <!-- MODAL POPUP -->
    <div class="modal-overlay" id="programModal">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h2 class="modal-title" id="modalTitle">Nama Program</h2>
                    <span class="modal-singkatan" id="modalSingkatan">PPLG</span>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-logo-container">
                    <img src="" id="modalLogo" alt="Logo Program" class="modal-logo" style="display: none;">
                </div>
                
                <div class="modal-section">
                    <div class="modal-section-label">
                        <i class="fas fa-info-circle"></i> Tentang Kami
                    </div>
                    <div class="modal-section-value" id="modalDeskripsi">
                        <!-- Deskripsi muncul di sini -->
                    </div>
                </div>
                
                <div class="modal-section" id="sectionVisi" style="display: none;">
                    <div class="modal-section-label">
                        <i class="fas fa-eye"></i> Visi
                    </div>
                    <div class="modal-section-value" id="modalVisi">
                        <!-- Visi muncul di sini -->
                    </div>
                </div>
                
                <div class="modal-section" id="sectionMisi" style="display: none;">
                    <div class="modal-section-label">
                        <i class="fas fa-bullseye"></i> Misi
                    </div>
                    <div class="modal-section-value" id="modalMisi">
                        <!-- Misi muncul di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Modal Functions
        const modal = document.getElementById('programModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalSingkatan = document.getElementById('modalSingkatan');
        const modalDeskripsi = document.getElementById('modalDeskripsi');
        const modalVisi = document.getElementById('modalVisi');
        const modalMisi = document.getElementById('modalMisi');
        const modalLogo = document.getElementById('modalLogo');
        const sectionVisi = document.getElementById('sectionVisi');
        const sectionMisi = document.getElementById('sectionMisi');

        // Open Modal
        function openModal(data) {
            modalTitle.textContent = data.nama;
            modalSingkatan.textContent = data.singkatan;
            modalDeskripsi.textContent = data.deskripsi || 'Deskripsi tidak tersedia.';
            
            // Logo Logic
            if (data.logo && data.logo !== '') {
                modalLogo.src = data.logo;
                modalLogo.style.display = 'block';
            } else {
                modalLogo.style.display = 'none';
            }
            
            // Visi Logic
            if (data.visi && data.visi.trim() !== '') {
                modalVisi.textContent = data.visi;
                sectionVisi.style.display = 'block';
            } else {
                sectionVisi.style.display = 'none';
            }
            
            // Misi Logic
            if (data.misi && data.misi.trim() !== '') {
                modalMisi.textContent = data.misi;
                sectionMisi.style.display = 'block';
            } else {
                sectionMisi.style.display = 'none';
            }
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Close Modal
        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Event Listeners
        document.querySelectorAll('.btn-modal').forEach(button => {
            button.addEventListener('click', function() {
                const data = {
                    nama: this.getAttribute('data-nama'),
                    singkatan: this.getAttribute('data-singkatan'),
                    deskripsi: this.getAttribute('data-deskripsi'),
                    visi: this.getAttribute('data-visi'),
                    misi: this.getAttribute('data-misi'),
                    logo: this.getAttribute('data-logo')
                };
                openModal(data);
            });
        });

        // Close on outside click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
        });
    </script>
</body>
</html>