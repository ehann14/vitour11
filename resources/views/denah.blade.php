<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Denah Sekolah 360° - SMK Negeri 11 Bandung</title>
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
--success: #28a745;
--shadow-sm: 0 4px 6px rgba(0,0,0,0.1);
--shadow-md: 0 10px 25px rgba(0,0,0,0.15);
--shadow-lg: 0 15px 40px rgba(0,0,0,0.2);
--transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}
body {
font-family: 'Poppins', sans-serif;
background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
color: var(--gray-700);
min-height: 100vh;
overflow-x: hidden;
position: relative;
line-height: 1.6;
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
display: flex;
align-items: center;
justify-content: center;
gap: 15px;
}
.header h1 i {
color: var(--accent-teal);
}
.header p {
font-size: 1.1rem;
color: rgba(255, 255, 255, 0.9);
max-width: 700px;
margin: 0 auto;
line-height: 1.7;
}
/* Scene Selector */
.scene-selector {
background: var(--white);
border-radius: 30px;
padding: 25px;
box-shadow: var(--shadow-md);
margin-bottom: 25px;
border: 2px solid var(--gray-300);
}
.scene-selector-header {
display: flex;
align-items: center;
justify-content: space-between;
margin-bottom: 20px;
padding-bottom: 15px;
border-bottom: 2px solid var(--gray-300);
}
.scene-selector-header h3 {
font-size: 1.5rem;
color: var(--primary-blue);
font-weight: 700;
display: flex;
align-items: center;
gap: 10px;
}
.scene-selector-header h3 i {
color: var(--accent-teal);
}
.scene-buttons {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
gap: 15px;
}
.scene-btn {
display: flex;
align-items: center;
justify-content: center;
gap: 10px;
padding: 14px 12px;
background: var(--gray-100);
border: none;
border-radius: 20px;
font-weight: 600;
font-size: 0.95rem;
color: var(--gray-700);
cursor: pointer;
transition: var(--transition);
text-align: center;
border: 2px solid transparent;
}
.scene-btn:hover {
background: rgba(30, 60, 114, 0.08);
transform: translateY(-2px);
color: var(--primary-blue);
border-color: var(--accent-teal);
}
.scene-btn.active {
background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
color: var(--white);
border-color: var(--primary-blue);
box-shadow: 0 6px 15px rgba(30, 60, 114, 0.3);
}
.scene-btn i {
font-size: 1.3rem;
min-width: 25px;
}
/* 360° Viewer Container */
.viewer-container {
background: var(--white);
border-radius: 30px;
padding: 30px;
box-shadow: var(--shadow-lg);
margin: 0 auto 30px;
position: relative;
overflow: hidden;
border: 2px solid var(--gray-300);
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
.scene-title {
font-size: 1.1rem;
color: var(--gray-600);
margin-top: 5px;
font-weight: 500;
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
background: rgba(255, 255, 255, 0.95);
padding: 30px 40px;
border-radius: 20px;
box-shadow: var(--shadow-lg);
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
font-weight: 700;
font-size: 1.2rem;
}
@keyframes spin {
to { transform: rotate(360deg); }
}
/* Info Panel */
.info-panel {
background: var(--white);
border-radius: 30px;
padding: 25px;
box-shadow: var(--shadow-md);
margin: 0 auto 30px;
border: 2px solid var(--gray-300);
}
.info-panel-header {
display: flex;
align-items: center;
gap: 10px;
margin-bottom: 20px;
padding-bottom: 15px;
border-bottom: 2px solid var(--gray-300);
}
.info-panel-header h3 {
font-size: 1.5rem;
color: var(--primary-blue);
font-weight: 700;
}
.info-panel-header h3 i {
color: var(--accent-teal);
}
.info-grid {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
gap: 20px;
}
.info-item {
display: flex;
align-items: flex-start;
gap: 12px;
padding: 15px;
background: var(--gray-100);
border-radius: 18px;
transition: var(--transition);
border: 2px solid transparent;
}
.info-item:hover {
background: rgba(30, 60, 114, 0.08);
transform: translateX(5px);
border-color: var(--accent-teal);
}
.info-item i {
font-size: 1.4rem;
color: var(--primary-blue);
min-width: 30px;
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
margin-bottom: 4px;
}
/* Hotspot Custom Styling */
.pnlm-hotspot.pnlm-info-hotspot {
background: var(--primary-blue) !important;
color: white !important;
}
.pnlm-hotspot.pnlm-scene-hotspot {
background: var(--accent-teal) !important;
color: white !important;
}
.pnlm-hotspot::before {
border-width: 6px !important;
}
/* Controls Custom Styling */
.pnlm-compass {
border-radius: 50% !important;
background: rgba(255, 255, 255, 0.9) !important;
backdrop-filter: blur(10px) !important;
}
/* Back Button */
.back-container {
text-align: center;
margin-top: 30px;
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
transition: var(--transition);
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
/* Responsive Design */
@media (max-width: 968px) {
.header h1 {
font-size: 2.1rem;
}
#panorama {
height: 60vh;
min-height: 450px;
}
.info-grid {
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
.scene-buttons {
grid-template-columns: repeat(3, 1fr);
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
.scene-buttons {
grid-template-columns: repeat(2, 1fr);
}
.scene-btn {
padding: 12px 8px;
font-size: 0.85rem;
}
.scene-btn i {
font-size: 1.1rem;
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
.info-panel-header h3 {
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
/* Animation Keyframes for Notifications */
@keyframes slideInRight {
from { transform: translateX(400px); opacity: 0; }
to { transform: translateX(0); opacity: 1; }
}
@keyframes slideOutRight {
from { transform: translateX(0); opacity: 1; }
to { transform: translateX(400px); opacity: 0; }
}
@keyframes fadeIn {
from { opacity: 0; }
to { opacity: 1; }
}
@keyframes slideUp {
from { transform: translateY(50px); opacity: 0; }
to { transform: translateY(0); opacity: 1; }
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
<li><a href="/denah" class="active">Denah 360°</a></li>
</ul>
<button class="nav-toggle">
<i class="fas fa-bars"></i>
</button>
</div>
</nav>
<!-- Header -->
<section class="header">
<div class="container">
<h1><i class="fas fa-compass"></i> Denah Sekolah 360° SMK Negeri 11 Bandung</h1>
<p>Explore lingkungan sekolah kami dengan pengalaman virtual 360° yang interaktif. Putar, zoom, dan jelajahi setiap sudut kampus kami secara virtual!</p>
</div>
</section>
<!-- Scene Selector -->
<div class="scene-selector">
<div class="scene-selector-header">
<h3><i class="fas fa-map-marked-alt"></i> Pilih Lokasi</h3>
</div>
<div class="scene-buttons">
<button class="scene-btn active" data-scene="gerbang">
<i class="fas fa-home"></i>
<span>Gerbang</span>
</button>
<button class="scene-btn" data-scene="lapangan">
<i class="fas fa-field"></i>
<span>Lapangan</span>
</button>
<button class="scene-btn" data-scene="masjid">
<i class="fas fa-mosque"></i>
<span>Masjid</span>
</button>
<button class="scene-btn" data-scene="koridor-lab">
<i class="fas fa-flask"></i>
<span>Koridor Lab</span>
</button>
<button class="scene-btn" data-scene="parkiran">
<i class="fas fa-parking"></i>
<span>Parkiran</span>
</button>
<button class="scene-btn" data-scene="ruang-bk">
<i class="fas fa-user-friends"></i>
<span>Ruang BK</span>
</button>
</div>
</div>
<!-- 360° Viewer Section -->
<section class="viewer-section">
<div class="container">
<div class="viewer-container">
<div class="viewer-header">
<div>
<h2><i class="fas fa-vr-cardboard"></i> Virtual Tour 360°</h2>
<p class="scene-title" id="current-scene-title">Gerbang SMK Negeri 11 Bandung</p>
<p class="viewer-subtitle">Klik dan drag untuk memutar | Scroll untuk zoom | Klik hotspot untuk navigasi</p>
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
<div class="info-panel-header">
<h3><i class="fas fa-info-circle"></i> Informasi & Tips Navigasi</h3>
</div>
<div class="info-grid">
<div class="info-item">
<i class="fas fa-mouse-pointer"></i>
<div>
<span class="info-label">Klik & Drag</span>
<span class="info-text">Putar pandangan dengan klik dan drag mouse</span>
</div>
</div>
<div class="info-item">
<i class="fas fa-scroll"></i>
<div>
<span class="info-label">Scroll Mouse</span>
<span class="info-text">Zoom in/out dengan scroll mouse</span>
</div>
</div>
<div class="info-item">
<i class="fas fa-arrows-alt"></i>
<div>
<span class="info-label">Touch Screen</span>
<span class="info-text">Swipe untuk memutar, pinch untuk zoom</span>
</div>
</div>
<div class="info-item">
<i class="fas fa-location-arrow"></i>
<div>
<span class="info-label">Hotspots</span>
<span class="info-text">Klik icon biru untuk pindah lokasi, hijau untuk info</span>
</div>
</div>
</div>
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
// Initialize Pannellum - Multi Scene
let viewer = null;
let currentScene = 'gerbang';
document.addEventListener('DOMContentLoaded', function() {
// Initialize Pannellum
viewer = pannellum.viewer('panorama', {
"default": {
"firstScene": "gerbang",
"sceneFadeDuration": 1000,
"autoLoad": true,
"showZoomCtrl": true,
"showFullscreenCtrl": true,
"compass": true,
"autoRotate": -2,
"autoRotateInactivityDelay": 5000
},
"scenes": {
// ===== SCENE 1: GERBANG =====
"gerbang": {
"title": "Gerbang Utama",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Gerbang.jpg') }}",
"hotSpots": [
{
"pitch": -4.53,
"yaw": -35.48,
"type": "scene",
"sceneId": "lapangan",
"targetYaw": -90,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Lapangan"
},
{
"pitch": -10,
"yaw": -55,
"type": "info",
"text": "Gerbang Utama Sekolah - Pintu masuk utama untuk siswa dan guru",
"id": "info-gerbang"
},
{
"pitch": -4.53,
"yaw": -46.48,
"type": "scene",
"text": "Parkiran",
"sceneId": "parkiran",
"targetYaw": 0,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Parkiran"
}
]
},
// ===== SCENE 2: LAPANGAN =====
"lapangan": {
"title": "Lapangan Sekolah",
"type": "equirectangular",
"panorama": "{{ asset('image/360/lapang.jpg') }}",
"hotSpots": [
{
"pitch": 0,
"yaw": -120,
"type": "scene",
"text": "Kembali ke Gerbang",
"sceneId": "gerbang",
"targetYaw": 180,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Gerbang"
},
{
"pitch": 5,
"yaw": 45,
"type": "scene",
"text": "Ke Koridor Lab",
"sceneId": "koridor-lab",
"targetYaw": -90,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Koridor Lab"
},
{
"pitch": -5,
"yaw": 135,
"type": "scene",
"text": "Ke Masjid",
"sceneId": "masjid",
"targetYaw": 0,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Masjid"
},
{
"pitch": 10,
"yaw": 90,
"type": "info",
"text": "Lapangan Utama - Area upacara dan kegiatan olahraga",
"id": "info-lapangan"
}
]
},
// ===== SCENE 3: MASJID =====
"masjid": {
"title": "Masjid Sekolah",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Masjid_atas.jpg') }}",
"hotSpots": [
{
"pitch": 0,
"yaw": -90,
"type": "scene",
"text": "Kembali ke Lapangan",
"sceneId": "lapangan",
"targetYaw": 180,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Lapangan"
},
{
"pitch": 5,
"yaw": 60,
"type": "info",
"text": "Masjid - Tempat ibadah dan kegiatan keagamaan",
"id": "info-masjid"
},
{
"pitch": -5,
"yaw": 150,
"type": "scene",
"text": "Tikungan Masjid",
"sceneId": "tikungan-masjid",
"targetYaw": 0,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Tikungan Masjid"
}
]
},
// ===== SCENE 4: KORIDOR LAB =====
"koridor-lab": {
"title": "Koridor Laboratorium",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Koridor_lab_atas_kanan.jpg') }}",
"hotSpots": [
{
"pitch": 0,
"yaw": -180,
"type": "scene",
"text": "Kembali ke Lapangan",
"sceneId": "lapangan",
"targetYaw": 180,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Lapangan"
},
{
"pitch": 10,
"yaw": 30,
"type": "info",
"text": "Koridor Laboratorium - Area praktikum siswa",
"id": "info-koridor-lab"
},
{
"pitch": -5,
"yaw": 90,
"type": "scene",
"text": "Ke Ruang BK",
"sceneId": "ruang-bk",
"targetYaw": 0,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Ruang BK"
}
]
},
// ===== SCENE 5: PARKIRAN =====
"parkiran": {
"title": "Area Parkiran",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Parkiran.jpg') }}",
"hotSpots": [
{
"pitch": 0,
"yaw": -90,
"type": "scene",
"text": "Kembali ke Gerbang",
"sceneId": "gerbang",
"targetYaw": 180,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Gerbang"
},
{
"pitch": 5,
"yaw": 45,
"type": "info",
"text": "Area Parkiran - Tempat parkir siswa dan guru",
"id": "info-parkiran"
}
]
},
// ===== SCENE 6: RUANG BK =====
"ruang-bk": {
"title": "Ruang BK",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tikungan_Ruang_BK.jpg') }}",
"hotSpots": [
{
"pitch": 0,
"yaw": -180,
"type": "scene",
"text": "Kembali ke Koridor Lab",
"sceneId": "koridor-lab",
"targetYaw": 180,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Koridor Lab"
},
{
"pitch": 5,
"yaw": 30,
"type": "info",
"text": "Ruang Bimbingan Konseling - Layanan konseling siswa",
"id": "info-bk"
}
]
},
// ===== SCENE 7: TIKUNGAN MASJID =====
"tikungan-masjid": {
"title": "Tikungan Masjid",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tikungan_kandang_burung_masjid_.jpg') }}",
"hotSpots": [
{
"pitch": 0,
"yaw": -90,
"type": "scene",
"text": "Kembali ke Masjid",
"sceneId": "masjid",
"targetYaw": 180,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Masjid"
},
{
"pitch": 5,
"yaw": 45,
"type": "info",
"text": "Area sekitar masjid",
"id": "info-tikungan-masjid"
}
]
},
// ===== SCENE 8: CORIDOR RAPAT =====
"coridor-rapat": {
"title": "Koridor Rapat",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Coridor_Rapat.jpg') }}",
"hotSpots": [
{
"pitch": 0,
"yaw": -90,
"type": "scene",
"text": "Kembali ke Gerbang",
"sceneId": "gerbang",
"targetYaw": 180,
"targetPitch": 0,
"createTooltipFunc": hotspotTooltip,
"createTooltipArgs": "Gerbang"
},
{
"pitch": 5,
"yaw": 45,
"type": "info",
"text": "Koridor Ruang Rapat - Area pertemuan",
"id": "info-rapat"
}
]
}
}
});
// Remove loading after viewer loads
setTimeout(() => {
const loading = document.querySelector('.loading');
if (loading) {
loading.style.display = 'none';
}
}, 2000);
// Scene selector functionality
document.querySelectorAll('.scene-btn').forEach(button => {
button.addEventListener('click', function() {
const sceneId = this.getAttribute('data-scene');
// Update active button
document.querySelectorAll('.scene-btn').forEach(btn => {
btn.classList.remove('active');
});
this.classList.add('active');
// Load scene
viewer.loadScene(sceneId);
currentScene = sceneId;
// Update scene title
const sceneTitle = document.getElementById('current-scene-title');
const sceneData = viewer.getConfig().scenes[sceneId];
if (sceneTitle && sceneData) {
sceneTitle.textContent = sceneData.title;
}
});
});
// Scene change event
viewer.on('scenechange', function(sceneId) {
// Update active button
document.querySelectorAll('.scene-btn').forEach(btn => {
btn.classList.remove('active');
if (btn.getAttribute('data-scene') === sceneId) {
btn.classList.add('active');
}
});
// Update scene title
const sceneTitle = document.getElementById('current-scene-title');
const sceneData = viewer.getConfig().scenes[sceneId];
if (sceneTitle && sceneData) {
sceneTitle.textContent = sceneData.title;
}
currentScene = sceneId;
});
});
// Custom hotspot tooltip function
function hotspotTooltip(hotSpotDiv, args) {
hotSpotDiv.classList.add('custom-tooltip');
hotSpotDiv.innerHTML = args;
hotSpotDiv.style.backgroundColor = 'rgba(30, 60, 114, 0.9)';
hotSpotDiv.style.color = 'white';
hotSpotDiv.style.padding = '8px 12px';
hotSpotDiv.style.borderRadius = '8px';
hotSpotDiv.style.fontSize = '14px';
hotSpotDiv.style.fontWeight = '600';
hotSpotDiv.style.boxShadow = '0 4px 15px rgba(0,0,0,0.3)';
}

// ===== WINDOW ONLOAD SCRIPTS =====
window.addEventListener('load', function() {
    
    // 1. Check WebGL Support
    if (!window.WebGLRenderingContext) {
        showNotification('⚠️ Browser Anda tidak mendukung WebGL. Virtual Tour mungkin tidak berfungsi optimal.', 'warning');
    } else {
        const canvas = document.createElement('canvas');
        const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
        if (!gl) {
            showNotification('⚠️ WebGL tidak tersedia di browser Anda.', 'warning');
        }
    }
    
    // 2. Preload Next Panorama Images
    preloadPanoramas();
    
    // 3. Check First Visit
    checkFirstVisit();
    
    // 4. Check Online Status
    checkOnlineStatus();
    
    // 5. Initialize Keyboard Shortcuts
    initKeyboardShortcuts();
    
    // 6. Log Performance
    logPerformance();
    
    // 7. Add Smooth Scroll Behavior
    enableSmoothScroll();
    
    // 8. Initialize Touch Gestures Info
    showTouchGesturesInfo();
    
    console.log('✅ Virtual Tour siap digunakan!');
});

// ===== HELPER FUNCTIONS =====

// Show Notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        padding: 15px 25px;
        background: ${type === 'warning' ? '#ff9800' : type === 'success' ? '#28a745' : '#1e3c72'};
        color: white;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        z-index: 9999;
        font-weight: 600;
        max-width: 350px;
        animation: slideInRight 0.5s ease;
        font-size: 0.95rem;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.5s ease';
        setTimeout(() => notification.remove(), 500);
    }, 5000);
}

// Preload Panorama Images
function preloadPanoramas() {
    if (!viewer) return;
    
    const scenes = viewer.getConfig().scenes;
    const sceneIds = Object.keys(scenes);
    
    sceneIds.forEach((sceneId, index) => {
        if (sceneId !== currentScene) {
            const img = new Image();
            img.src = scenes[sceneId].panorama.replace("{{ asset('", "").replace("') }}", "");
            console.log(`🔄 Preloading scene ${index + 1}/${sceneIds.length}: ${sceneId}`);
        }
    });
    
    console.log('✅ All panoramas preloading started');
}

// Check First Visit
function checkFirstVisit() {
    const hasVisited = localStorage.getItem('hasVisitedVirtualTour');
    
    if (!hasVisited) {
        setTimeout(() => {
            showWelcomeModal();
            localStorage.setItem('hasVisitedVirtualTour', 'true');
        }, 1500);
    }
}

// Show Welcome Modal
function showWelcomeModal() {
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        animation: fadeIn 0.3s ease;
    `;
    
    modal.innerHTML = `
        <div style="
            background: white;
            padding: 40px;
            border-radius: 20px;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideUp 0.5s ease;
        ">
            <div style="font-size: 4rem; margin-bottom: 20px;">🎓</div>
            <h2 style="color: #1e3c72; margin-bottom: 15px; font-size: 1.8rem;">Selamat Datang!</h2>
            <p style="color: #6c757d; margin-bottom: 25px; line-height: 1.6;">
                Jelajahi SMK Negeri 11 Bandung dengan Virtual Tour 360°.<br><br>
                <strong>Cara Navigasi:</strong><br>
                🖱️ Klik & drag untuk memutar<br>
                📜 Scroll untuk zoom<br>
                🔵 Klik hotspot biru untuk pindah lokasi
            </p>
            <button onclick="this.closest('div[style*=fixed]').remove()" style="
                background: linear-gradient(135deg, #1e3c72, #2a5298);
                color: white;
                border: none;
                padding: 12px 35px;
                border-radius: 25px;
                font-weight: 700;
                cursor: pointer;
                font-size: 1rem;
                transition: transform 0.3s;
            ">Mulai Jelajah</button>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Close on outside click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.remove();
        }
    });
}

// Check Online Status
function checkOnlineStatus() {
    if (!navigator.onLine) {
        showNotification('📴 Anda sedang offline. Beberapa fitur mungkin tidak berfungsi.', 'warning');
    }
    
    window.addEventListener('online', () => {
        showNotification('📶 Koneksi internet telah pulih.', 'success');
    });
    
    window.addEventListener('offline', () => {
        showNotification('📴 Anda sedang offline.', 'warning');
    });
}

// Initialize Keyboard Shortcuts
function initKeyboardShortcuts() {
    document.addEventListener('keydown', function(e) {
        // Press 'P' to show current pitch/yaw
        if (e.key === 'p' || e.key === 'P') {
            if (viewer) {
                const pitch = viewer.getPitch().toFixed(2);
                const yaw = viewer.getYaw().toFixed(2);
                
                console.log('📍 POSISI HOTSPOT:');
                console.log('   Pitch:', pitch);
                console.log('   Yaw:', yaw);
                
                // Show notification
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 20px;
                    background: linear-gradient(135deg, #1e3c72, #2a5298);
                    color: white;
                    padding: 20px 25px;
                    border-radius: 15px;
                    z-index: 9999;
                    font-family: 'Poppins', sans-serif;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                    animation: slideInRight 0.3s ease;
                `;
                notification.innerHTML = `
                    <strong style="font-size: 1.1rem; display: block; margin-bottom: 10px;">📍 Posisi Saat Ini</strong>
                    <div style="font-family: monospace; font-size: 1rem;">
                        <div><strong>Pitch:</strong> ${pitch}</div>
                        <div><strong>Yaw:</strong> ${yaw}</div>
                    </div>
                    <small style="display: block; margin-top: 10px; opacity: 0.8;">
                        Salin nilai ini ke konfigurasi hotspot
                    </small>
                `;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            }
        }
        
        // Other keyboard shortcuts
        if (!viewer) return;
        
        switch(e.key) {
            case 'ArrowLeft':
                viewer.rotateView(-45, 0);
                break;
            case 'ArrowRight':
                viewer.rotateView(45, 0);
                break;
            case 'ArrowUp':
                viewer.rotateView(0, -45);
                break;
            case 'ArrowDown':
                viewer.rotateView(0, 45);
                break;
            case '+':
            case '=':
                viewer.setZoom(viewer.getZoom() + 1);
                break;
            case '-':
                viewer.setZoom(viewer.getZoom() - 1);
                break;
            case 'f':
            case 'F':
                viewer.toggleFullscreen();
                break;
        }
    });
    
    console.log('⌨️ Keyboard shortcuts enabled: P (posisi), Arrow keys (rotate), +/- (zoom), F (fullscreen)');
}

// Log Performance
function logPerformance() {
    if (window.performance && window.performance.timing) {
        const timing = window.performance.timing;
        const pageLoadTime = timing.loadEventEnd - timing.navigationStart;
        const domContentLoaded = timing.domContentLoadedEventEnd - timing.navigationStart;
        
        console.log('📊 Performance Metrics:');
        console.log(`   DOM Content Loaded: ${domContentLoaded}ms`);
        console.log(`   Full Page Load: ${pageLoadTime}ms`);
        
        if (pageLoadTime > 3000) {
            console.warn('⚠️ Page load time is slow (>3s). Consider optimizing images.');
        }
    }
}

// Enable Smooth Scroll
function enableSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
}

// Show Touch Gestures Info (for mobile)
function showTouchGesturesInfo() {
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    
    if (isTouchDevice) {
        setTimeout(() => {
            showNotification('📱 Swipe untuk memutar, pinch untuk zoom', 'info');
        }, 2000);
    }
}
</script>
</body>
</html>