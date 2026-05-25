<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori; // Hubungkan dengan model Kategori

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $dataKategori = [
            [
                'nama_kategori' => 'Programming',
                'deskripsi' => 'Buku seputar dunia logika, coding, dan pengembangan perangkat lunak.',
                'icon' => 'code-slash',
                'warna' => 'primary'
            ],
            [
                'nama_kategori' => 'Database',
                'deskripsi' => 'Buku penunjang materi SQL, NoSQL, optimasi query, dan arsitektur data.',
                'icon' => 'database',
                'warna' => 'success'
            ],
            [
                'nama_kategori' => 'Web Design',
                'deskripsi' => 'Buku panduan perancangan antarmuka, UI/UX desain, dan kreativitas frontend.',
                'icon' => 'palette',
                'warna' => 'info'
            ],
            [
                'nama_kategori' => 'Networking',
                'deskripsi' => 'Buku panduan infrastruktur jaringan, konfigurasi perangkat, dan keamanan siber.',
                'icon' => 'wifi',
                'warna' => 'warning'
            ],
            [
                'nama_kategori' => 'Data Science',
                'deskripsi' => 'Buku pengantar analisis data besar, statistika terapan, dan machine learning.',
                'icon' => 'graph-up',
                'warna' => 'danger'
            ]
        ];

        // Memasukkan data ke database menggunakan loop
        foreach ($dataKategori as $kat) {
            Kategori::create($kat);
        }
    }
}