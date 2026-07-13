<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami & Chat AI - SI-RETRIBUSI</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        
        .chat-container::-webkit-scrollbar { width: 5px; }
        .chat-container::-webkit-scrollbar-track { background: #f1f1f1; }
        .chat-container::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50/50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- NAVIGATION BAR -->
    <nav class="bg-[#0062E3] text-white py-4 px-6 md:px-16 flex justify-between items-center sticky top-0 z-50 shadow-md">
        <div class="font-bold text-lg tracking-wider">
    <a href="{{ route('beranda') }}" class="flex items-center">
        <img src="{{ asset('assets/logo.png') }}" alt="SI-RETRIBUSI"
             class="h-8 w-auto"
             style="transform: scale(6); transform-origin: left center;">
    </a>
</div>
        <div class="hidden md:flex space-x-6 items-center text-sm font-medium">
            <a href="{{ route('beranda') }}" class="hover:text-gray-200">Beranda</a>
            <a href="{{ route('tentang') }}" class="hover:text-gray-200">Tentang</a>
            <a href="{{ route('tarif') }}" class="hover:text-gray-200">Tarif</a>
            <a href="{{ route('informasi') }}" class="hover:text-gray-200">Informasi</a>
            <a href="{{ route('kontak') }}" class="hover:text-gray-200 font-bold underline">Kontak</a>
            @auth
                <a href="{{ route('pedagang.dashboard') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-white text-[#0062E3] px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition shadow-sm">Masuk</a>
            @endauth
        </div>
    </nav>

    <!-- HEADER -->
    <header class="bg-gradient-to-r from-[#0062E3] to-[#004BB3] text-white py-12 px-6 md:px-16 text-center relative overflow-hidden shrink-0">
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
        <div class="relative z-10">
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-1">Pusat Bantuan Digital</h1>
            <p class="text-xs text-blue-100 max-w-xl mx-auto opacity-90 font-light">
                Gunakan asisten pintar terpandu kami untuk mendapatkan informasi instan seputar pengelolaan lapak retribusi.
            </p>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="container mx-auto px-4 md:px-16 py-8 max-w-7xl grid grid-cols-1 lg:grid-cols-5 gap-8 flex-1">
        
        <!-- INTERMUKA PERCAKAPAN CHAT AI -->
        <div class="lg:col-span-3 bg-white rounded-2xl border border-slate-200 shadow-sm flex flex-col h-[550px] overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-100 p-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 text-[#0062E3] rounded-full flex items-center justify-center text-lg relative">
                        <i class="fa-solid fa-robot"></i>
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full absolute bottom-0 right-0 border-2 border-white animate-pulse"></span>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-800">Panduan Asisten SI-RETRIBUSI</h4>
                        <p class="text-[10px] text-emerald-600 font-medium">Sistem Penjawab Terbimbing Dinamis</p>
                    </div>
                </div>
                <button onclick="resetChat()" class="text-[10px] font-bold text-slate-400 hover:text-rose-600 transition flex items-center gap-1">
                    <i class="fa-solid fa-arrow-rotate-left"></i> Reset Chat
                </button>
            </div>

            <div id="chat-box" class="chat-container flex-1 p-4 overflow-y-auto space-y-4 bg-slate-50/40">
                <!-- Awal Pesan Pembuka AI Bawaan -->
                <div class="flex items-start gap-2.5 max-w-[85%]">
                    <div class="w-7 h-7 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-robot text-[10px]"></i>
                    </div>
                    <div class="bg-white border border-slate-100 p-3.5 rounded-2xl rounded-tl-none shadow-sm space-y-3">
                        <p class="text-xs text-slate-700 leading-relaxed">
                            Halo! Agar Anda mendapatkan rincian data regulasi secara akurat, silakan pilih salah satu **topik utama layanan** yang telah disediakan di bawah ini:
                        </p>
                        
                        <!-- Kontainer Opsi Awal (Chips) -->
                        <div class="follow-up-container flex flex-wrap gap-2 pt-1">
                            <button type="button" onclick="sendQuickOption('Berapa rincian tarif retribusi per hari?', this)" class="bg-blue-50 hover:bg-[#0062E3] text-[#0062E3] hover:text-white border border-blue-200 px-3 py-1.5 rounded-xl text-[11px] font-bold text-left transition duration-200">
                                📋 Cek Rincian Tarif Harian
                            </button>
                            <button type="button" onclick="sendQuickOption('Bagaimana metode cara bayar tagihan pasar?', this)" class="bg-blue-50 hover:bg-[#0062E3] text-[#0062E3] hover:text-white border border-blue-200 px-3 py-1.5 rounded-xl text-[11px] font-bold text-left transition duration-200">
                                💳 Metode Cara Pembayaran
                            </button>
                            <button type="button" onclick="sendQuickOption('Bagaimana alur pendaftaran pedagang baru?', this)" class="bg-blue-50 hover:bg-[#0062E3] text-[#0062E3] hover:text-white border border-blue-200 px-3 py-1.5 rounded-xl text-[11px] font-bold text-left transition duration-200">
                                📝 Alur Registrasi Pedagang
                            </button>
                            <button type="button" onclick="sendQuickOption('Bagaimana jika saya terlambat membayar iuran?', this)" class="bg-blue-50 hover:bg-[#0062E3] text-[#0062E3] hover:text-white border border-blue-200 px-3 py-1.5 rounded-xl text-[11px] font-bold text-left transition duration-200">
                                ⚠️ Aturan Keterlambatan
                            </button>
                        </div>
                        <span class="text-[9px] text-slate-400 block mt-1 text-right font-normal">Sistem Utama</span>
                    </div>
                </div>
            </div>

            <!-- Form input bawah -->
            <form id="chat-form" class="p-3 border-t border-slate-100 bg-white flex gap-2 items-center">
                <input type="text" id="chat-input" autocomplete="off" placeholder="Pilih opsi tindak lanjut di atas atau ketik di sini..." 
                    class="flex-1 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-[#0062E3] focus:bg-white transition font-medium text-slate-700">
                <button type="submit" class="bg-[#0062E3] hover:bg-[#004BB3] text-white p-2.5 rounded-xl text-xs transition shadow-md shadow-blue-500/10 shrink-0">
                    <i class="fa-solid fa-paper-plane px-1"></i>
                </button>
            </form>
        </div>

        <!-- KONTAK KANTOR -->
        <div class="lg:col-span-2 space-y-4">
            <h3 class="text-base font-extrabold text-slate-900 tracking-wide">Kontak Operasional Kantor</h3>
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-start gap-3">
                    <div class="bg-blue-50 text-[#0062E3] w-9 h-9 rounded-xl flex items-center justify-center text-sm shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h5 class="font-bold text-[10px] text-slate-400 uppercase tracking-wider">Alamat Kantor</h5>
                        <p class="text-xs text-slate-800 font-semibold mt-0.5 leading-relaxed">Jl. Pemuda No. 45, Kompleks Pemda, Gedung B Lantai 2.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="bg-blue-50 text-[#0062E3] w-9 h-9 rounded-xl flex items-center justify-center text-sm shrink-0">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h5 class="font-bold text-[10px] text-slate-400 uppercase tracking-wider">Call Center</h5>
                        <p class="text-xs text-slate-800 font-extrabold mt-0.5">(021) 1234567</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

 <footer class="bg-[#004BB3] text-white pt-12 pb-8 px-6 md:px-16">
    <div class="container mx-auto max-w-7xl grid grid-cols-1 md:grid-cols-4 gap-8 text-sm border-b border-blue-400/30 pb-10">

        <!-- Logo & Deskripsi -->
        <div class="md:col-span-1">
            <a href="{{ route('beranda') }}" class="flex items-center">
        <img src="{{ asset('assets/logo.png') }}" alt="SI-RETRIBUSI"
             class="h-8 w-auto"
             style="transform: scale(6); transform-origin: left center;">
    </a><br>

            <p class="leading-relaxed text-xs text-blue-100 mb-6 font-medium">
                Sistem informasi retribusi pasar yang modern, transparan, dan mudah digunakan untuk semua.
            </p>
             <p class="font-semibold mb-3 text-xs uppercase tracking-wider text-blue-200">Ikuti Kami</p>
            <div class="flex space-x-4 text-lg">
                <a href="#" class="hover:text-blue-200 transition">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" class="hover:text-blue-200 transition">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="#" class="hover:text-blue-200 transition">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>

        <!-- Layanan -->
        <div>
            <h5 class="font-bold mb-4 text-xs tracking-wider uppercase text-blue-200">
                Layanan
            </h5>

            <ul class="space-y-2 text-xs text-blue-50">
                @auth
                    <li>
                        <a href="{{ route('pedagang.tagihan') }}" class="hover:underline">
                            Cek Tagihan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pedagang.tagihan') }}" class="hover:underline">
                            Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pedagang.riwayat-bayar') }}" class="hover:underline">
                            Riwayat Pembayaran
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="hover:underline">
                            Cek Tagihan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="hover:underline">
                            Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="hover:underline">
                            Riwayat Pembayaran
                        </a>
                    </li>
                @endauth

                <li>
                    <a href="{{ route('tarif') }}" class="hover:underline">
                        Informasi Tarif
                    </a>
                </li>
            </ul>
        </div>

        <!-- Informasi -->
        <div>
            <h5 class="font-bold mb-4 text-xs tracking-wider uppercase text-blue-200">
                Informasi
            </h5>

            <ul class="space-y-2 text-xs text-blue-50">
                <li>
                    <a href="{{ route('tentang') }}" class="hover:underline">
                        Tentang Retribusi
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:underline">
                        FAQ
                    </a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}" class="hover:underline">
                        Kontak
                    </a>
                </li>
            </ul>
        </div>

        <!-- Hubungi Kami -->
        <div>
            <h5 class="font-bold mb-4 text-xs tracking-wider uppercase text-blue-200">
                Hubungi Kami
            </h5>

            <ul class="space-y-2 text-xs text-blue-50">
                <li>
                    <i class="fa-solid fa-building mr-2"></i>
                    Dinas Pasar Wilayah
                </li>
                <li>
                    <i class="fa-solid fa-envelope mr-2"></i>
                    support@si-retribusi.go.id
                </li>
                <li>
                    <i class="fa-solid fa-phone mr-2"></i>
                    (021) 889-2341
                </li>
            </ul>
        </div>

    </div>

    <!-- Copyright -->
    <div class="flex items-center justify-center gap-3 pt-6 text-xs text-blue-200">
        <span>&copy; 2026</span>

        <span>All Rights Reserved.</span>
    </div>
