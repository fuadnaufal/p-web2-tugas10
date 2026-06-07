<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\kategoriController;

// ====================================================
// Praktikum 6 - Pertemuan 9/a: Route Closure Sederhana
// ====================================================
// Route default
// Route::get('/', function () {
//     return view('welcome');
// });

// Route baru - return text
// Route::get('/hello', function () {
//     return 'Hello dari Laravel!';
// });

// Route dengan HTML
// Route::get('/info', function () {
//     return '<h1>Sistem Perpustakaan</h1><p>Selamat datang!</p>';
// });

// Route dengan JSON
// Route::get('/buku', function () {
//     return [
//         'judul' => 'Laravel Programming',
//         'pengarang' => 'John Doe',
//         'harga' => 150000
//     ];
// });

// ===================================================
// Praktikum 6 - Pertemuan 9/b: Route dengan Parameter
// ===================================================
// Route dengan parameter required
// Route::get('/buku/{id}', function ($id) {
//     return "Detail buku dengan ID: " . $id;
// });

// Route dengan parameter optional
// Route::get('/kategori/{nama?}', function ($nama = 'Semua Kategori') {
//     return "Menampilkan kategori: " . $nama;
// });

// Route dengan multiple parameters
// Route::get('/search/{kategori}/{keyword}', function ($kategori, $keyword) {
//     return "Cari buku kategori: $kategori dengan keyword: $keyword";
// });

// =========================================
// Praktikum 6 - Pertemuan 9/c: Named Routes
// =========================================
// Named route
// Route::get('/perpustakaan', function () {
//     return 'Halaman Perpustakaan';
// })->name('perpus.home');

// Gunakan named route
// Route::get('/test-route', function () {
//     $url = route('perpus.home');
//     return "URL perpustakaan: " . $url;
// });

// ==========================================================
// Praktikum 7 - Pertemuan 9/b: Route untuk View BESERTA DATA
// ==========================================================
Route::get('/perpustakaan', function () {
    // Data untuk dikirim ke view
    $nama_sistem = "Sistem Perpustakaan Laravel";
    $versi = "13.x";
    $total_buku = 5;
    
    $buku_list = [
        [
            'judul' => 'Pemrograman PHP',
            'pengarang' => 'Budi Raharjo',
            'harga' => 75000,
            'stok' => 10
        ],
        [
            'judul' => 'Laravel Framework',
            'pengarang' => 'Andi Nugroho',
            'harga' => 125000,
            'stok' => 5
        ],
        [
            'judul' => 'MySQL Database',
            'pengarang' => 'Siti Aminah',
            'harga' => 95000,
            'stok' => 0
        ],
        [
            'judul' => 'Web Design',
            'pengarang' => 'Dedi Santoso',
            'harga' => 85000,
            'stok' => 8
        ],
        [
            'judul' => 'JavaScript Modern',
            'pengarang' => 'Rina Wijaya',
            'harga' => 80000,
            'stok' => 12
        ]
    ];
    
    // Return view dengan data
    return view('perpustakaan.index', [
        'nama_sistem' => $nama_sistem,
        'versi' => $versi,
        'total_buku' => $total_buku,
        'buku_list' => $buku_list
    ]);
});

// ===============================================================
// Praktikum 7 - Pertemuan 9/c: Alternative: Menggunakan compact()
// ===============================================================
// Route::get('/perpustakaan', function () {
//     $nama_sistem = "Sistem Perpustakaan Laravel";
//     $versi = "13.x";
//     $total_buku = 5;

//     $buku_list = [
//         // ... data buku sama
//     ];

//     // Menggunakan compact() - lebih praktis
//     return view('perpustakaan.index', compact('nama_sistem', 'versi', 'total_buku', 'buku_list'));
// });

// // ==========================================
// // Praktikum 8 - Pertemuan 9/c: Update Routes
// // ==========================================
// Route::get('/', function () {
//     return view('welcome');
// });

// // Route menggunakan Controller
// Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
// Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);
// Route::get('/about', [PerpustakaanController::class, 'about']);

// =====================
// TUGAS 1 - Pertemuan 9
// =====================
// Data Anggota (Shared/Global untuk simulasi)
$anggota_list = [
    [
        'id' => 1,
        'kode' => 'AGT-001',
        'nama' => 'Budi Santoso',
        'email' => 'budi@email.com',
        'telepon' => '081234567890',
        'alamat' => 'Jl. Merdeka No. 10, Jakarta',
        'status' => 'Aktif'
    ],
    [
        'id' => 2,
        'kode' => 'AGT-002',
        'nama' => 'Siti Aminah',
        'email' => 'siti@email.com',
        'telepon' => '082198765432',
        'alamat' => 'Jl. Mawar No. 5, Bandung',
        'status' => 'Aktif'
    ],
    [
        'id' => 3,
        'kode' => 'AGT-003',
        'nama' => 'Ahmad Hidayat',
        'email' => 'ahmad@email.com',
        'telepon' => '085711223344',
        'alamat' => 'Jl. Melati No. 12, Surabaya',
        'status' => 'Non-Aktif'
    ],
    [
        'id' => 4,
        'kode' => 'AGT-004',
        'nama' => 'Dewi Lestari',
        'email' => 'dewi@email.com',
        'telepon' => '081955667788',
        'alamat' => 'Jl. Anggrek No. 3, Yogyakarta',
        'status' => 'Aktif'
    ],
    [
        'id' => 5,
        'kode' => 'AGT-005',
        'nama' => 'Rian Wijaya',
        'email' => 'rian@email.com',
        'telepon' => '081344556677',
        'alamat' => 'Jl. Kenanga No. 8, Semarang',
        'status' => 'Non-Aktif'
    ],
];

// Route 1: Daftar Anggota
Route::get('/anggota', function () use ($anggota_list) {
    return view('anggota.index', ['anggota' => $anggota_list]);
});

// Route 2: Detail Anggota
Route::get('/anggota/{id}', function ($id) use ($anggota_list) {
    // Mencari anggota berdasarkan ID
    $detail_anggota = collect($anggota_list)->firstWhere('id', $id);

    // Jika ID tidak ditemukan, tampilkan error 404
    if (!$detail_anggota) {
        abort(404, 'Anggota tidak ditemukan');
    }

    return view('anggota.show', ['anggota' => $detail_anggota]);
});
// =====================
// TUGAS 2 - Pertemuan 9
// =====================
// Routing Kategori Buku dengan Named Routes
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/detail/{id}', [KategoriController::class, 'show'])->name('kategori.show');
Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');