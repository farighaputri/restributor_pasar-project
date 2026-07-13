<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi - SI-RETRIBUSI</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50/50 text-slate-800 antialiased">

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

    <header class="bg-gradient-to-r from-[#0062E3] to-[#004BB3] text-white py-16 px-6 md:px-16 text-center relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
        <div class="relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Pusat Informasi & Pengumuman</h1>
            <p class="text-xs md:text-sm text-blue-100 max-w-xl mx-auto opacity-90 font-light">
                Temukan berita terbaru, regulasi pemerintah, panduan aplikasi, dan jawaban atas pertanyaan umum seputar retribusi digital.
            </p>
        </div>
    </header>

    <main class="container mx-auto px-6 md:px-16 py-12 max-w-7xl grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-bullhorn text-[#0062E3] text-sm"></i> Berita & Pengumuman Terbaru
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition flex flex-col">
                    <div class="h-44 bg-slate-200 relative">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=500" alt="Pasar Berita" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-[#0062E3] text-white text-[10px] font-bold px-2 py-1 rounded">Pengumuman</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] text-slate-400 font-medium"><i class="fa-regular fa-calendar mr-1"></i> 2 Juli 2026</span>
                            <h4 class="font-bold text-sm text-slate-900 mt-2 line-clamp-2 hover:text-[#0062E3] transition">
                                <a href="#">Sosialisasi Penerapan QRIS untuk Pembayaran Lapak Pasar Tradisional</a>
                            </h4>
                            <p class="text-xs text-slate-500 mt-2 font-light line-clamp-3">
                                Dinas Pasar akan mengadakan sosialisasi serentak mengenai implementasi metode e-wallet dan QRIS guna mempermudah transaksi harian pedagang...
                            </p>
                        </div>
                        <a href="#" class="text-xs font-bold text-[#0062E3] inline-flex items-center gap-1 mt-4 hover:underline">Baca Selengkapnya <i class="fa-solid fa-chevron-right text-[9px]"></i></a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition flex flex-col">
                    <div class="h-44 bg-slate-200 relative">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&q=80&w=500" alt="Sosialisasi" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] font-bold px-2 py-1 rounded">Edukasi</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] text-slate-400 font-medium"><i class="fa-regular fa-calendar mr-1"></i> 28 Juni 2026</span>
                            <h4 class="font-bold text-sm text-slate-900 mt-2 line-clamp-2 hover:text-[#0062E3] transition">
                                <a href="#">Panduan Lengkap Cara Cek Nomor NIK Pedagang dan Cek Tagihan Bulanan</a>
                            </h4>
                            <p class="text-xs text-slate-500 mt-2 font-light line-clamp-3">
                                Membantu para pedagang baru yang belum memahami alur sistem online, berikut langkah mudah melakukan verifikasi mandiri di portal...
                            </p>
                        </div>
                        <a href="#" class="text-xs font-bold text-[#0062E3] inline-flex items-center gap-1 mt-4 hover:underline">Baca Selengkapnya <i class="fa-solid fa-chevron-right text-[9px]"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-scale-balanced text-[#0062E3] text-sm"></i> Regulasi & Hukum
            </h3>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="p-4 bg-gray-50/50 rounded-xl border border-slate-100 flex items-start gap-4">
                    <div class="bg-red-50 text-red-500 w-10 h-10 rounded-xl flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div>
                        <h5 class="font-bold text-xs text-slate-800 leading-tight">PERDA No. 12 Tahun 2025</h5>
                        <p class="text-[11px] text-slate-400 mt-1 font-light">Tentang Penyesuaian Tarif Retribusi Pelayanan Pasar Digital.</p>
                        <a href="#" class="text-[11px] font-bold text-[#0062E3] inline-flex items-center gap-1 mt-2 hover:underline"><i class="fa-solid fa-download"></i> Unduh Dokumen (2.4 MB)</a>
                    </div>
                </div>

                <div class="p-4 bg-gray-50/50 rounded-xl border border-slate-100 flex items-start gap-4">
                    <div class="bg-red-50 text-red-500 w-10 h-10 rounded-xl flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div>
                        <h5 class="font-bold text-xs text-slate-800 leading-tight">SK Walikota SK-88/2026</h5>
                        <p class="text-[11px] text-slate-400 mt-1 font-light">Tata Cara Penunjukan & Validasi Lapak Pedagang Resmi.</p>
                        <a href="#" class="text-[11px] font-bold text-[#0062E3] inline-flex items-center gap-1 mt-2 hover:underline"><i class="fa-solid fa-download"></i> Unduh Dokumen (1.1 MB)</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="bg-white py-16 border-t border-slate-100">
        <div class="container mx-auto px-6 md:px-16 max-w-4xl">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Pertanyaan Sering Diajukan (FAQ)</h2>
                <p class="text-xs text-slate-400 mt-2 font-medium">Temukan jawaban cepat seputar kendala teknis dan administrasi retribusi</p>
                <div class="h-1 w-12 bg-[#0062E3] mt-3 rounded-full mx-auto"></div>
            </div>

            <div class="space-y-4">
                <div class="p-5 bg-gray-50/50 border border-slate-100 rounded-xl">
                    <h5 class="font-bold text-sm text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-[#0062E3]"></i> Bagaimana jika NIK saya tidak terdaftar di sistem?
                    </h5>
                    <p class="text-xs text-slate-500 mt-2 pl-6 leading-relaxed font-light">
                        Silakan laporkan ke Kantor Pengelola Pasar setempat dengan membawa KTP asli dan Kartu Bukti Hak Tempat Usaha (KBHTU) untuk pemutakhiran data oleh petugas dinas terkait.
                    </p>
                </div>

                <div class="p-5 bg-gray-50/50 border border-slate-100 rounded-xl">
                    <h5 class="font-bold text-sm text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-[#0062E3]"></i> Kapan batas akhir pembayaran retribusi pasar dilakukan?
                    </h5>
                    <p class="text-xs text-slate-500 mt-2 pl-6 leading-relaxed font-light">
                        Pembayaran akumulasi tagihan bulanan dilakukan paling lambat tanggal 10 pada setiap bulannya guna menghindari sanksi denda administratif sesuai peraturan daerah.
                    </p>
                </div>
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