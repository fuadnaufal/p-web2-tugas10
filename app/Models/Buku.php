<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = ['kode_buku', 'judul', 'kategori', 'pengarang', 'penerbit', 'tahun_terbit', 'harga', 'stok', 'bahasa'];

    // =========================================================================
    // ACCESSORS
    // =========================================================================

    // 1. Accessor status_stok_badge ($buku->status_stok_badge)
    public function getStatusStokBadgeAttribute(): string
    {
        $stok = $this->stok;

        if ($stok == 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($stok >= 1 && $stok <= 5) {
            return '<span class="badge bg-warning">Menipis</span>';
        } elseif ($stok >= 6 && $stok <= 15) {
            return '<span class="badge bg-info">Sedang</span>';
        } else {
            return '<span class="badge bg-success">Aman</span>';
        }
    }

    // 2. Accessor tahun_label ($buku->tahun_label)
    public function getTahunLabelAttribute(): string
    {
        return $this->tahun_terbit >= 2024 ? 'Buku Baru' : 'Buku Lama';
    }

    // =========================================================================
    // LOCAL SCOPES
    // =========================================================================

    // 1. Scope stokMenipis (Buku::stokMenipis())
    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    // 2. Scope hargaRange (Buku::hargaRange($min, $max))
    public function scopeHargaRange($query, $min, $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    // 3. Scope terbaru (Buku::terbaru())
    public function scopeTerbaru($query)
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }
}

// {
//     use HasFactory;

//     /**
//      * Nama tabel yang digunakan oleh model ini.
//      *
//      * @var string
//      */
//     protected $table = 'buku';

//     /**
//      * Kolom yang dapat diisi secara mass assignment.
//      *
//      * @var array<int, string>
//      */
//     protected $fillable = [
//         'kode_buku',
//         'judul',
//         'kategori',
//         'pengarang',
//         'penerbit',
//         'tahun_terbit',
//         'isbn',
//         'harga',
//         'stok',
//         'deskripsi',
//         'bahasa',
//     ];

//     /**
//      * Tipe casting untuk atribut.
//      *
//      * @var array<string, string>
//      */
//     protected $casts = [
//         'tahun_terbit' => 'integer',
//         'harga' => 'decimal:2',
//         'stok' => 'integer',
//     ];

//     /**
//      * Accessor untuk format harga.
//      */
//     public function getHargaFormatAttribute(): string
//     {
//         return 'Rp ' . number_format($this->harga, 0, ',', '.');
//     }

//     /**
//      * Accessor untuk status ketersediaan.
//      */
//     public function getTersediaAttribute(): bool
//     {
//         return $this->stok > 0;
//     }

//     /**
//      * Scope untuk filter buku tersedia.
//      */
//     public function scopeTersedia($query)
//     {
//         return $query->where('stok', '>', 0);
//     }

//     /**
//      * Scope untuk filter berdasarkan kategori.
//      */
//     public function scopeKategori($query, $kategori)
//     {
//         return $query->where('kategori', $kategori);
//     }
// }