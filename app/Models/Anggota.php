<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $fillable = ['kode_anggota', 'nama', 'email', 'umur', 'jenis_kelamin', 'status'];

    // =========================================================================
    // ACCESSORS
    // =========================================================================

    // 1. Accessor status_badge ($anggota->status_badge)
    public function getStatusBadgeAttribute(): string
    {
        // Menyesuaikan jika di database kamu string 'Aktif'/'Nonaktif' atau boolean
        $status = strtolower($this->status);
        
        if ($status === 'aktif' || $status === '1') {
            return '<span class="badge bg-success">Aktif</span>';
        }
        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    // 2. Accessor kategori_usia ($anggota->kategori_usia)
    public function getKategoriUsiaAttribute(): string
    {
        $umur = $this->umur;

        if ($umur < 20) {
            return 'Remaja';
        } elseif ($umur >= 20 && $umur <= 50) {
            return 'Dewasa';
        } else {
            return 'Senior';
        }
    }

    // =========================================================================
    // LOCAL SCOPES
    // =========================================================================

    // 1. Scope jenisKelamin (Anggota::jenisKelamin('L'))
    public function scopeJenisKelamin($query, $jk)
    {
        return $query->where('jenis_kelamin', $jk);
    }

    // 2. Scope terdaftarBulanIni (Anggota::terdaftarBulanIni())
    public function scopeTerdaftarBulanIni($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year);
    }
}

// {
//     use HasFactory;

//     /**
//      * Nama tabel yang digunakan oleh model ini.
//      *
//      * @var string
//      */
//     protected $table = 'anggota';

//     /**
//      * Kolom yang dapat diisi secara mass assignment.
//      *
//      * @var array<int, string>
//      */
//     protected $fillable = [
//         'kode_anggota',
//         'nama',
//         'email',
//         'telepon',
//         'alamat',
//         'tanggal_lahir',
//         'jenis_kelamin',
//         'pekerjaan',
//         'tanggal_daftar',
//         'status',
//     ];

//     /**
//      * Tipe casting untuk atribut.
//      *
//      * @var array<string, string>
//      */
//     protected $casts = [
//         'tanggal_lahir' => 'date',
//         'tanggal_daftar' => 'date',
//     ];

//     /**
//      * Accessor untuk menghitung umur.
//      */
//     public function getUmurAttribute(): int
//     {
//         return Carbon::parse($this->tanggal_lahir)->age;
//     }

//     /**
//      * Accessor untuk lama menjadi anggota (dalam hari).
//      */
//     public function getLamaAnggotaAttribute(): int
//     {
//         return Carbon::parse($this->tanggal_daftar)->diffInDays(now());
//     }

//     /**
//      * Scope untuk filter anggota aktif.
//      */
//     public function scopeAktif($query)
//     {
//         return $query->where('status', 'Aktif');
//     }

//     /**
//      * Scope untuk filter berdasarkan jenis kelamin.
//      */
//     public function scopeJenisKelamin($query, $jenisKelamin)
//     {
//         return $query->where('jenis_kelamin', $jenisKelamin);
//     }
// }