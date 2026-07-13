<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gedung Administrasi - SI-RETRIBUSI</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 antialiased min-h-screen flex flex-col justify-between">

    <header class="p-6 flex justify-between items-center border-b border-slate-800 shrink-0 bg-slate-950/40 backdrop-blur">
        <div class="flex items-center gap-2.5">
            <div class="bg-blue-600 text-white w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs">R</div>
            <span class="font-bold tracking-wider text-xs text-slate-300">SI-RETRIBUSI SYSTEM</span>
        </div>
        <a href="{{ route('beranda') }}" class="text-xs font-bold text-slate-400 hover:text-white transition flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Portal
        </a>
    </header>

    <main class="px-4 py-8 flex items-center justify-center flex-1 shrink-0">
        <div class="w-full max-w-sm bg-slate-950 p-8 rounded-2xl border border-slate-800 shadow-2xl space-y-6 relative overflow-hidden">
            <div class="absolute top-0 inset-x-0 h-[2px] bg-gradient-to-r from-transparent via-blue-500 to-transparent"></div>
            
            <div class="text-center space-y-1">
                <div class="w-12 h-12 bg-blue-500/10 text-blue-400 rounded-2xl flex items-center justify-center mx-auto text-xl font-extrabold border border-blue-500/20 shadow-xs">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <h3 class="text-lg font-bold text-white tracking-wide pt-2">Otentikasi Administrator</h3>
                <p class="text-[11px] text-slate-500 font-medium">Gunakan akun Dinas resmi untuk mengakses panel kendali utama.</p>
            </div>

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                @csrf

                @if($errors->any())
                    <div class="p-3 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs rounded-xl font-medium flex items-start gap-2">
                        <i class="fa-solid fa-circle-exclamation text-sm shrink-0 mt-0.5"></i>
                        <ul class="list-disc pl-4 space-y-0.5 font-semibold">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-1.5">
                    <label for="identity" class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Email Dinas / NIP</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-600">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </span>
                        <input type="text" id="identity" name="identity" value="{{ old('identity') }}" required placeholder="admin@si-retribusi.id" 
                            class="w-full pl-9 pr-4 py-2.5 bg-slate-900 border border-slate-800 text-white rounded-xl text-xs focus:outline-none focus:border-blue-500 transition font-medium placeholder-slate-600">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kata Sandi Akun</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-600">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </span>
                        <input type="password" id="password" name="password" required placeholder="••••••••" 
                            class="w-full pl-9 pr-10 py-2.5 bg-slate-900 border border-slate-800 text-white rounded-xl text-xs focus:outline-none focus:border-blue-500 transition font-medium placeholder-slate-600">
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2 mt-2">
                    <i class="fa-solid fa-right-to-bracket text-xs"></i> Masuk Ruang Panel
                </button>
            </form>
        </div>
    </main>

    <footer class="p-4 border-t border-slate-800 text-center text-[10px] text-slate-600 font-medium tracking-wide">
        &copy; 2026 SI-RETRIBUSI. Protected Under Secure Admin Authentication.
    </footer>
</body>
</html>