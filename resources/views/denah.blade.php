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
max-height: 400px;
overflow-y: auto;
padding: 10px;
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
.pnlm-compass {
border-radius: 50% !important;
background: rgba(255, 255, 255, 0.9) !important;
backdrop-filter: blur(10px) !important;
}
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
@media (max-width: 968px) {
.header h1 { font-size: 2.1rem; }
#panorama { height: 60vh; min-height: 450px; }
.info-grid { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
.nav-toggle { display: block; }
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
.nav-menu.active { right: 0; }
.nav-menu li { margin-bottom: 20px; }
.nav-menu a { font-size: 1.1rem; display: block; }
.header h1 { font-size: 1.9rem; }
.header p { font-size: 1rem; }
.scene-buttons { grid-template-columns: repeat(3, 1fr); }
#panorama { height: 55vh; min-height: 400px; }
.viewer-header h2 { font-size: 1.6rem; }
.info-panel { padding: 20px; }
.btn-back { width: 100%; max-width: 280px; padding: 12px; font-size: 0.95rem; }
}
@media (max-width: 480px) {
.header h1 { font-size: 1.7rem; }
.header p { font-size: 0.95rem; }
.scene-buttons { grid-template-columns: repeat(2, 1fr); }
.scene-btn { padding: 12px 8px; font-size: 0.85rem; }
.scene-btn i { font-size: 1.1rem; }
#panorama { height: 50vh; min-height: 350px; }
.viewer-header h2 { font-size: 1.4rem; }
.viewer-subtitle { font-size: 0.9rem; }
.info-panel-header h3 { font-size: 1.3rem; }
.btn-back { padding: 10px 25px; font-size: 0.9rem; }
.footer-brand { font-size: 1.2rem; }
.footer-text { font-size: 0.9rem; }
}
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
<div class="circle-bg">
<div class="circle circle-1"></div>
<div class="circle circle-2"></div>
<div class="circle circle-3"></div>
<div class="circle circle-4"></div>
</div>
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
<section class="header">
<div class="container">
<h1><i class="fas fa-compass"></i> Denah Sekolah 360° SMK Negeri 11 Bandung</h1>
<p>Explore lingkungan sekolah kami dengan pengalaman virtual 360° yang interaktif. Putar, zoom, dan jelajahi setiap sudut kampus kami secara virtual!</p>
</div>
</section>
<div class="scene-selector">
<div class="scene-selector-header">
<h3><i class="fas fa-map-marked-alt"></i> Pilih Lokasi</h3>
</div>
<div class="scene-buttons" id="sceneButtons"></div>
</div>
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
<div id="panorama">
<div class="loading">
<div class="spinner"></div>
<div class="loading-text">Memuat Virtual Tour...</div>
</div>
</div>
</div>
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
<div class="back-container">
<a href="/" class="btn-back">
<i class="fas fa-arrow-left"></i>
Kembali ke Beranda
</a>
</div>
</div>
</section>
<footer>
<div class="container">
<div class="footer-brand">
<i class="fas fa-graduation-cap"></i>
<span>SMK NEGERI 11 BANDUNG</span>
</div>
<p class="footer-text">© {{ date('Y') }} SMK Negeri 11 Bandung | Sekolah Kejuruan Unggulan</p>
</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
<script>
document.querySelector('.nav-toggle').addEventListener('click', function() {
document.querySelector('.nav-menu').classList.toggle('active');
});
document.querySelectorAll('.nav-menu a').forEach(link => {
link.addEventListener('click', function() {
document.querySelector('.nav-menu').classList.remove('active');
});
});

let viewer = null;
let currentScene = 'gerbang';

// Scene configuration (26 scenes sesuai denah)
const scenesConfig = {
"gerbang": { "title": "Gerbang", "icon": "fa-home" },
"lapangan": { "title": "Lapangan", "icon": "fa-field" },
"kantin": { "title": "Kantin", "icon": "fa-utensils" },
"parkiran": { "title": "Parkiran", "icon": "fa-parking" },
"wc-kantin": { "title": "WC Kantin", "icon": "fa-restroom" },
"tangga-kantin": { "title": "Tangga Kantin", "icon": "fa-stairs" },
"koridor-akl-bawah": { "title": "Koridor AKL Bawah", "icon": "fa-road" },
"tangga-tengah-bdp": { "title": "Tangga Tengah BDP", "icon": "fa-stairs" },
"tangga-atas-bdp": { "title": "Tangga Atas BDP", "icon": "fa-stairs" },
"wc-akl": { "title": "WC AKL", "icon": "fa-restroom" },
"tangga-atas-rseni": { "title": "Tangga Atas R Seni", "icon": "fa-stairs" },
"koridor-rseni": { "title": "Koridor R Seni", "icon": "fa-road" },
"tangga-tengah-rspw": { "title": "Tangga Tengah RSPW", "icon": "fa-stairs" },
"tangga-rspw": { "title": "Tangga RSPW", "icon": "fa-stairs" },
"panorama": { "title": "Panorama", "icon": "fa-image" },
"koridor-rotkp11": { "title": "Koridor ROTKP 11", "icon": "fa-road" },
"rotkp11": { "title": "ROTKP 11", "icon": "fa-door-open" },
"koridor-perpustakaan-1": { "title": "Koridor Perpus 1", "icon": "fa-road" },
"koridor-perpustakaan-2": { "title": "Koridor Perpus 2", "icon": "fa-road" },
"koridor-rotkp4-1": { "title": "Koridor ROTKP4 1", "icon": "fa-road" },
"koridor-rotkp4-2": { "title": "Koridor ROTKP4 2", "icon": "fa-road" },
"rotkp4": { "title": "ROTKP 4", "icon": "fa-door-open" },
"rat": { "title": "RAT", "icon": "fa-door-open" },
"tempat-wudhu": { "title": "Tempat Wudhu", "icon": "fa-faucet" },
"tangga-lab": { "title": "Tangga Lab", "icon": "fa-stairs" },
"lab": { "title": "Laboratorium", "icon": "fa-flask" }
};

const sceneButtonsContainer = document.getElementById('sceneButtons');
Object.keys(scenesConfig).forEach(sceneId => {
const scene = scenesConfig[sceneId];
const btn = document.createElement('button');
btn.className = 'scene-btn';
btn.setAttribute('data-scene', sceneId);
btn.innerHTML = `<i class="fas ${scene.icon}"></i><span>${scene.title}</span>`;
sceneButtonsContainer.appendChild(btn);
});

document.addEventListener('DOMContentLoaded', function() {
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
// ===== 1. GERBANG =====
"gerbang": {
"title": "Gerbang Utama",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Gerbang.jpg') }}",
"hotSpots": [
{ "pitch": 0, "yaw": 45, "type": "scene", "text": "Ke Kantin", "sceneId": "kantin", "targetYaw": 180, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Kantin" },
{ "pitch": 0, "yaw": -30, "type": "scene", "text": "Ke Lapangan", "sceneId": "lapangan", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Lapangan" },
{ "pitch": 0, "yaw": -45, "type": "scene", "text": "Ke Parkiran", "sceneId": "parkiran", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Parkiran" },
{ "pitch": -10, "yaw": -60, "type": "info", "text": "Gerbang Utama SMK Negeri 11 Bandung", "id": "info-gerbang" }
]
},
// ===== 2. PARKIRAN =====
"parkiran": {
"title": "Area Parkiran",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Parkiran.jpg') }}",
"hotSpots": [
{ "pitch": 0, "yaw": -179, "type": "scene", "text": "Kembali ke Gerbang", "sceneId": "gerbang", "targetYaw": -45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Gerbang" },
{ "pitch": 0, "yaw": 45, "type": "info", "text": "Area Parkiran Siswa & Guru", "id": "info-parkiran" }
]
},
// ===== 3. LAPANGAN =====
"lapangan": {
"title": "Lapangan Utama",
"type": "equirectangular",
"panorama": "{{ asset('image/360/lapang.jpg') }}",
"hotSpots": [
{ "pitch": 0, "yaw": 30, "type": "scene", "text": "Ke RAT", "sceneId": "rat", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "RAT" },
{ "pitch": 0, "yaw": 180, "type": "scene", "text": "Kembali ke Gerbang", "sceneId": "gerbang", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Gerbang" },
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Koridor AKL Bawah", "sceneId": "koridor-akl-bawah", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor AKL Bawah" },
{ "pitch": 0, "yaw": 45, "type": "info", "text": "Lapangan Utama - Area Upacara", "id": "info-lapangan" }
]
},
// ===== 4. KORIDOR AKL BAWAH =====
"koridor-akl-bawah": {
"title": "Koridor AKL Bawah",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Koridor_AKLbawah.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 45, "type": "scene", "text": "Ke WC Kantin", "sceneId": "wc-kantin", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "WC Kantin" },
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Tangga Tengah BDP", "sceneId": "tangga-tengah-bdp", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Tengah BDP" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Ke Koridor R Seni", "sceneId": "koridor-rseni", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor R Seni" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Koridor AKL Lantai Bawah", "id": "info-koridor-akl-bawah" }
]
},
// ===== 5. TANGGA TENGAH BDP =====
"tangga-tengah-bdp": {
"title": "Tangga Tengah BDP",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tangga_TengahBDP.jpg') }}",
"hotSpots": [
{ "pitch": -8, "yaw": -90, "type": "scene", "text": "Ke WC AKL", "sceneId": "wc-akl", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "WC AKL" },
{ "pitch": 8, "yaw": 90, "type": "scene", "text": "Ke Tangga Atas BDP", "sceneId": "tangga-atas-bdp", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Atas BDP" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Tangga Tengah BDP", "id": "info-tangga-tengah-bdp" }
]
},
// ===== 6. WC AKL =====
"wc-akl": {
"title": "WC AKL",
"type": "equirectangular",
"panorama": "{{ asset('image/360/WC_akl.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Kembali ke Tangga Tengah BDP", "sceneId": "tangga-tengah-bdp", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Tengah BDP" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Ke Tangga Atas R Seni", "sceneId": "tangga-atas-rseni", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Atas R Seni" },
{ "pitch": 0, "yaw": 45, "type": "info", "text": "WC AKL", "id": "info-wc-akl" }
]
},
// ===== 7. TANGGA ATAS BDP =====
"tangga-atas-bdp": {
"title": "Tangga Atas BDP",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tangga_AtasBDP.jpg') }}",
"hotSpots": [
{ "pitch": -8, "yaw": -90, "type": "scene", "text": "Kembali ke Tangga Tengah BDP", "sceneId": "tangga-tengah-bdp", "targetYaw": 90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Tengah BDP" },
{ "pitch": 5, "yaw": 45, "type": "scene", "text": "Ke Panorama", "sceneId": "panorama", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Panorama" },
{ "pitch": 5, "yaw": -45, "type": "scene", "text": "Ke Koridor ROTKP 11", "sceneId": "koridor-rotkp11", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP 11" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Tangga Atas BDP", "id": "info-tangga-atas-bdp" }
]
},
// ===== 8. PANORAMA =====
"panorama": {
"title": "Panorama Sekolah",
"type": "equirectangular",
"panorama": "{{ asset('image/360/panorama.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Tangga Tengah RSPW", "sceneId": "tangga-tengah-rspw", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Tengah RSPW" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Kembali ke Lapangan", "sceneId": "lapangan", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Lapangan" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Panorama Lengkap Sekolah", "id": "info-panorama" }
]
},
// ===== 9. TANGGA TENGAH RSPW =====
"tangga-tengah-rspw": {
"title": "Tangga Tengah RSPW",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tangga_TengahRSPW.jpg') }}",
"hotSpots": [
{ "pitch": -8, "yaw": -90, "type": "scene", "text": "Ke Tangga RSPW", "sceneId": "tangga-rspw", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga RSPW" },
{ "pitch": 8, "yaw": 90, "type": "scene", "text": "Kembali ke Panorama", "sceneId": "panorama", "targetYaw": 90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Panorama" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Tangga Tengah RSPW", "id": "info-tangga-tengah-rspw" }
]
},
// ===== 10. TANGGA RSPW =====
"tangga-rspw": {
"title": "Tangga RSPW",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tangga_RSPW.jpg') }}",
"hotSpots": [
{ "pitch": -8, "yaw": -90, "type": "scene", "text": "Kembali ke Tangga Tengah RSPW", "sceneId": "tangga-tengah-rspw", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Tengah RSPW" },
{ "pitch": 5, "yaw": 45, "type": "scene", "text": "Ke Tangga Kantin", "sceneId": "tangga-kantin", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Kantin" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Tangga RSPW", "id": "info-tangga-rspw" }
]
},
// ===== 11. KANTIN =====
"kantin": {
"title": "Kantin Sekolah",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Kantin.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": -135, "type": "scene", "text": "Kembali ke Gerbang", "sceneId": "gerbang", "targetYaw": 45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Gerbang" },
{ "pitch": -8, "yaw": 45, "type": "scene", "text": "Ke Tangga Kantin", "sceneId": "tangga-kantin", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Kantin" },
{ "pitch": -6, "yaw": 120, "type": "scene", "text": "Ke WC Kantin", "sceneId": "wc-kantin", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "WC Kantin" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Kantin - Area Makan Siswa", "id": "info-kantin" }
]
},
// ===== 12. WC KANTIN =====
"wc-kantin": {
"title": "WC Kantin",
"type": "equirectangular",
"panorama": "{{ asset('image/360/wc_kantin.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Kembali ke Kantin", "sceneId": "kantin", "targetYaw": 120, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Kantin" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Ke Koridor AKL Bawah", "sceneId": "koridor-akl-bawah", "targetYaw": 45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor AKL Bawah" },
{ "pitch": 0, "yaw": 45, "type": "info", "text": "WC Kantin", "id": "info-wc-kantin" }
]
},
// ===== 13. KORIDOR ROTKP 11 =====
"koridor-rotkp11": {
"title": "Koridor ROTKP 11",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Koridor_ROTKP11.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke ROTKP 11", "sceneId": "rotkp11", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "ROTKP 11" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Ke Tangga Atas BDP", "sceneId": "tangga-atas-bdp", "targetYaw": -45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Atas BDP" },
{ "pitch": -8, "yaw": 45, "type": "scene", "text": "Ke Koridor Perpus 2", "sceneId": "koridor-perpustakaan-2", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor Perpus 2" },
{ "pitch": -8, "yaw": -45, "type": "scene", "text": "Ke Tangga Atas R Seni", "sceneId": "tangga-atas-rseni", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Atas R Seni" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Koridor ROTKP 11", "id": "info-koridor-rotkp11" }
]
},
// ===== 14. ROTKP 11 =====
"rotkp11": {
"title": "ROTKP 11",
"type": "equirectangular",
"panorama": "{{ asset('image/360/ROTKP11.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Kembali ke Koridor ROTKP 11", "sceneId": "koridor-rotkp11", "targetYaw": 90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP 11" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Ruang ROTKP 11", "id": "info-rotkp11" }
]
},
// ===== 15. KORIDOR PERPUSTAKAAN 2 =====
"koridor-perpustakaan-2": {
"title": "Koridor Perpus 2",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Koridor_Perpustakaan2.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Ke Koridor Perpus 1", "sceneId": "koridor-perpustakaan-1", "targetYaw": 90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor Perpus 1" },
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Koridor ROTKP 11", "sceneId": "koridor-rotkp11", "targetYaw": 45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP 11" },
{ "pitch": 0, "yaw": 45, "type": "info", "text": "Koridor Perpustakaan Lantai 2", "id": "info-koridor-perpus-2" }
]
},
// ===== 16. KORIDOR PERPUSTAKAAN 1 =====
"koridor-perpustakaan-1": {
"title": "Koridor Perpus 1",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Koridor_Perpustakaan1.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Koridor Perpus 2", "sceneId": "koridor-perpustakaan-2", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor Perpus 2" },
{ "pitch": -8, "yaw": -45, "type": "scene", "text": "Ke Koridor ROTKP4 1", "sceneId": "koridor-rotkp4-1", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP4 1" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Koridor Perpustakaan 1", "id": "info-koridor-perpus-1" }
]
},
// ===== 17. KORIDOR ROTKP4 1 =====
"koridor-rotkp4-1": {
"title": "Koridor ROTKP4 1",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Koridor_ROTKP4_1.jpg') }}",
"hotSpots": [
{ "pitch": -8, "yaw": -45, "type": "scene", "text": "Ke ROTKP 4", "sceneId": "rotkp4", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "ROTKP 4" },
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Koridor ROTKP4 2", "sceneId": "koridor-rotkp4-2", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP4 2" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Kembali ke Koridor Perpus 1", "sceneId": "koridor-perpustakaan-1", "targetYaw": -45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor Perpus 1" },
{ "pitch": -8, "yaw": 45, "type": "scene", "text": "Ke RAT", "sceneId": "rat", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "RAT" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Koridor ROTKP4 Area 1", "id": "info-koridor-rotkp4-1" }
]
},
// ===== 18. ROTKP 4 =====
"rotkp4": {
"title": "ROTKP 4",
"type": "equirectangular",
"panorama": "{{ asset('image/360/ROTKP4.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Kembali ke Koridor ROTKP4 1", "sceneId": "koridor-rotkp4-1", "targetYaw": -45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP4 1" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Ruang ROTKP 4", "id": "info-rotkp4" }
]
},
// ===== 19. KORIDOR ROTKP4 2 =====
"koridor-rotkp4-2": {
"title": "Koridor ROTKP4 2",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Koridor_ROTKP4_2.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Kembali ke Koridor ROTKP4 1", "sceneId": "koridor-rotkp4-1", "targetYaw": 90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP4 1" },
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Koridor R Seni", "sceneId": "koridor-rseni", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor R Seni" },
{ "pitch": 0, "yaw": 45, "type": "info", "text": "Koridor ROTKP4 Area 2", "id": "info-koridor-rotkp4-2" }
]
},
// ===== 20. KORIDOR R SENI =====
"koridor-rseni": {
"title": "Koridor R Seni",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Koridor_RSeni.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Tangga Atas R Seni", "sceneId": "tangga-atas-rseni", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Atas R Seni" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Kembali ke Koridor AKL Bawah", "sceneId": "koridor-akl-bawah", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor AKL Bawah" },
{ "pitch": -8, "yaw": 45, "type": "scene", "text": "Ke Koridor ROTKP4 2", "sceneId": "koridor-rotkp4-2", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP4 2" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Koridor Ruang Seni", "id": "info-koridor-rseni" }
]
},
// ===== 21. TANGGA ATAS R SENI =====
"tangga-atas-rseni": {
"title": "Tangga Atas R Seni",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tangga_AtasRSeni.jpg') }}",
"hotSpots": [
{ "pitch": -8, "yaw": -90, "type": "scene", "text": "Kembali ke Koridor R Seni", "sceneId": "koridor-rseni", "targetYaw": 90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor R Seni" },
{ "pitch": -8, "yaw": 90, "type": "scene", "text": "Ke WC AKL", "sceneId": "wc-akl", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "WC AKL" },
{ "pitch": 5, "yaw": 45, "type": "scene", "text": "Ke Koridor ROTKP 11", "sceneId": "koridor-rotkp11", "targetYaw": -45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP 11" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Tangga Atas R Seni", "id": "info-tangga-atas-rseni" }
]
},
// ===== 22. RAT =====
"rat": {
"title": "RAT",
"type": "equirectangular",
"panorama": "{{ asset('image/360/RAT.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 180, "type": "scene", "text": "Kembali ke Lapangan", "sceneId": "lapangan", "targetYaw": 30, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Lapangan" },
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Ke Koridor ROTKP4 1", "sceneId": "koridor-rotkp4-1", "targetYaw": 45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Koridor ROTKP4 1" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Ke Tempat Wudhu", "sceneId": "tempat-wudhu", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tempat Wudhu" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Ruang RAT", "id": "info-rat" }
]
},
// ===== 23. TEMPAT WUDHU =====
"tempat-wudhu": {
"title": "Tempat Wudhu",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tempat_Wudhu.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Kembali ke Lapangan", "sceneId": "lapangan", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Lapangan" },
{ "pitch": -5, "yaw": -90, "type": "scene", "text": "Ke RAT", "sceneId": "rat", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "RAT" },
{ "pitch": 0, "yaw": 45, "type": "info", "text": "Tempat Wudhu", "id": "info-tempat-wudhu" }
]
},
// ===== 24. TANGGA LABORATORIUM =====
"tangga-lab": {
"title": "Tangga Laboratorium",
"type": "equirectangular",
"panorama": "{{ asset('image/360/tangga_lab.jpg') }}",
"hotSpots": [
{ "pitch": -8, "yaw": -90, "type": "scene", "text": "Kembali ke Lapangan", "sceneId": "lapangan", "targetYaw": 90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Lapangan" },
{ "pitch": 5, "yaw": 45, "type": "scene", "text": "Ke Laboratorium", "sceneId": "lab", "targetYaw": 0, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Laboratorium" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Tangga Laboratorium", "id": "info-tangga-lab" }
]
},
// ===== 25. LABORATORIUM =====
"lab": {
"title": "Laboratorium",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Lab.jpg') }}",
"hotSpots": [
{ "pitch": -5, "yaw": 90, "type": "scene", "text": "Kembali ke Tangga Lab", "sceneId": "tangga-lab", "targetYaw": 45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga Lab" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Laboratorium - Ruang Praktikum", "id": "info-lab" }
]
},
// ===== 26. TANGGA KANTIN =====
"tangga-kantin": {
"title": "Tangga Kantin",
"type": "equirectangular",
"panorama": "{{ asset('image/360/Tangga_KantinRSPW.jpg') }}",
"hotSpots": [
{ "pitch": -8, "yaw": -90, "type": "scene", "text": "Kembali ke Kantin", "sceneId": "kantin", "targetYaw": 45, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Kantin" },
{ "pitch": 5, "yaw": 45, "type": "scene", "text": "Ke Tangga RSPW", "sceneId": "tangga-rspw", "targetYaw": -90, "createTooltipFunc": hotspotTooltip, "createTooltipArgs": "Tangga RSPW" },
{ "pitch": 0, "yaw": 60, "type": "info", "text": "Tangga Kantin", "id": "info-tangga-kantin" }
]
}
}
});

