<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - SI-RETRIBUSI</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 bg-white/10 rounded-xl text-xs font-bold transition-all">
                <i class="fa-solid fa-chart-pie text-sm w-5 text-center"></i> Dashboard Utama
            </a>
            <a href="{{ route('admin.data-pedagang') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold text-blue-100 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-users text-sm w-5 text-center"></i> Data Pedagang
            </a>
            <a href="{{ route('admin.kelola-tagihan') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold text-blue-100 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-file-invoice-dollar text-sm w-5 text-center"></i> Kelola Tagihan
            </a>
            <a href="{{ route('admin.atur-tarif') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold text-blue-100 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-calculator text-sm w-5 text-center"></i> Atur Tarif Pasar
            </a>
            <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold text-blue-100 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-user-shield text-sm w-5 text-center"></i> Profil Akun Dinas
            </a>
        </nav>
    </div>

    <div class="p-4 border-t border-blue-400/20 shrink-0">
        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-2.5 bg-red-500/20 hover:bg-red-500/30 text-red-200 hover:text-white rounded-xl text-xs font-bold transition-all">
            <i class="fa-solid fa-right-from-bracket text-sm w-5 text-center"></i> Keluar Sistem
        </a>
    </div>
</aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <header class="bg-white h-16 border-b border-slate-100 flex items-center justify-between px-6 md:px-8 shrink-0 shadow-sm">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600 text-lg hover:text-blue-600 transition">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h2 class="text-sm font-bold text-slate-800">Ringkasan Statistik Pasar</h2>
            </div>
            
            <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 group hover:opacity-80 transition-all">
                <div class="text-right hidden sm:block">
                    <h5 class="text-xs font-bold text-slate-900 group-hover:text-[#0062E3] transition">{{ Auth::user()->name ?? 'Administrator' }}</h5>
                    <p class="text-[10px] text-slate-400 font-medium">Super Admin Dinas</p>
                </div>
                
                <div class="w-9 h-9 rounded-full overflow-hidden flex items-center justify-center shadow-sm border border-slate-100 bg-blue-50 shrink-0">
                    @if(Auth::user() && Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#0062E3] text-white font-bold flex items-center justify-center text-xs uppercase">
                            AD
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                    <div class="min-w-0 flex-1 pr-2">
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider truncate">Total Pendaftar</p>
                        <h3 class="text-2xl font-extrabold text-slate-800 mt-1 truncate">{{ $totalPendaftarBaru }}</h3>
                        <span class="text-[10px] text-amber-600 font-bold bg-amber-50 px-2 py-0.5 rounded-md mt-2 inline-block whitespace-nowrap">Butuh Validasi</span>
                    </div>
                    <div class="bg-blue-50 text-[#0062E3] w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner shrink-0">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                    <div class="min-w-0 flex-1 pr-2">
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider truncate">Pedagang Aktif</p>
                        <h3 class="text-2xl font-extrabold text-slate-800 mt-1 truncate">{{ $totalPedagangAktif }}</h3>
                        <span class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-0.5 rounded-md mt-2 inline-block whitespace-nowrap">Terverifikasi</span>
                    </div>
                    <div class="bg-green-50 text-green-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner shrink-0">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                    <div class="min-w-0 flex-1 pr-2">
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider truncate">Tagihan Terbayar</p>
                        <h3 class="text-2xl font-extrabold text-slate-800 mt-1 truncate">{{ $tagihanTerbayar }}</h3>
                        <span class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2 py-0.5 rounded-md mt-2 inline-block whitespace-nowrap">Persentase</span>
                    </div>
                    <div class="bg-blue-50 text-[#0062E3] w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner shrink-0">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                    <div class="min-w-0 flex-1 pr-2">
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider truncate">Total Pendapatan</p>
                        <h3 class="text-xl font-extrabold text-slate-800 mt-1 truncate">{{ $totalPendapatan }}</h3>
                        <span class="text-[10px] text-purple-600 font-bold bg-purple-50 px-2 py-0.5 rounded-md mt-2 inline-block whitespace-nowrap">Dana Masuk</span>
                    </div>
                    <div class="bg-purple-50 text-purple-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner shrink-0">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm lg:col-span-2 space-y-4">
                    <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wide">Tren Pendapatan Retribusi Daerah</h4>
                    <div class="relative h-64 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                    <h4 class="font-extrabold text-sm text-slate-900 uppercase tracking-wide">Segmentasi Properti Lapak</h4>
                    <div class="relative h-64 w-full flex items-center justify-center">
                        <canvas id="lapakChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100">
                    <h4 class="font-extrabold text-base text-slate-900">Permohonan Registrasi Pedagang Baru</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Calon pedagang aktif yang mengirim data mandiri.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3 px-6 text-center w-12">No</th>
                                <th class="py-3 px-6">Nama Pemohon</th>
                                <th class="py-3 px-6">NIK KTP</th>
                                <th class="py-3 px-6">Pasar Tujuan</th>
                                <th class="py-3 px-6 text-center">Jenis Lapak</th>
                                <th class="py-3 px-6 text-center w-40">Aksi Manajemen</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($permohonan as $index => $item)
                                @php
                                    $badgeClass = match($item->jenis_lapak) {
                                        'Kios' => 'bg-blue-50 text-[#0062E3]',
                                        'Los Pasar' => 'bg-emerald-50 text-emerald-600',
                                        default => 'bg-purple-50 text-purple-600',
                                    };
                                
                                    $routeAction = route('admin.pedagang.approve', $item->id);
                                @endphp
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="py-3.5 px-6 text-center text-slate-400 font-normal">{{ $index + 1 }}</td>
                                    <td class="py-3.5 px-6 font-bold text-slate-900">{{ $item->nama }}</td>
                                    <td class="py-3.5 px-6 font-mono text-slate-500">{{ $item->nik }}</td>
                                    <td class="py-3.5 px-6 font-semibold text-slate-600">{{ $item->pasar_tujuan }}</td>
                                    <td class="py-3.5 px-6 text-center">
                                        <span class="{{ $badgeClass }} text-[10px] px-2.5 py-1 rounded-lg font-extrabold uppercase">{{ $item->jenis_lapak }}</span>
                                    </td>
                                    <td class="py-3.5 px-6 text-center">
                                        <div class="flex gap-2 justify-center items-center">
                                            <form action="{{ $routeAction }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="tindakan" value="setuju">
                                                <button type="submit" onclick="return confirm('Setujui pedagang ini?')" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-3 py-1.5 rounded-xl text-[10px] shadow-sm transition cursor-pointer flex items-center gap-1">
                                                    <i class="fa-solid fa-check"></i> Setujui
                                                </button>
                                            </form>
                                            <form action="{{ $routeAction }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="tindakan" value="tolak">
                                                <button type="submit" onclick="return confirm('Tolak permohonan pedagang ini?')" class="bg-rose-500 hover:bg-rose-600 text-white font-bold px-3 py-1.5 rounded-xl text-[10px] shadow-sm transition cursor-pointer flex items-center gap-1">
                                                    <i class="fa-solid fa-xmark"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-sm text-slate-400 font-normal">
                                        <i class="fa-solid fa-folder-open text-2xl block mb-2 text-slate-300"></i>
                                        Tidak ditemukan antrean permohonan baru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Chart 1: Revenue Trends
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctxRevenue, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartMonths) !!},
                    datasets: [{
                        label: 'Pendapatan Sah (Rp)',
                        data: {!! json_encode($chartDataRevenue) !!},
                        backgroundColor: '#0062E3',
                        borderColor: '#004BB3',
                        borderWidth: 1,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: { family: 'Poppins', size: 10 },
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            ticks: { font: { family: 'Poppins', size: 10 } }
                        }
                    }
                }
            });

            // Chart 2: Stall Segmentation
            const ctxLapak = document.getElementById('lapakChart').getContext('2d');
            new Chart(ctxLapak, {
                type: 'doughnut',
                data: {
                    labels: ['Kios', 'Los Pasar', 'Tenda'],
                    datasets: [{
                        data: {!! json_encode($chartLapakData) !!},
                        backgroundColor: ['#0062E3', '#10B981', '#A855F7'],
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: { font: { family: 'Poppins', size: 11 } }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>