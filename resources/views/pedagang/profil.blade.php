<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - SI-RETRIBUSI</title>
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
                <a href="{{ route('pedagang.informasi-lapak') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
                    <i class="fa-solid fa-store text-sm"></i> Informasi Lapak
                </a>
                <a href="{{ route('pedagang.profil') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition-all">
                    <i class="fa-solid fa-user-gear text-sm"></i> Profil Akun Saya
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-teal-700">
            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">@csrf</form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 bg-rose-500/10 hover:bg-rose-50 text-rose-200 hover:text-white rounded-xl text-xs font-bold transition-all duration-200">
                <i class="fa-solid fa-right-from-bracket text-sm"></i> Keluar Sistem
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <header class="bg-white h-16 border-b border-slate-200 flex items-center justify-between px-6 md:px-8 shadow-sm shrink-0">
            <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-user-gear text-teal-600"></i> Pengaturan Profil & Keamanan
            </h2>
            <a href="{{ route('pedagang.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-teal-700 transition flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-xl border border-slate-200 shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </header>

        <div class="p-6 md:p-8 space-y-6 overflow-y-auto flex-1 bg-slate-50/50">
            
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-2 max-w-4xl shadow-sm">
                    <i class="fa-solid fa-circle-check text-sm text-emerald-600"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-xs font-semibold max-w-4xl shadow-sm">
                    <div class="flex items-center gap-2 mb-2 font-bold text-rose-800">
                        <i class="fa-solid fa-circle-exclamation"></i> Harap periksa kesalahan berikut:
                    </div>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start max-w-4xl">
                
                <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center space-y-5 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 inset-x-0 h-[4px] bg-teal-600"></div>
                    
                    <div class="w-28 h-28 rounded-full bg-teal-50 border-4 border-slate-50 flex items-center justify-center mx-auto relative overflow-hidden shadow-inner group">
                        @if(Auth::check() && Auth::user()->foto)
                            <img id="avatarPreviewPedagang" src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                        @else
                            <div id="avatarPlaceholder" class="w-full h-full bg-teal-600 text-white font-bold flex items-center justify-center text-3xl uppercase">
                                {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
                            </div>
                            <img id="avatarPreviewPedagang" class="w-full h-full object-cover hidden">
                        @endif
                    </div>

                    <div>
                        <h4 class="text-sm font-bold text-slate-800">{{ Auth::user()->name ?? 'Nama Pedagang' }}</h4>
                        <p class="text-[10px] text-teal-600 font-bold uppercase tracking-wider mt-1 bg-teal-50 px-2 py-0.5 rounded-full inline-block">Pedagang Terverifikasi</p>
                    </div>

                    <hr class="border-slate-100">

                    <form action="{{ route('pedagang.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-left">
                        @csrf
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-slate-400 tracking-wider block">Ganti Foto Profil</label>
                            <label for="fotoInputPedagang" class="inline-block w-full text-center bg-slate-50 hover:bg-teal-50 text-slate-600 hover:text-teal-700 font-bold text-xs py-2 px-4 rounded-xl cursor-pointer transition border border-slate-200 hover:border-teal-200">
                                <i class="fa-solid fa-camera mr-1"></i> Pilih Gambar
                            </label>
                            <input type="file" name="foto" id="fotoInputPedagang" accept="image/*" class="hidden"/>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-xs">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name ?? '') }}" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:border-teal-600 focus:bg-white focus:ring-2 focus:ring-teal-100 transition" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs px-4 py-3 rounded-xl shadow-md shadow-teal-100 transition flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Data Diri
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 tracking-wide flex items-center gap-2">
                                <i class="fa-solid fa-id-card text-teal-600"></i> Informasi Identitas Sistem
                            </h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Data kependudukan permanen terdaftar yang diverifikasi oleh petugas dinas pasar.</p>
                        </div>
                        <hr class="border-slate-100">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Nomor Induk Kependudukan (KTP)</span>
                                <div class="bg-slate-100 border border-slate-200 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-500 flex items-center gap-2 select-none">
                                    <i class="fa-solid fa-address-card text-slate-400"></i> {{ Auth::user()->nik ?? '3201xxxxxxxxxxxx' }}
                                </div>
                            </div>
                            <div class="space-y-1">
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Username / ID Masuk</span>
                                <div class="bg-slate-100 border border-slate-200 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-500 flex items-center gap-2 select-none">
                                    <i class="fa-solid fa-fingerprint text-slate-400"></i> {{ Auth::user()->username ?? 'pedagang_aktif' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm space-y-4">
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 tracking-wide flex items-center gap-2">
                                <i class="fa-solid fa-key text-teal-600"></i> Perbarui Kata Sandi Akun
                            </h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Amankan akun Anda dengan mengganti kata sandi secara berkala menggunakan kombinasi kuat.</p>
                        </div>
                        <hr class="border-slate-100">
                        
                        <form action="{{ route('pedagang.password.update') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div class="space-y-1.5">
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Kata Sandi Sekarang</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-xs">
                                        <i class="fa-solid fa-lock text-slate-400"></i>
                                    </span>
                                    <input type="password" name="current_password" class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:border-teal-600 focus:bg-white focus:ring-2 focus:ring-teal-100 transition" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Kata Sandi Baru</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-xs">
                                            <i class="fa-solid fa-lock-open text-slate-400"></i>
                                        </span>
                                        <input type="password" name="password" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:border-teal-600 focus:bg-white focus:ring-2 focus:ring-teal-100 transition" placeholder="Minimal 8 karakter" required>
                                    </div>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Ulangi Kata Sandi Baru</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-xs">
                                            <i class="fa-solid fa-shield text-slate-400"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:border-teal-600 focus:bg-white focus:ring-2 focus:ring-teal-100 transition" placeholder="Harus sama dengan sandi baru" required>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2 flex justify-end">
                                <button type="submit" class="w-full sm:w-auto bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs px-6 py-3 rounded-xl shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                                    <i class="fa-solid fa-shield-halved"></i> Perbarui Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('fotoInputPedagang').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('avatarPreviewPedagang');
                const placeholder = document.getElementById('avatarPlaceholder');
                
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>