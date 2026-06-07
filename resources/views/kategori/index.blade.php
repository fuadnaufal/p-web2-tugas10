@extends('layouts.app')

@section('title', 'Daftar Kategori Buku')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2 class="fw-bold text-secondary">Daftar Kategori Buku</h2>
        <p class="text-muted">Silakan pilih kategori untuk melihat koleksi buku yang tersedia.</p>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($kategori_list as $kategori)
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">{{ $kategori['nama'] }}</h5>
                <p class="card-text text-muted">{{ $kategori['deskripsi'] }}</p>
            </div>
            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center pb-3">
                <span class="badge bg-secondary">{{ $kategori['jumlah_buku'] }} Buku</span>
                <a href="{{ route('kategori.show', $kategori['id']) }}" class="btn btn-sm btn-outline-primary">
                    Lihat Detail &rarr;
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection