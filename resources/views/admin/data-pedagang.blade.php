<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pedagang - SI-RETRIBUSI</title>
    
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
                <a href="{{ route('admin.data-pedagang') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition">
                    <i class="fa-solid fa-users text-sm"></i> Data Pedagang
                </a>
                <a href="{{ route('admin.kelola-tagihan') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-blue-100 hover:text-white transition">
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
            <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-users text-[#0062E3]"></i> Manajemen Data Pedagang Pasar
            </h2>
            
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

            <form action="{{ route('admin.data-pedagang') }}" method="GET" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col lg:flex-row gap-4 justify-between items-center">
                <div class="relative w-full lg:w-80">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIK, atau nomor lapak..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:bg-white focus:ring-2 focus:ring-blue-100 transition font-medium">
                </div>

                <div class="flex flex-wrap w-full lg:w-auto gap-3 justify-end items-center">
                    <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 focus:outline-none focus:border-[#0062E3] focus:bg-white transition font-medium cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Aktif / Terverifikasi</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Menunggu Validasi</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>

                    <select name="pasar_tujuan" onchange="this.form.submit()" class="px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 focus:outline-none focus:border-[#0062E3] focus:bg-white transition font-medium cursor-pointer">
                        <option value="">Semua Pasar</option>
                        <option value="Pasar Raya Pusat" {{ request('pasar_tujuan') == 'Pasar Raya Pusat' ? 'selected' : '' }}>Pasar Raya Pusat</option>
                        <option value="Pasar Tradisional Barat" {{ request('pasar_tujuan') == 'Pasar Tradisional Barat' ? 'selected' : '' }}>Pasar Tradisional Barat</option>
                        <option value="Pasar Induk Timur" {{ request('pasar_tujuan') == 'Pasar Induk Timur' ? 'selected' : '' }}>Pasar Induk Timur</option>
                    </select>

                    @if(request()->filled('search') || request()->filled('status') || request()->filled('pasar_tujuan'))
                        <a href="{{ route('admin.data-pedagang') }}" class="text-xs text-slate-400 hover:text-[#0062E3] underline font-medium mr-2">Reset Filter</a>
                    @endif

                    <button type="button" onclick="openAddModal()" class="bg-[#0062E3] hover:bg-[#004BB3] text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-sm transition flex items-center gap-2 whitespace-nowrap cursor-pointer">
                        <i class="fa-solid fa-plus"></i> Tambah Pedagang
                    </button>
                </div>
            </form>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h4 class="font-extrabold text-base text-slate-900">Master Data Pedagang Pasar</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Seluruh berkas data pedagang aktif, antrean verifikasi, maupun riwayat penolakan.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="py-3 px-6 text-center">No</th>
                                <th class="py-3 px-6">Profil &amp; Nama</th>
                                <th class="py-3 px-6">NIK KTP</th>
                                <th class="py-3 px-6">Lokasi Pasar</th>
                                <th class="py-3 px-6 text-center">Jenis Lapak</th>
                                <th class="py-3 px-6 text-center">Status Akun</th>
                                <th class="py-3 px-6 text-center">Aksi Manajemen</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($pedagangs as $index => $pedagang)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="py-4 px-6 text-center text-slate-400 font-normal">{{ $index + 1 }}</td>
                                    
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl overflow-hidden shadow-inner bg-blue-50 border border-slate-100 shrink-0 flex items-center justify-center font-bold text-[#0062E3] text-xs">
                                                @if(!empty($pedagang->foto))
                                                    <img src="{{ asset('storage/' . $pedagang->foto) }}" class="w-full h-full object-cover">
                                                @elseif(isset($pedagang->user) && !empty($pedagang->user->foto))
                                                    <img src="{{ asset('storage/' . $pedagang->user->foto) }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ strtoupper(substr($pedagang->nama, 0, 1)) }}
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-bold text-slate-800 block">{{ $pedagang->nama }}</span>
                                                <span class="text-[10px] text-slate-400 block font-normal mt-0.5">{{ $pedagang->telepon }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-6 font-mono text-slate-500">{{ $pedagang->nik }}</td>
                                    <td class="py-4 px-6 font-normal">
                                        <span class="text-slate-800 font-semibold block">{{ $pedagang->pasar_tujuan ?? 'Belum ditentukan' }}</span>
                                        @if($pedagang->blok)
                                            <span class="text-[10px] bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded font-bold inline-block mt-1">Blok {{ $pedagang->blok }}</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="bg-blue-50 text-[#0062E3] text-[10px] px-2 py-0.5 rounded font-bold">{{ $pedagang->jenis_lapak }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        @php
                                            $statusClass = $pedagang->status === 'Disetujui' ? 'bg-emerald-50 text-emerald-600' : ($pedagang->status === 'Ditolak' ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-600');
                                            $statusLabel = $pedagang->status === 'Disetujui' ? 'Aktif' : ($pedagang->status === 'Ditolak' ? 'Ditolak' : 'Pending');
                                        @endphp
                                        <span class="{{ $statusClass }} text-[10px] px-2 py-0.5 rounded font-bold inline-block">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center space-x-1 whitespace-nowrap">
                                        <button type="button" onclick="openEditModal('{{ $pedagang->id }}', '{{ json_encode($pedagang) }}')" class="bg-slate-100 hover:bg-slate-200 text-slate-600 p-2 rounded-xl text-[11px] transition cursor-pointer" title="Edit Data"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" onclick="openShowModal('{{ json_encode($pedagang) }}')" class="bg-blue-50 hover:bg-blue-100 text-[#0062E3] p-2 rounded-xl text-[11px] transition cursor-pointer" title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                        <form action="{{ route('admin.data-pedagang.delete', $pedagang->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pedagang ini secara permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-xl text-[11px] transition cursor-pointer" title="Hapus Data"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-slate-400 font-normal">Tidak ada record data pedagang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div id="addModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-xl space-y-4 my-8">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <h3 class="font-bold text-base text-slate-900"><i class="fa-solid fa-user-plus text-emerald-600 mr-1"></i> Tambah Pedagang Manual</h3>
                <button type="button" onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('admin.data-pedagang.store') }}" method="POST" class="space-y-4 text-xs font-semibold text-slate-600">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-slate-500">Nama Lengkap</label>
                        <input type="text" name="nama" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-slate-500">NIK KTP (16 Digit)</label>
                        <input type="text" name="nik" maxlength="16" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-slate-500">No. WhatsApp</label>
                        <input type="text" name="telepon" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-slate-500">Email (Opsional)</label>
                        <input type="email" name="email" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="block text-slate-500">Alamat Rumah Lengkap</label>
                    <input type="text" name="alamat" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-slate-500">Pasar Tujuan</label>
                        <select name="pasar_tujuan" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] bg-slate-50 focus:bg-white transition cursor-pointer">
                            <option value="Pasar Raya Pusat">Pasar Raya Pusat</option>
                            <option value="Pasar Tradisional Barat">Pasar Tradisional Barat</option>
                            <option value="Pasar Induk Timur">Pasar Induk Timur</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-slate-500">Jenis Lapak</label>
                        <select name="jenis_lapak" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] bg-slate-50 focus:bg-white transition cursor-pointer">
                            @foreach($tarifs as $t)
                                <option value="{{ $t->jenis_lapak }}">{{ $t->jenis_lapak }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-slate-500">Blok / No Lapak</label>
                        <input type="text" name="blok" placeholder="A-12" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-slate-500">Komoditas Jualan</label>
                        <input type="text" name="komoditas" placeholder="Sembako" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="block text-slate-500">Status Verifikasi</label>
                    <select name="status" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] bg-slate-50 focus:bg-white transition cursor-pointer">
                        <option value="Disetujui">Aktif / Disetujui</option>
                        <option value="Pending">Pending / Validasi</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-3">
                    <button type="button" onclick="closeAddModal()" class="w-1/2 bg-slate-100 hover:bg-slate-200 py-3 rounded-xl font-bold transition cursor-pointer">Batal</button>
                    <button type="submit" class="w-1/2 bg-[#0062E3] hover:bg-[#004BB3] text-white py-3 rounded-xl font-bold transition shadow-sm cursor-pointer">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-xl space-y-4 my-8">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <h3 class="font-bold text-base text-slate-900"><i class="fa-solid fa-pen-to-square text-[#0062E3] mr-1"></i> Perbarui Profil Pedagang</h3>
                <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form id="editForm" method="POST" class="space-y-4 text-xs font-semibold text-slate-600">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-slate-500">Nama Lengkap</label>
                        <input type="text" name="nama" id="edit_nama" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-slate-500">NIK KTP</label>
                        <input type="text" name="nik" id="edit_nik" maxlength="16" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-slate-500">No. WhatsApp</label>
                        <input type="text" name="telepon" id="edit_telepon" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-slate-500">Email</label>
                        <input type="email" name="email" id="edit_email" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="block text-slate-500">Alamat Lengkap</label>
                    <input type="text" name="alamat" id="edit_alamat" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-slate-500">Pasar Tujuan</label>
                        <select name="pasar_tujuan" id="edit_pasar_tujuan" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] bg-slate-50 focus:bg-white transition cursor-pointer">
                            <option value="Pasar Raya Pusat">Pasar Raya Pusat</option>
                            <option value="Pasar Tradisional Barat">Pasar Tradisional Barat</option>
                            <option value="Pasar Induk Timur">Pasar Induk Timur</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-slate-500">Jenis Lapak</label>
                        <select name="jenis_lapak" id="edit_jenis_lapak" required class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] bg-slate-50 focus:bg-white transition cursor-pointer">
                            @foreach($tarifs as $t)
                                <option value="{{ $t->jenis_lapak }}">{{ $t->jenis_lapak }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-slate-500">Blok / No Lapak</label>
                        <input type="text" name="blok" id="edit_blok" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-slate-500">Komoditas Jualan</label>
                        <input type="text" name="komoditas" id="edit_komoditas" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] focus:bg-white transition">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="block text-slate-500">Status Akun</label>
                    <select name="status" id="edit_status" class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:border-[#0062E3] bg-slate-50 focus:bg-white transition cursor-pointer">
                        <option value="Disetujui">Disetujui</option>
                        <option value="Pending">Pending</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-3">
                    <button type="button" onclick="closeEditModal()" class="w-1/2 bg-slate-100 hover:bg-slate-200 py-3 rounded-xl font-bold transition cursor-pointer">Batal</button>
                    <button type="submit" class="w-1/2 bg-[#0062E3] hover:bg-[#004BB3] text-white py-3 rounded-xl font-bold transition shadow-sm cursor-pointer">Simpan Pembaruan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="showModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl space-y-4">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <h3 class="font-bold text-base text-slate-900"><i class="fa-solid fa-id-card text-[#0062E3] mr-1"></i> Informasi Lengkap Pedagang</h3>
                <button type="button" onclick="closeShowModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
            </div>
            
            <div id="show_avatar_container" class="w-20 h-20 mx-auto rounded-2xl overflow-hidden border border-slate-200 bg-blue-50 flex items-center justify-center text-xl font-bold text-[#0062E3] shadow-inner mb-4">
            </div>

            <div class="space-y-2.5 text-xs font-semibold text-slate-700">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100"><span class="text-slate-400 font-medium block mb-0.5">Nama Lengkap</span> <span id="show_nama" class="font-bold text-slate-800"></span></div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100"><span class="text-slate-400 font-medium block mb-0.5">NIK Nomor KTP</span> <span id="show_nik" class="font-mono text-slate-600"></span></div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100"><span class="text-slate-400 font-medium block mb-0.5">No. Kontak WhatsApp / Email</span> <span id="show_telepon"></span></div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100"><span class="text-slate-400 font-medium block mb-0.5">Alamat Domisili</span> <span id="show_alamat" class="font-normal text-slate-600"></span></div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100"><span class="text-slate-400 font-medium block mb-0.5">Lokasi Pasar &amp; Lapak</span> <span id="show_lapak" class="font-bold text-[#0062E3]"></span></div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100"><span class="text-slate-400 font-medium block mb-0.5">Komoditas Barang</span> <span id="show_komoditas" class="text-slate-800"></span></div>
            </div>
            <button type="button" onclick="closeShowModal()" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 rounded-xl text-xs transition cursor-pointer">Tutup Detail</button>
        </div>
    </div>

    <script>
        function openAddModal() { document.getElementById('addModal').classList.remove('hidden'); }
        function closeAddModal() { document.getElementById('addModal').classList.add('hidden'); }

        function openEditModal(id, dataJson) {
            const d = JSON.parse(dataJson);
            document.getElementById('edit_nama').value = d.nama;
            document.getElementById('edit_nik').value = d.nik;
            document.getElementById('edit_telepon').value = d.telepon;
            document.getElementById('edit_email').value = d.email ? d.email : '';
            document.getElementById('edit_alamat').value = d.alamat;
            document.getElementById('edit_pasar_tujuan').value = d.pasar_tujuan;
            document.getElementById('edit_jenis_lapak').value = d.jenis_lapak;
            document.getElementById('edit_blok').value = d.blok;
            document.getElementById('edit_komoditas').value = d.komoditas;
            document.getElementById('edit_status').value = d.status;

            document.getElementById('editForm').action = `/admin/data-pedagang/${id}/update`;
            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }

        function openShowModal(dataJson) {
            const d = JSON.parse(dataJson);
            document.getElementById('show_nama').innerText = d.nama;
            document.getElementById('show_nik').innerText = d.nik;
            document.getElementById('show_telepon').innerText = d.telepon + (d.email ? ' | ' + d.email : '');
            document.getElementById('show_alamat').innerText = d.alamat;
            document.getElementById('show_lapak').innerText = d.pasar_tujuan + ' - ' + d.jenis_lapak + ' (Blok ' + d.blok + ')';
            document.getElementById('show_komoditas').innerText = d.komoditas;

            const avatarContainer = document.getElementById('show_avatar_container');
            const fotoPath = d.foto || (d.user ? d.user.foto : null);
            
            if (fotoPath) {
                avatarContainer.innerHTML = `<img src="/storage/${fotoPath}" class="w-full h-full object-cover">`;
            } else {
                avatarContainer.innerHTML = d.nama.substring(0, 1).toUpperCase();
            }

            document.getElementById('showModal').classList.remove('hidden');
        }
        function closeShowModal() { document.getElementById('showModal').classList.add('hidden'); }
    </script>
</body>
</html>