<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedagangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\ChatAiController;
use App\Models\Tarif;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes - SI-RETRIBUSI (Final Terintegrasi Lengkap + Midtrans)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE FRONTEND / PORTAL UMUM
// ==========================================
Route::get('/', [PedagangController::class, 'frontendBeranda'])->name('beranda');

Route::get('/tentang', function () { 
    return view('frontend.tentang'); 
})->name('tentang');

Route::get('/tarif', [TarifController::class, 'frontend'])->name('tarif');

Route::get('/informasi', function () { 
    return view('frontend.informasi'); 
})->name('informasi');

// Fitur Chat AI Interaktif Terpandu
Route::get('/kontak', function () { 
    return view('frontend.kontak'); 
})->name('kontak');
Route::post('/kontak/chat-ai', [ChatAiController::class, 'tanyaAi'])->name('kontak.chat_ai');


// ==========================================
// 2. SISTEM OTENTIKASI (LOGIN & LOGOUT)
// ==========================================
Route::get('/login', [AuthController::class, 'loginFormPedagang'])->name('login');
Route::get('/admin/login', [AuthController::class, 'loginFormAdmin'])->name('admin.login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// 3. MIDTRANS WEBHOOK / NOTIFICATION HANDLER
// ==========================================
// Rute ini harus publik agar Midtrans bisa mengirimkan status transaksi (settlement/expire)
Route::post('/midtrans/callback', [TagihanController::class, 'midtransCallback'])->name('midtrans.callback');


// ==========================================
// 4. JALUR REGISTRASI PEDAGANG MANDIRI (FRONTEND)
// ==========================================
Route::get('/daftar-pedagang', function() {
    $tarifs = Tarif::oldest()->get(); 
    return view('frontend.daftar-pedagang', compact('tarifs'));
})->name('daftar-pedagang');

Route::post('/daftar-pedagang/simpan', [PedagangController::class, 'storeMandiri'])->name('daftar-pedagang.simpan');
Route::get('/status-pendaftaran/{pedagang}', [PedagangController::class, 'status'])->name('status-pendaftaran');


// ==========================================
// 5. PORTAL INTERNAL PEDAGANG (PROTEKSI AUTH MIDDLEWARE)
// ==========================================
Route::middleware('auth')->group(function () {
    // [A] Dashboard Akun Pedagang
    Route::get('/pedagang/dashboard', [PedagangController::class, 'dashboardPedagang'])->name('pedagang.dashboard');
    
    // [B] Menu Tagihan & Aksi Bayar Snap Token Midtrans
    Route::get('/pedagang/tagihan', [TagihanController::class, 'tagihanPedagang'])->name('pedagang.tagihan');
    Route::post('/pedagang/tagihan/{id}/bayar', [TagihanController::class, 'bayarTagihan'])->name('pedagang.bayar');

    // [C] Menu Riwayat Pembayaran Resmi
    Route::get('/pedagang/riwayat-bayar', [TagihanController::class, 'riwayatPedagang'])->name('pedagang.riwayat-bayar');

    // [D] Menu Informasi Detail Fisik Lapak
    Route::get('/pedagang/informasi-lapak', [PedagangController::class, 'informasiLapak'])->name('pedagang.informasi-lapak');

    // [E] Halaman Profil Akun Milik Pedagang
    Route::get('/pedagang/profil', function() {
        $user = Auth::user();
        $pedagang = \App\Models\Pedagang::where('nik', $user->nik)->first();
        return view('pedagang.profil', compact('user', 'pedagang'));
    })->name('pedagang.profil');

    // Rute POST khusus pembaruan data profil pedagang
    Route::post('/pedagang/profil/update', [AuthController::class, 'updateProfilPedagang'])->name('pedagang.profil.update');
    
    // Rute PUT khusus untuk memperbarui kata sandi pedagang
    Route::put('/pedagang/profil/password', [AuthController::class, 'updatePasswordPedagang'])->name('pedagang.password.update');
});


// ==========================================
// 6. KELOMPOK RUTE INTERNAL PANEL ADMIN
// ==========================================
Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Auto-redirect jika admin hanya mengakses URL /admin
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // [A] Dashboard Utama Admin & Aksi Verifikasi Pendaftar Baru
    Route::get('/dashboard', [PedagangController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/pedagang/{id}/approve', [AuthController::class, 'approvePedagang'])->name('admin.pedagang.approve');
    Route::post('/pedagang/{id}/aksi', [AuthController::class, 'approvePedagang'])->name('admin.pedagang.aksi');
    
    // Halaman Profil Akun Pengelola Dinas & Rute Simpan Terpisah
    Route::get('/profil', function () {
        return view('admin.profil');
    })->name('admin.profil');

    Route::post('/profil/update', [AuthController::class, 'updateProfilAdmin'])->name('admin.profil.update');

    // [B] CRUD Master Data Pedagang (Pop-up Modal System)
    Route::get('/data-pedagang', [PedagangController::class, 'dataPedagang'])->name('admin.data-pedagang');
    Route::post('/data-pedagang/simpan', [PedagangController::class, 'storeManual'])->name('admin.data-pedagang.store');
    Route::post('/data-pedagang/{id}/update', [PedagangController::class, 'updateManual'])->name('admin.data-pedagang.update');
    Route::delete('/data-pedagang/{id}/delete', [PedagangController::class, 'destroyManual'])->name('admin.data-pedagang.delete');

    // [C] Kelola Invoice Tagihan & Verifikasi Manual
    Route::get('/kelola-tagihan', [TagihanController::class, 'kelolaTagihan'])->name('admin.kelola-tagihan');
    Route::post('/tagihan/{id}/bayar', [TagihanController::class, 'bayarTagihanAdmin'])->name('admin.tagihan.bayar');

    // [D] CRUD Parameter Tarif Kebijakan Pasar
    Route::get('/atur-tarif', [TarifController::class, 'index'])->name('admin.atur-tarif');
    Route::post('/atur-tarif', [TarifController::class, 'store'])->name('admin.atur-tarif.store');
    Route::post('/atur-tarif/{id}/update', [TarifController::class, 'update'])->name('admin.atur-tarif.update');
    Route::delete('/atur-tarif/{id}/delete', [TarifController::class, 'destroy'])->name('admin.atur-tarif.delete');

    // [E] Batch Processor: Generator Tagihan Bulanan Otomatis Seluruh Pedagang Aktif
    Route::post('/tagihan/generate-otomatis', [TagihanController::class, 'generateTagihanBulanan'])->name('admin.tagihan.generate');
});