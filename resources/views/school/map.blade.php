@extends('layouts.app')

@section('title', 'Denah Sekolah - SMK Negeri 11 Bandung')

@section('styles')
<style>
    .map-container {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        overflow: hidden;
        position: relative;
    }

    .school-map {
        width: 100%;
        display: block;
        border-radius: 12px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .school-map:hover {
        transform: scale(1.02);
    }

    .legend {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 25px;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 4px;
    }

    .btn-back {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        text-decoration: none;
        margin-top: 25px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="container">
    <header class="text-center mb-5">
        <h1 class="display-4 fw-bold">Denah Sekolah SMK Negeri 11 Bandung</h1>
        <p class="lead">Lihat lokasi gedung, fasilitas, dan area penting di lingkungan sekolah</p>
    </header>

    <div class="map-container">
        <!-- Ganti dengan path gambar denah Anda -->
        <img 
            src="{{ asset('images/Tangga_spw.jpg') }}" 
            alt="Denah Sekolah SMK Negeri 11 Bandung"
            class="school-map"
            id="schoolMap"
        />

        <div class="legend">
            <div class="legend-item">
                <div class="legend-color" style="background: #FF6B6B;"></div>
                <span>Gedung Utama</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #4ECDC4;"></div>
                <span>Lapangan</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #FFE66D;"></div>
                <span>Perpustakaan</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #1A535C;"></div>
                <span>Workshop</span>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Profil Sekolah
        </a>
    </div>

    <footer class="text-center mt-5">
        <p>&copy; {{ date('Y') }} SMK Negeri 11 Bandung</p>
    </footer>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('schoolMap').addEventListener('click', function() {
        if (this.style.transform === 'scale(1.5)') {
            this.style.transform = 'scale(1)';
            this.style.transition = 'transform 0.3s ease';
        } else {
            this.style.transform = 'scale(1.5)';
            this.style.transition = 'transform 0.3s ease';
        }
    });
</script>
@endsection