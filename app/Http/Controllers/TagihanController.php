<?php

namespace App\Http\Controllers;

use App\Models\Pedagang;
use App\Models\Tagihan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;  

class TagihanController extends Controller
{
    /**
     * Memproses pembuatan Snap Token Midtrans untuk pembayaran digital pedagang.
     */
    public function bayarTagihan(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        
        // Proteksi jika tagihan ternyata sudah lunas
        if ($tagihan->status === 'Lunas') {
            return response()->json([
                'success' => false,
                'message' => 'Tagihan ini sudah lunas sebelumnya.'
            ], 400);
        }

        $user = Auth::user();

        // 1. Konfigurasi Kredensial Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 2. Siapkan Parameter Transaksi (Gunakan Gross Amount dari field nominal tagihan Anda)
        $orderId = 'RET-' . $tagihan->id . '-' . time(); // Format unik order id
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $tagihan->nominal,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email ?? 'pedagang@si-retribusi.com',
            ],
            'item_details' => [
                [
                    'id' => 'INV-' . $tagihan->id,
                    'price' => (int) $tagihan->nominal,
                    'quantity' => 1,
                    'name' => 'Retribusi Pasar Periode ' . $tagihan->bulan_tahun,
                ]
            ]
        ];

        try {
            // 3. Request Token ke Midtrans
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kesalahan Midtrans: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Webhook / Notification Handler otomatis dari Server Midtrans (Tanpa Proteksi CSRF)
     */
 /**
     * Webhook / Notification Handler otomatis dari Server Midtrans & Bypass Localhost
     */
    public function midtransCallback(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION'), FILTER_VALIDATE_BOOLEAN);

        try {
            // --- STRATEGI HYBRID UNTUK MENGATASI LOCALHOST BLANK ---
            // Cek apakah request datang dari form bypass localhost (membawa data JSON langsung)
            if ($request->has('transaction_status')) {
                $transactionStatus = $request->input('transaction_status');
                $paymentType = $request->input('payment_type');
                $orderId = $request->input('order_id');
                $fraudStatus = 'accept';
            } else {
                // Jika dari server Midtrans asli (Online / Production)
                $notification = new \Midtrans\Notification();
                $transactionStatus = $notification->transaction_status;
                $paymentType = $notification->payment_type;
                $orderId = $notification->order_id;
                $fraudStatus = $notification->fraud_status;
            }

            // Pecah order_id kembali untuk mendapatkan ID asli tabel tagihan ('RET-{id}-{time}')
            $orderParts = explode('-', $orderId);
            $tagihanId = isset($orderParts[1]) ? $orderParts[1] : null;

            if (!$tagihanId) {
                return response()->json(['message' => 'Format Order ID tidak valid'], 400);
            }

            $tagihan = Tagihan::find($tagihanId);
            if (!$tagihan) {
                return response()->json(['message' => 'Data tagihan tidak ditemukan di database'], 404);
            }

            Log::info("Callback Terbaca. Order ID: $orderId | Status Transaksi: $transactionStatus");

            // 2. Evaluasi Status Notifikasi Transaksi
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $tagihan->status = 'Belum Dibayar';
                } else if ($fraudStatus == 'accept') {
                    $tagihan->status = 'Lunas';
                    $tagihan->tanggal_bayar = now();
                    $tagihan->metode_pembayaran = 'Midtrans (' . ucfirst($paymentType) . ')';
                }
            } else if ($transactionStatus == 'settlement') {
                $tagihan->status = 'Lunas';
                $tagihan->tanggal_bayar = now();
                $tagihan->metode_pembayaran = 'Midtrans (' . ucfirst($paymentType) . ')';
            } else if ($transactionStatus == 'pending') {
                $tagihan->status = 'Belum Dibayar';
            } else if (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $tagihan->status = 'Gagal';
            }

            $tagihan->save();
            return response()->json(['message' => 'Callback Midtrans sukses disinkronkan ke database']);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Memproses penandaan pelunasan tunai langsung oleh admin di loket pasar.
     */
    public function bayarTagihanAdmin(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->status = 'Lunas';
        $tagihan->tanggal_bayar = now();
        $tagihan->metode_pembayaran = 'Loket Tunai';
        $tagihan->save();

        return redirect()->back()->with('success', 'Tagihan berhasil ditandai lunas oleh administrator.');
    }

    /**
     * Menerbitkan (Generate) tagihan bulanan otomatis untuk semua pedagang yang berstatus aktif/Disetujui.
     */
    public function generateTagihanBulanan(Request $request)
    {
        App::setLocale('id');

        $periode = now()->format('m-Y');
        $bulanTahunText = now()->translatedFormat('F Y');
        
        $pedagangs = Pedagang::where('status', 'Disetujui')->get();
        $created = 0;

        $masterTarif = Tarif::all()->pluck('tarif_per_hari', 'jenis_lapak');

        foreach ($pedagangs as $pedagang) {
            if (isset($masterTarif[$pedagang->jenis_lapak])) {
                $amount = $masterTarif[$pedagang->jenis_lapak] * 30;
            } else {
                $amount = match ($pedagang->jenis_lapak) {
                    'Kios' => 150000,
                    'Los Pasar' => 90000,
                    'Tenda' => 60000,
                    default => 100000,
                };
            }

            $tagihan = Tagihan::firstOrCreate([
                'pedagang_id' => $pedagang->id,
                'periode' => $periode,
            ], [
                'bulan_tahun' => $bulanTahunText,
                'nominal' => $amount,
                'status' => 'Belum Dibayar',
            ]);

            if ($tagihan->wasRecentlyCreated) {
                $created++;
            }
        }

        if ($created === 0) {
            return redirect()->back()->with('info', 'Tagihan periode ini sudah digenerate sebelumnya.');
        }

        return redirect()->back()->with('success', "Berhasil menerbitkan $created invoice tagihan baru periode $bulanTahunText.");
    }

    /**
     * Halaman panel administrator untuk memantau ringkasan tagihan seluruh pasar.
     */
    public function kelolaTagihan()
    {
        $tagihans = Tagihan::with('pedagang')->latest()->get();
        $totalInvoice = $tagihans->count();
        $pendingCount = $tagihans->where('status', 'Belum Dibayar')->count();
        $totalPaid = $tagihans->where('status', 'Lunas')->sum('nominal');

        return view('admin.kelola-tagihan', compact('tagihans', 'totalInvoice', 'pendingCount', 'totalPaid'));
    }

    /**
     * Halaman beranda tagihan internal milik akun pedagang yang masuk log.
     */
    public function tagihanPedagang()
    {
        $user = Auth::user();
        $pedagang = Pedagang::where('nik', $user->nik)->first();

        if (!$pedagang) {
            return redirect()->back()->with('error', 'Profil data pedagang Anda tidak ditemukan.');
        }

        $tagihans = Tagihan::where('pedagang_id', $pedagang->id)->latest()->get();
        $totalDue = $tagihans->where('status', 'Belum Dibayar')->sum('nominal');
        $pendingCount = $tagihans->where('status', 'Belum Dibayar')->count();
        $totalPaid = $tagihans->where('status', 'Lunas')->sum('nominal');

        return view('pedagang.tagihan', compact('user', 'pedagang', 'tagihans', 'totalDue', 'pendingCount', 'totalPaid'));
    }

    /**
     * Menampilkan daftar arsip kwitansi/riwayat transaksi sukses bagi pedagang.
     */
    public function riwayatPedagang()
    {
        $user = Auth::user();
        $pedagang = Pedagang::where('nik', $user->nik)->first();

        if (!$pedagang) {
            return redirect()->back()->with('error', 'Profil pedagang tidak ditemukan.');
        }

        $tagihans = Tagihan::where('pedagang_id', $pedagang->id)->where('status', 'Lunas')->latest()->get();
        return view('pedagang.riwayat-bayar', compact('user', 'pedagang', 'tagihans'));
    }
}