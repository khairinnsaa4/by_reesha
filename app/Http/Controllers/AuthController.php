<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function registerProses(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Semua yang daftar mandiri otomatis menjadi pelanggan.
        // Karyawan hanya bisa ditambahkan oleh owner dari dashboard.
        $role = 'pelanggan';

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect('/login')->with('sukses', 'Akun berhasil dibuat! Silakan masuk.');
    }

    public function loginProses(Request $request)
    {
        $kredensial = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'owner') {
                return redirect('/dashboard-owner');
            } elseif ($user->role === 'karyawan') {
                return redirect('/pemesanan');
            } else {
                return redirect('/');
            }
        }

        return back()->withErrors(['login_error' => 'Email atau kata sandi salah!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function updateProfil(Request $request)
    {
        $user = User::find(Auth::id());
        
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:25',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('sukses', 'Data diri berhasil diperbarui!')->with('active_tab', 'data-diri');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'new_password.required'     => 'Kata sandi baru wajib diisi.',
            'new_password.min'          => 'Kata sandi baru minimal 6 karakter.',
            'new_password.confirmed'    => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai.'])->with('active_tab', 'keamanan');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('sukses', 'Kata sandi berhasil diperbarui!')->with('active_tab', 'keamanan');
    }
}