<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMK Negeri 11 Bandung - Sekolah Unggulan</title>
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
            --success: #28a745;
        }
        html { scroll-behavior: smooth; scroll-padding-top: 80px; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--gray-700);
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6;
        }
        .circle-bg { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden; }
        .circle { position: absolute; border-radius: 50%; filter: blur(40px); opacity: 0.3; }
        .circle-1 { width: 500px; height: 500px; top: -200px; left: -100px; background: radial-gradient(circle, var(--accent-teal), transparent 70%); animation: float 20s infinite linear; }
        .circle-2 { width: 600px; height: 600px; bottom: -250px; right: -150px; background: radial-gradient(circle, var(--accent-teal), transparent 70%); animation: float 25s infinite reverse linear; }
        .circle-3 { width: 350px; height: 350px; top: 40%; right: -100px; background: radial-gradient(circle, rgba(255,255,255,0.5), transparent 70%); animation: float 15s infinite linear; }
        .circle-4 { width: 400px; height: 400px; bottom: 10%; left: -50px; background: radial-gradient(circle, rgba(255,255,255,0.4), transparent 70%); animation: float 18s infinite reverse linear; }
        @keyframes float { 0% { transform: translate(0, 0) rotate(0deg); } 25% { transform: translate(50px, -30px) rotate(90deg); } 50% { transform: translate(100px, 0) rotate(180deg); } 75% { transform: translate(50px, 30px) rotate(270deg); } 100% { transform: translate(0, 0) rotate(360deg); } }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 2; }
        
        /* Navigation */
        .navbar { background: rgba(255, 255, 255, 0.95); box-shadow: 0 4px 20px rgba(0,0,0,0.15); position: sticky; top: 0; z-index: 1000; padding: 12px 0; border-radius: 0 0 25px 25px; }
        .navbar .container { display: flex; justify-content: space-between; align-items: center; }
        .nav-brand { display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 1.2rem; color: var(--primary-blue); }
        .nav-brand i { font-size: 1.4rem; }
        .nav-menu { display: flex; list-style: none; gap: 20px; }
        .nav-menu a { text-decoration: none; color: var(--gray-700); font-weight: 600; font-size: 0.95rem; padding: 4px 0; position: relative; transition: color 0.3s; }
        .nav-menu a:hover, .nav-menu a.active { color: var(--primary-blue); }
        .nav-menu a::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: var(--accent-teal); transition: width 0.3s ease; border-radius: 3px; }
        .nav-menu a:hover::after, .nav-menu a.active::after { width: 100%; }
        .nav-toggle { display: none; background: none; border: none; font-size: 1.4rem; color: var(--primary-blue); cursor: pointer; border-radius: 50%; padding: 6px; transition: all 0.3s ease; }
        .nav-toggle:hover { background: rgba(30, 60, 114, 0.1); }
        .nav-login-btn { display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue)); color: var(--white); border-radius: 25px; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(30, 60, 114, 0.25); }
        .nav-login-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(30, 60, 114, 0.4); color: var(--white); }
        .nav-login-btn i { font-size: 0.95rem; }
        
        /* Hero Section */
        .hero { min-height: 85vh; display: flex; align-items: center; justify-content: center; padding: 60px 0; position: relative; z-index: 3; }
        .hero-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
        .hero-text { color: var(--white); max-width: 600px; }
        .hero-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(0, 201, 177, 0.2); color: var(--accent-teal); padding: 6px 16px; border-radius: 40px; font-weight: 600; margin-bottom: 20px; border: 2px solid var(--accent-teal); font-size: 0.9rem; }
        .hero h1 { font-size: 2.8rem; font-weight: 800; line-height: 1.2; margin-bottom: 20px; text-shadow: 0 4px 15px rgba(0,0,0,0.3); }
        .hero h1 span { color: var(--accent-teal); display: block; margin-top: 8px; font-size: 2.6rem; }
        .hero-subtitle { font-size: 1.2rem; margin-bottom: 30px; opacity: 0.95; font-weight: 300; line-height: 1.6; }
        .hero-buttons { display: flex; gap: 15px; flex-wrap: wrap; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 14px 28px; border-radius: 40px; text-decoration: none; font-weight: 700; font-size: 1rem; transition: all 0.3s ease; border: none; cursor: pointer; text-align: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
        .btn-primary { background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue)); color: var(--white); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(30, 60, 114, 0.4); }
        .btn-secondary { background: transparent; color: var(--white); border: 2px solid var(--white); }
        .btn-secondary:hover { background: var(--white); color: var(--primary-blue); transform: translateY(-3px); box-shadow: 0 6px 20px rgba(255,255,255,0.3); }
        .hero-images { display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(2, 1fr); gap: 12px; position: relative; }
        .hero-img { border-radius: 25px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.3); transition: all 0.4s ease; height: 220px; position: relative; }
        .hero-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .hero-img:hover { transform: translateY(-8px) scale(1.05); box-shadow: 0 12px 35px rgba(0,0,0,0.4); }
        .hero-img:hover img { transform: scale(1.1); }
        .hero-img-1 { grid-column: 1 / 2; grid-row: 1 / 3; height: 460px; }
        
        /* School Profile Section */
        .school-profile { padding: 60px 0; background: var(--white); border-radius: 35px; }
        .section-header { text-align: center; margin-bottom: 45px; }
        .section-header h2 { font-size: 2.2rem; font-weight: 700; margin-bottom: 12px; color: var(--primary-blue); display: flex; align-items: center; justify-content: center; gap: 12px; }
        .section-header h2 i { color: var(--accent-teal); font-size: 1.6rem; }
        .section-header p { font-size: 1.05rem; color: var(--gray-600); max-width: 550px; margin: 0 auto; }
        .profile-container { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .school-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; margin-bottom: 30px; }
        .stat-card { background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue)); color: var(--white); padding: 20px; border-radius: 30px; display: flex; align-items: center; gap: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.15); transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .stat-icon { width: 50px; height: 50px; background: rgba(255, 255, 255, 0.25); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .stat-info h3 { font-size: 1.8rem; font-weight: 800; margin-bottom: 5px; }
        .stat-info p { font-size: 0.9rem; opacity: 0.95; font-weight: 500; }
        .vision-mission { display: flex; flex-direction: column; gap: 22px; margin-bottom: 30px; }
        .vision-card, .mission-card { background: var(--white); border: 2px solid var(--primary-blue); border-radius: 30px; padding: 28px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; }
        .vision-card:hover, .mission-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); border-color: var(--accent-teal); }
        .card-header { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 2px solid var(--primary-blue); }
        .card-header i { font-size: 1.5rem; color: var(--primary-blue); }
        .card-header h3 { font-size: 1.4rem; color: var(--primary-blue); font-weight: 700; }
        .vision-text { font-size: 1rem; line-height: 1.7; color: var(--gray-700); font-weight: 400; }
        .mission-list { list-style: none; display: flex; flex-direction: column; gap: 12px; padding-left: 10px; }
        .mission-list li { display: flex; align-items: flex-start; gap: 12px; font-size: 0.95rem; line-height: 1.6; color: var(--gray-700); padding: 5px 0; }
        .mission-list li i { color: var(--accent-teal); font-size: 1.1rem; margin-top: 4px; flex-shrink: 0; }
        .info-contact-container { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 30px; }
        .school-info-card { background: var(--white); border-radius: 25px; padding: 22px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid var(--gray-300); transition: all 0.3s ease; }
        .school-info-card:hover { border-color: var(--primary-blue); box-shadow: 0 6px 20px rgba(0,0,0,0.15); transform: translateY(-2px); }
        .info-header { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid var(--primary-blue); }
        .info-header i { font-size: 1.4rem; color: var(--primary-blue); }
        .info-header h3 { font-size: 1.3rem; color: var(--primary-blue); font-weight: 700; }
        .info-grid { display: grid; gap: 12px; }
        .info-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--gray-300); }
        .info-item:last-child { border-bottom: none; padding-bottom: 0; }
        .info-label { font-weight: 600; color: var(--gray-600); font-size: 0.9rem; min-width: 110px; }
        .info-value { font-weight: 600; color: var(--primary-blue); font-size: 1rem; text-align: right; max-width: 65%; }
        .info-badge { display: inline-block; padding: 5px 14px; border-radius: 25px; font-size: 0.9rem; font-weight: 600; }
        .badge-success { background: rgba(40, 167, 69, 0.18); color: var(--success); }
        .address-card { background: var(--white); border-radius: 25px; padding: 22px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid var(--gray-300); transition: all 0.3s ease; }
        .address-card:hover { border-color: var(--accent-teal); box-shadow: 0 6px 20px rgba(0,0,0,0.15); transform: translateY(-2px); }
        .address-grid { display: flex; flex-direction: column; gap: 14px; margin-top: 10px; }
        .address-item { display: flex; gap: 10px; padding: 12px; background: var(--gray-100); border-radius: 18px; transition: all 0.3s ease; }
        .address-item:hover { background: rgba(30, 60, 114, 0.08); transform: translateX(3px); }
        .address-item i { font-size: 1.2rem; color: var(--primary-blue); min-width: 28px; display: flex; align-items: center; }
        .address-label { display: block; font-weight: 600; color: var(--gray-700); margin-bottom: 5px; font-size: 0.9rem; }
        .address-text { margin: 0; color: var(--primary-blue); font-weight: 500; font-size: 1rem; line-height: 1.5; }
        .map-card { background: var(--white); border-radius: 30px; padding: 28px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 2px solid var(--gray-300); transition: all 0.3s ease; }
        .map-card:hover { border-color: var(--primary-blue); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
        .map-card .card-header { margin-bottom: 18px; }
        .map-container { height: 300px; border-radius: 25px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
        
        /* Gallery Section */
        .gallery { padding: 60px 0; background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-radius: 35px; }
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .gallery-item { position: relative; border-radius: 25px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.15); height: 280px; transition: all 0.4s ease; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .gallery-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(30, 60, 114, 0.9), transparent); padding: 25px 20px; color: var(--white); transform: translateY(100%); transition: transform 0.4s ease; }
        .gallery-item:hover .gallery-overlay { transform: translateY(0); }
        .gallery-item:hover img { transform: scale(1.1); }
        .gallery-item h4 { font-size: 1.3rem; margin-bottom: 6px; font-weight: 700; }
        .gallery-item p { font-size: 0.9rem; opacity: 0.9; line-height: 1.5; }
        .gallery-button-container { text-align: center; margin-top: 50px; padding: 30px 0 20px; }
        .gallery-button-container .btn-primary { background: var(--primary-blue); border: none; border-radius: 25px; padding: 14px 35px; font-size: 1.05rem; box-shadow: 0 6px 20px rgba(30, 60, 114, 0.3); transition: all 0.3s ease; }
        .gallery-button-container .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(30, 60, 114, 0.4); }

        /* Comments Section - CAROUSEL STYLES */
        .comments-section { background: var(--white); border-radius: 35px; padding: 60px 0; margin-top: 40px; }
        .comment-form-card { background: var(--white); border-radius: 25px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); border: 2px solid var(--gray-200); overflow: hidden; }
        .card-body-custom { padding: 35px; }
        .form-title { color: var(--primary-blue); font-weight: 700; font-size: 1.4rem; margin-bottom: 25px; display: flex; align-items: center; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .form-col { display: flex; flex-direction: column; }
        .form-group { margin-bottom: 25px; }
        .form-label-custom { font-weight: 600; color: var(--gray-700); margin-bottom: 8px; display: block; font-size: 0.95rem; }
        .required { color: #dc3545; }
        .form-input-custom, .form-textarea-custom { width: 100%; padding: 14px 18px; border: 2px solid var(--gray-300); border-radius: 15px; font-family: 'Poppins', sans-serif; font-size: 0.95rem; transition: all 0.3s ease; background: var(--white); }
        .form-input-custom:focus, .form-textarea-custom:focus { outline: none; border-color: var(--accent-teal); box-shadow: 0 0 0 4px rgba(0, 201, 177, 0.1); }
        .form-textarea-custom { resize: vertical; min-height: 120px; }
        .form-actions { text-align: right; margin-top: 10px; }
        .btn-submit-custom { display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue)); color: var(--white); border: none; border-radius: 25px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(30, 60, 114, 0.3); }
        .btn-submit-custom:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(30, 60, 114, 0.4); }
        .invalid-feedback-custom { color: #dc3545; font-size: 0.85rem; margin-top: 5px; display: block; }
        .alert-success-custom { background: rgba(40, 167, 69, 0.15); border: 2px solid var(--success); color: var(--success); padding: 15px 20px; border-radius: 15px; display: flex; align-items: center; justify-content: space-between; font-weight: 500; }
        .btn-close-custom { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--success); line-height: 1; padding: 0 5px; }
        .comments-title { color: var(--primary-blue); font-weight: 700; font-size: 1.3rem; margin-bottom: 25px; display: flex; align-items: center; }
        
        /* ✅ CAROUSEL WRAPPER & CONTROLS */
        .comment-carousel-wrapper {
            position: relative;
            max-width: 1000px; /* Lebar area carousel */
            margin: 0 auto;
            padding: 0 50px; /* Ruang untuk tombol panah */
        }
        
        .comment-carousel-window {
            overflow: hidden;
            border-radius: 20px;
            background: #f8f9fa;
        }

        .comment-carousel-track {
            display: flex;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }
        
        .comment-carousel-item {
            min-width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .comment-card-carousel {
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .comment-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .comment-card-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-teal), var(--secondary-blue));
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .comment-card-info { flex: 1; }
        .comment-card-author { color: var(--primary-blue); font-weight: 700; font-size: 1.1rem; }
        .comment-card-time { color: var(--gray-600); font-size: 0.85rem; }
        .comment-card-text { color: var(--gray-700); line-height: 1.7; font-size: 1rem; }

        /* Tombol Panah */
        .carousel-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            background: var(--white);
            border: 2px solid var(--primary-blue);
            border-radius: 50%;
            color: var(--primary-blue);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .carousel-nav-btn:hover {
            background: var(--primary-blue);
            color: var(--white);
        }
        .carousel-nav-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            background: #eee;
            border-color: #ddd;
            color: #999;
        }
        .btn-prev { left: 0; }
        .btn-next { right: 0; }

        /* Dots Indicator */
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }
        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--gray-300);
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            padding: 0;
        }
        .carousel-dot:hover { transform: scale(1.2); }
        .carousel-dot.active {
            background: var(--accent-teal);
            width: 30px;
            border-radius: 10px;
        }

        .empty-comments { text-align: center; padding: 50px 20px; background: var(--gray-100); border-radius: 20px; border: 2px dashed var(--gray-300); }
        .empty-comments i { font-size: 3.5rem; color: var(--gray-300); margin-bottom: 15px; display: block; }
        .text-muted { color: var(--gray-600) !important; }
        
        /* Footer */
        footer { background: var(--white); padding: 40px 0 25px; margin-top: 40px; border-top: 4px solid var(--primary-blue); border-radius: 25px 25px 0 0; }
        .footer-content { display: flex; justify-content: center; align-items: center; padding-bottom: 25px; border-bottom: 1px solid rgba(0,0,0,0.1); }
        .footer-brand { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.4rem; color: var(--primary-blue); }
        .footer-brand i { font-size: 1.8rem; }
        .footer-bottom { text-align: center; padding-top: 20px; color: var(--gray-600); font-size: 1rem; }
        
        /* Customer Service Button */
        .cs-button { position: fixed; bottom: 25px; right: 25px; z-index: 9999; display: flex; align-items: center; justify-content: center; width: 56px; height: 56px; background: linear-gradient(135deg, var(--accent-teal), #00b39d); color: var(--white); border-radius: 50%; text-decoration: none; box-shadow: 0 6px 20px rgba(0, 201, 177, 0.35); transition: all 0.3s ease; }
        .cs-button:hover { transform: translateY(-4px) scale(1.05); box-shadow: 0 10px 30px rgba(0, 201, 177, 0.55); color: var(--white); }
        .cs-button i { font-size: 1.8rem; }
        .cs-tooltip { position: absolute; bottom: 100%; right: 50%; transform: translateX(50%) translateY(10px); margin-bottom: 12px; padding: 8px 16px; background: var(--primary-blue); color: var(--white); border-radius: 12px; font-size: 0.85rem; font-weight: 500; white-space: nowrap; opacity: 0; visibility: hidden; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .cs-tooltip::after { content: ''; position: absolute; top: 100%; left: 50%; transform: translateX(-50%); border: 6px solid transparent; border-top-color: var(--primary-blue); }
        .cs-button:hover .cs-tooltip { opacity: 1; visibility: visible; transform: translateX(50%) translateY(0); }
        @media (max-width: 768px) { .cs-button { bottom: 15px; right: 15px; width: 50px; height: 50px; } .cs-button i { font-size: 1.5rem; } }
        
        /* Responsive */
        @media (max-width: 968px) { .profile-container { grid-template-columns: 1fr; } .school-stats { grid-template-columns: repeat(2, 1fr); } .hero-grid { grid-template-columns: 1fr; text-align: center; } .hero-buttons { justify-content: center; } }
        @media (max-width: 768px) { 
            html { scroll-padding-top: 70px; } 
            .nav-toggle { display: block; } 
            .nav-menu { position: fixed; top: 70px; right: -100%; flex-direction: column; background: var(--white); width: 260px; height: calc(100vh - 70px); padding: 35px 25px; box-shadow: -5px 0 20px rgba(0,0,0,0.15); transition: right 0.4s ease; border-radius: 0 0 35px 35px; } 
            .nav-menu.active { right: 0; } 
            .nav-menu li { margin-bottom: 20px; } 
            .nav-menu a { font-size: 1.1rem; display: block; } 
            .nav-menu a::after { height: 3px; } 
            .hero h1 { font-size: 2rem; } 
            .hero h1 span { font-size: 2.2rem; } 
            .hero-buttons { flex-direction: column; align-items: center; } 
            .btn { width: 100%; max-width: 280px; border-radius: 25px; } 
            .hero-img-1 { height: 220px; } 
            .school-stats { grid-template-columns: repeat(2, 1fr); } 
            .info-contact-container { grid-template-columns: 1fr; } 
            .school-info-card, .address-card, .map-card, .vision-card, .mission-card { border-radius: 25px; padding: 22px; } 
            .info-grid { gap: 12px; } 
            .info-item { padding: 10px 0; flex-direction: column; align-items: flex-start; } 
            .info-label { margin-bottom: 6px; } 
            .info-value { text-align: left; width: 100%; } 
            .nav-login-btn span { display: none; } 
            .nav-login-btn { padding: 10px 16px; } 
            .nav-login-btn i { font-size: 1.1rem; } 
            .gallery-button-container { margin-top: 40px; padding: 25px 0 15px; } 
            .comments-section { padding: 40px 0; } 
            .form-row { grid-template-columns: 1fr; gap: 15px; } 
            .card-body-custom { padding: 25px; } 
            .btn-submit-custom { width: 100%; justify-content: center; } 
            .form-actions { text-align: center; }
            .comment-carousel-wrapper { padding: 0 40px; }
            .carousel-nav-btn { width: 36px; height: 36px; }
        }
        @media (max-width: 480px) { 
            .hero h1 { font-size: 1.7rem; } 
            .hero h1 span { font-size: 1.9rem; } 
            .hero-subtitle { font-size: 1rem; } 
            .section-header h2 { font-size: 1.9rem; } 
            .btn { padding: 12px; font-size: 0.95rem; } 
            .school-stats { grid-template-columns: 1fr; } 
            .stat-card { padding: 18px; border-radius: 25px; } 
            .vision-mission { gap: 18px; } 
            .vision-card, .mission-card { padding: 22px; border-radius: 25px; } 
            .school-info-card, .address-card { padding: 22px; border-radius: 25px; } 
            .gallery-button-container .btn-primary { padding: 12px 30px; font-size: 1rem; }
            .comment-carousel-wrapper { padding: 0 32px; }
            .comment-card-carousel { padding: 20px; }
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

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SMK NEGERI 11 BANDUNG</span>
            </a>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="nav-link-beranda {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="#profile" class="nav-link-profile">Profil Sekolah</a></li>
                <li><a href="{{ route('program.keahlian') }}">Program Keahlian</a></li>
                <li><a href="{{ route('gallery.index') }}" class="nav-link-galeri {{ request()->routeIs('gallery.*') ? 'active' : '' }}">Galeri</a></li>
                <li><a href="{{ route('prestasi') }}" class="{{ request()->routeIs('prestasi') ? 'active' : '' }}">Prestasi</a></li>
                <li><a href="#contact" class="nav-link-contact">Kontak</a></li>
                <li><a href="{{ route('denah') }}" class="{{ request()->routeIs('denah') ? 'active' : '' }}">Denah 360°</a></li>
            </ul>
            <a href="{{ route('admin.login') }}" class="nav-login-btn">
                <i class="fas fa-user-shield"></i>
                <span>Login Admin</span>
            </a>
            <button class="nav-toggle"><i class="fas fa-bars"></i></button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-text">
                    <div class="hero-badge"><i class="fas fa-star"></i><span>SEKOLAH PUSAT KEUNGGULAN</span></div>
                    <h1>Selamat Datang di <span>SMK Negeri 11 Bandung</span></h1>
                    <p class="hero-subtitle">Sekolah unggulan yang memadukan tradisi pendidikan berkualitas dengan inovasi pembelajaran modern</p>
                    <div class="hero-buttons">
                        <a href="#profile" class="btn btn-primary"><i class="fas fa-book-open"></i>Pelajari Lebih Lanjut</a>
                        <a href="{{ route('denah') }}" class="btn btn-secondary"><i class="fas fa-map-marked-alt"></i>Lihat Denah Sekolah</a>
                    </div>
                </div>
                <div class="hero-images">
                    <div class="hero-img hero-img-1"><img src="{{ asset('image/b/SMKN 11 IN NIGHT.png') }}" alt="Banner"></div>
                    <div class="hero-img"><img src="{{ asset('image/b/slide_1.jpg') }}" alt="Sekolah"></div>
                    <div class="hero-img"><img src="{{ asset('image/b/slide_3a.jpeg') }}" alt="Banner"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Profile Section -->
    <section class="school-profile" id="profile">
        <div class="container">
            <div class="section-header">
                <h2><i class="fas fa-school"></i> Profil Sekolah</h2>
                <p>Menjelajahi sejarah, visi, dan misi SMK Negeri 11 Bandung</p>
            </div>
            <div class="profile-container">
                <div class="school-stats">
                    <div class="stat-card"><div class="stat-icon"><i class="fas fa-calendar-alt"></i></div><div class="stat-info"><h3>1980</h3><p>Tahun Berdiri</p></div></div>
                    <div class="stat-card"><div class="stat-icon"><i class="fas fa-award"></i></div><div class="stat-info"><h3>A</h3><p>Akreditasi Unggul</p></div></div>
                    <div class="stat-card"><div class="stat-icon"><i class="fas fa-user-graduate"></i></div><div class="stat-info"><h3>1.645</h3><p>Siswa Aktif</p></div></div>
                    <div class="stat-card"><div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div><div class="stat-info"><h3>94</h3><p>Tenaga Pendidik</p></div></div>
                </div>
                <div class="vision-mission">
                    <div class="vision-card"><div class="card-header"><i class="fas fa-bullseye"></i><h3>Visi Sekolah</h3></div><p class="vision-text">Menghasilkan lulusan yang BERKUALITAS (Berakhlak mulia, Empatik, Rasional, Kreatif, Unggul, Adaptif, LIterat, dan Tangguh serta Siap bersaing dalam dunia karier dan usaha).</p></div>
                    <div class="mission-card"><div class="card-header"><i class="fas fa-tasks"></i><h3>Misi Sekolah</h3></div><ul class="mission-list"><li><i class="fas fa-check-circle"></i> Membentuk murid berakhlak mulia dan empatik melalui penguatan nilai-nilai Pancawaluya dalam budaya sekolah.</li><li><i class="fas fa-check-circle"></i> Menyelenggarakan pembelajaran yang rasional, kreatif, dan literat berbasis proyek, pemecahan masalah, dan teknologi.</li><li><i class="fas fa-check-circle"></i> Mengembangkan kompetensi unggul dan berintegritas agar peserta didik memiliki daya saing di dunia kerja dan dunia usaha.</li><li><i class="fas fa-check-circle"></i> Menumbuhkan karakter tangguh dan adaptif dalam menghadapi perubahan dan tantangan global.</li><li><i class="fas fa-check-circle"></i> Mendorong kemandirian dan jiwa kewirausahaan melalui pengalaman belajar nyata dan kolaborasi dengan dunia usaha dan industri.</li></ul></div>
                </div>
            </div>
            <div class="info-contact-container">
                <div class="school-info-card">
                    <div class="info-header"><i class="fas fa-id-card"></i><h3>Identitas Sekolah</h3></div>
                    <div class="info-grid">
                        <div class="info-item"><span class="info-label">Nama Sekolah</span><span class="info-value">SMK Negeri 11 Bandung</span></div>
                        <div class="info-item"><span class="info-label">NPSN</span><span class="info-value">20219175</span></div>
                        <div class="info-item"><span class="info-label">NSS</span><span class="info-value">341026003001</span></div>
                        <div class="info-item"><span class="info-label">Status</span><span class="info-value">Negeri</span></div>
                        <div class="info-item"><span class="info-label">Akreditasi</span><span class="info-value"><span class="info-badge badge-success">A (Unggul)</span></span></div>
                        <div class="info-item"><span class="info-label">Tahun Berdiri</span><span class="info-value">1980</span></div>
                        <div class="info-item"><span class="info-label">Kepala Sekolah</span><span class="info-value">Eka Rachman, S.Kom., M.M.Pd</span></div>
                    </div>
                </div>
                <div class="address-card" id="contact">
                    <div class="info-header"><i class="fas fa-map-marker-alt"></i><h3>Alamat & Kontak</h3></div>
                    <div class="address-grid">
                        <div class="address-item"><i class="fas fa-map-pin"></i><div><span class="address-label">Alamat</span><p class="address-text">Jl. Raya Cilember, RT.01/RW.04, Sukaraja, Kec. Cicendo, Kota Bandung, Jawa Barat 40136</p></div></div>
                        <div class="address-item"><i class="fas fa-phone"></i><div><span class="address-label">Telepon</span><p class="address-text">(022) 6652442</p></div></div>
                        <div class="address-item"><i class="fas fa-envelope"></i><div><span class="address-label">Email</span><p class="address-text">official@smkn11bdg.sch.id & smkn11bdg@gmail.com</p></div></div>
                        <div class="address-item"><i class="fas fa-globe"></i><div><span class="address-label">Website</span><p class="address-text">https://smkn11bdg.sch.id</p></div></div>
                        <div class="address-item"><i class="fab fa-instagram"></i><div><span class="address-label">Instagram</span><p class="address-text">@info.smkn11bandung</p></div></div>
                    </div>
                </div>
            </div>
            <div class="map-card">
                <div class="card-header"><i class="fas fa-location-arrow"></i><h3>Lokasi Sekolah</h3></div>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.00062464909!2d107.55575517403304!3d-6.890527093108526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bd6aaaaaab%3A0xf843088e2b5bf838!2sSMKN%2011%20Bandung!5e0!3m2!1sid!2sid!4v1777510794762!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery" id="gallery">
        <div class="container">
            <div class="section-header">
                <h2><i class="fas fa-images"></i> Galeri Sekolah</h2>
                <p>Berbagai kegiatan dan fasilitas di SMK Negeri 11 Bandung</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item"><img src="{{ asset('image/b/banner-1.png') }}" alt="Kegiatan Upacara"><div class="gallery-overlay"><h4>Kegiatan Upacara</h4><p>Siswa aktif mengikuti kegiatan pembinaan disiplin dan karakter di sekolah</p></div></div>
                <div class="gallery-item"><img src="{{ asset('image/b/ehan.jpeg') }}" alt="Owner"><div class="gallery-overlay"><h4>Owner</h4><p>Akulah Sang Pembuat Vitour11</p></div></div>
                <div class="gallery-item"><img src="{{ asset('image/b/eskul.jpg') }}" alt="Ekstrakurikuler"><div class="gallery-overlay"><h4>Ekstrakurikuler</h4><p>Pengembangan minat dan bakat siswa</p></div></div>
                <div class="gallery-item"><img src="{{ asset('image/b/Belajar.Jpeg') }}" alt="Kegiatan Pembelajaran"><div class="gallery-overlay"><h4>Kegiatan belajar</h4><p>Proses pembelajaran interaktif di dalam kelas</p></div></div>
                <div class="gallery-item"><img src="{{ asset('image/b/slide_2a.jpeg') }}" alt="Taman"><div class="gallery-overlay"><h4>Taman</h4><p>Sebagai ruang belajar alami dan cocok untuk bersantai</p></div></div>
                <div class="gallery-item"><img src="{{ asset('image/b/Lab.png') }}" alt="Laboratorium Komputer"><div class="gallery-overlay"><h4>Laboratorium Komputer</h4><p>Fasilitas komputer yang dapat di gunakan untuk kebutuhan pembelajaran</p></div></div>
            </div>
            <div class="gallery-button-container">
                <a href="{{ route('gallery.index') }}" class="btn btn-primary"><i class="fas fa-images me-2"></i>Lihat Semua Galeri</a>
            </div>
        </div>
    </section>

    <!-- ✅ COMMENTS SECTION - AUTO SLIDE CAROUSEL -->
    <section class="comments-section" id="comments">
        <div class="container" style="max-width: 1200px;">
            <div class="section-header mb-5">
                <h2><i class="fas fa-comments"></i> Komentar & Pesan</h2>
                <p>Bagikan kesan dan pesan Anda untuk SMK Negeri 11 Bandung</p>
            </div>

            @if(session('success'))
            <div class="alert-success-custom mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close-custom" onclick="this.parentElement.remove()">×</button>
            </div>
            @endif

            <!-- Form Komentar -->
            <div class="comment-form-card mb-5">
                <div class="card-body-custom">
                    <h5 class="form-title"><i class="fas fa-pen me-2"></i>Tulis Komentar</h5>
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-col">
                                <label for="name" class="form-label-custom">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form-input-custom @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama Anda" required>
                                @error('name')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-col">
                                <label for="email" class="form-label-custom">Email <small class="text-muted">(Tidak ditampilkan)</small> <span class="required">*</span></label>
                                <input type="email" name="email" id="email" class="form-input-custom @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                @error('email')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label-custom">Pesan/Komentar <span class="required">*</span></label>
                            <textarea name="message" id="message" class="form-textarea-custom @error('message') is-invalid @enderror" rows="4" placeholder="Tulis pesan atau kesan Anda..." required>{{ old('message') }}</textarea>
                            @error('message')<div class="invalid-feedback-custom">{{ $message }}</div>@enderror
                            <small class="text-muted">Maksimal 500 karakter</small>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-submit-custom"><i class="fas fa-paper-plane me-2"></i>Kirim Komentar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ✅ AUTO SLIDE CAROUSEL COMMENT -->
            <div class="mb-4">
                <h5 class="comments-title">
                    <i class="fas fa-list me-2"></i>Komentar Terbaru 
                    <span class="badge" style="background: var(--accent-teal); color: white; font-size: 0.8rem; padding: 4px 10px; border-radius: 20px; margin-left: 8px;">Max 10</span>
                </h5>
                
                @if($comments->count() > 0)
                    <div class="comment-carousel-wrapper" id="commentCarousel">
                        <!-- Previous Button -->
                        <button class="carousel-nav-btn btn-prev" id="commentPrev" aria-label="Sebelumnya">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        
                        <!-- Carousel Window -->
                        <div class="comment-carousel-window">
                            <div class="comment-carousel-track" id="commentTrack">
                                @foreach($comments as $comment)
                                <div class="comment-carousel-item">
                                    <div class="comment-card-carousel">
                                        <div class="comment-card-header">
                                            <div class="comment-card-avatar">
                                                {{ strtoupper(substr($comment->name, 0, 1)) }}
                                            </div>
                                            <div class="comment-card-info">
                                                <div class="comment-card-author">{{ $comment->name }}</div>
                                                <span class="comment-card-time">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <p class="comment-card-text">{{ $comment->message }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Next Button -->
                        <button class="carousel-nav-btn btn-next" id="commentNext" aria-label="Berikutnya">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Dots Indicator -->
                        <div class="carousel-dots" id="commentDots">
                            @foreach($comments as $index => $comment)
                            <button class="carousel-dot {{ $index === 0 ? 'active' : '' }}" 
                                    data-index="{{ $index }}" 
                                    aria-label="Pindah ke komentar {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="empty-comments">
                        <i class="fas fa-comments"></i>
                        <p class="text-muted mb-0">Belum ada komentar. Jadilah yang pertama!</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand"><i class="fas fa-graduation-cap"></i><span>SMK NEGERI 11 BANDUNG</span></div>
            </div>
            <div class="footer-bottom">
                <p>© {{ date('Y') }} SMK Negeri 11 Bandung | Sekolah Kejuruan Unggulan Berbasis Industri</p>
            </div>
        </div>
    </footer>

    <!-- Customer Service Button -->
    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20SMK%20Negeri%2011%20Bandung,%20saya%20ingin%20bertanya..." class="cs-button" target="_blank" rel="noopener noreferrer" aria-label="Hubungi Customer Service via WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <div class="cs-tooltip">Chat via WhatsApp</div>
    </a>

    <script>
    // Mobile Navigation Toggle
    document.querySelector('.nav-toggle')?.addEventListener('click', function() {
        document.querySelector('.nav-menu')?.classList.toggle('active');
    });
    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', function() {
            document.querySelector('.nav-menu')?.classList.remove('active');
        });
    });
    
    // Smooth scroll untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#' || href.includes('/')) return;
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                window.scrollTo({ top: target.offsetTop - 70, behavior: 'smooth' });
            }
        });
    });

    // Active nav logic
    function updateActiveNav() {
        const scrollY = window.scrollY || window.pageYOffset;
        const navbarHeight = 100;
        const sections = [
            { id: 'home', selector: '.nav-link-beranda' },
            { id: 'profile', selector: '.nav-link-profile' },
            { id: 'gallery', selector: '.nav-link-galeri' },
            { id: 'contact', selector: '.nav-link-contact' }
        ];
        let currentSection = 'home';
        for (let i = sections.length - 1; i >= 0; i--) {
            const section = sections[i];
            const element = document.getElementById(section.id);
            if (element) {
                const sectionTop = element.offsetTop - navbarHeight;
                const sectionBottom = sectionTop + element.offsetHeight;
                if (scrollY >= sectionTop && scrollY < sectionBottom) {
                    currentSection = section.id;
                    break;
                }
            }
        }
        sections.forEach(s => {
            const link = document.querySelector(s.selector);
            if (link) link.classList.remove('active');
        });
        const activeLink = document.querySelector(sections.find(s => s.id === currentSection)?.selector);
        if (activeLink) activeLink.classList.add('active');
    }
    window.addEventListener('DOMContentLoaded', updateActiveNav);
    window.addEventListener('scroll', updateActiveNav, { passive: true });
    window.addEventListener('resize', updateActiveNav);

    // ✅ COMMENT CAROUSEL - AUTO SLIDE FUNCTIONALITY
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('commentTrack');
        const prevBtn = document.getElementById('commentPrev');
        const nextBtn = document.getElementById('commentNext');
        const dots = document.querySelectorAll('.carousel-dot');
        const carousel = document.getElementById('commentCarousel');
        
        // Pastikan elemen ada sebelum menjalankan script
        if (!track || !prevBtn || !nextBtn) return;
        
        let currentIndex = 0;
        const totalItems = document.querySelectorAll('.comment-carousel-item').length;
        let autoSlideInterval;
        const AUTO_SLIDE_DELAY = 5000; // 5 Detik
        
        // Fungsi Update Tampilan
        function updateCarousel() {
            // Geser track
            track.style.transform = `translateX(-${currentIndex * 100}%)`;
            
            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
            
            // Disable tombol jika di awal/akhir (Optional: hapus if/else jika ingin looping terus)
            // prevBtn.disabled = currentIndex === 0;
            // nextBtn.disabled = currentIndex === totalItems - 1;
        }
        
        // Next Slide Logic
        function nextSlide() {
            if (currentIndex < totalItems - 1) {
                currentIndex++;
            } else {
                currentIndex = 0; // Looping kembali ke awal
            }
            updateCarousel();
        }
        
        // Prev Slide Logic
        function prevSlide() {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = totalItems - 1; // Looping ke akhir
            }
            updateCarousel();
        }

        // Start Auto Slide
        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, AUTO_SLIDE_DELAY);
        }
        
        // Stop Auto Slide
        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        // Event Listeners
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetTimer();
        });
        
        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetTimer();
        });

        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                currentIndex = parseInt(this.dataset.index);
                updateCarousel();
                resetTimer();
            });
        });

        // Pause saat hover
        carousel.addEventListener('mouseenter', stopAutoSlide);
        carousel.addEventListener('mouseleave', startAutoSlide);

        function resetTimer() {
            stopAutoSlide();
            startAutoSlide();
        }
        
        // Initialize
        updateCarousel();
        startAutoSlide();
    });
    </script>
</body>
</html>