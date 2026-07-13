<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedagangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->text('alamat');
            $table->string('pasar_tujuan');
            $table->string('jenis_lapak', 100); // Tipe string agar dinamis menampung jenis lapak baru dari backend
            $table->string('blok');
            $table->string('komoditas');
            $table->string('ktp_path')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedagangs');
    }
};