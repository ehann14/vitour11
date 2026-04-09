<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMK Negeri 11 Bandung</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/splash.css')
</head>
<body>
    <!-- Background Circles -->
    <div class="splash-bg">
        <div class="splash-circle splash-circle-1"></div>
        <div class="splash-circle splash-circle-2"></div>
        <div class="splash-circle splash-circle-3"></div>
    </div>

    <!-- Splash Container -->
    <div class="splash-container">
        <div class="logo-container">
            <div class="logo-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h1 class="school-name">SMK NEGERI 11 BANDUNG</h1>
        </div>

        <div class="loading-container">
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
            <div class="loading-info">
                <span class="loading-dots">Loading</span>
                <span class="percentage">0%</span>
            </div>
        </div>

        <div class="tagline">
            <p>Membangun Generasi Unggul</p>
        </div>

        <div class="splash-footer">
            <p>© {{ date('Y') }} SMK Negeri 11 Bandung | Sekolah Kejuruan Unggulan</p>
        </div>
    </div>

    @vite('resources/js/splash.js')
</body>
</html>