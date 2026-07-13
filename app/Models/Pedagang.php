<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedagang extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * Seluruh kolom pendaftaran mandiri dari frontend sudah didaftarkan di sini.
     */
    protected $fillable = [
        'nama',
        'nik',
        'telepon',
        'email',
        'alamat',
        'pasar_tujuan',
        'jenis_lapak',
        'blok',
        'komoditas',
        'ktp_path',
        'status',
    ];

    /**
     * Relasi One-to-Many ke model Tagihan.
     * Mengindikasikan satu pedagang dapat memiliki banyak invoice tagihan bulanan.
     */
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'pedagang_id');
    }

    /**
     * Relasi BelongsTo ke model Master Tarif Kebijakan Pasar.
     * Menghubungkan tipe jenis_lapak pedagang secara langsung dengan nominal tarif harian di database.
     */
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'jenis_lapak', 'jenis_lapak');
    }
}