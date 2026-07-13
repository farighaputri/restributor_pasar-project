<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedagang;

class PedagangSeeder extends Seeder
{
    public function run(): void
    {
        Pedagang::create([
            'nama' => 'Hendra Wijaya',
            'nik' => '3271031204990002',
            'pasar_tujuan' => 'Pasar Raya Pusat',
            'jenis_lapak' => 'Kios',
            'status' => 'Pending'
        ]);

        Pedagang::create([
            'nama' => 'Ratna Sari',
            'nik' => '3271092408950004',
            'pasar_tujuan' => 'Pasar Induk Timur',
            'jenis_lapak' => 'Los Pasar',
            'status' => 'Pending'
        ]);
    }
}