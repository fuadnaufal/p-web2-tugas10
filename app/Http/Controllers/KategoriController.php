<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Data Dummy Kategori (Global dalam Controller)
    private $kategori_list = [
        ['id' => 1, 'nama' => 'Programming', 'deskripsi' => 'Buku pemrograman dan coding', 'jumlah_buku' => 3],
        ['id' => 2, 'nama' => 'Desain Grafis', 'deskripsi' => 'Panduan UI/UX dan editing visual', 'jumlah_buku' => 2],
        ['id' => 3, 'nama' => 'Fiksi', 'deskripsi' => 'Novel dan kumpulan cerita pendek', 'jumlah_buku' => 2],
        ['id' => 4, 'nama' => 'Sains', 'deskripsi' => 'Buku ilmu pengetahuan alam dan fisika', 'jumlah_buku' => 1],
        ['id' => 5, 'nama' => 'Sejarah', 'deskripsi' => 'Catatan peristiwa masa lalu dunia', 'jumlah_buku' => 1],
    ];

    // Data Dummy Buku (Berelasi dengan kategori via 'kategori_id')
    private $buku_list = [
        ['id' => 101, 'kategori_id' => 1, 'judul' => 'Kuasai Laravel 11', 'penulis' => 'Alexandre', 'penerbit' => 'TechPress'],
        ['id' => 102, 'kategori_id' => 1, 'judul' => 'Logika Python untuk Pemula', 'penulis' => 'Budi', 'penerbit' => 'CodeMedia'],
        ['id' => 103, 'kategori_id' => 1, 'judul' => 'JavaScript Modern', 'penulis' => 'Candra', 'penerbit' => 'TechPress'],
        ['id' => 104, 'kategori_id' => 2, 'judul' => 'Belajar Figma dari Nol', 'penulis' => 'Dina', 'penerbit' => 'CreativeIndo'],
        ['id' => 105, 'kategori_id' => 2, 'judul' => 'Tipografi dalam Desain', 'penulis' => 'Eri', 'penerbit' => 'VisualBook'],
        ['id' => 106, 'kategori_id' => 3, 'judul' => 'Hujan di Bulan Juni', 'penulis' => 'Sapardi', 'penerbit' => 'Gramedia'],
        ['id' => 107, 'kategori_id' => 3, 'judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'penerbit' => 'Bentang'],
        ['id' => 108, 'kategori_id' => 4, 'judul' => 'Kosmos: Alam Semesta', 'penulis' => 'Carl Sagan', 'penerbit' => 'SainsPress'],
        ['id' => 109, 'kategori_id' => 5, 'judul' => 'Nusantara Lama', 'penulis' => 'Gatot', 'penerbit' => 'HistoriCo'],
    ];

    // a. Method index() - Daftar Kategori
    public function index()
    {
        $kategori_list = $this->kategori_list;
        return view('kategori.index', compact('kategori_list'));
    }

    // b. Method show($id) - Detail Kategori
    public function show($id)
    {
        // Cari kategori berdasarkan id
        $kategori = collect($this->kategori_list)->firstWhere('id', $id);

        if (!$kategori) {
            abort(404, 'Kategori tidak ditemukan');
        }

        // Filter buku yang termasuk dalam kategori ini
        $buku_list = collect($this->buku_list)->where('kategori_id', $id)->all();

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    // c. Method search($keyword) - Cari Kategori
    public function search($keyword)
    {
        // Filter kategori yang namanya mengandung keyword (case-insensitive)
        $hasil_pencarian = collect($this->kategori_list)->filter(function ($item) use ($keyword) {
            return str_contains(strtolower($item['nama']), strtolower($keyword)) || 
                   str_contains(strtolower($item['deskripsi']), strtolower($keyword));
        })->all();

        return view('kategori.search', compact('hasil_pencarian', 'keyword'));
    }
}