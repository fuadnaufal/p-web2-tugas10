<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Pastikan mengarah ke tabel 'kategori' (karena default Laravel menggunakan jamak bahasa Inggris)
    protected $table = 'kategori'; 

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'icon',
        'warna',
    ];
}