<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pedagang - SI-RETRIBUSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

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
                <a href="{{ route('pedagang.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition-all">
                    <i class="fa-solid fa-house-user text-sm"></i> Beranda Utama
                </a>
                <a href="{{ route('pedagang.tagihan') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
                    <i class="fa-solid fa-file-invoice-dollar text-sm"></i> Tagihan Saya
                </a>
                <a href="{{ route('pedagang.riwayat-bayar') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
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
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 bg-rose-500/10 hover:bg-rose-500 text-rose-200 hover:text-white rounded-xl text-xs font-bold transition-all duration-200">
                <i class="fa-solid fa-right-from-bracket text-sm"></i> Keluar Sistem
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <header class="bg-white h-16 border-b border-slate-200 flex items-center justify-between px-6 md:px-8 shadow-sm">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600 text-lg"><i class="fa-solid fa-bars"></i></button>
                <h2 class="text-sm font-bold text-slate-800">Selamat Datang di Portal Retribusi Pasar</h2>
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
            
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-check text-sm text-emerald-600"></i> {{ session('success') }}
                </div>
            @endif

            @if($pedagang)
                <div class="bg-gradient-to-r from-teal-800 to-teal-600 text-white p-6 rounded-3xl shadow-md flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <span class="bg-teal-900/40 text-teal-200 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Detail Lapak Aktif</span>
                        <h3 class="text-xl sm:text-2xl font-extrabold tracking-tight mt-2">
                            {{ $pedagang->jenis_lapak ?? 'Lapak' }} {{ $pedagang->blok ? 'Blok '.$pedagang->blok : '' }}
                        </h3>
                        <p class="text-xs text-teal-100/90 mt-1"><i class="fa-solid fa-location-dot mr-1 text-teal-300"></i>
                            {{ $pedagang->komoditas ? ucfirst($pedagang->komoditas) : 'Komoditas belum ditentukan' }} — {{ $pedagang->pasar_tujuan ?? 'Belum ada pasar' }}
                        </p>
                    </div>
                    <span class="bg-emerald-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-sm">
                        Status Lapak: {{ $pedagang->status === 'Disetujui' ? 'Aktif' : ucfirst(strtolower($pedagang->status)) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                        <h4 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2"><i class="fa-solid fa-id-card text-teal-600"></i> Data Akun Pedagang</h4>
                        <div class="space-y-3 text-xs sm:text-sm text-slate-600">
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-20 sm:inline-block">Nama:</span> {{ Auth::user()->name }}</p>
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-20 sm:inline-block">NIK:</span> {{ $pedagang->nik }}</p>
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-20 sm:inline-block">Email:</span> {{ Auth::user()->email ?? '-' }}</p>
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-20 sm:inline-block">Telepon:</span> {{ $pedagang->telepon ?? '-' }}</p>
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-20 sm:inline-block">Alamat:</span> {{ $pedagang->alamat ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white border border-slate-200 p-6 shadow-sm">
                        <h4 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2"><i class="fa-solid fa-shop text-teal-600"></i> Informasi Pendaftaran</h4>
                        <div class="space-y-3 text-xs sm:text-sm text-slate-600">
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-32 sm:inline-block">Jenis Lapak:</span> {{ $pedagang->jenis_lapak ?? '-' }}</p>
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-32 sm:inline-block">Nomor / Blok:</span> {{ $pedagang->blok ?? '-' }}</p>
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-32 sm:inline-block">Pasar Tujuan:</span> {{ $pedagang->pasar_tujuan ?? '-' }}</p>
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-32 sm:inline-block">Komoditas:</span> {{ $pedagang->komoditas ?? '-' }}</p>
                            <p><span class="font-semibold text-slate-900 block sm:inline sm:w-32 sm:inline-block">Status Verifikasi:</span> {{ $pedagang->status }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="rounded-3xl bg-amber-50 border border-amber-200 p-6 text-amber-700">
                    Data pedagang tidak ditemukan. Pastikan akun Anda terhubung dengan data pendaftaran.
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Tagihan Belum Dibayar</p>
                        <h3 class="text-2xl font-extrabold text-rose-600 mt-1">Rp {{ number_format($totalDue ?? 0, 0, ',', '.') }}</h3>
                        <span class="text-[10px] text-rose-600 font-bold bg-rose-50 px-2 py-0.5 rounded mt-2 inline-block">{{ $pendingCount ?? 0 }} Invoice Tertunda</span>
                    </div>
                    <div class="bg-rose-50 text-rose-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner">
                        <i class="fa-solid fa-file-circle-exclamation"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Total Terbayar</p>
                        <h3 class="text-2xl font-extrabold text-slate-800 mt-1">Rp {{ number_format($totalPaid ?? 0, 0, ',', '.') }}</h3>
                        <span class="text-[10px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded mt-2 inline-block">Transaksi Lunas</span>
                    </div>
                    <div class="bg-emerald-50 text-emerald-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Tarif Wajib Retribusi</p>
                        <h3 class="text-2xl font-extrabold text-slate-800 mt-1">
                            @if(isset($tarifWajib) && $tarifWajib > 0)
                                Rp {{ number_format($tarifWajib, 0, ',', '.') }}
                            @else
                                Rp 0
                            @endif
                            <span class="text-xs font-normal text-slate-400">/hari</span>
                        </h3>
                        <span class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2 py-0.5 rounded mt-2 inline-block">Sesuai Kebijakan Lapak</span>
                    </div>
                    <div class="bg-blue-50 text-blue-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner">
                        <i class="fa-solid fa-calculator"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden lg:col-span-2">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                        <div>
                            <h4 class="font-bold text-base text-slate-900">Riwayat Pembayaran Retribusi</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Daftar berkas tagihan retribusi Anda dari backend database.</p>
                        </div>
                        <a href="{{ route('pedagang.riwayat-bayar') }}" class="text-xs font-bold text-teal-700 hover:underline">Semua Riwayat</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                    <th class="py-3 px-6">ID Tagihan</th>
                                    <th class="py-3 px-6">Periode</th>
                                    <th class="py-3 px-6 text-center">Dibuat</th>
                                    <th class="py-3 px-6 text-right">Jumlah</th>
                                    <th class="py-3 px-6 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs divide-y divide-slate-100 font-medium text-slate-700">
                                @forelse($tagihans ?? [] as $tagihan)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="py-4 px-6 font-mono font-bold text-slate-900">TAG-{{ str_pad($tagihan->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td class="py-4 px-6 font-semibold">{{ $tagihan->periode ?? $tagihan->bulan_tahun }}</td>
                                        <td class="py-4 px-6 text-center text-slate-500">{{ $tagihan->created_at->format('d M Y') }}</td>
                                        <td class="py-4 px-6 text-right font-bold">Rp {{ number_format($tagihan->jumlah ?? $tagihan->nominal, 0, ',', '.') }}</td>
                                        <td class="py-4 px-6 text-center">
                                            <span class="text-[10px] px-2.5 py-0.5 rounded-full font-bold 
                                                {{ $tagihan->status === 'Lunas' ? 'bg-emerald-50 text-emerald-600' : ($tagihan->status === 'Belum Dibayar' ? 'bg-amber-50 text-amber-700' : 'bg-slate-50 text-slate-700') }}">
                                                {{ $tagihan->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center text-sm text-slate-400 font-normal">
                                            Belum ada data rekaman transaksi untuk akun Anda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                        <h4 class="font-bold text-sm text-slate-900 uppercase tracking-wide">Aksi Cepat Manajemen</h4>
                        
                        @if(isset($totalDue) && $totalDue > 0)
                            <div class="p-4 bg-amber-50 rounded-xl border border-amber-200">
                                <p class="text-xs text-amber-800 leading-relaxed font-medium">
                                    Ada <strong>{{ $pendingCount }} Tagihan Belum Terbayar</strong> senilai <strong>Rp {{ number_format($totalDue, 0, ',', '.') }}</strong>. Segera selesaikan invoice pembayaran Anda.
                                </p>
                            </div>
                            
                            @php
                                $tagihanBelumBayar = collect($tagihans)->where('status', 'Belum Dibayar')->first();
                            @endphp

                            @if($tagihanBelumBayar)
                                <button type="button"
                                        id="btn-dashboard-pay"
                                        onclick="triggerDashboardMidtrans('{{ $tagihanBelumBayar->id }}')"
                                        class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md shadow-teal-100 flex items-center justify-center gap-2 cursor-pointer">
                                    <i class="fa-solid fa-credit-card"></i> Selesaikan Tagihan Sekarang
                                </button>
                            @endif
                        @else
                            <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-2 text-xs text-emerald-800 font-semibold">
                                <i class="fa-solid fa-square-check text-base text-emerald-500"></i> Semua tagihan Anda bulan ini lunas terbayar!
                            </div>
                            <button disabled class="w-full bg-slate-100 text-slate-400 font-bold py-3 px-4 rounded-xl text-xs cursor-not-allowed flex items-center justify-center gap-2">
                                <i class="fa-solid fa-lock"></i> Tidak Ada Tagihan Aktif
                            </button>
                        @endif
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                        <h4 class="font-bold text-sm text-slate-900 uppercase tracking-wide flex items-center gap-2">
                            <i class="fa-solid fa-bullhorn text-teal-600"></i> Pengumuman Pasar
                        </h4>
                        <div class="space-y-3 divide-y divide-slate-100">
                            <div class="pt-2 first:pt-0">
                                <span class="text-[9px] font-bold text-slate-400 uppercase">03 Juli 2026</span>
                                <p class="text-xs font-bold text-slate-800 mt-0.5 hover:text-teal-600 cursor-pointer">Pembersihan Massal &amp; Fogging Blok A</p>
                                <p class="text-[11px] text-slate-500 mt-1">Diharapkan seluruh pedagang mengosongkan lapak pada jam operasional malam...</p>
                            </div>
                            <div class="pt-3">
                                <span class="text-[9px] font-bold text-slate-400 uppercase">24 Juni 2026</span>
                                <p class="text-xs font-bold text-slate-800 mt-0.5 hover:text-teal-600 cursor-pointer">Pemberlakuan Sistem E-Retribusi Baru</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script type="text/javascript">
        function triggerDashboardMidtrans(tagihanId) {
            const button = document.getElementById('btn-dashboard-pay');
            const originalContent = button.innerHTML;
            
            button.disabled = true;
            button.innerHTML = `<i class="fa-solid fa-spinner animate-spin"></i> Memuat Sesi Gateway...`;
            button.classList.replace('bg-teal-600', 'bg-slate-400');

            fetch(`/pedagang/tagihan/${tagihanId}/bayar`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                button.disabled = false;
                button.innerHTML = originalContent;
                button.classList.replace('bg-slate-400', 'bg-teal-600');

                if (data.success) {
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            forceLocalDashboardSettlement(tagihanId, result);
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran Anda.");
                            location.reload();
                        },
                        onError: function(result) {
                            alert("Transaksi dibatalkan atau gagal.");
                        }
                    });
                } else {
                    alert('Gagal mengambil sesi bayar: ' + data.message);
                }
            })
            .catch(error => {
                button.disabled = false;
                button.innerHTML = originalContent;
                button.classList.replace('bg-slate-400', 'bg-teal-600');
                console.error(error);
                alert('Gagal menghubungi server gateway.');
            });
        }

        // Fungsi sinkronisasi bypass instan khusus localhost (development)
        function forceLocalDashboardSettlement(tagihanId, midtransResult) {
            fetch('/midtrans/callback', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    transaction_status: 'settlement',
                    order_id: `RET-${tagihanId}-dev`,
                    payment_type: midtransResult.payment_type || 'qris'
                })
            })
            .then(() => {
                alert("Pembayaran Retribusi Lunas Terkonfirmasi!");
                location.reload();
            })
            .catch(() => {
                location.reload();
            });
        }
    </script>
</body>
</html>