</footer>

    <!-- JAVASCRIPT AJAX CONTROLLER DENGAN DYNAMIC CHIPS HANDLING -->
    <script>
        const initialChatContent = document.getElementById('chat-box').innerHTML;

        function resetChat() {
            document.getElementById('chat-box').innerHTML = initialChatContent;
        }

        // Fungsi ketika tombol follow-up diklik
        function sendQuickOption(messageText, element) {
            document.getElementById('chat-input').value = messageText;
            document.getElementById('chat-form').requestSubmit();
        }

        document.getElementById('chat-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const inputField = document.getElementById('chat-input');
            const chatBox = document.getElementById('chat-box');
            let userMessage = inputField.value.trim();
            
            if (!userMessage) return;

            // Hapus ikon emoji awalan dari tombol follow up agar pencarian backend bersih
            userMessage = userMessage.replace(/[\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDD00-\uDFFF]/g, "").trim();

            const timeString = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            
            // 1. Matikan/Sembunyikan semua tombol opsi yang ada di atas agar user fokus pada jawaban baru
            document.querySelectorAll('.follow-up-container').forEach(el => el.remove());

            // 2. Cetak pesan user ke chatroom
            const userBubble = `
                <div class="flex items-start gap-2.5 max-w-[85%] ml-auto justify-end">
                    <div class="bg-[#0062E3] text-white p-3 rounded-2xl rounded-tr-none shadow-sm">
                        <p class="text-xs font-semibold leading-relaxed">${escapeHtml(userMessage)}</p>
                        <span class="text-[9px] text-blue-200 block mt-1 text-right">${timeString}</span>
                    </div>
                </div>
            `;
            chatBox.insertAdjacentHTML('beforeend', userBubble);
            inputField.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            // 3. Cetak animasi loading tunggu
            const loadingId = 'loading-' + Date.now();
            const loadingBubble = `
                <div id="${loadingId}" class="flex items-start gap-2.5 max-w-[85%] animate-pulse">
                    <div class="w-7 h-7 bg-slate-300 text-slate-500 text-xs rounded-full flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-robot text-[10px]"></i>
                    </div>
                    <div class="bg-white border border-slate-200 p-3 rounded-2xl rounded-tl-none shadow-sm">
                        <p class="text-xs text-slate-400 italic font-medium">Sedang memproses pertanyaan lanjutan...</p>
                    </div>
                </div>
            `;
            chatBox.insertAdjacentHTML('beforeend', loadingBubble);
            chatBox.scrollTop = chatBox.scrollHeight;

            try {
                const response = await fetch("{{ route('kontak.chat_ai') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ message: userMessage })
                });

                const data = await response.json();
                document.getElementById(loadingId).remove();

                if (data.status === 'success') {
                    // 4. Bangun string HTML untuk tombol follow up dinamis dari backend
                    let followUpButtonsHtml = '';
                    if (data.follow_ups && data.follow_ups.length > 0) {
                        followUpButtonsHtml = `<div class="follow-up-container flex flex-wrap gap-2 pt-2 border-t border-slate-100 mt-2">`;
                        data.follow_ups.forEach(btnText => {
                            followUpButtonsHtml += `
                                <button type="button" onclick="sendQuickOption('${escapeHtml(btnText)}', this)" class="bg-slate-50 hover:bg-[#0062E3] text-slate-600 hover:text-white border border-slate-200 px-2.5 py-1.5 rounded-xl text-[10px] font-bold text-left transition duration-200 shadow-xs">
                                    ${escapeHtml(btnText)}
                                </button>
                            `;
                        });
                        followUpButtonsHtml += `</div>`;
                    }

                    // 5. Cetak Balasan AI beserta Tombol Lanjutan Barunya
                    const aiBubble = `
                        <div class="flex items-start gap-2.5 max-w-[85%]">
                            <div class="w-7 h-7 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-robot text-[10px]"></i>
                            </div>
                            <div class="bg-white border border-slate-100 p-3.5 rounded-2xl rounded-tl-none shadow-sm text-xs text-slate-700 leading-relaxed font-medium space-y-1 text-justify">
                                ${data.reply}
                                ${followUpButtonsHtml}
                                <span class="text-[9px] text-slate-400 block mt-2 text-right font-normal">${timeString}</span>
                            </div>
                        </div>
                    `;
                    chatBox.insertAdjacentHTML('beforeend', aiBubble);
                }
            } catch (error) {
                document.getElementById(loadingId).remove();
                const errorBubble = `
                    <div class="flex items-start gap-2.5 max-w-[85%]">
                        <div class="w-7 h-7 bg-rose-500 text-white text-xs rounded-full flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i>
                        </div>
                        <div class="bg-rose-50 border border-rose-100 p-3 rounded-2xl rounded-tl-none text-rose-700 text-xs font-semibold">
                            Gagal memuat balasan otomatis. Periksa jaringan local proyek Anda.
                        </div>
                    </div>
                `;
                chatBox.insertAdjacentHTML('beforeend', errorBubble);
            }

            chatBox.scrollTop = chatBox.scrollHeight;
        });

        function escapeHtml(text) {
            return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }
    </script>
</body>
</html>