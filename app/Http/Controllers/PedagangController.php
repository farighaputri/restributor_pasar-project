<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedagang;
use App\Models\Tagihan;
use App\Models\Tarif;   
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class PedagangController extends Controller
{
    public function dashboard()
    {
        // Data Otentikasi Admin Login
        $adminUser = Auth::user();

        // 1. Ambil data permohonan tertunda
        $permohonan = Pedagang::where('status', 'Pending')->latest()->get();

        // 2. Agregasi Statistik Asli dari Database
        $totalPendaftarBaru = Pedagang::where('status', 'Pending')->count();
        $totalPedagangAktif = Pedagang::where('status', 'Disetujui')->count();
        
        // Hitung Rasio Tagihan Terbayar Akurat
        $totalInvoice = Tagihan::count();
        $lunasInvoice = Tagihan::where('status', 'Lunas')->count();
        $tagihanTerbayar = $totalInvoice > 0 ? round(($lunasInvoice / $totalInvoice) * 100) . '%' : '0%';

        // Akumulasi Finansial Pendapatan
        $pendapatanSelesai = Tagihan::where('status', 'Lunas')->sum('nominal');
        $totalPendapatan = 'Rp ' . number_format($pendapatanSelesai, 0, ',', '.');

        // 3. Persiapan Data Chart Pendapatan Bulanan (6 Bulan Terakhir)
        $chartMonths = [];
        $chartDataRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $periodeKey = $monthDate->format('m-Y');
            $monthLabel = $monthDate->translatedFormat('F Y');
            
            $chartMonths[] = $monthLabel;
            $chartDataRevenue[] = Tagihan::where('periode', $periodeKey)->where('status', 'Lunas')->sum('nominal');
        }

        // Data Chart Distribusi Jenis Lapak
        $kiosCount = Pedagang::where('status', 'Disetujui')->where('jenis_lapak', 'Kios')->count();
        $losCount = Pedagang::where('status', 'Disetujui')->where('jenis_lapak', 'Los Pasar')->count();
        $tendaCount = Pedagang::where('status', 'Disetujui')->where('jenis_lapak', 'Tenda')->count();
        $chartLapakData = [$kiosCount, $losCount, $tendaCount];

        return view('admin.index', compact(
            'permohonan', 
            'totalPendaftarBaru', 
            'totalPedagangAktif', 
            'tagihanTerbayar', 
            'totalPendapatan',
            'chartMonths',
            'chartDataRevenue',
            'chartLapakData',
            'adminUser'
        ));
    }

    public function dashboardPedagang()
    {
        $user = auth()->user();
        $pedagang = Pedagang::where('nik', $user->nik)
            ->orWhere('email', $user->email)
            ->first();

        $tagihans = collect();
        $totalDue = 0;
        $totalPaid = 0;
        $pendingCount = 0;
        $tarifWajib = 0;

        if ($pedagang) {
            $tagihans = $pedagang->tagihans()->latest()->get();
            $totalDue = $tagihans->where('status', 'Belum Dibayar')->sum('nominal');
            $totalPaid = $tagihans->where('status', 'Lunas')->sum('nominal');
            $pendingCount = $tagihans->where('status', 'Belum Dibayar')->count();
            $tarifWajib = Tarif::where('jenis_lapak', $pedagang->jenis_lapak)->value('tarif_per_hari') ?? 0;
        }

        return view('pedagang.dashboard', compact('user', 'pedagang', 'tagihans', 'totalDue', 'totalPaid', 'pendingCount', 'tarifWajib'));
    }

    public function status(Pedagang $pedagang)
    {
        $user = User::where('nik', $pedagang->nik)->first();
        return view('Frontend.status-pendaftaran', compact('pedagang', 'user'));
    }


public function dataPedagang(Request $request)
{
    // Mengambil data admin login
    $adminUser = auth()->user();

    // Query dasar pencarian & filter dinamis data pedagang asli
    $query = Pedagang::query();

    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('nama', 'LIKE', '%' . $request->search . '%')
              ->orWhere('nik', 'LIKE', '%' . $request->search . '%')
              ->orWhere('blok', 'LIKE', '%' . $request->search . '%');
        });
    }

    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    if ($request->has('pasar_tujuan') && $request->pasar_tujuan != '') {
        $query->where('pasar_tujuan', $request->pasar_tujuan);
    }

    $pedagangs = $query->latest()->get();
    
    // Mengambil master tarif untuk opsi dropdown dinamis di form tambah/edit modal
    $tarifs = Tarif::all();

    return view('admin.data-pedagang', compact('pedagangs', 'tarifs', 'adminUser'));
}

/**
 * Fitur [CREATE]: Admin menginput data pedagang resmi langsung dari panel backend.
 */
public function storeManual(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|size:16|unique:pedagangs,nik',
        'telepon' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'alamat' => 'required|string',
        'pasar_tujuan' => 'required|string',
        'jenis_lapak' => 'required|string|exists:tarifs,jenis_lapak',
        'blok' => 'required|string|max:100',
        'komoditas' => 'required|string|max:255',
        'status' => 'required|in:Pending,Disetujui,Ditolak',
    ]);

    Pedagang::create($request->all());

    return redirect()->route('admin.data-pedagang')->with('success', 'Data pedagang baru berhasil ditambahkan ke database.');
}

/**
 * Fitur [UPDATE]: Memperbarui profil data pedagang terpilih.
 */
