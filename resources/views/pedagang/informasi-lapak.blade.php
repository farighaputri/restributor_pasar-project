<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Lapak - SI-RETRIBUSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex min-h-screen">

   <aside class="w-64 bg-teal-800 text-white flex flex-col justify-between shrink-0 hidden md:flex shadow-xl">
    <div>
        <div class="px-6 h-20 border-b border-teal-700 flex items-center justify-center shrink-0">
            <a href="{{ route('pedagang.dashboard') }}" class="block transition transform hover:scale-105 duration-200">
                <img src="{{ asset('assets/logo.png') }}" 
                     alt="Logo SI-RETRIBUSI" 
                     class="w-[160px] h-auto object-contain mx-auto block">
            </a>
        </div>
        
        <nav class="p-4 space-y-1">
                <a href="{{ route('pedagang.dashboard') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
                    <i class="fa-solid fa-house-user text-sm"></i> Beranda Utama
                </a>
                <a href="{{ route('pedagang.tagihan') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
                    <i class="fa-solid fa-file-invoice-dollar text-sm"></i> Tagihan Saya
                </a>
                <a href="{{ route('pedagang.riwayat-bayar') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
                    <i class="fa-solid fa-clock-rotate-left text-sm"></i> Riwayat Bayar
                </a>
                <a href="{{ route('pedagang.informasi-lapak') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition-all">
                    <i class="fa-solid fa-store text-sm"></i> Informasi Lapak
                </a>
                <a href="{{ route('pedagang.profil') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
                    <i class="fa-solid fa-user-gear text-sm"></i> Profil Akun Saya
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-teal-700">
            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 bg-rose-500/10 hover:bg-rose-50 text-rose-200 hover:text-white rounded-xl text-xs font-bold transition-all duration-200">
                <i class="fa-solid fa-right-from-bracket text-sm"></i> Keluar Sistem
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <header class="bg-white h-16 border-b border-slate-200 flex items-center justify-between px-6 md:px-8 shadow-sm">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600 text-lg"><i class="fa-solid fa-bars"></i></button>
                <h2 class="text-sm font-bold text-slate-800">Detail Hak Guna Pakai Tempat Usaha</h2>
            </div>
            
            <a href="{{ route('pedagang.profil') }}" class="flex items-center gap-3 group hover:opacity-80 transition">
                <div class="text-right hidden sm:block">
                    <h5 class="text-xs font-bold text-slate-900 group-hover:text-teal-700 transition">{{ Auth::user()->name }}</h5>
                    <p class="text-[10px] text-teal-600 font-bold uppercase tracking-wider">{{ $pedagang->pasar_tujuan ?? 'Pasar belum ditentukan' }}</p>
                </div>
                
                <div class="w-9 h-9 rounded-full overflow-hidden flex items-center justify-center shadow-sm border border-slate-200 bg-teal-50">
                    @if(Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-teal-700 text-white font-bold flex items-center justify-center text-xs uppercase">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </a>
        </header>

        <div class="p-6 md:p-8 space-y-6 overflow-y-auto flex-1 bg-slate-50/50">

            @if($pedagang)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden lg:col-span-2 space-y-6 p-6">
                        <div>
                            <h4 class="font-extrabold text-base text-slate-900">Spesifikasi Properti Lapak Usaha</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Informasi rincian teknis fisik tempat penempatan jualan Anda.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">ID Registrasi Lapak</span>
                                <span class="text-sm font-mono font-bold text-slate-800">LPK-{{ str_pad($pedagang->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Lokasi Pasar</span>
                                <span class="text-sm font-bold text-slate-800">{{ $pedagang->pasar_tujuan ?? '-' }}</span>
                            </div>
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Nomor Petak / Blok</span>
                                <span class="text-sm font-bold text-slate-800">
                                    {{ $pedagang->jenis_lapak ?? 'Lapak' }} — {{ $pedagang->blok ?? 'Belum Ditentukan Petugas' }}
                                </span>
                            </div>
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Klasifikasi Komoditas</span>
                                <span class="text-sm font-bold text-slate-800">{{ $pedagang->komoditas ? ucfirst($pedagang->komoditas) : 'Sembako / Umum' }}</span>
                            </div>
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Dimensi Ukuran</span>
                                <span class="text-sm font-bold text-slate-800">
                                    @if(($pedagang->jenis_lapak ?? '') === 'Kios') 3 x 4 Meter @elseif(($pedagang->jenis_lapak ?? '') === 'Los Pasar') 2 x 2 Meter @else 2 x 1.5 Meter @endif
                                </span>
                            </div>
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Kapasitas Daya Listrik</span>
                                <span class="text-sm font-bold text-slate-800">
                                    @if(($pedagang->jenis_lapak ?? '') === 'Kios') 900 Watt @else 450 Watt (Fasilitas Bersama) @endif
                                </span>
                            </div>
                        </div>

                        <div class="border border-slate-200 rounded-xl p-4 bg-teal-50/20">
                            <h5 class="text-xs font-bold text-teal-800 flex items-center gap-1.5 mb-1">
                                <i class="fa-solid fa-shield-halved"></i> Ketentuan Pemeliharaan Aset Daerah:
                            </h5>
                            <p class="text-[11px] text-teal-700/90 leading-relaxed font-normal">
                                Pedagang dilarang keras merubah bangunan fisik permanen, menambah instalasi jalur kabel listrik ilegal tanpa persetujuan Unit Pelaksana Teknis (UPT) Pasar, serta wajib menjaga kebersihan radius 1 meter di luar area zonasi petak lapak.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4 lg:col-span-1">
                        <div>
                            <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wide flex items-center gap-2">
                                <i class="fa-solid fa-scale-balanced text-teal-600"></i> Aspek Hukum Sewa
                            </h4>
                            <p class="text-xs text-slate-400 mt-0.5">Status legalitas pemanfaatan lapak milik pemerintah daerah.</p>
                        </div>

                        <div class="divide-y divide-slate-100 text-xs font-medium text-slate-700 space-y-3">
                            <div class="pt-2 first:pt-0 flex justify-between items-center">
                                <span class="text-slate-400 font-semibold">Dasar Penetapan Tarif</span>
                                <span class="font-bold text-slate-800">
                                    @if(($pedagang->jenis_lapak ?? '') === 'Kios') Perda No. 12/2024 @else Perda No. 08/2022 @endif
                                </span>
                            </div>
                            <div class="pt-3 flex justify-between items-center">
                                <span class="text-slate-400 font-semibold">Beban Biaya / Hari</span>
                                <span class="font-mono font-bold text-slate-800">
                                    @if(($pedagang->jenis_lapak ?? '') === 'Kios') Rp 5.000 @elseif(($pedagang->jenis_lapak ?? '') === 'Los Pasar') Rp 3.000 @else Rp 2.000 @endif
                                </span>
                            </div>
                            <div class="pt-3 flex justify-between items-center">
                                <span class="text-slate-400 font-semibold">Siklus Penagihan</span>
                                <span class="bg-teal-50 text-teal-700 font-bold px-2 py-0.5 rounded">Maks. Bulanan</span>
                            </div>
                            <div class="pt-3 flex justify-between items-center">
                                <span class="text-slate-400 font-semibold">Masa Berlaku Izin</span>
                                <span class="font-bold text-slate-800">31 Des 2026</span>
                            </div>
                        </div>

                        <hr class="border-slate-100 my-4">

                        <button onclick="alert('Mengunduh Surat Izin Penghunian Tempat Berjualan (SIPTB) format resmi digital PDF.')" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition shadow-md flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-file-pdf"></i> Unduh Berkas SIPTB (PDF)
                        </button>
                    </div>

                </div>
            @else
                <div class="rounded-3xl bg-amber-50 border border-amber-200 p-6 text-amber-700">
                    Gagal memuat informasi properti. Pastikan data pendaftaran lapak Anda telah aktif dan disetujui dinas.
                </div>
            @endif

        </div>
    </main>

</body>
</html>