setTimeout(() => {
const loading = document.querySelector('.loading');
if (loading) loading.style.display = 'none';
}, 2000);

document.querySelectorAll('.scene-btn').forEach(button => {
button.addEventListener('click', function() {
const sceneId = this.getAttribute('data-scene');
document.querySelectorAll('.scene-btn').forEach(btn => btn.classList.remove('active'));
this.classList.add('active');
viewer.loadScene(sceneId);
currentScene = sceneId;
const sceneTitle = document.getElementById('current-scene-title');
const sceneData = viewer.getConfig().scenes[sceneId];
if (sceneTitle && sceneData) sceneTitle.textContent = sceneData.title;
});
});

viewer.on('scenechange', function(sceneId) {
document.querySelectorAll('.scene-btn').forEach(btn => {
btn.classList.remove('active');
if (btn.getAttribute('data-scene') === sceneId) btn.classList.add('active');
});
const sceneTitle = document.getElementById('current-scene-title');
const sceneData = viewer.getConfig().scenes[sceneId];
if (sceneTitle && sceneData) sceneTitle.textContent = sceneData.title;
currentScene = sceneId;
});

document.querySelector('.scene-btn').classList.add('active');
});

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

window.addEventListener('load', function() {
if (!window.WebGLRenderingContext) {
showNotification('⚠️ Browser Anda tidak mendukung WebGL.', 'warning');
}
preloadPanoramas();
checkFirstVisit();
checkOnlineStatus();
initKeyboardShortcuts();
console.log('✅ Virtual Tour siap digunakan!');
});

