<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencoba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect ke dashboard jika login berhasil
            return redirect()->route('admin.index');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ]);
    }

    // Fungsi logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
