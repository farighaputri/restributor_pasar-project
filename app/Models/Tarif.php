<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_lapak',
        'tarif_per_hari',
        'dasar_hukum',
    ];

    /**
     * Menyediakan tarif bawaan sistem jika database kosong.
     */
    public static function getDefaultDailyRate(string $jenisLapak): int
    {
        return match ($jenisLapak) {
            'Kios' => 5000,
            'Los Pasar' => 3000,
            'Tenda' => 2000,
            default => 3000,
        };
    }

    /**
     * Mengambil tarif aktif dari database atau membuat otomatis dari fallback.
     */
    public static function getDailyRateForJenis(string $jenisLapak): int
    {
        $tarif = self::firstOrCreate(
            ['jenis_lapak' => $jenisLapak],
            [
                'tarif_per_hari' => self::getDefaultDailyRate($jenisLapak),
                'dasar_hukum' => 'Otomatis dibuat dari konfigurasi master tarif',
            ]
        );

        return $tarif->tarif_per_hari;
    }
}