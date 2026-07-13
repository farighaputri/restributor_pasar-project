<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Tampilan Halaman Dashboard Manajemen Master Tarif (READ)
     */
    public function index()
    {
        // 1. Memastikan 3 jenis lapak standard bawaan sistem selalu ada di database
        $defaultTarifs = [
            'Kios' => ['tarif_per_hari' => 5000, 'dasar_hukum' => 'Perda No. 12/2024'],
            'Los Pasar' => ['tarif_per_hari' => 3000, 'dasar_hukum' => 'Perda No. 12/2024'],
            'Tenda' => ['tarif_per_hari' => 2000, 'dasar_hukum' => 'Perda No. 08/2022'],
        ];

        foreach ($defaultTarifs as $jenis => $defaults) {
            Tarif::firstOrCreate(
                ['jenis_lapak' => $jenis],
                $defaults
            );
        }

        // 2. Mengambil seluruh data master tarif asli dari database secara terurut
        $tarifs = Tarif::oldest()->get();

        return view('admin.atur-tarif', compact('tarifs'));
    }

    /**
     * Memproses Penambahan Jenis Lapak Baru ke Database (CREATE)
     */
    public function store(Request $request)
    {
        // Validasi input form tambah lapak
        $request->validate([
            'jenis_lapak'    => 'required|string|max:100|unique:tarifs,jenis_lapak',
            'tarif_per_hari' => 'required|numeric|min:0',
            'dasar_hukum'    => 'nullable|string|max:255',
        ]);

        // Menyimpan data asli ke database
        Tarif::create([
            'jenis_lapak'    => $request->jenis_lapak,
            'tarif_per_hari' => $request->tarif_per_hari,
            'dasar_hukum'    => $request->dasar_hukum ?? 'Perda Kebijakan Wilayah',
        ]);

        return redirect()->route('admin.atur-tarif')->with('success', 'Master jenis lapak baru berhasil ditambahkan.');
    }

    /**
     * Memproses Pembaruan Nominal Tarif per ID via Modal Pop-up (UPDATE)
     */
    public function update(Request $request, $id)
    {
        // Validasi nilai nominal harian dan teks hukum
        $request->validate([
            'tarif_per_hari' => 'required|numeric|min:0',
            'dasar_hukum'    => 'nullable|string|max:255',
        ]);

        // Mencari data asli berdasarkan ID yang dilempar oleh JavaScript Modal
        $tarif = Tarif::findOrFail($id);

        // Eksekusi pembaruan record ke database MySQL
        $tarif->update([
            'tarif_per_hari' => $request->tarif_per_hari,
            'dasar_hukum'    => $request->dasar_hukum ?? '',
        ]);

        return redirect()->route('admin.atur-tarif')->with('success', "Tarif untuk jenis lapak '{$tarif->jenis_lapak}' berhasil diperbarui.");
    }

    /**
     * Memproses Penghapusan Jenis Lapak Non-Standar (DELETE)
     */
    public function destroy($id)
    {
        $tarif = Tarif::findOrFail($id);
        
        // Proteksi tingkat controller agar master bawaan sistem tidak bisa dihapus sengaja
        if (in_array($tarif->jenis_lapak, ['Kios', 'Los Pasar', 'Tenda'])) {
            return redirect()->back()->with('error', 'Kategori master tarif bawaan sistem dilindungi dan tidak boleh dihapus.');
        }

        $tarif->delete();
        return redirect()->route('admin.atur-tarif')->with('success', 'Kategori tarif berhasil dihapus dari database.');
    }

    /**
     * Tampilan Informasi Daftar Tarif Resmi untuk Portal Publik Depan
     */
    public function frontend()
    {
        // Mengambil data tarif asli untuk dilempar ke halaman depan pengunjung
        $tarifs = Tarif::oldest()->get();

        return view('frontend.tarif', compact('tarifs'));
    }
}