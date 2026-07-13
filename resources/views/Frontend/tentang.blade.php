<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SI-RETRIBUSI</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50/50 text-slate-800 antialiased">

    <!-- NAVBAR -->
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
            <a href="{{ route('tarif') }}" class="hover:text-gray-200">Tarif</a>
            <a href="{{ route('informasi') }}" class="hover:text-gray-200">Informasi</a>
            <a href="{{ route('kontak') }}" class="hover:text-gray-200">Kontak</a>
           <a href="{{ route('login') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Masuk</a>
        </div>
    </nav>

    <!-- BREADCRUMB HEADER -->
    <header class="bg-gradient-to-r from-[#0062E3] to-[#004BB3] text-white py-16 px-6 md:px-16 text-center relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
        <div class="relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Tentang Platform</h1>
            <p class="text-xs md:text-sm text-blue-100 max-w-xl mx-auto opacity-90 font-light">
                Mengenal lebih dekat Sistem Informasi Retribusi Pasar Digital dan komitmen kami untuk pelayanan publik yang lebih baik.
            </p>
        </div>
    </header>

    <!-- SEKSI UTAMA: PENJELASAN PLATFORM -->
    <section class="container mx-auto px-6 md:px-16 py-16 max-w-7xl grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Foto / Ilustrasi Kiri -->
        <div class="relative rounded-3xl overflow-hidden shadow-xl shadow-slate-200/50 h-[350px]">
            <img src="https://images.unsplash.com/photo-1578916171728-46686eac8d58?auto=format&fit=crop&q=80&w=1000" alt="Aktivitas Pasar" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#004BB3]/40 to-transparent"></div>
        </div>

        <!-- Konten Kanan -->
        <div class="space-y-5">
            <span class="text-xs font-bold text-[#0062E3] uppercase tracking-widest bg-blue-50 px-3 py-1.5 rounded-md">Transformasi Digital</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Membangun Ekosistem Pasar Tradisional yang Modern
            </h2>
            <p class="text-sm text-slate-600 leading-relaxed font-light">
                <strong>SI-RETRIBUSI</strong> adalah inovasi sistem informasi manajemen yang dirancang khusus untuk memodernisasi pemungutan retribusi pelayanan pasar. Kami hadir untuk menggantikan metode konvensional berbasis kertas menjadi sistem digital yang terintegrasi penuh.
            </p>
            <p class="text-sm text-slate-600 leading-relaxed font-light">
                Melalui platform ini, pemerintah daerah dan pengelola pasar dapat memantau pendapatan daerah secara real-time, sementara para pedagang mendapatkan kepastian tagihan serta kemudahan dalam bertransaksi secara aman, transparan, dan akuntabel.
            </p>
        </div>
    </section>

    <!-- SEKSI VISI & MISI -->
    <section class="bg-white py-16 border-y border-slate-100">
        <div class="container mx-auto px-6 md:px-16 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Visi -->
                <div class="bg-gray-50/50 p-8 rounded-2xl border border-slate-100">
                    <div class="text-[#0062E3] text-2xl mb-4 bg-blue-50 w-12 h-12 flex items-center justify-center rounded-xl">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h4 class="font-extrabold text-slate-900 mb-3">Visi Kami</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-light">
                        Menjadi pionir dalam digitalisasi pasar tradisional demi mewujudkan pengelolaan keuangan daerah yang transparan, efektif, dan berbasis teknologi terdepan.
                    </p>
                </div>

                <!-- Misi 1 -->
                <div class="bg-gray-50/50 p-8 rounded-2xl border border-slate-100">
                    <div class="text-[#0062E3] text-2xl mb-4 bg-blue-50 w-12 h-12 flex items-center justify-center rounded-xl">
                        <i class="fa-solid fa-gauge-high"></i>
                    </div>
                    <h4 class="font-extrabold text-slate-900 mb-3">Meningkatkan Efisiensi</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-light">
                        Memotong birokrasi pembayaran dengan menyediakan berbagai opsi kanal pembayaran nontunai yang bisa diakses kapan saja dan di mana saja oleh pedagang.
                    </p>
                </div>

                <!-- Misi 2 -->
                <div class="bg-gray-50/50 p-8 rounded-2xl border border-slate-100">
                    <div class="text-[#0062E3] text-2xl mb-4 bg-blue-50 w-12 h-12 flex items-center justify-center rounded-xl">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h4 class="font-extrabold text-slate-900 mb-3">Transparansi Data</h4>
                    <p class="text-xs text-slate-500 leading-relaxed font-light">
                        Menyajikan pelaporan data pendapatan pasar yang akurat guna meminimalisir kebocoran dana anggaran dan meningkatkan kepercayaan masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- NILAI UTAMA PLATFORM -->
    <section class="container mx-auto px-6 md:px-16 py-20 max-w-7xl text-center">
        <div class="max-w-xl mx-auto mb-16">
            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Nilai Utama Kami</h2>
            <p class="text-xs text-slate-400 mt-2 font-medium">Nilai yang mendasari pelayanan dan pengembangan sistem SI-RETRIBUSI</p>
            <div class="h-1 w-12 bg-[#0062E3] mt-3 rounded-full mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center">
                <div class="text-[#0062E3] text-2xl mb-4 bg-blue-50/50 w-14 h-14 flex items-center justify-center rounded-full">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h5 class="font-bold text-sm text-slate-800 mb-1">Aman & Terlindungi</h5>
                <p class="text-[11px] text-slate-400 font-light">Keamanan data transaksi terjamin</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center">
                <div class="text-[#0062E3] text-2xl mb-4 bg-blue-50/50 w-14 h-14 flex items-center justify-center rounded-full">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h5 class="font-bold text-sm text-slate-800 mb-1">Cepat & Responsif</h5>
                <p class="text-[11px] text-slate-400 font-light">Proses verifikasi kilat tanpa antre</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center">
                <div class="text-[#0062E3] text-2xl mb-4 bg-blue-50/50 w-14 h-14 flex items-center justify-center rounded-full">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h5 class="font-bold text-sm text-slate-800 mb-1">Transparan</h5>
                <p class="text-[11px] text-slate-400 font-light">Alokasi dana tercatat secara terbuka</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center">
                <div class="text-[#0062E3] text-2xl mb-4 bg-blue-50/50 w-14 h-14 flex items-center justify-center rounded-full">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h5 class="font-bold text-sm text-slate-800 mb-1">Mudah Digunakan</h5>
                <p class="text-[11px] text-slate-400 font-light">Antarmuka ramah bagi seluruh pedagang</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
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