<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    // Tambahkan 'periode', 'bulan_tahun', dan 'nominal' ke dalam array ini
    protected $fillable = [
        'pedagang_id',
        'periode',
        'bulan_tahun', 
        'nominal',    
        'status',
        'tanggal_bayar',
        'metode_pembayaran'
    ];

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'pedagang_id');
    }
}