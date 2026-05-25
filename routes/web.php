<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Anggota;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test-accessor-scope', function () {
    // CDN Bootstrap dimasukkan ke HTML agar style badge warna-warni keluar sempurna
    $html = '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container mt-5">
        <h1 class="mb-4 text-primary text-center">Hasil Testing Accessor & Scope</h1>
        <hr>';

    // -------------------------------------------------------------------------
    // BAGIAN 1: TESTING BUKU
    // -------------------------------------------------------------------------
    $html .= '<h2 class="text-secondary mt-4">1. Data Buku (Accessor & Scope)</h2>';

    // A. Semua Buku dengan status_stok_badge & tahun_label
    $html .= '<h4 class="text-info mt-3">-> Semua Buku (Menguji Accessor)</h4>';
    $html .= '<table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr><th>Judul</th><th>Stok</th><th>Status Stok</th><th>Tahun</th><th>Label</th></tr>
                </thead><tbody>';
    foreach (Buku::all() as $b) {
        $html .= "<tr>
                    <td>{$b->judul}</td>
                    <td>{$b->stok}</td>
                    <td>{$b->status_stok_badge}</td>
                    <td>{$b->tahun_terbit}</td>
                    <td><span class='badge bg-dark'>{$b->tahun_label}</span></td>
                  </tr>";
    }
    $html .= '</tbody></table>';

    // B. Scope Terbaru
    $html .= '<h4 class="text-info mt-3">-> Buku Terbaru (Scope Terbaru >= 2024)</h4><ul>';
    foreach (Buku::terbaru()->get() as $b) {
        $html .= "<li>{$b->judul} ({$b->tahun_terbit})</li>";
    }
    $html .= '</ul>';

    // C. Scope Stok Menipis
    $html .= '<h4 class="text-info mt-3">-> Buku Stok Menipis (Scope Stok < 5)</h4><ul>';
    foreach (Buku::stokMenipis()->get() as $b) {
        $html .= "<li>{$b->judul} - Stok: <strong class='text-danger'>{$b->stok}</strong></li>";
    }
    $html .= '</ul>';


    // -------------------------------------------------------------------------
    // BAGIAN 2: TESTING ANGGOTA
    // -------------------------------------------------------------------------
    $html .= '<hr><h2 class="text-secondary mt-5">2. Data Anggota (Accessor & Scope)</h2>';

    // A. Semua Anggota dengan status_badge & kategori_usia
    $html .= '<h4 class="text-info mt-3">-> Semua Anggota (Menguji Accessor)</h4>';
    $html .= '<table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr><th>Nama</th><th>Umur</th><th>Kategori Usia</th><th>Status</th></tr>
                </thead><tbody>';
    foreach (Anggota::all() as $a) {
        $html .= "<tr>
                    <td>{$a->nama}</td>
                    <td>{$a->umur} Tahun</td>
                    <td><span class='badge bg-primary'>{$a->kategori_usia}</span></td>
                    <td>{$a->status_badge}</td>
                  </tr>";
    }
    $html .= '</tbody></table>';

    // B. Scope Terdaftar Bulan Ini
    $html .= '<h4 class="text-info mt-3">-> Anggota Terdaftar Bulan Ini (Scope)</h4><ul>';
    $anggotaBulanIni = Anggota::terdaftarBulanIni()->get();
    if($anggotaBulanIni->isEmpty()) {
        $html .= "<li><em class='text-muted'>Tidak ada anggota baru yang didaftarkan bulan ini.</em></li>";
    } else {
        foreach ($anggotaBulanIni as $a) {
            $html .= "<li>{$a->nama} (Terdaftar: {$a->created_at->format('d-m-Y')})</li>";
        }
    }
    $html .= '</ul></div>';

    return $html;
});

// ========== TESTING BUKU ==========

// List all buku
// Route::get('/buku', function () {
//     $bukus = Buku::all();
    
