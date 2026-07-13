<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Saya - SI-RETRIBUSI</title>
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
                <a href="{{ route('pedagang.dashboard') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-xs font-semibold text-teal-100 hover:text-white transition-all">
                    <i class="fa-solid fa-house-user text-sm"></i> Beranda Utama
                </a>
                <a href="{{ route('pedagang.tagihan') }}" class="flex items-center gap-3 px-4 py-3 bg-white/10 rounded-xl text-xs font-bold transition-all">
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
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 bg-rose-500/10 hover:bg-rose-50 text-rose-200 hover:text-white rounded-xl text-xs font-bold transition-all duration-200">
                <i class="fa-solid fa-right-from-bracket text-sm"></i> Keluar Sistem
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <header class="bg-white h-16 border-b border-slate-200 flex items-center justify-between px-6 md:px-8 shadow-sm">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-slate-600 text-lg"><i class="fa-solid fa-bars"></i></button>
                <h2 class="text-sm font-bold text-slate-800">Rincian Lembar Invoice Tagihan Anda</h2>
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

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Akumulasi Belum Dibayar</p>
                        <h3 class="text-3xl font-extrabold text-rose-600 mt-1">Rp {{ number_format($tagihans->where('status', 'Belum Dibayar')->sum('nominal'), 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-rose-50 text-rose-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Total Pembayaran Lunas</p>
                        <h3 class="text-3xl font-extrabold text-emerald-600 mt-1">Rp {{ number_format($tagihans->where('status', 'Lunas')->sum('nominal'), 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-emerald-50 text-emerald-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl shadow-inner">
                        <i class="fa-solid fa-vault"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h4 class="font-bold text-base text-slate-900">Berkas Rekam Invoice Pembayaran</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Berikut adalah detail seluruh tagihan bulanan yang diterbitkan oleh sistem dinas.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="py-3.5 px-6 text-center">No</th>
                                <th class="py-3.5 px-6">ID Invoice</th>
                                <th class="py-3.5 px-6">Periode Bulan</th>
                                <th class="py-3.5 px-6 text-right">Nominal Tagihan</th>
                                <th class="py-3.5 px-6 text-center">Tanggal Pelunasan</th>
                                <th class="py-3.5 px-6 text-center">Metode</th>
                                <th class="py-3.5 px-6 text-center">Status</th>
                                <th class="py-3.5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($tagihans as $index => $tagihan)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="py-4 px-6 text-center text-slate-400 font-normal">{{ $index + 1 }}</td>
                                    <td class="py-4 px-6 font-mono font-bold text-slate-900">INV-{{ str_pad($tagihan->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td class="py-4 px-6 font-semibold">{{ $tagihan->bulan_tahun }}</td>
                                    <td class="py-4 px-6 text-right font-bold text-slate-900">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                    <td class="py-4 px-6 text-center text-slate-500">{{ $tagihan->tanggal_bayar ? \Carbon\Carbon::parse($tagihan->tanggal_bayar)->format('d M Y, H:i') : '-' }}</td>
                                    <td class="py-4 px-6 text-center font-semibold text-slate-600">
                                        <span class="bg-slate-100 px-2 py-0.5 rounded text-[10px]">{{ $tagihan->metode_pembayaran ?? '-' }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="text-[10px] px-2.5 py-1 rounded-full font-bold
                                            {{ $tagihan->status === 'Lunas' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($tagihan->status === 'Pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                            {{ $tagihan->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
                                        @if($tagihan->status === 'Belum Dibayar')
                                            <button type="button" 
                                                    id="btn-pay-{{ $tagihan->id }}"
                                                    onclick="triggerMidtransPayment('{{ $tagihan->id }}')" 
                                                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-3 py-2 rounded-xl text-[10px] shadow-md shadow-teal-100 transition-all cursor-pointer flex items-center justify-center mx-auto gap-1">
                                                <i class="fa-solid fa-credit-card"></i> Bayar Digital
                                            </button>
                                        @else
                                            <button onclick="alert('Mencetak struk digital resmi PDF untuk nomor transaksi: INV-{{ str_pad($tagihan->id, 6, '0', STR_PAD_LEFT) }}')" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold px-3 py-2 rounded-xl text-[10px] border border-slate-200 transition flex items-center justify-center mx-auto gap-1">
                                                <i class="fa-solid fa-file-pdf text-rose-600"></i> Struk PDF
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-12 text-center text-sm text-slate-400 font-normal">
                                        <i class="fa-solid fa-folder-open text-2xl block mb-2 text-slate-300"></i>
                                        Tidak ada riwayat berkas tagihan terdaftar untuk akun Anda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        function triggerMidtransPayment(tagihanId) {
            const button = document.getElementById(`btn-pay-${tagihanId}`);
            const originalContent = button.innerHTML;
            
            button.disabled = true;
            button.innerHTML = `<i class="fa-solid fa-spinner animate-spin"></i> Memuat...`;
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
                            forceLocalSettlement(tagihanId, result);
                        },
                        onPending: function(result) {
                            alert("Menunggu penyelesaian pembayaran. Silakan cek aplikasi e-wallet Anda.");
                            location.reload();
                        },
                        onError: function(result) {
                            alert("Proses transaksi gagal.");
                        }
                    });
                } else {
                    alert('Gagal memproses tagihan: ' + data.message);
                }
            })
            .catch(error => {
                button.disabled = false;
                button.innerHTML = originalContent;
                button.classList.replace('bg-slate-400', 'bg-teal-600');
                alert('Terjadi kendala interkoneksi ke server gateway Midtrans.');
            });
        }

        function forceLocalSettlement(tagihanId, midtransResult) {
            fetch('/midtrans/callback', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    transaction_status: 'settlement',
                    order_id: `RET-${tagihanId}-dev`,
                    payment_type: midtransResult.payment_type || 'gopay/qris'
                })
            })
            .then(() => {
                alert("Pembayaran Berhasil Terkonfirmasi!");
                location.reload();
            })
            .catch(() => {
                location.reload();
            });
        }
    </script>
</body>
</html>