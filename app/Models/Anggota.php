<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anggota extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'anggota';

    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status',
    ];

    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];

    /**
     * Accessor untuk menghitung umur.
     */
    public function getUmurAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    /**
     * Accessor untuk lama menjadi anggota (dalam hari).
     */
    public function getLamaAnggotaAttribute(): int
    {
        return Carbon::parse($this->tanggal_daftar)->diffInDays(now());
    }

    /**
     * Scope untuk filter anggota aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    /**
     * Scope untuk filter berdasarkan jenis kelamin.
     */
    public function scopeJenisKelamin($query, $jenisKelamin)
    {
        return $query->where('jenis_kelamin', $jenisKelamin);
    }

    // ======================
    // TUGAS 2 - Pertemuan 10
    // ======================
    // ==========================================
    // ACCESSOR ANGGOTA
    // ==========================================

    /**
     * Accessor untuk badge status keanggotaan
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->status === 'Aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }
        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    /**
     * Accessor untuk kategori usia
     */
    public function getKategoriUsiaAttribute(): string
    {
        // Menggunakan accessor getUmurAttribute() yang sudah ada
        $umur = $this->umur; 

        if ($umur < 20) {
            return 'Remaja';
        } elseif ($umur >= 20 && $umur <= 50) {
            return 'Dewasa';
        } else {
            return 'Senior';
        }
    }

    // ==========================================
    // SCOPE ANGGOTA
    // ==========================================

    /**
     * Scope untuk anggota yang terdaftar bulan ini
     */
    public function scopeTerdaftarBulanIni($query)
    {
        // Karena di seeder Anda mendaftar menggunakan 'tanggal_daftar',
        // kita melakukan filter bulan dan tahun menggunakan kolom tersebut.
        return $query->whereMonth('tanggal_daftar', now()->month)
                     ->whereYear('tanggal_daftar', now()->year);
    }
}