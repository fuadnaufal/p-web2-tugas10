@extends('layouts.app')

@section('title', 'Hasil Pencarian: ' . $keyword)

@section('content')
<div class="mb-4">
    <h4>Hasil Pencarian Kategori untuk: <span class="badge bg-warning text-dark">"{{ $keyword }}"</span></h4>
    <a href="{{ route('kategori.index') }}" class="text-decoration-none">&larr; Kembali ke Semua Kategori</a>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse($hasil_pencarian as $kategori)
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">
                    {!! str_ireplace($keyword, '<mark class="p-0 bg-warning">'.$keyword.'</mark>', $kategori['nama']) !!}
                </h5>
                <p class="card-text text-muted">
                    {!! str_ireplace($keyword, '<mark class="p-0 bg-warning">'.$keyword.'</mark>', $kategori['deskripsi']) !!}
                </p>
            </div>
            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center pb-3">
                <span class="badge bg-secondary">{{ $kategori['jumlah_buku'] }} Buku</span>
                <a href="{{ route('kategori.show', $kategori['id']) }}" class="btn btn-sm btn-outline-primary">
                    Lihat Detail &rarr;
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="alert alert-info">
            Kategori dengan kata kunci <strong>"{{ $keyword }}"</strong> tidak ditemukan.
        </div>
    </div>
    @endforelse
</div>
@endsection