//     $html = '<h1>Daftar Buku</h1>';
//     $html .= '<a href="/buku/create">Tambah Buku</a><br /><br />';
//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr>
//                 <th>ID</th>
//                 <th>Kode</th>
//                 <th>Judul</th>
//                 <th>Kategori</th>
//                 <th>Harga</th>
//                 <th>Stok</th>
//                 <th>Aksi</th>
//               </tr>';
    
//     foreach ($bukus as $buku) {
//         $html .= '<tr>';
//         $html .= '<td>' . $buku->id . '</td>';
//         $html .= '<td>' . $buku->kode_buku . '</td>';
//         $html .= '<td>' . $buku->judul . '</td>';
//         $html .= '<td>' . $buku->kategori . '</td>';
//         $html .= '<td>' . $buku->harga_format . '</td>';
//         $html .= '<td>' . $buku->stok . '</td>';
//         $html .= '<td>
//                     <a href="/buku/' . $buku->id . '">Detail</a> | 
//                     <a href="/buku/' . $buku->id . '/edit">Edit</a>
//                   </td>';
//         $html .= '</tr>';
//     }
    
//     $html .= '</table>';
    
//     return $html;
// });

// // Show single buku
// Route::get('/buku/{id}', function ($id) {
//     $buku = Buku::findOrFail($id);
    
//     $html = '<h1>Detail Buku</h1>';
//     $html .= '<a href="/buku">Kembali</a><br /><br />';
//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr><th>Field</th><th>Value</th></tr>';
//     $html .= '<tr><td>ID</td><td>' . $buku->id . '</td></tr>';
//     $html .= '<tr><td>Kode Buku</td><td>' . $buku->kode_buku . '</td></tr>';
//     $html .= '<tr><td>Judul</td><td>' . $buku->judul . '</td></tr>';
//     $html .= '<tr><td>Kategori</td><td>' . $buku->kategori . '</td></tr>';
//     $html .= '<tr><td>Pengarang</td><td>' . $buku->pengarang . '</td></tr>';
//     $html .= '<tr><td>Penerbit</td><td>' . $buku->penerbit . '</td></tr>';
//     $html .= '<tr><td>Tahun</td><td>' . $buku->tahun_terbit . '</td></tr>';
//     $html .= '<tr><td>ISBN</td><td>' . $buku->isbn . '</td></tr>';
//     $html .= '<tr><td>Harga</td><td>' . $buku->harga_format . '</td></tr>';
//     $html .= '<tr><td>Stok</td><td>' . $buku->stok . '</td></tr>';
//     $html .= '<tr><td>Tersedia?</td><td>' . ($buku->tersedia ? 'Ya' : 'Tidak') . '</td></tr>';
//     $html .= '<tr><td>Created</td><td>' . $buku->created_at . '</td></tr>';
//     $html .= '<tr><td>Updated</td><td>' . $buku->updated_at . '</td></tr>';
//     $html .= '</table>';
    
//     return $html;
// });

// // ========== TESTING ANGGOTA ==========

// // List all anggota
// Route::get('/anggota', function () {
//     $anggotas = Anggota::all();
    
//     $html = '<h1>Daftar Anggota</h1>';
//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr>
//                 <th>ID</th>
//                 <th>Kode</th>
//                 <th>Nama</th>
//                 <th>Email</th>
//                 <th>Umur</th>
//                 <th>Status</th>
//                 <th>Aksi</th>
//               </tr>';
    
//     foreach ($anggotas as $anggota) {
//         $html .= '<tr>';
//         $html .= '<td>' . $anggota->id . '</td>';
//         $html .= '<td>' . $anggota->kode_anggota . '</td>';
//         $html .= '<td>' . $anggota->nama . '</td>';
//         $html .= '<td>' . $anggota->email . '</td>';
//         $html .= '<td>' . $anggota->umur . ' tahun</td>';
//         $html .= '<td>' . $anggota->status . '</td>';
//         $html .= '<td><a href="/anggota/' . $anggota->id . '">Detail</a></td>';
//         $html .= '</tr>';
//     }
    
