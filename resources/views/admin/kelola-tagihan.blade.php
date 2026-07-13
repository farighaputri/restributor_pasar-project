<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tagihan - SI-RETRIBUSI</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex min-h-screen">

    <aside class="w-64 bg-[#004BB3] text-white flex flex-col justify-between shrink-0 hidden md:flex shadow-xl">
    <div class="px-6 h-20 border-b border-blue-400/20 flex items-center justify-center shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="block transition transform hover:scale-105 duration-200">
            <img src="{{ asset('assets/logo.png') }}" 
                 alt="Logo SI-RETRIBUSI" 
                 class="w-[160px] h-auto object-contain mx-auto block">
        </a>
    </div>
    
    <nav class="p-4 space-y-1 flex-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-blue-100 hover:text-white transition">
                    <i class="fa-solid fa-chart-pie text-sm"></i> Dashboard Utama
                </a>
                <a href="{{ route('admin.data-pedagang') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-blue-100 hover:text-white transition">
                    <i class="fa-solid fa-users text-sm"></i> Data Pedagang
                </a>
                <a href="{{ route('admin.kelola-tagihan') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition">
                    <i class="fa-solid fa-file-invoice-dollar text-sm"></i> Kelola Tagihan
                </a>
                <a href="{{ route('admin.atur-tarif') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-blue-100 hover:text-white transition">
                    <i class="fa-solid fa-calculator text-sm"></i> Atur Tarif Pasar
                </a>
                <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-blue-100 hover:text-white transition">
                    <i class="fa-solid fa-user-shield text-sm"></i> Profil Akun Dinas
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-blue-400/20">
            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">@csrf</form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 bg-red-500/20 hover:bg-red-500/30 text-red-200 hover:text-white rounded-xl text-xs font-bold transition">
                <i class="fa-solid fa-right-from-bracket text-sm"></i> Keluar Sistem
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <header class="bg-white h-16 border-b border-slate-100 flex items-center justify-between px-6 md:px-8 shrink-0 shadow-sm">
            <h2 class="text-sm font-bold text-slate-800">Manajemen Finansial &amp; Tagihan</h2>
            
            <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 group hover:opacity-80 transition">
                <div class="text-right hidden sm:block">
                    <h5 class="text-xs font-bold text-slate-900 group-hover:text-[#0062E3] transition">{{ Auth::user()->name ?? 'Administrator' }}</h5>
                    <p class="text-[10px] text-slate-400 font-medium">Super Admin Dinas</p>
                </div>
                
                <div class="w-9 h-9 rounded-full overflow-hidden flex items-center justify-center shadow-sm">
                    @if(Auth::user() && Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#0062E3] group-hover:bg-[#004BB3] text-white font-bold flex items-center justify-center text-xs transition">
                            AD
                        </div>
                    @endif
                </div>
            </a>
        </header>

        <div class="p-6 md:p-8 space-y-6 overflow-y-auto flex-1">
            
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-sm"></i> {{ session('success') }}
                </div>
            @endif

            <div class="bg-gradient-to-r from-blue-700 to-[#0062E3] text-white p-6 rounded-3xl shadow-md flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <span class="bg-white/15 text-blue-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Otomatisasi Sistem</span>
                    <h3 class="text-xl font-extrabold tracking-tight mt-2">Penerbitan Tagihan Bulanan Serentak</h3>
                    <p class="text-xs text-blue-100/90 mt-1">Tekan tombol di samping untuk mengkalkulasi dan menerbitkan invoice tagihan baru periode bulan ini (<span class="font-bold">Juli 2026</span>) bagi seluruh pedagang aktif.</p>
                </div>
                <form action="{{ route('admin.tagihan.generate') }}" method="POST" class="w-full md:w-auto shrink-0">
                    @csrf
                    <button type="submit" class="w-full md:w-auto bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs px-6 py-3.5 rounded-xl shadow-lg shadow-amber-600/20 transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Tagihan Bulanan
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Total Invoice Terbit</p>
                        <h3 class="text-2xl font-extrabold text-slate-800 mt-1">{{ $totalInvoice }} <span class="text-xs font-normal text-slate-400">berkas</span></h3>
                    </div>
                    <div class="bg-blue-50 text-[#0062E3] w-11 h-11 rounded-xl flex items-center justify-center text-lg"><i class="fa-solid fa-file-invoice"></i></div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Menunggu Konfirmasi</p>
                        <h3 class="text-2xl font-extrabold text-amber-600 mt-1">{{ $pendingCount }} <span class="text-xs font-normal text-slate-400">transfer</span></h3>
                    </div>
                    <div class="bg-amber-50 text-amber-600 w-11 h-11 rounded-xl flex items-center justify-center text-lg"><i class="fa-solid fa-receipt"></i></div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Total Tagihan Lunas</p>
                        <h3 class="text-2xl font-extrabold text-green-600 mt-1">Rp {{ number_format($totalPaid, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-green-50 text-green-600 w-11 h-11 rounded-xl flex items-center justify-center text-lg"><i class="fa-solid fa-wallet"></i></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
                    <div>
                        <h4 class="font-extrabold text-base text-slate-900">Daftar Invoice Retribusi Pedagang</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Validasi bukti pembayaran manual dan pantau status pelunasan harian/bulanan.</p>
                    </div>
                    
                    <div class="flex gap-2 w-full sm:w-auto justify-end">
                        <select class="px-3 py-2 border border-slate-200 rounded-xl text-xs text-slate-600 bg-white focus:outline-none focus:border-[#0062E3]">
                            <option value="">Semua Status</option>
                            <option value="Lunas">Lunas</option>
                            <option value="Pending">Pending (Cek Bukti)</option>
                            <option value="Belum Dibayar">Belum Dibayar</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="py-3.5 px-6 text-center">No</th>
                                <th class="py-3.5 px-6">Nama Pedagang</th>
                                <th class="py-3.5 px-6">Lapak / Pasar</th>
                                <th class="py-3.5 px-6">Periode</th>
                                <th class="py-3.5 px-6 text-right">Nominal</th>
                                <th class="py-3.5 px-6 text-center">Status</th>
                                <th class="py-3.5 px-6 text-center">Tindakan Admin</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($tagihans as $index => $tagihan)
                                <tr class="hover:bg-slate-50/50 transition {{ $tagihan->status === 'Belum Dibayar' ? 'bg-amber-50/20' : '' }}">
                                    <td class="py-4 px-6 text-center text-slate-400 font-normal">{{ $index + 1 }}</td>
                                    <td class="py-4 px-6 font-bold text-slate-800">{{ $tagihan->pedagang->nama ?? 'N/A' }}</td>
                                    <td class="py-4 px-6 font-normal">
                                        {{ $tagihan->pedagang->jenis_lapak ?? 'Lapak belum ada' }}
                                        <span class="text-[10px] text-slate-400 block font-semibold mt-0.5">{{ $tagihan->pedagang->pasar_tujuan ?? 'Pasar belum ditentukan' }}</span>
                                    </td>
                                    <td class="py-4 px-6 font-mono text-slate-600">{{ $tagihan->periode }}</td>
                                    <td class="py-4 px-6 text-right font-bold text-slate-900">Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}</td>
                                    <td class="py-4 px-6 text-center">
                                        @php
                                            $statusClass = 'bg-amber-50 text-amber-700';
                                            if ($tagihan->status === 'Lunas') {
                                                $statusClass = 'bg-green-50 text-green-700';
                                            } elseif ($tagihan->status === 'Belum Dibayar') {
                                                $statusClass = 'bg-rose-50 text-rose-700';
                                            }
                                        @endphp
                                        <span class="{{ $statusClass }} text-[10px] px-2.5 py-0.5 rounded-full font-bold">
                                            {{ $tagihan->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center space-x-1.5 whitespace-nowrap">
                                        @if($tagihan->status !== 'Lunas')
                                            <form action="{{ route('admin.tagihan.bayar', $tagihan->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-green-600 text-white hover:bg-green-700 font-bold px-2 py-1 rounded text-[10px] transition shadow-sm cursor-pointer">
                                                    <i class="fa-solid fa-check"></i> Tandai Lunas
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[10px] text-slate-400 font-semibold"><i class="fa-solid fa-circle-check text-green-600 mr-1"></i>Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-slate-400 font-normal">Tidak ada record data invoice ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <script>
        function lihatBukti(imageUrl) {
            alert("Sistem membuka berkas gambar struk transfer pedagang.\n\nLink Gambar Berkas: " + imageUrl + "\n\n(Catatan: Berkas struk diverifikasi manual sebelum ditandai lunas)");
        }
    </script>
</body>
</html>