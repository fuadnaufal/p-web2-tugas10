<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'nama_kategori' => 'Programming',
                'deskripsi'     => 'Buku terkait bahasa pemrograman dan pengembangan perangkat lunak.',
                'icon'          => 'code-slash',
                'warna'         => 'primary',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_kategori' => 'Database',
                'deskripsi'     => 'Buku terkait perancangan, manajemen, dan optimasi basis data.',
                'icon'          => 'database',
                'warna'         => 'success',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_kategori' => 'Web Design',
                'deskripsi'     => 'Buku terkait perancangan antarmuka, UI/UX, dan estetika web.',
                'icon'          => 'palette',
                'warna'         => 'info',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_kategori' => 'Networking',
                'deskripsi'     => 'Buku terkait jaringan komputer, protokol, dan keamanan jaringan.',
                'icon'          => 'wifi',
                'warna'         => 'warning',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_kategori' => 'Data Science',
                'deskripsi'     => 'Buku terkait analisis data, machine learning, dan statistik.',
                'icon'          => 'graph-up',
                'warna'         => 'danger',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        Kategori::insert($kategori);
    }
}