//     $html .= '</table>';
    
//     return $html;
// });

// // Show single anggota
// Route::get('/anggota/{id}', function ($id) {
//     $anggota = Anggota::findOrFail($id);
    
//     $html = '<h1>Detail Anggota</h1>';
//     $html .= '<a href="/anggota">Kembali</a><br /><br />';
//     $html .= '<table border="1" cellpadding="10">';
//     $html .= '<tr><th>Field</th><th>Value</th></tr>';
//     $html .= '<tr><td>Kode Anggota</td><td>' . $anggota->kode_anggota . '</td></tr>';
//     $html .= '<tr><td>Nama</td><td>' . $anggota->nama . '</td></tr>';
//     $html .= '<tr><td>Email</td><td>' . $anggota->email . '</td></tr>';
//     $html .= '<tr><td>Telepon</td><td>' . $anggota->telepon . '</td></tr>';
//     $html .= '<tr><td>Alamat</td><td>' . $anggota->alamat . '</td></tr>';
//     $html .= '<tr><td>Tanggal Lahir</td><td>' . $anggota->tanggal_lahir->format('d-m-Y') . '</td></tr>';
//     $html .= '<tr><td>Umur</td><td>' . $anggota->umur . ' tahun</td></tr>';
//     $html .= '<tr><td>Jenis Kelamin</td><td>' . $anggota->jenis_kelamin . '</td></tr>';
//     $html .= '<tr><td>Pekerjaan</td><td>' . $anggota->pekerjaan . '</td></tr>';
//     $html .= '<tr><td>Tanggal Daftar</td><td>' . $anggota->tanggal_daftar->format('d-m-Y') . '</td></tr>';
//     $html .= '<tr><td>Lama Anggota</td><td>' . $anggota->lama_anggota . ' hari</td></tr>';
//     $html .= '<tr><td>Status</td><td>' . $anggota->status . '</td></tr>';
//     $html .= '</table>';
    
//     return $html;
// });

// // Testing Scope & Query
// Route::get('/test-query', function () {
//     $html = '<h1>Testing Query Eloquent</h1>';
    
//     // Buku tersedia
//     $tersedia = Buku::tersedia()->get();
//     $html .= '<h3>Buku Tersedia (Stok > 0): ' . $tersedia->count() . '</h3>';
//     $html .= '<ul>';
//     foreach ($tersedia as $buku) {
//         $html .= '<li>' . $buku->judul . ' (Stok: ' . $buku->stok . ')</li>';
//     }
//     $html .= '</ul>';
    
//     // Buku Programming
//     $programming = Buku::kategori('Programming')->get();
//     $html .= '<h3>Buku Programming: ' . $programming->count() . '</h3>';
//     $html .= '<ul>';
//     foreach ($programming as $buku) {
//         $html .= '<li>' . $buku->judul . '</li>';
//     }
//     $html .= '</ul>';
    
//     // Anggota Aktif
//     $aktif = Anggota::aktif()->get();
//     $html .= '<h3>Anggota Aktif: ' . $aktif->count() . '</h3>';
//     $html .= '<ul>';
//     foreach ($aktif as $anggota) {
//         $html .= '<li>' . $anggota->nama . ' (' . $anggota->email . ')</li>';
//     }
//     $html .= '</ul>';
    
//     return $html;
// });

// Route::get('/', function () {
//     return view('welcome');
// });

// // Route test koneksi database
// Route::get('/test-db', function () {
//     try {
//         DB::connection()->getPdo();
//         $dbName = DB::connection()->getDatabaseName();
        
//         return "Koneksi database berhasil!<br />Database: <strong>{$dbName}</strong>";
//     } catch (\Exception $e) {
//         return "Koneksi database gagal!<br />Error: " . $e->getMessage();
//     }
// });