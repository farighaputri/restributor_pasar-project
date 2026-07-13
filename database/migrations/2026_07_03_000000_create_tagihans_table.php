<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedagang_id')->constrained('pedagangs')->cascadeOnDelete();
            $table->string('periode', 20); // Tetap dipertahankan untuk pencocokan unique
            $table->string('bulan_tahun', 50); // Digunakan untuk visualisasi teks view
            $table->unsignedBigInteger('nominal'); // Nominal rupiah tagihan
            $table->string('status')->default('Belum Dibayar');
            $table->timestamp('tanggal_bayar')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->timestamps();
            
            $table->unique(['pedagang_id', 'periode']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tagihans');
    }
};