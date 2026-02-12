@extends('layouts.app')

@section('title', 'Denah Sekolah')

@section('content')
<div class="text-center mb-5">
    <h1 class="display-4 fw-bold">Denah Sekolah SMK Negeri 11 Bandung</h1>
    <p class="lead">Lihat denah ruangan dan fasilitas sekolah</p>
</div>

<div class="row g-4">
    @forelse($maps as $map)
    <div class="col-md-4">
        <div class="card h-100 shadow-lg border-0" style="border-radius: 16px; overflow: hidden;">
            <div style="height: 250px; overflow: hidden;">
                <img 
                    src="{{ $map->image_url }}" 
                    class="card-img-top" 
                    alt="{{ $map->room_name }}"
                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.1)'"
                    onmouseout="this.style.transform='scale(1)'"
                >
            </div>
            <div class="card-body bg-dark text-white">
                <h5 class="card-title fw-bold">
                    {{ $map->room_name ?? '-' }}
                </h5>
                <p class="card-text text-muted mb-3">
                    <strong>Kode:</strong> {{ $map->room_code ?? '-' }}
                </p>
                <div class="d-flex gap-2">
                    <a href="{{ route('school.detail', $map->id) }}" class="btn btn-primary flex-grow-1">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                    <a href="{{ route('school.edit', $map->id) }}" class="btn btn-warning" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('school.destroy', $map->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus denah ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i> Belum ada data denah sekolah.
        </div>
        <a href="{{ route('school.create') }}" class="btn btn-teal">
            <i class="fas fa-plus"></i> Tambah Denah Pertama
        </a>
    </div>
    @endforelse
</div>
@endsection