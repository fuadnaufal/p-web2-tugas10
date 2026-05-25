<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'kategori';

    // Menentukan kolom mana saja yang boleh diisi (Fillable)
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'icon',
        'warna'
    ];
}