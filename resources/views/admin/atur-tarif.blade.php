<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Tarif Pasar - SI-RETRIBUSI</title>
    
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
                <a href="{{ route('admin.kelola-tagihan') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-blue-100 hover:text-white transition">
                    <i class="fa-solid fa-file-invoice-dollar text-sm"></i> Kelola Tagihan
                </a>
                <a href="{{ route('admin.atur-tarif') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition">
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
            <h2 class="text-sm font-bold text-slate-800">Konfigurasi Besaran Tarif Retribusi Pasar</h2>
            
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
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-circle-check text-base"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-circle-exclamation text-base"></i> {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-5 lg:col-span-1">
                    <div>
                        <h4 class="font-extrabold text-base text-slate-900">Tambah Jenis Lapak Baru</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Buat parameter kategori lapak baru ke database.</p>
                    </div>
                    
                    <form action="{{ route('admin.atur-tarif.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-3">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Jenis Lapak</label>
                                <input type="text" name="jenis_lapak" placeholder="Contoh: Lapak Khusus Kontainer" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] transition" required>
                                @error('jenis_lapak') <p class="text-rose-600 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tarif Harian (Rp)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-xs font-bold text-slate-400">Rp</span>
                                    <input type="number" name="tarif_per_hari" placeholder="4000" class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] transition font-semibold" required>
                                </div>
                                @error('tarif_per_hari') <p class="text-rose-600 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Dasar Hukum Kebijakan</label>
                                <input type="text" name="dasar_hukum" placeholder="Perda No. 10/2026" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] transition">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md shadow-emerald-600/10 flex items-center justify-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-plus"></i> Daftarkan Jenis Lapak
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden lg:col-span-2">
                    <div class="p-6 border-b border-slate-100">
                        <h4 class="font-extrabold text-base text-slate-900">Ketentuan Master Tarif Aktif</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Kelola seluruh data tarif menggunakan aksi baca (Show), ubah (Edit), dan hapus (Delete).</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="py-3.5 px-6">Jenis Lapak</th>
                                    <th class="py-3.5 px-6 text-right">Tarif / Hari</th>
                                    <th class="py-3.5 px-6">Dasar Hukum Aturan</th>
                                    <th class="py-3.5 px-6 text-center">Aksi Pengelolaan</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs divide-y divide-slate-100 font-medium text-slate-700">
                                @foreach($tarifs as $item)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="py-4 px-6 font-bold text-slate-800">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-[#0062E3]"></span>
                                            {{ $item->jenis_lapak }}
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6 text-right font-mono font-bold text-slate-900">
                                        Rp {{ number_format($item->tarif_per_hari, 0, ',', '.') }}
                                    </td>

                                    <td class="py-4 px-6 truncate max-w-[180px] text-slate-500 font-normal">
                                        {{ $item->dasar_hukum ?: '-' }}
                                    </td>

                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button type="button" onclick="openShowModal('{{ $item->jenis_lapak }}', '{{ $item->tarif_per_hari }}', '{{ $item->dasar_hukum }}')" title="Detail Informasi" class="bg-slate-100 hover:bg-slate-200 text-slate-700 p-2 rounded-lg transition shadow-sm cursor-pointer">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>

                                            <button type="button" onclick="openEditModal('{{ $item->id }}', '{{ $item->jenis_lapak }}', '{{ $item->tarif_per_hari }}', '{{ $item->dasar_hukum }}')" title="Ubah Data" class="bg-[#0062E3] hover:bg-[#004BB3] text-white p-2 rounded-lg transition shadow-sm cursor-pointer">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            
                                            @if(!in_array($item->jenis_lapak, ['Kios', 'Los Pasar', 'Tenda']))
                                                <form action="{{ route('admin.atur-tarif.delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori lapak ini beserta standard tarifnya?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus Kategori" class="bg-rose-500 hover:bg-rose-600 text-white p-2 rounded-lg transition shadow-sm cursor-pointer">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" disabled title="Kategori Bawaan Sistem Terkunci" class="bg-slate-200 text-slate-400 p-2 rounded-lg cursor-not-allowed">
                                                    <i class="fa-solid fa-lock"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <div id="showModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl space-y-4">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <h3 class="font-extrabold text-base text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-[#0062E3]"></i> Detail Master Tarif
                </h3>
                <button type="button" onclick="closeShowModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="space-y-3 text-xs font-medium">
                <div class="grid grid-cols-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-400">Jenis Lapak</span>
                    <span id="show_jenis_lapak" class="col-span-2 font-bold text-slate-800">-</span>
                </div>
                <div class="grid grid-cols-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-400">Tarif / Hari</span>
                    <span id="show_tarif_hari" class="col-span-2 font-bold text-slate-900 font-mono">-</span>
                </div>
                <div class="grid grid-cols-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-400">Tarif / Bulan</span>
                    <span id="show_tarif_bulan" class="col-span-2 font-extrabold text-[#0062E3] font-mono">-</span>
                </div>
                <div class="grid grid-cols-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <span class="text-slate-400">Dasar Hukum</span>
                    <span id="show_dasar_hukum" class="col-span-2 text-slate-600 leading-relaxed font-normal">-</span>
                </div>
            </div>
            <button type="button" onclick="closeShowModal()" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 rounded-xl text-xs transition cursor-pointer">Tutup Detail</button>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl space-y-4">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <h3 class="font-extrabold text-base text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-[#0062E3]"></i> Ubah Nominal Tarif
                </h3>
                <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
            </div>
            
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kategori Lapak (Terkunci)</label>
                        <input type="text" id="edit_jenis_lapak" class="w-full px-3 py-2 bg-slate-100 border border-slate-200 text-slate-500 rounded-xl font-bold cursor-not-allowed focus:outline-none" readonly>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tarif Harian Baru (Rp)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 font-bold text-slate-400">Rp</span>
                            <input type="number" name="tarif_per_hari" id="edit_tarif_per_hari" class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-xl font-semibold focus:outline-none focus:border-[#0062E3] transition bg-white" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Penyesuaian Dasar Hukum Aturan</label>
                        <input type="text" name="dasar_hukum" id="edit_dasar_hukum" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] transition bg-white">
                    </div>
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="button" onclick="closeEditModal()" class="w-1/2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-xl text-xs transition cursor-pointer">Batal</button>
                    <button type="submit" class="w-1/2 bg-[#0062E3] hover:bg-[#004BB3] text-white font-bold py-3 rounded-xl text-xs transition shadow-sm cursor-pointer">Simpan Pembaruan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // --- Logic Show Detail ---
        function openShowModal(jenis, tarif, hukum) {
            const parsedTarif = parseInt(tarif);
            document.getElementById('show_jenis_lapak').innerText = jenis;
            document.getElementById('show_tarif_hari').innerText = 'Rp ' + parsedTarif.toLocaleString('id-ID');
            document.getElementById('show_tarif_bulan').innerText = 'Rp ' + (parsedTarif * 30).toLocaleString('id-ID');
            document.getElementById('show_dasar_hukum').innerText = hukum && hukum !== 'null' ? hukum : 'Belum diatur';
            
            document.getElementById('showModal').classList.remove('hidden');
        }

        function closeShowModal() {
            document.getElementById('showModal').classList.add('hidden');
        }

        // --- Logic Form Edit / Update ---
        function openEditModal(id, jenis, tarif, hukum) {
            document.getElementById('edit_jenis_lapak').value = jenis;
            document.getElementById('edit_tarif_per_hari').value = tarif;
            document.getElementById('edit_dasar_hukum').value = hukum && hukum !== 'null' ? hukum : '';
            
            document.getElementById('editForm').action = `/admin/atur-tarif/${id}/update`;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Mencegah penutupan tidak sengaja jika area latar belakang diklik
        window.onclick = function(event) {
            const showM = document.getElementById('showModal');
            const editM = document.getElementById('editModal');
            if (event.target == showM) closeShowModal();
            if (event.target == editM) closeEditModal();
        }
    </script>
</body>
</html>