<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use App\Models\Anggota;

// // =============================================
// // Praktikum 1 - Pertemuan 10/c: Testing Koneksi
// // =============================================
// Route::get('/', function () {
//     return view('welcome');
// });

// Route test koneksi database
// Route::get('/test-db', function () {
//     try {
//         DB::connection()->getPdo();
//         $dbName = DB::connection()->getDatabaseName();
        
//         return "Koneksi database berhasil!<br />Database: <strong>{$dbName}</strong>";
//     } catch (\Exception $e) {
//         return "Koneksi database gagal!<br />Error: " . $e->getMessage();
//     }
// });

// // ================================================
// // Praktikum 8 - Pertemuan 10/a: Route Testing CRUD
// // ================================================

Route::get('/', function () {
    return view('welcome');
});

// ========== TESTING BUKU ==========

// List all buku
Route::get('/buku', function () {
    $bukus = Buku::all();
    
    $html = '<h1>Daftar Buku</h1>';
    $html .= '<a href="/buku/create">Tambah Buku</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>';
    
    foreach ($bukus as $buku) {
        $html .= '<tr>';
        $html .= '<td>' . $buku->id . '</td>';
        $html .= '<td>' . $buku->kode_buku . '</td>';
        $html .= '<td>' . $buku->judul . '</td>';
        $html .= '<td>' . $buku->kategori . '</td>';
        $html .= '<td>' . $buku->harga_format . '</td>';
        $html .= '<td>' . $buku->stok . '</td>';
        $html .= '<td>
                    <a href="/buku/' . $buku->id . '">Detail</a> | 
                    <a href="/buku/' . $buku->id . '/edit">Edit</a>
                  </td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    return $html;
});

// Show single buku
Route::get('/buku/{id}', function ($id) {
    $buku = Buku::findOrFail($id);
    
    $html = '<h1>Detail Buku</h1>';
    $html .= '<a href="/buku">Kembali</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr><th>Field</th><th>Value</th></tr>';
    $html .= '<tr><td>ID</td><td>' . $buku->id . '</td></tr>';
    $html .= '<tr><td>Kode Buku</td><td>' . $buku->kode_buku . '</td></tr>';
    $html .= '<tr><td>Judul</td><td>' . $buku->judul . '</td></tr>';
    $html .= '<tr><td>Kategori</td><td>' . $buku->kategori . '</td></tr>';
    $html .= '<tr><td>Pengarang</td><td>' . $buku->pengarang . '</td></tr>';
    $html .= '<tr><td>Penerbit</td><td>' . $buku->penerbit . '</td></tr>';
    $html .= '<tr><td>Tahun</td><td>' . $buku->tahun_terbit . '</td></tr>';
    $html .= '<tr><td>ISBN</td><td>' . $buku->isbn . '</td></tr>';
    $html .= '<tr><td>Harga</td><td>' . $buku->harga_format . '</td></tr>';
    $html .= '<tr><td>Stok</td><td>' . $buku->stok . '</td></tr>';
    $html .= '<tr><td>Tersedia?</td><td>' . ($buku->tersedia ? 'Ya' : 'Tidak') . '</td></tr>';
    $html .= '<tr><td>Created</td><td>' . $buku->created_at . '</td></tr>';
    $html .= '<tr><td>Updated</td><td>' . $buku->updated_at . '</td></tr>';
    $html .= '</table>';
    
    return $html;
});

// ========== TESTING ANGGOTA ==========

// List all anggota
Route::get('/anggota', function () {
    $anggotas = Anggota::all();
    
    $html = '<h1>Daftar Anggota</h1>';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Umur</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>';
    
    foreach ($anggotas as $anggota) {
        $html .= '<tr>';
        $html .= '<td>' . $anggota->id . '</td>';
        $html .= '<td>' . $anggota->kode_anggota . '</td>';
        $html .= '<td>' . $anggota->nama . '</td>';
        $html .= '<td>' . $anggota->email . '</td>';
        $html .= '<td>' . $anggota->umur . ' tahun</td>';
        $html .= '<td>' . $anggota->status . '</td>';
        $html .= '<td><a href="/anggota/' . $anggota->id . '">Detail</a></td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    return $html;
});

// Show single anggota
Route::get('/anggota/{id}', function ($id) {
    $anggota = Anggota::findOrFail($id);
    
    $html = '<h1>Detail Anggota</h1>';
    $html .= '<a href="/anggota">Kembali</a><br /><br />';
    $html .= '<table border="1" cellpadding="10">';
    $html .= '<tr><th>Field</th><th>Value</th></tr>';
    $html .= '<tr><td>Kode Anggota</td><td>' . $anggota->kode_anggota . '</td></tr>';
    $html .= '<tr><td>Nama</td><td>' . $anggota->nama . '</td></tr>';
    $html .= '<tr><td>Email</td><td>' . $anggota->email . '</td></tr>';
    $html .= '<tr><td>Telepon</td><td>' . $anggota->telepon . '</td></tr>';
    $html .= '<tr><td>Alamat</td><td>' . $anggota->alamat . '</td></tr>';
    $html .= '<tr><td>Tanggal Lahir</td><td>' . $anggota->tanggal_lahir->format('d-m-Y') . '</td></tr>';
    $html .= '<tr><td>Umur</td><td>' . $anggota->umur . ' tahun</td></tr>';
    $html .= '<tr><td>Jenis Kelamin</td><td>' . $anggota->jenis_kelamin . '</td></tr>';
    $html .= '<tr><td>Pekerjaan</td><td>' . $anggota->pekerjaan . '</td></tr>';
    $html .= '<tr><td>Tanggal Daftar</td><td>' . $anggota->tanggal_daftar->format('d-m-Y') . '</td></tr>';
    $html .= '<tr><td>Lama Anggota</td><td>' . $anggota->lama_anggota . ' hari</td></tr>';
    $html .= '<tr><td>Status</td><td>' . $anggota->status . '</td></tr>';
    $html .= '</table>';
    
    return $html;
});

// Testing Scope & Query
Route::get('/test-query', function () {
    $html = '<h1>Testing Query Eloquent</h1>';
    
    // Buku tersedia
    $tersedia = Buku::tersedia()->get();
    $html .= '<h3>Buku Tersedia (Stok > 0): ' . $tersedia->count() . '</h3>';
    $html .= '<ul>';
    foreach ($tersedia as $buku) {
        $html .= '<li>' . $buku->judul . ' (Stok: ' . $buku->stok . ')</li>';
    }
    $html .= '</ul>';
    
    // Buku Programming
    $programming = Buku::kategori('Programming')->get();
    $html .= '<h3>Buku Programming: ' . $programming->count() . '</h3>';
    $html .= '<ul>';
    foreach ($programming as $buku) {
        $html .= '<li>' . $buku->judul . '</li>';
    }
    $html .= '</ul>';
    
    // Anggota Aktif
    $aktif = Anggota::aktif()->get();
    $html .= '<h3>Anggota Aktif: ' . $aktif->count() . '</h3>';
    $html .= '<ul>';
    foreach ($aktif as $anggota) {
        $html .= '<li>' . $anggota->nama . ' (' . $anggota->email . ')</li>';
    }
    $html .= '</ul>';
    
    return $html;
});

// ======================
// TUGAS 2 - Pertemuan 10
// ======================

// ... (route lainnya yang sudah ada)

Route::get('/test-accessor-scope', function () {
    $html = '<h1>Testing Accessor & Scope </h1><hr>';
    
    // ===============
    // A. TESTING BUKU
    // ===============
    $html .= '<h2>A. Model Buku</h2>';
    
    // Cek Accessor Buku
    $bukuSample = App\Models\Buku::first();
    if ($bukuSample) {
        $html .= '<ul>';
        $html .= "<li><strong>Sampel Buku:</strong> {$bukuSample->judul}</li>";
        $html .= "<li><strong>Accessor status_stok_badge:</strong> {$bukuSample->status_stok_badge}</li>";
        $html .= "<li><strong>Accessor tahun_label:</strong> {$bukuSample->tahun_label}</li>";
        $html .= '</ul>';
    } else {
        $html .= '<p><i>Data buku masih kosong.</i></p>';
    }

    // Cek Scope Buku Terbaru
    $html .= '<h3>Scope: Buku Terbaru (>= 2024)</h3><ul>';
    foreach (App\Models\Buku::terbaru()->get() as $b) {
        $html .= "<li>{$b->judul} (Tahun: {$b->tahun_terbit})</li>";
    }
    $html .= '</ul>';

    // Cek Scope Stok Menipis
    $html .= '<h3>Scope: Buku Stok Menipis (< 5)</h3><ul>';
    foreach (App\Models\Buku::stokMenipis()->get() as $b) {
        $html .= "<li>{$b->judul} (Stok: {$b->stok}) - {$b->status_stok_badge}</li>";
    }
    $html .= '</ul>';

    // ==================
    // B. TESTING ANGGOTA
    // ==================  
    $html .= '<hr><h2>B. Model Anggota</h2>';
    
    // Cek Accessor Anggota
    $anggotaSample = App\Models\Anggota::first();
    if ($anggotaSample) {
        $html .= '<ul>';
        $html .= "<li><strong>Sampel Anggota:</strong> {$anggotaSample->nama}</li>";
        $html .= "<li><strong>Accessor status_badge:</strong> {$anggotaSample->status_badge}</li>";
        $html .= "<li><strong>Accessor kategori_usia:</strong> {$anggotaSample->kategori_usia} ({$anggotaSample->umur} tahun)</li>";
        $html .= '</ul>';
    } else {
        $html .= '<p><i>Data anggota masih kosong.</i></p>';
    }

    // Cek Scope Anggota Terdaftar Bulan Ini
    $html .= '<h3>Scope: Anggota Terdaftar Bulan Ini</h3><ul>';
    $anggotaBaru = App\Models\Anggota::terdaftarBulanIni()->get();
    
    if($anggotaBaru->count() > 0) {
        foreach ($anggotaBaru as $a) {
            // Menggunakan format tanggal_daftar sesuai skema
            $html .= "<li>{$a->nama} (Mendaftar: {$a->tanggal_daftar->format('d M Y')})</li>";
        }
    } else {
        $html .= '<p><i>Belum ada anggota yang terdaftar pada bulan ini.</i></p>';
    }
    $html .= '</ul>';

    return $html;
});