<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun bawaan Super Admin Dinas untuk login pertama kali
        User::updateOrCreate(
            ['email' => 'admin@si-retribusi.id'], // Mencegah duplikasi jika seeder dijalankan ulang
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'), // Kata sandi untuk masuk ke panel
                
              
            ]
        );
    }
}