<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Pedagang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Menampilkan Halaman Form Login untuk UMUM / PEDAGANG.
     */
    public function loginFormPedagang()
    {
        return view('Frontend.login'); 
    }

    /**
     * Menampilkan Halaman Form Login khusus INTERNAL / ADMIN.
     */
    public function loginFormAdmin()
    {
        return view('admin.login');
    }

    /**
     * Memproses Verifikasi Otentikasi Masuk Akun (Multi-input: Email / NIK).
     */
    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required|string', 
            'password' => 'required|string',
        ]);

        $identity = $request->identity;
        $credentials = ['password' => $request->password];

        // Deteksi input identity apakah Email atau NIK
        if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $identity;
        } else {
            $credentials['nik'] = $identity;
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            // Cek status Admin secara ketat
            $isAdmin = ($user->email === 'admin@si-retribusi.id' || Str::contains($user->email, 'admin'));
            
            // Deteksi asal halaman form login via previous URL
            $isFromAdminLogin = Str::contains(url()->previous(), '/admin/login');

            // Proteksi 1: Pedagang dilarang login lewat Halaman Admin
            if ($isFromAdminLogin && !$isAdmin) {
                Auth::logout();
                return redirect()->route('admin.login')
                    ->withErrors(['identity' => 'Akses ditolak! Halaman ini hanya untuk Administrator Dinas Resmi.'])
                    ->onlyInput('identity');
            }

            // Proteksi 2: Admin dilarang login lewat Halaman Pedagang (akan diarahkan paksa ke Admin Panel)
            if (!$isFromAdminLogin && $isAdmin) {
                return redirect()->intended(route('admin.dashboard'));
            }

            if ($isAdmin) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('pedagang.dashboard'));
        }

        return back()
            ->withErrors(['identity' => 'Kredensial email/NIK atau kata sandi salah.'])
            ->onlyInput('identity');
    }

    /**
     * Mengeluarkan Sesi Login Pengguna (Logout).
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * [ADMIN FUNCTION] Validasi Persetujuan Berkas Pedagang
     */
    public function approvePedagang($id)
    {
        $pedagang = Pedagang::findOrFail($id);
        
        if ($pedagang->status === 'Pending') {
            $pedagang->status = 'Disetujui';
            $pedagang->save(); 

            $emailPedagang = $pedagang->email ?: 'user+' . $pedagang->id . '@si-retribusi.local';

            $user = User::updateOrCreate(
                ['email' => $emailPedagang], 
                [
                    'name'     => $pedagang->nama,
                    'password' => Hash::make('password123'), 
                    'nik'      => $pedagang->nik,            
                ]
            );

            return redirect()->back()->with('success', "Pedagang disetujui. Akun otomatis aktif: {$user->email}");
        }

        return redirect()->back()->with('info', 'Pedagang sudah tidak dalam status pending.');
    }

    /**
     * KHUSUS ADMIN: Update nama dan foto profil admin
     */
    public function updateProfilAdmin(Request $request)
    {
        $user = Auth::user();

        // Keamanan 1: Validasi role admin aktif
        $isAdmin = ($user && ($user->email === 'admin@si-retribusi.id' || Str::contains($user->email, 'admin')));
        if (!$isAdmin) {
            Auth::logout();
            $request->session()->invalidate();
            return redirect()->route('admin.login')->withErrors(['identity' => 'Sesi tidak sah! Login kembali sebagai Admin.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $user->foto = $request->file('foto')->store('profil/admin', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil Dinas Pembina Administrasi berhasil diperbarui!');
    }

    /**
     * KHUSUS PEDAGANG: Update nama dan foto profil pedagang
     */
    public function updateProfilPedagang(Request $request)
    {
        $user = Auth::user();

        // Keamanan 2: Validasi agar admin tidak menimpa data pedagang jika sesi browser tertukar
        $isAdmin = ($user && ($user->email === 'admin@si-retribusi.id' || Str::contains($user->email, 'admin')));
        if ($isAdmin) {
            return redirect()->route('admin.dashboard')->withErrors(['identity' => 'Aksi ditolak karena Anda terdeteksi menggunakan akun Admin di halaman Pedagang!']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $user->foto = $request->file('foto')->store('profil/pedagang', 'public');
        }

        $user->save();

        // Sinkronisasi ke tabel pedagang secara aman (pastikan NIK tidak null/empty sebelum mencocokkan)
        if ($user->nik) {
            $pedagang = Pedagang::where('nik', $user->nik)->first();
            if ($pedagang) {
                $pedagang->nama = $request->name;
                $pedagang->save();
            }
        }

        return redirect()->back()->with('success', 'Profil akun pedagang Anda berhasil diperbarui!');
    }
    public function updatePasswordPedagang(Request $request)
{
    // 1. Validasi input formulir
    $request->validate([
        'current_password' => ['required', 'current_password'], // Memastikan password lama sesuai database
        'password' => ['required', 'confirmed', Password::min(8)], // Minimal 8 karakter & harus sama dengan konfirmasi
    ], [
        'current_password.current_password' => 'Kata sandi saat ini yang Anda masukkan salah.',
        'password.required' => 'Kata sandi baru wajib diisi.',
        'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        'password.min' => 'Kata sandi baru minimal harus 8 karakter.',
    ]);

    // 2. Ambil data user yang sedang login dan perbarui password-nya
    $user = $request->user();
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // 3. Kembali ke halaman profil dengan pesan sukses
    return redirect()->back()->with('success', 'Kata sandi akun Anda berhasil diperbarui!');
}
}