function showNotification(message, type = 'info') {
const notification = document.createElement('div');
notification.style.cssText = `position:fixed;top:100px;right:20px;padding:15px 25px;background:${type==='warning'?'#ff9800':'#1e3c72'};color:white;border-radius:12px;box-shadow:0 8px 25px rgba(0,0,0,0.3);z-index:9999;font-weight:600;max-width:350px;animation:slideInRight 0.5s ease;font-size:0.95rem;`;
notification.textContent = message;
document.body.appendChild(notification);
setTimeout(() => {
notification.style.animation = 'slideOutRight 0.5s ease';
setTimeout(() => notification.remove(), 500);
}, 5000);
}

function preloadPanoramas() {
if (!viewer) return;
const scenes = viewer.getConfig().scenes;
Object.keys(scenes).forEach((sceneId, index) => {
if (sceneId !== currentScene) {
const img = new Image();
img.src = scenes[sceneId].panorama.replace("{{ asset('", "").replace("') }}", "");
}
});
}

function checkFirstVisit() {
const hasVisited = localStorage.getItem('hasVisitedVirtualTour');
if (!hasVisited) {
setTimeout(() => { showWelcomeModal(); localStorage.setItem('hasVisitedVirtualTour', 'true'); }, 1500);
}
}

function showWelcomeModal() {
const modal = document.createElement('div');
modal.style.cssText = `position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);display:flex;align-items:center;justify-content:center;z-index:10000;animation:fadeIn 0.3s ease;`;
modal.innerHTML = `<div style="background:white;padding:40px;border-radius:20px;max-width:500px;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,0.3);animation:slideUp 0.5s ease;"><div style="font-size:4rem;margin-bottom:20px;">🎓</div><h2 style="color:#1e3c72;margin-bottom:15px;font-size:1.8rem;">Selamat Datang!</h2><p style="color:#6c757d;margin-bottom:25px;line-height:1.6;">Jelajahi SMK Negeri 11 Bandung dengan Virtual Tour 360°.<br><br><strong>Cara Navigasi:</strong><br>🖱️ Klik & drag untuk memutar<br>📜 Scroll untuk zoom<br>🔵 Klik hotspot biru untuk pindah lokasi</p><button onclick="this.closest('div[style*=fixed]').remove()" style="background:linear-gradient(135deg,#1e3c72,#2a5298);color:white;border:none;padding:12px 35px;border-radius:25px;font-weight:700;cursor:pointer;font-size:1rem;">Mulai Jelajah</button></div>`;
document.body.appendChild(modal);
modal.addEventListener('click', function(e) { if (e.target === modal) modal.remove(); });
}

