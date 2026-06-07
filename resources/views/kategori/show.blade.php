@extends('layouts.app')

@section('title', 'Detail Kategori ' . $kategori['nama'])

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $kategori['nama'] }}</li>
    </ol>
</nav>

<div class="p-4 mb-4 bg-white rounded shadow-sm border-start border-primary border-4">
    <h1 class="fw-bold text-dark">{{ $kategori['nama'] }}</h1>
    <p class="lead text-muted mb-0">{{ $kategori['deskripsi'] }}</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white fw-bold">
        Daftar Buku Terkait
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buku_list as $index => $buku)
                    <tr>
                        <td class="ps-4">{{ $index + 1 }}</td>
                        <td class="fw-bold text-secondary">{{ $buku['judul'] }}</td>
                        <td>{{ $buku['penulis'] }}</td>
                        <td>{{ $buku['penerbit'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Belum ada koleksi buku di kategori ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>
@endsection