<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarif Retribusi - SI-RETRIBUSI</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50/50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <nav class="bg-[#0062E3] text-white py-4 px-6 md:px-16 flex justify-between items-center sticky top-0 z-50 shadow-md">
        <div class="font-bold text-lg tracking-wider">
    <a href="{{ route('beranda') }}" class="flex items-center">
        <img src="{{ asset('assets/logo.png') }}" alt="SI-RETRIBUSI"
             class="h-8 w-auto"
             style="transform: scale(6); transform-origin: left center;">
    </a>
</div>
        <div class="hidden md:flex space-x-6 items-center text-sm font-medium">
            <a href="{{ route('beranda') }}" class="hover:text-gray-200">Beranda</a>
            <a href="{{ route('tentang') }}" class="hover:text-gray-200">Tentang</a>
            <a href="{{ route('tarif') }}" class="hover:text-gray-200 font-bold underline">Tarif</a>
            <a href="{{ route('informasi') }}" class="hover:text-gray-200">Informasi</a>
            <a href="{{ route('kontak') }}" class="hover:text-gray-200">Kontak</a>
            @auth
                <a href="{{ route('pedagang.dashboard') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Masuk</a>
            @endauth
        </div>
    </nav>

    <header class="bg-gradient-to-r from-[#0062E3] to-[#004BB3] text-white py-16 px-6 md:px-16 text-center relative overflow-hidden shrink-0">
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
        <div class="relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Daftar Tarif Retribusi</h1>
            <p class="text-xs md:text-sm text-blue-100 max-w-xl mx-auto opacity-90 font-light">
                Informasi transparan mengenai besaran tarif retribusi pelayanan pasar berdasarkan Peraturan Daerah (PERDA) resmi yang berlaku.
            </p>
        </div>
    </header>

    <section class="container mx-auto px-6 md:px-16 pt-12 max-w-7xl shrink-0">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                <div class="bg-blue-50 text-[#0062E3] w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div>
                    <h5 class="font-bold text-sm text-slate-800">Kios / Toko</h5>
                    <p class="text-[11px] text-slate-400 mt-0.5">Bangunan permanen beratap dan berpintu kokoh.</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                <div class="bg-blue-50 text-[#0062E3] w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-border-all"></i>
                </div>
                <div>
                    <h5 class="font-bold text-sm text-slate-800">Los Pasar</h5>
                    <p class="text-[11px] text-slate-400 mt-0.5">Tempat dasaran tetap di area dalam los tanpa pembatas dinding.</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center space-x-4">
                <div class="bg-blue-50 text-[#0062E3] w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-umbrella-beach"></i>
                </div>
                <div>
                    <h5 class="font-bold text-sm text-slate-800">Pelataran / Awat-awat</h5>
                    <p class="text-[11px] text-slate-400 mt-0.5">Area terbuka komoditas harian atau tenda bongkar muat.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 md:px-16 py-12 max-w-7xl flex-1">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-md shadow-slate-100/50 overflow-hidden">
            
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="font-extrabold text-lg text-slate-900">Rincian Besaran Tarif Aktif</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Tarif penagihan resmi yang terintegrasi langsung pada sistem e-invoice.</p>
                </div>
                <div class="text-xs bg-amber-50 text-amber-700 font-semibold px-4 py-2 rounded-xl border border-amber-200/60 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info"></i> Sistem Diperbarui Berjalan Riil
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <th class="py-4 px-6 w-16 text-center">No</th>
                            <th class="py-4 px-6">Jenis Tempat Usaha / Lapak</th>
                            <th class="py-4 px-6">Ketetapan Hukum PERDA</th>
                            <th class="py-4 px-6 text-center">Estimasi / Bulan</th>
                            <th class="py-4 px-6 text-right">Tarif Riil / Hari</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($tarifs as $tarif)
                            @php
                                // Penyelarasan badge visual dinamis untuk mempercantik interface tugas kuliah
                                $badgeClass = 'bg-blue-50 text-[#0062E3]';
                                if ($tarif->jenis_lapak === 'Los Pasar') {
                                    $badgeClass = 'bg-emerald-50 text-emerald-600';
                                } elseif ($tarif->jenis_lapak === 'Tenda') {
                                    $badgeClass = 'bg-purple-50 text-purple-600';
                                } elseif (!in_array($tarif->jenis_lapak, ['Kios', 'Los Pasar', 'Tenda'])) {
                                    $badgeClass = 'bg-amber-50 text-amber-600'; // Warna pembeda untuk lapak kustom baru
                                }
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-4 px-6 text-center text-slate-400 font-normal">{{ $loop->iteration }}</td>
                                <td class="py-4 px-6 font-bold text-slate-800">{{ $tarif->jenis_lapak }}</td>
                                <td class="py-4 px-6">
                                    <span class="{{ $badgeClass }} text-[11px] px-2.5 py-1 rounded-md font-bold">
                                        {{ $tarif->dasar_hukum ?: 'Perda Wilayah' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center font-semibold text-slate-500 font-mono">
                                    Rp {{ number_format($tarif->tarif_per_hari * 30, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-right font-extrabold text-[#0062E3] font-mono">
                                    Rp {{ number_format($tarif->tarif_per_hari, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-sm text-slate-400 font-normal">Belum ada master tarif yang terdaftar di database.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-slate-50/50 p-5 text-xs text-slate-400 border-t border-slate-100 font-light leading-relaxed">
                * Seluruh besaran nominal pembayaran retribusi di atas diakumulasikan secara otomatis ke dalam tagihan bulanan pedagang yang dapat diakses mandiri setelah login ke portal.
            </div>
        </div>
    </section>

  <footer class="bg-[#004BB3] text-white pt-12 pb-8 px-6 md:px-16">
    <div class="container mx-auto max-w-7xl grid grid-cols-1 md:grid-cols-4 gap-8 text-sm border-b border-blue-400/30 pb-10">

        <!-- Logo & Deskripsi -->
        <div class="md:col-span-1">
            <a href="{{ route('beranda') }}" class="flex items-center">
        <img src="{{ asset('assets/logo.png') }}" alt="SI-RETRIBUSI"
             class="h-8 w-auto"
             style="transform: scale(6); transform-origin: left center;">
    </a><br>

            <p class="leading-relaxed text-xs text-blue-100 mb-6 font-medium">
                Sistem informasi retribusi pasar yang modern, transparan, dan mudah digunakan untuk semua.
            </p>
             <p class="font-semibold mb-3 text-xs uppercase tracking-wider text-blue-200">Ikuti Kami</p>
            <div class="flex space-x-4 text-lg">
                <a href="#" class="hover:text-blue-200 transition">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" class="hover:text-blue-200 transition">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="#" class="hover:text-blue-200 transition">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>

        <!-- Layanan -->
        <div>
            <h5 class="font-bold mb-4 text-xs tracking-wider uppercase text-blue-200">
                Layanan
            </h5>

            <ul class="space-y-2 text-xs text-blue-50">
                @auth
                    <li>
                        <a href="{{ route('pedagang.tagihan') }}" class="hover:underline">
                            Cek Tagihan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pedagang.tagihan') }}" class="hover:underline">
                            Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pedagang.riwayat-bayar') }}" class="hover:underline">
                            Riwayat Pembayaran
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="hover:underline">
                            Cek Tagihan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="hover:underline">
                            Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="hover:underline">
                            Riwayat Pembayaran
                        </a>
                    </li>
                @endauth

                <li>
                    <a href="{{ route('tarif') }}" class="hover:underline">
                        Informasi Tarif
                    </a>
                </li>
            </ul>
        </div>

        <!-- Informasi -->
        <div>
            <h5 class="font-bold mb-4 text-xs tracking-wider uppercase text-blue-200">
                Informasi
            </h5>

            <ul class="space-y-2 text-xs text-blue-50">
                <li>
                    <a href="{{ route('tentang') }}" class="hover:underline">
                        Tentang Retribusi
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:underline">
                        FAQ
                    </a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}" class="hover:underline">
                        Kontak
                    </a>
                </li>
            </ul>
        </div>

        <!-- Hubungi Kami -->
        <div>
            <h5 class="font-bold mb-4 text-xs tracking-wider uppercase text-blue-200">
                Hubungi Kami
            </h5>

            <ul class="space-y-2 text-xs text-blue-50">
                <li>
                    <i class="fa-solid fa-building mr-2"></i>
                    Dinas Pasar Wilayah
                </li>
                <li>
                    <i class="fa-solid fa-envelope mr-2"></i>
                    support@si-retribusi.go.id
                </li>
                <li>
                    <i class="fa-solid fa-phone mr-2"></i>
                    (021) 889-2341
                </li>
            </ul>
        </div>

    </div>

    <!-- Copyright -->
    <div class="flex items-center justify-center gap-3 pt-6 text-xs text-blue-200">
        <span>&copy; 2026</span>

        <span>All Rights Reserved.</span>
    </div>
</footer>

</body>
</html>