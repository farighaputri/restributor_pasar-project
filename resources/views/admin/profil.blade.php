<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Administrator - SI-RETRIBUSI</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex min-h-screen">

    <!-- SIDEBAR (Synced with Admin Index) -->
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
                <a href="{{ route('admin.data-pedagang') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold text-blue-100 hover:bg-white/5 hover:text-white transition">
                    <i class="fa-solid fa-users text-sm"></i> Data Pedagang
                </a>
                <a href="{{ route('admin.kelola-tagihan') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-blue-100 hover:text-white transition">
                    <i class="fa-solid fa-file-invoice-dollar text-sm"></i> Kelola Tagihan
                </a>
                <a href="{{ route('admin.atur-tarif') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-blue-100 hover:text-white transition">
                    <i class="fa-solid fa-calculator text-sm"></i> Atur Tarif Pasar
                </a>
                <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition">
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

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- TOPBAR (Synced with Admin Index) -->
        <header class="bg-white h-16 border-b border-slate-100 flex items-center justify-between px-6 md:px-8 shrink-0 shadow-sm">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600 text-lg"><i class="fa-solid fa-bars"></i></button>
                <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-user-shield text-[#0062E3]"></i> Pengaturan Akun Resmi Dinas
                </h2>
            </div>
            
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

        <!-- CONTAINER BODY -->
        <div class="p-6 md:p-8 space-y-6 overflow-y-auto flex-1 bg-slate-50/50">
            
            <!-- Flash Message: Success -->
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm max-w-4xl">
                    <i class="fa-solid fa-circle-check text-sm text-emerald-600"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Flash Message: Error -->
            @if($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-xs font-semibold shadow-sm max-w-4xl">
                    <div class="flex items-center gap-2 mb-2 font-bold text-rose-800">
                        <i class="fa-solid fa-circle-exclamation"></i> Terjadi Kesalahan:
                    </div>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Pengaturan Profil -->
            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start max-w-4xl">
                @csrf
                
                <!-- Kiri: Unggah Foto Profil -->
                <div class="bg-white border border-slate-200 rounded-2xl p-6 text-center space-y-4 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 inset-x-0 h-[4px] bg-[#0062E3]"></div>
                    
                    <div class="w-28 h-28 rounded-full bg-slate-50 border-4 border-slate-100 flex items-center justify-center mx-auto relative overflow-hidden shadow-inner group">
                        @if(Auth::check() && Auth::user()->foto)
                            <img id="avatarPreview" src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                        @else
                            <div id="avatarPlaceholder" class="w-full h-full bg-[#0062E3] text-white font-bold flex items-center justify-center text-2xl uppercase">
                                AD
                            </div>
                            <img id="avatarPreview" class="w-full h-full object-cover hidden">
                        @endif
                    </div>
                    
                    <div class="space-y-2">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Foto Profil</span>
                        <label for="fotoInput" class="inline-block w-full text-center bg-blue-50 hover:bg-blue-100 text-[#0062E3] font-bold text-xs py-2 px-4 rounded-xl cursor-pointer transition border border-blue-100">
                            <i class="fa-solid fa-camera mr-1"></i> Pilih Foto
                        </label>
                        <input type="file" name="foto" id="fotoInput" accept="image/*" class="hidden"/>
                        <p class="text-[10px] text-slate-400">Format: JPG, PNG (Maks. 2MB)</p>
                    </div>
                </div>

                <!-- Kanan: Form Kredensial -->
                <div class="md:col-span-2 bg-white border border-slate-200 rounded-2xl p-6 md:p-8 space-y-6 shadow-sm">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 tracking-wide flex items-center gap-2">
                            <i class="fa-solid fa-id-card text-[#0062E3]"></i> Data Kredensial Admin
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-1">Anda masuk menggunakan akun seeder resmi. Email administrator tidak dapat diubah demi keamanan.</p>
                    </div>
                    
                    <hr class="border-slate-100">

                    <div class="space-y-5">
                        <!-- Input Nama -->
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Nama Lengkap Admin</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-xs">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all" required placeholder="Masukkan nama lengkap">
                            </div>
                        </div>

                        <!-- Input Email (Terunci) -->
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Email Dinas</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-xs">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="text" class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-xs text-slate-400 cursor-not-allowed font-semibold" value="{{ Auth::user()->email }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-[#0062E3] hover:bg-[#004BB3] text-white font-bold text-xs px-6 py-3.5 rounded-xl shadow-md transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Admin
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- JavaScript Image Preview Logic -->
    <script>
        document.getElementById('fotoInput').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('avatarPreview');
                const placeholder = document.getElementById('avatarPlaceholder');
                
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                if(placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>