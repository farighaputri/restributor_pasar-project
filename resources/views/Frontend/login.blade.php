<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SI-RETRIBUSI</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-800 min-h-screen grid grid-cols-1 md:grid-cols-2 antialiased">

    <div class="hidden md:flex relative p-16 flex-col justify-between text-white overflow-hidden bg-slate-900">
        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=1000" 
             alt="Pasar Tradisional" 
             class="absolute inset-0 h-full w-full object-cover object-center opacity-40 z-0">
        
        <div class="absolute inset-0 bg-gradient-to-t from-[#004BB3] via-[#0062E3]/80 to-slate-900/40 z-10"></div>

        <div class="relative z-20">
            <a href="{{ url('/') }}" class="font-bold text-lg tracking-wider flex items-center gap-2 hover:text-blue-200 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i> SI-RETRIBUSI
            </a>
        </div>

        <div class="relative z-20 my-auto max-w-md space-y-4">
            <div class="bg-white/10 backdrop-blur-md w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm border border-white/10">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h2 class="text-4xl font-extrabold leading-tight tracking-tight">
                Kemudahan Pengelolaan Retribusi Pasar.
            </h2>
            <p class="text-sm text-blue-100/90 leading-relaxed font-light">
                Silakan masuk untuk mengelola data pedagang, memantau tagihan secara langsung, dan melakukan transaksi pembayaran transparan.
            </p>
        </div>

        <div class="relative z-20 text-xs text-blue-200/60 font-medium">
            &copy; 2026 SI-RETRIBUSI. Semua Hak Dilindungi.
        </div>
    </div>

    <div class="flex flex-col justify-center px-6 sm:px-16 lg:px-24 py-12 bg-white relative">
        
        <div class="absolute top-6 left-6 block md:hidden">
            <a href="{{ url('/') }}" class="text-xs font-bold text-[#0062E3] flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Beranda
            </a>
        </div>

        <div class="w-full max-w-md mx-auto">
            <div class="mb-10 text-center md:text-left">
                <span class="block md:hidden font-bold text-xl tracking-wider text-[#0062E3] mb-6">SI-RETRIBUSI</span>
                
                <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h3>
                <p class="text-xs text-slate-400 mt-2 font-medium">Silakan masukkan akun resmi Anda untuk melanjutkan akses</p>
            </div>

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf
                @if ($errors->any())
                    <div class="rounded-3xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="mt-2 list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="space-y-2">
                    <label for="identity" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Email atau NIK Pedagang</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" id="identity" name="identity" required placeholder="contoh: pedagang@email.com atau NIK" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 focus:border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0062E3]/20 focus:bg-white transition font-medium placeholder-slate-400">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Kata Sandi</label>
                        <a href="#" class="text-xs font-semibold text-[#0062E3] hover:underline">Lupa Sandi?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 text-sm">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" required placeholder="••••••••" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 focus:border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#0062E3]/20 focus:bg-white transition font-medium placeholder-slate-400">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-[#0062E3] border-slate-300 rounded focus:ring-[#0062E3]">
                        <label for="remember" class="ml-2 text-xs font-medium text-slate-500 select-none">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#0062E3] hover:bg-[#004BB3] text-white font-bold py-3.5 px-4 rounded-xl text-sm shadow-md shadow-blue-200 hover:shadow-lg transition flex items-center justify-center gap-2 group mt-4">
                    Masuk ke Sistem
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition duration-200"></i>
                </button>
            </form>

            <div class="text-center mt-10 pt-6 border-t border-slate-100">
    <p class="text-xs text-slate-500 font-medium">
        Belum memiliki akun pedagang resmi? 
        <a href="{{ route('daftar-pedagang') }}" class="text-[#0062E3] font-bold hover:underline ml-0.5">Daftar Sekarang</a>
    </p>
</div>
        </div>
    </div>

</body>
</html>