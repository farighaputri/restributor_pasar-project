<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran - SI-RETRIBUSI</title>
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
                <a href="{{ route('pedagang.riwayat-bayar') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition-all">
                    <i class="fa-solid fa-clock-rotate-left text-sm"></i> Riwayat Bayar
                </a>
                <a href="{{ route('pedagang.informasi-lapak') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
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
                <h2 class="text-sm font-bold text-slate-800">Arsip Transaksi Pelunasan Retribusi</h2>
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

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between max-w-md">
                <div>
                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Total Kontribusi Retribusi Anda</p>
                    <h3 class="text-3xl font-extrabold text-emerald-600 mt-1">
                        Rp {{ number_format($tagihans->where('status', 'Lunas')->sum('nominal'), 0, ',', '.') }}
                    </h3>
                    <p class="text-[10px] text-slate-400 mt-1">Akumulasi pembayaran sah yang tercatat di sistem digital.</p>
                </div>
                <div class="bg-emerald-50 text-emerald-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-receipt"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h4 class="font-extrabold text-base text-slate-900">Buku Catatan Pembayaran Sah</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Berikut adalah seluruh daftar tagihan Anda yang berstatus lunas terverifikasi.</p>
                    </div>
                    <button onclick="alert('Mencetak laporan rekapitulasi seluruh transaksi pelunasan retribusi ke file PDF.')" class="bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md shadow-teal-100 transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-print"></i> Cetak Rekap Laporan
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3.5 px-6 text-center">No</th>
                                <th class="py-3.5 px-6">ID Transaksi</th>
                                <th class="py-3.5 px-6">Periode Bulan</th>
                                <th class="py-3.5 px-6 text-center">Tanggal Pembayaran</th>
                                <th class="py-3.5 px-6 text-center">Metode Pembayaran</th>
                                <th class="py-3.5 px-6 text-right">Jumlah Setoran</th>
                                <th class="py-3.5 px-6 text-center">Bukti Validasi</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-100 font-medium text-slate-700">
                            @php $no = 1; @endphp
                            @forelse($tagihans->where('status', 'Lunas') as $tagihan)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="py-4 px-6 text-center text-slate-400 font-normal">{{ $no++ }}</td>
                                    <td class="py-4 px-6 font-mono font-bold text-slate-900">TRX-{{ str_pad($tagihan->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td class="py-4 px-6">{{ $tagihan->bulan_tahun }}</td>
                                    <td class="py-4 px-6 text-center text-slate-600 font-medium">
                                        {{ \Carbon\Carbon::parse($tagihan->tanggal_bayar)->format('d M Y, H:i') }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="bg-slate-100 text-slate-700 text-[10px] px-2 py-0.5 rounded font-bold uppercase">
                                            {{ $tagihan->metode_pembayaran ?? 'QRIS' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right font-extrabold text-emerald-600">
                                        Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
                                        <button onclick="alert('Mengunduh berkas Kwitansi PDF resmi untuk Kode Transaksi: TRX-{{ str_pad($tagihan->id, 6, '0', STR_PAD_LEFT) }}')" class="bg-blue-50 hover:bg-blue-100 text-teal-700 font-bold px-2.5 py-1.5 rounded-lg text-[10px] transition flex items-center gap-1 mx-auto">
                                            <i class="fa-solid fa-file-pdf"></i> Unduh Struk
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-10 text-center text-sm text-slate-400">
                                        <i class="fa-solid fa-receipt text-2xl text-slate-200 block mb-2"></i>
                                        Belum ditemukan riwayat pembayaran berstatus lunas pada akun Anda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>