public function updateManual(Request $request, $id)
{
    $pedagang = Pedagang::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|size:16|unique:pedagangs,nik,' . $pedagang->id,
        'telepon' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'alamat' => 'required|string',
        'pasar_tujuan' => 'required|string',
        'jenis_lapak' => 'required|string|exists:tarifs,jenis_lapak',
        'blok' => 'required|string|max:100',
        'komoditas' => 'required|string|max:255',
        'status' => 'required|in:Pending,Disetujui,Ditolak',
    ]);

    $pedagang->update($request->all());

    return redirect()->route('admin.data-pedagang')->with('success', "Profil data pedagang {$pedagang->nama} sukses diperbarui.");
}

/**
 * Fitur [DELETE]: Menghapus entitas record pedagang dari database.
 */
public function destroyManual($id)
{
    $pedagang = Pedagang::findOrFail($id);
    $pedagang->delete();

    return redirect()->route('admin.data-pedagang')->with('success', 'Record data pedagang berhasil dihapus secara permanen.');
}

    public function prosesAksi(Request $request, $id)
    {
        $request->validate(['tindakan' => 'required|in:setuju,tolak']);
        $pedagang = Pedagang::findOrFail($id);

        if ($request->tindakan === 'setuju') {
            $pedagang->status = 'Disetujui';
            $pedagang->save();

            User::firstOrCreate([
                'nik' => $pedagang->nik
            ], [
                'name' => $pedagang->nama,
                'email' => $pedagang->email ?: 'pedagang+' . $pedagang->id . '@si-retribusi.local',
                'password' => Hash::make('password123'),
            ]);

            $pesan = "Permohonan {$pedagang->nama} berhasil disetujui dan akun login dibuat.";
        } else {
            $pedagang->status = 'Ditolak';
            $pedagang->save();
            $pesan = "Permohonan {$pedagang->nama} telah ditolak.";
        }

        return redirect()->back()->with('success', $pesan);
    }

   public function storeMandiri(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|size:16|unique:pedagangs,nik',
        'telepon' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'alamat' => 'required|string|max:1000',
        'pasar_tujuan' => 'required|string|max:255',
        
        // DIUBAH: Sekarang validasi memeriksa kecocokan dinamis ke kolom 'jenis_lapak' di tabel 'tarifs'
        'jenis_lapak' => 'required|string|exists:tarifs,jenis_lapak',
        
        'blok' => 'required|string|max:100',
        'komoditas' => 'required|string|max:255',
        'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // ... sisa kode di bawahnya tetap sama ...
    $ktpPath = $request->hasFile('ktp') ? $request->file('ktp')->store('ktp', 'public') : null;

    $pedagang = Pedagang::create([
        'nama' => $request->nama,
        'nik' => $request->nik,
        'telepon' => $request->telepon,
        'email' => $request->email,
        'alamat' => $request->alamat,
        'pasar_tujuan' => $request->pasar_tujuan,
        'jenis_lapak' => $request->jenis_lapak,
        'blok' => $request->blok,
        'komoditas' => $request->komoditas,
        'ktp_path' => $ktpPath,
        'status' => 'Pending',
    ]);

    return redirect()->route('status-pendaftaran', $pedagang->id);
}

    public function informasiLapak()
    {
        $user = auth()->user();
        $pedagang = Pedagang::where('nik', $user->nik)->first();

        if (!$pedagang) {
            return redirect()->back()->with('error', 'Data profil lapak Anda belum terdaftar.');
        }

        return view('pedagang.informasi-lapak', compact('user', 'pedagang'));
    }
    public function frontendBeranda()
{
    // 1. Menghitung total seluruh pedagang aktif (Disetujui)
    $totalPedagang = Pedagang::where('status', 'Disetujui')->count();

    // 2. Menghitung pedagang baru yang bergabung pada bulan berjalan saat ini
    $pedagangBaruBulanIni = Pedagang::where('status', 'Disetujui')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    // 3. Menghitung total pasar unik yang terdaftar dari data lokasi pedagang
    $totalPasar = Pedagang::where('status', 'Disetujui')
        ->distinct('pasar_tujuan')
        ->count('pasar_tujuan');

    // 4. Menghitung penambahan pasar baru di bulan ini (logika dinamis berdasarkan entri baru)
    $pasarBaruBulanIni = Pedagang::where('status', 'Disetujui')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->distinct('pasar_tujuan')
        ->count('pasar_tujuan');

    // 5. Menghitung total nominal rupiah retribusi yang lunas dibayarkan HARI INI
    $pembayaranHariIni = Tagihan::where('status', 'Lunas')
        ->whereDate('tanggal_bayar', now()->today())
        ->sum('nominal');

    // 6. Menghitung persentase tren kenaikan pembayaran (contoh logika statis/dinamis penunjang tampilan)
    $trenPembayaranBulanIni = 12; 

    return view('Frontend.beranda', compact(
        'totalPedagang',
        'pedagangBaruBulanIni',
        'totalPasar',
        'pasarBaruBulanIni',
        'pembayaranHariIni',
        'trenPembayaranBulanIni'
    ));
}   
public function updatePassword(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'current_password' => ['required', 'current_password'], // Memastikan password lama cocok dengan database
        'password' => ['required', 'confirmed', Password::defaults()], // Memastikan password baru cocok dengan konfirmasi
    ], [
        'current_password.current_password' => 'Kata sandi saat ini tidak cocok dengan data kami.',
        'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
    ]);

    // 2. Perbarui Password User di Database
    $user = auth()->user();
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // 3. Kembali dengan Pesan Sukses
    return redirect()->back()->with('success', 'Kata sandi Anda berhasil diperbarui!');
}
}