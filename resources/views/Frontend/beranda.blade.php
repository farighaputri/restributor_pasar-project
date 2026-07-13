<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Retribusi Pasar Digital</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

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
            @auth
                <a href="{{ route('pedagang.dashboard') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Masuk</a>
            @endauth
        </div>
    </nav>

    <header class="relative bg-[#0062E3] text-white min-h-[450px] flex items-center overflow-hidden">
        <div class="absolute right-0 top-0 h-full w-full md:w-1/2 opacity-30 md:opacity-80">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=1000" alt="Pasar Tradisional" class="h-full w-full object-cover object-center">
        </div>

        <div class="container mx-auto px-6 md:px-16 relative z-10 py-12 md:py-0 max-w-7xl">
            <div class="max-w-xl">
                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4 text-white">
                    Sistem Informasi<br>Retribusi Pasar Digital
                </h1>
                <p class="text-sm md:text-base text-blue-100 mb-8 max-w-md">
                    Bayar retribusi pasar lebih mudah, cepat, aman dan transparan.
                </p>
                <div class="flex flex-wrap gap-3 items-center">
                    @auth
                        <a href="{{ route('pedagang.tagihan') }}" class="bg-white text-[#0062E3] text-xs md:text-sm font-bold px-5 py-3 rounded-full shadow hover:bg-gray-100 transition">Bayar Retribusi</a>
                        <a href="{{ route('pedagang.tagihan') }}" class="bg-transparent text-white text-xs md:text-sm font-semibold px-5 py-3 rounded-full shadow-sm border border-white/40 hover:bg-white/10 transition">Cek Tagihan</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-[#0062E3] text-xs md:text-sm font-bold px-5 py-3 rounded-full shadow hover:bg-gray-100 transition">Bayar Retribusi</a>
                        <a href="{{ route('login') }}" class="bg-transparent text-white text-xs md:text-sm font-semibold px-5 py-3 rounded-full shadow-sm border border-white/40 hover:bg-white/10 transition">Cek Tagihan</a>
                        <a href="{{ route('daftar-pedagang') }}" class="bg-amber-500 hover:bg-amber-600 text-white text-xs md:text-sm font-bold px-5 py-3 rounded-full shadow transition">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

<section class="container mx-auto px-6 md:px-16 -mt-12 relative z-20 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4 border border-gray-100">
                <div class="bg-blue-50 text-[#0062E3] w-12 h-12 rounded-full flex items-center justify-center text-xl">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Pedagang</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalPedagang ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-xs text-green-500 font-semibold mt-0.5">
                        <span class="bg-green-50 px-1 py-0.5 rounded">+{{ $pedagangBaruBulanIni ?? 0 }}</span> bulan ini
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4 border border-gray-100">
                <div class="bg-blue-50 text-[#0062E3] w-12 h-12 rounded-full flex items-center justify-center text-xl">
                    <i class="fa-solid fa-shop"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Pasar</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalPasar ?? 0 }}</h3>
                    <p class="text-xs text-green-500 font-semibold mt-0.5">
                        <span class="bg-green-50 px-1 py-0.5 rounded">+{{ $pasarBaruBulanIni ?? 0 }}</span> bulan ini
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4 border border-gray-100">
                <div class="bg-blue-50 text-[#0062E3] w-12 h-12 rounded-full flex items-center justify-center text-xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Pembayaran Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($pembayaranHariIni ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-xs text-green-500 font-semibold mt-0.5">
                        <span class="bg-green-50 px-1 py-0.5 rounded">+{{ $trenPembayaranBulanIni ?? 0 }}%</span> bulan ini
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="container mx-auto px-6 md:px-16 py-16 max-w-7xl">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-10">Layanan Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @auth
                <a href="{{ route('pedagang.tagihan') }}" class="bg-white p-8 rounded-2xl shadow-md border border-gray-50 hover:shadow-xl transition text-center flex flex-col items-center block group">
            @else
                <a href="{{ route('login') }}" class="bg-white p-8 rounded-2xl shadow-md border border-gray-50 hover:shadow-xl transition text-center flex flex-col items-center block group">
            @endauth
                <h4 class="font-bold text-lg text-gray-800 mb-4 group-hover:text-[#0062E3]">Cek Tagihan</h4>
                <div class="text-[#0062E3] text-4xl mb-4">
                    <i class="fa-solid fa-magnifying-glass-dollar"></i>
                </div>
                <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">Cek tagihan retribusi pasar anda</p>
            </a>

            @auth
                <a href="{{ route('pedagang.tagihan') }}" class="bg-white p-8 rounded-2xl shadow-md border border-gray-50 hover:shadow-xl transition text-center flex flex-col items-center block group">
            @else
                <a href="{{ route('login') }}" class="bg-white p-8 rounded-2xl shadow-md border border-gray-50 hover:shadow-xl transition text-center flex flex-col items-center block group">
            @endauth
                <h4 class="font-bold text-lg text-gray-800 mb-4 group-hover:text-[#0062E3]">Pembayaran</h4>
                <div class="text-[#0062E3] text-4xl mb-4">
                    <i class="fa-solid fa-credit-card"></i>
                </div>
                <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">Bayar retribusi dengan berbagai metode</p>
            </a>

            @auth
                <a href="{{ route('pedagang.riwayat-bayar') }}" class="bg-white p-8 rounded-2xl shadow-md border border-gray-50 hover:shadow-xl transition text-center flex flex-col items-center block group">
            @else
                <a href="{{ route('login') }}" class="bg-white p-8 rounded-2xl shadow-md border border-gray-50 hover:shadow-xl transition text-center flex flex-col items-center block group">
            @endauth
                <h4 class="font-bold text-lg text-gray-800 mb-4 group-hover:text-[#0062E3]">Riwayat</h4>
                <div class="text-[#0062E3] text-4xl mb-4">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <p class="text-xs text-gray-500 max-w-[200px] leading-relaxed">Lihat riwayat pembayaran yang telah dilakukan</p>
            </a>
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