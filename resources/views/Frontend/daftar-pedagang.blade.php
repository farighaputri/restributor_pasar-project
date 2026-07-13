<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pedagang Baru - SI-RETRIBUSI</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <nav class="bg-[#0062E3] text-white py-4 px-6 md:px-16 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <div class="font-bold text-lg tracking-wider">
    <a href="{{ route('beranda') }}" class="flex items-center">
        <img src="{{ asset('assets/logo.png') }}" alt="SI-RETRIBUSI"
             class="h-8 w-auto"
             style="transform: scale(6); transform-origin: left center;">
    </a>
</div>
        <div class="hidden md:flex space-x-8 items-center text-sm font-medium">
            <a href="{{ route('beranda') }}" class="hover:text-blue-100 transition">Beranda</a>
            <a href="{{ route('tentang') }}" class="hover:text-blue-100 transition">Tentang</a>
            <a href="{{ route('tarif') }}" class="hover:text-blue-100 transition">Tarif</a>
            <a href="{{ route('informasi') }}" class="hover:text-blue-100 transition">Informasi</a>
            <a href="{{ route('kontak') }}" class="hover:text-blue-100 transition">Kontak</a>
            @auth
                <a href="{{ route('pedagang.dashboard') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Masuk</a>
            @endauth
        </div>
    </nav>

    <header class="bg-gradient-to-r from-[#0062E3] to-[#004BB3] text-white py-14 px-6 md:px-16 text-center relative overflow-hidden shrink-0">
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
        <div class="relative z-10 space-y-2">
            <h1 class="text-2xl md:text-4xl font-extrabold tracking-tight">Formulir Pendaftaran Pedagang</h1>
            <p class="text-xs md:text-sm text-blue-100/90 max-w-xl mx-auto font-light leading-relaxed">
                Silakan isi data diri dan spesifikasi lokasi usaha Anda di bawah ini secara lengkap untuk mengajukan permohonan hak guna lapak pasar digital resmi.
            </p>
        </div>
    </header>

    <main class="container mx-auto px-4 md:px-16 py-10 max-w-3xl flex-1">
        <div class="bg-white p-6 md:p-10 rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/40">
            
            <div class="mb-8 border-b border-slate-100 pb-4">
                <h3 class="text-lg font-bold text-slate-900 tracking-wide">Data Registrasi Usaha Mandiri</h3>
                <p class="text-xs text-slate-400 mt-0.5">Seluruh berkas masuk akan divalidasi oleh Administrator Dinas Pasar.</p>
            </div>

            <form action="{{ route('daftar-pedagang.simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-xs text-rose-700 space-y-2">
                        <div class="flex items-center gap-2 font-bold">
                            <i class="fa-solid fa-circle-exclamation text-sm"></i> Periksa kembali isian form Anda:
                        </div>
                        <ul class="list-disc pl-5 space-y-0.5 font-medium text-rose-600/90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-4">
                    <h4 class="text-[11px] font-extrabold text-[#0062E3] uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                        <i class="fa-solid fa-user-check text-xs"></i> 1. Profil Biodata Pemohon
                    </h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="nama" class="text-xs font-bold text-slate-600">Nama Lengkap (Sesuai KTP)</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap" 
                                class="w-full px-4 py-2.5 bg-slate-50 hover:bg-slate-100/50 focus:bg-white border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 transition font-semibold placeholder-slate-400">
                        </div>
                        <div class="space-y-1.5">
                            <label for="nik" class="text-xs font-bold text-slate-600">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required placeholder="16 Digit No. KTP Kependudukan" maxlength="16"
                                class="w-full px-4 py-2.5 bg-slate-50 hover:bg-slate-100/50 focus:bg-white border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 transition font-semibold font-mono placeholder-slate-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="telepon" class="text-xs font-bold text-slate-600">No. Kontak WhatsApp Aktif</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-xs font-bold text-slate-400"><i class="fa-brands fa-whatsapp text-sm text-emerald-500"></i></span>
                                <input type="tel" id="telepon" name="telepon" value="{{ old('telepon') }}" required placeholder="081234567xxx" 
                                    class="w-full pl-9 pr-4 py-2.5 bg-slate-50 hover:bg-slate-100/50 focus:bg-white border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 transition font-semibold placeholder-slate-400">
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label for="email" class="text-xs font-bold text-slate-600">Alamat Email Pembayaran (Opsional)</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="contoh@domain.com" 
                                class="w-full px-4 py-2.5 bg-slate-50 hover:bg-slate-100/50 focus:bg-white border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 transition font-semibold placeholder-slate-400">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="alamat" class="text-xs font-bold text-slate-600">Alamat Domisili Kependudukan Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="3" required placeholder="Tulis nama jalan, RT/RW, nomor rumah, kelurahan, dan kecamatan tempat tinggal saat ini"
                            class="w-full px-4 py-2.5 bg-slate-50 hover:bg-slate-100/50 focus:bg-white border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 transition font-medium placeholder-slate-400 leading-relaxed">{{ old('alamat') }}</textarea>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <h4 class="text-[11px] font-extrabold text-[#0062E3] uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                        <i class="fa-solid fa-store text-xs"></i> 2. Spesifikasi Penempatan Lapak Usaha
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="pasar" class="text-xs font-bold text-slate-600">Kompleks Pasar Tujuan</label>
                            <select id="pasar" name="pasar_tujuan" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 text-slate-700 font-semibold transition">
                                <option value="" disabled {{ old('pasar_tujuan') ? '' : 'selected' }}>Pilih Lokasi Unit Pasar</option>
                                <option value="Pasar Raya Pusat" {{ old('pasar_tujuan') === 'Pasar Raya Pusat' ? 'selected' : '' }}>Pasar Raya Pusat</option>
                                <option value="Pasar Tradisional Barat" {{ old('pasar_tujuan') === 'Pasar Tradisional Barat' ? 'selected' : '' }}>Pasar Tradisional Barat</option>
                                <option value="Pasar Induk Timur" {{ old('pasar_tujuan') === 'Pasar Induk Timur' ? 'selected' : '' }}>Pasar Induk Timur</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label for="jenis_tempat" class="text-xs font-bold text-slate-600">Kategori Jenis Lapak Usaha</label>
                            <select id="jenis_tempat" name="jenis_lapak" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 text-slate-700 font-semibold transition">
                                <option value="" disabled {{ old('jenis_lapak') ? '' : 'selected' }}>Pilih Tipe Lapak Kontrak</option>
                                @foreach($tarifs as $tarif)
                                    <option value="{{ $tarif->jenis_lapak }}" {{ old('jenis_lapak') === $tarif->jenis_lapak ? 'selected' : '' }}>
                                        {{ $tarif->jenis_lapak }} (Rp {{ number_format($tarif->tarif_per_hari, 0, ',', '.') }}/Hari)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="blok" class="text-xs font-bold text-slate-600">Kode Blok / Nomor Petak Unit</label>
                            <input type="text" id="blok" name="blok" value="{{ old('blok') }}" required placeholder="Contoh: Blok B / Los No. 24" 
                                class="w-full px-4 py-2.5 bg-slate-50 hover:bg-slate-100/50 focus:bg-white border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 transition font-semibold placeholder-slate-400">
                        </div>
                        <div class="space-y-1.5">
                            <label for="komoditas" class="text-xs font-bold text-slate-600">Komoditas Utama Barang Dagangan</label>
                            <input type="text" id="komoditas" name="komoditas" value="{{ old('komoditas') }}" required placeholder="Contoh: Sembako, Daging, Pakaian Konveksi" 
                                class="w-full px-4 py-2.5 bg-slate-50 hover:bg-slate-100/50 focus:bg-white border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:ring-4 focus:ring-blue-500/10 transition font-semibold placeholder-slate-400">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-600">Dokumen Lampiran Identitas (Scan KTP Resmi)</label>
                        <div class="border-2 border-dashed border-slate-200 hover:border-[#0062E3] rounded-2xl p-4 bg-slate-50/50 hover:bg-slate-50 transition text-center flex flex-col items-center justify-center relative group">
                            <div class="text-slate-400 group-hover:text-[#0062E3] transition text-2xl mb-1">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <span class="text-[11px] font-bold text-slate-600">Pilih Berkas Scan KTP Anda</span>
                            <span class="text-[9px] text-slate-400 mt-0.5">Format file: JPG, PNG, PDF (Maksimal Ukuran 2MB)</span>
                            <input type="file" id="ktp" name="ktp" accept="image/*,.pdf" required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                        </div>
                    </div>
                </div>

                <div class="flex items-start bg-blue-50/40 p-3.5 rounded-xl border border-blue-100/30 mt-2">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="agree" name="agree" required class="w-4 h-4 text-[#0062E3] border-slate-300 rounded focus:ring-[#0062E3] cursor-pointer">
                    </div>
                    <div class="ml-2.5 text-xs font-medium text-slate-500 leading-normal select-none">
                        Saya dengan kesadaran penuh menyatakan bahwa seluruh berkas data yang diisi di atas adalah sah dan benar. Saya bersedia mematuhi Peraturan Daerah (Perda) terkait ketetapan wajib retribusi pasar yang berlaku secara periodik.
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#0062E3] hover:bg-[#004BB3] text-white font-bold py-3 px-4 rounded-xl text-xs shadow-md shadow-blue-600/10 hover:shadow-lg transition flex items-center justify-center gap-2 mt-4 group">
                    <i class="fa-solid fa-id-card text-sm"></i> Kirim Berkas Formulir Registrasi
                </button>
            </form>

        </div>
    </main>

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