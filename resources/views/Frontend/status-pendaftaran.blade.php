<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran - SI-RETRIBUSI</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-8">

    <div class="w-full max-w-2xl bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden">
        
        <div class="bg-gradient-to-r 
            {{ $pedagang->status === 'Disetujui' ? 'from-emerald-600 to-teal-700' : ($pedagang->status === 'Ditolak' ? 'from-rose-600 to-red-700' : 'from-[#0062E3] to-blue-700') }} 
            text-white p-6 sm:p-8 md:p-10 text-center sm:text-left">
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center text-2xl shrink-0">
                    @if($pedagang->status === 'Disetujui')
                        <i class="fa-solid fa-circle-check"></i>
                    @elseif($pedagang->status === 'Ditolak')
                        <i class="fa-solid fa-circle-xmark"></i>
                    @else
                        <i class="fa-solid fa-clock animate-pulse"></i>
                    @endif
                </div>
                <div>
                    <p class="text-[10px] sm:text-xs uppercase tracking-[0.2em] text-white/80 font-bold">Status Pendaftaran</p>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-0.5">
                        @if($pedagang->status === 'Disetujui')
                            Terverifikasi Aktif
                        @elseif($pedagang->status === 'Ditolak')
                            Pendaftaran Ditolak
                        @else
                            Menunggu Verifikasi
                        @endif
                    </h1>
                </div>
            </div>
            <p class="mt-4 text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                {{ $pedagang->status === 'Disetujui' 
                    ? 'Selamat! Berkas pendaftaran Anda telah disetujui oleh dinas terkait. Akun Anda kini siap digunakan.' 
                    : ($pedagang->status === 'Ditolak' 
                        ? 'Mohon maaf, permohonan pendaftaran Anda ditolak karena berkas data tidak sesuai ketentuan atau belum lengkap.' 
                        : 'Terima kasih telah mengirim pendaftaran mandiri. Berkas Anda sedang dalam antrean pemeriksaan tim dinas.') }}
            </p>
        </div>

        <div class="p-6 sm:p-8 space-y-6">
            
            <div class="text-center py-4 bg-slate-50 border border-slate-100 rounded-2xl">
                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Nomor Registrasi Anda</p>
                <h3 id="registration-number" class="text-2xl sm:text-3xl font-mono font-bold text-slate-800 mt-1">
                    RP-{{ str_pad($pedagang->id, 8, '0', STR_PAD_LEFT) }}
                </h3>
                <p class="text-[11px] text-slate-400 mt-1.5">Gunakan nomor referensi di atas untuk pelacakan berkas pendaftaran.</p>
            </div>

            <div class="border border-slate-100 p-5 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4
                {{ $pedagang->status === 'Disetujui' ? 'bg-emerald-50/50' : ($pedagang->status === 'Ditolak' ? 'bg-rose-50/50' : 'bg-amber-50/40') }}">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg shrink-0
                        {{ $pedagang->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-700' : ($pedagang->status === 'Ditolak' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                        <i class="fa-solid fa-circle-nodes"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider text-slate-400 font-bold">Progres Peninjauan</p>
                        <p class="text-xs sm:text-sm text-slate-700 font-semibold mt-0.5">
                            {{ $pedagang->status === 'Disetujui' ? 'Selesai & Disahkan' : ($pedagang->status === 'Ditolak' ? 'Dibatalkan / Selesai' : 'Sedang Diperiksa Dokumen') }}
                        </p>
                    </div>
                </div>
                <div>
                    <span class="inline-flex rounded-full text-xs font-bold px-4 py-1.5 shadow-sm
                        {{ $pedagang->status === 'Disetujui' ? 'bg-emerald-600 text-white' : ($pedagang->status === 'Ditolak' ? 'bg-rose-600 text-white' : 'bg-amber-500 text-white') }}">
                        {{ $pedagang->status }}
                    </span>
                </div>
            </div>

            @if($pedagang->status === 'Disetujui' && isset($user))
                <div class="border border-slate-200 bg-white p-5 rounded-2xl shadow-sm space-y-3 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50/50 rounded-full translate-x-8 -translate-y-8 flex items-center justify-center">
                        <i class="fa-solid fa-key text-blue-200/60 text-3xl"></i>
                    </div>
                    <h4 class="text-xs uppercase tracking-wider text-blue-600 font-bold flex items-center gap-2">
                        <i class="fa-solid fa-lock-open"></i> Informasi Akses Masuk Sistem
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-[10px] text-slate-400 font-bold block uppercase">Username (NIK KTP)</span>
                            <span class="text-sm font-mono font-bold text-slate-800">{{ $user->nik ?? $pedagang->nik }}</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-[10px] text-slate-400 font-bold block uppercase">Password Bawaan</span>
                            <span class="text-sm font-semibold text-slate-800">password123</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-400 italic"><span class="text-amber-500 font-bold">*</span> Harap segera lakukan penggantian password default setelah masuk pertama kali demi keamanan akun.</p>
                </div>
            @endif

            <div class="border border-slate-100 p-5 rounded-2xl bg-white shadow-inner-sm">
                <h4 class="text-xs uppercase tracking-wider text-slate-400 font-bold flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-slate-300"></i> Catatan Penting Prosedur
                </h4>
                <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-500">
                    Petugas Admin Dinas Pasar akan mencocokkan lampiran dokumen identitas diri dengan kapasitas sisa ketersediaan lapak/los pasar yang Anda pilih. Pemrosesan data memakan waktu maksimal **1-3 hari kerja**.
                </p>
            </div>

            <div class="text-center pt-2">
                <a href="{{ route('beranda') }}" class="inline-flex items-center justify-center rounded-full bg-[#0062E3] px-8 py-3 text-sm font-bold text-white shadow-lg shadow-blue-500/10 hover:bg-[#0b4db8] transition-all hover:-translate-y-0.5">
                    <i class="fa-solid fa-house mr-2"></i> Kembali ke Beranda Utama
                </a>
            </div>

        </div>
    </div>

</body>
</html>