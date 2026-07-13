<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatAiController extends Controller
{
    public function tanyaAi(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $pesanUser = Str::lower($request->message);
        
        // 1. Definisikan Data Jawaban Beserta Opsi Lanjutan Dinamis (Follow-ups)
        $knowledgeBase = [
            'tarif' => [
                'reply' => '<b>📋 RINCIAN TARIF RETRIBUSI RESMI:</b><br>
                            Berdasarkan Peraturan Daerah (Perda) No. 12 Tahun 2024, iuran wajib harian dihitung flat per unit usaha sebagai berikut:<br>
                            1. <b>Kios Permanen (Berpintu):</b> Rp 5.000 / hari.<br>
                            2. <b>Los Pasar (Dasaran Dalam):</b> Rp 3.000 / hari.<br>
                            3. <b>Tenda / Pelataran Terbuka:</b> Rp 2.000 / hari.',
                'follow_ups' => [
                    '💳 Lalu, bagaimana cara bayarnya?',
                    '⚖️ Apa dasar hukum ketetapan tarif ini?',
                    '❓ Apakah tarif bisa berubah sewaktu-waktu?'
                ]
            ],
            'bayar' => [
                'reply' => '<b>💳 METODE & CARA PEMBAYARAN ELEKTRONIK:</b><br>
                            Untuk menjaga transparansi, iuran tidak lagi dibayarkan tunai ke petugas lapangan, melainkan melalui portal:<br>
                            1. <b>Langkah Awal:</b> Silakan masuk (Login) terlebih dahulu menggunakan nomor NIK KTP Anda.<br>
                            2. <b>Buka Tagihan:</b> Masuk ke halaman Dashboard Pedagang, lalu klik menu <b>"Daftar Tagihan"</b>.<br>
                            3. <b>Metode Pembayaran:</b> Klik tombol "Bayar Sekarang" untuk memunculkan kode <b>QRIS Instan</b> (bisa di-scan via ShopeePay, GOPAY, OVO, Dana, atau Mobile Banking).',
                'follow_ups' => [
                    '📱 Bisakah bayar pakai QRIS bank daerah?',
                    '⚠️ Bagaimana jika status tidak berubah jadi Lunas?',
                    '📜 Lalu, di mana saya bisa melihat riwayat pembayaran?'
                ]
            ],
            'daftar' => [
                'reply' => '<b>📝 ALUR PENDAFTARAN PEDAGANG BARU:</b><br>
                            Basi warga yang ingin mendapatkan hak kelola petak pasar, ikuti proses berikut:<br>
                            1. Masuk ke halaman utama portal, klik menu <b>"Daftar Pedagang"</b> di bagian atas.<br>
                            2. Isi formulir biodata lengkap (Nama, NIK, No. WhatsApp aktif, dan Alamat Domisili).<br>
                            3. Pilih Kompleks Pasar tujuan serta jenis tipe lapak (Kios/Los/Tenda) yang diinginkan.<br>
                            4. Unggah foto berkas scan KTP asli.',
                'follow_ups' => [
                    '⏱️ Berapa lama proses verifikasi berkas oleh admin?',
                    '📂 Lalu, berkas apa saja kelengkapan tambahannya?',
                    '❌ Bagaimana jika pendaftaran saya ditolak?'
                ]
            ],
            'terlambat' => [
                'reply' => '<b>⚠️ ATURAN KETERLAMBATAN & SANKSI IURAN:</b><br>
                            Sesuai dengan ketentuan tata tertib dinas perdagangan daerah:<br>
                            1. Invoice tagihan diterbitkan secara otomatis oleh sistem pada tanggal 1 setiap awal bulan.<br>
                            2. Pedagang diimbau melunasi tagihan sebelum batas akhir masa kumulatif.<br>
                            3. Keterlambatan pembayaran secara berturut-turut akan menyebabkan pemblokiran akses sementara akun pedagang pada sistem e-retribusi.',
                'follow_ups' => [
                    '💸 Lalu, apakah ada denda berupa uang tunai?',
                    '🔓 Bagaimana cara membuka kembali akun yang terblokir?',
                    '📞 Siapa yang harus dihubungi untuk dispensasi?'
                ]
            ],
            'hukum' => [
                'reply' => '<b>⚖️ DASAR HUKUM RETRIBUSI PASAR:</b><br>
                            Pungutan retribusi pelayanan pasar ini didasarkan secara sah pada Peraturan Daerah (Perda) Nomor 12 Tahun 2024 tentang Pajak Daerah dan Retribusi Daerah, serta UU Nomor 1 Tahun 2022 tentang Hubungan Keuangan Pemerintah Pusat dan Daerah.',
                'follow_ups' => [
                    '📋 Rincian tarifnya berapa saja?',
                    '💳 Bagaimana alur pembayarannya?'
                ]
            ],
            'berkas' => [
                'reply' => '<b>📂 KELENGKAPAN BERKAS TAMBAHAN:</b><br>
                            Dokumen utama yang wajib diunggah adalah <b>Scan KTP Asli</b> yang jelas dan terbaca. Jika Anda mendaftar untuk kategori Kios Permanen, disarankan menyiapkan salinan Surat Izin Menempati Tempat Usaha (SIMTU) lama jika ada, untuk mempercepat persetujuan admin.',
                'follow_ups' => [
                    '📝 Langsung daftar sekarang bagaimana caranya?',
                    '⏱️ Verifikasinya berapa hari kerja?'
                ]
            ]
        ];

        // 2. Default Jawaban jika user mengetik bebas / kata kunci tidak cocok
        $replyText = '<b>💡 PANDUAN ASISTEN VIRTUAL:</b><br>
                    Untuk menghindari kesalahan informasi, mohon gunakan salah satu tombol pintasan opsi yang tersedia di bawah ini untuk langsung memunculkan regulasi pasal hukum dan panduan teknis yang valid.';
        $followUps = [
            '📋 Berapa rincian tarif retribusi per hari?',
            '💳 Bagaimana metode cara bayar tagihan pasar?',
            '📝 Bagaimana alur pendaftaran pedagang baru?',
            '⚠️ Bagaimana jika saya terlambat membayar iuran?'
        ];

        // 3. Cari kecocokan kata kunci
        foreach ($knowledgeBase as $key => $data) {
            if (Str::contains($pesanUser, $key)) {
                $replyText = $data['reply'];
                $followUps = $data['follow_ups'];
                break;
            }
        }

        // 4. Kembalikan Response JSON Lengkap dengan Array Follow-Up
        return response()->json([
            'status' => 'success',
            'reply' => $replyText,
            'follow_ups' => $followUps
        ]);
    }
}