function checkOnlineStatus() {
if (!navigator.onLine) showNotification('📴 Anda sedang offline.', 'warning');
window.addEventListener('online', () => showNotification('📶 Koneksi internet telah pulih.', 'success'));
window.addEventListener('offline', () => showNotification('📴 Anda sedang offline.', 'warning'));
}

function initKeyboardShortcuts() {
document.addEventListener('keydown', function(e) {
if (e.key === 'p' || e.key === 'P') {
if (viewer) {
const pitch = viewer.getPitch().toFixed(2);
const yaw = viewer.getYaw().toFixed(2);
showNotification(`📍 Pitch: ${pitch} | Yaw: ${yaw}`, 'info');
}
}
if (!viewer) return;
switch(e.key) {
case 'ArrowLeft': viewer.rotateView(-45, 0); break;
case 'ArrowRight': viewer.rotateView(45, 0); break;
case 'ArrowUp': viewer.rotateView(0, -45); break;
case 'ArrowDown': viewer.rotateView(0, 45); break;
case '+': case '=': viewer.setZoom(viewer.getZoom() + 1); break;
case '-': viewer.setZoom(viewer.getZoom() - 1); break;
case 'f': case 'F': viewer.toggleFullscreen(); break;
}
});
}
</script>
</body>
</html>