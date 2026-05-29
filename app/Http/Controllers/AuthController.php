<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. MENAMPILKAN FORM LOGIN
    public function showLoginForm()
    {
        return view('login'); // mengarah ke login.blade.php
    }

    // 2. PROSES OTENTIKASI (LOGIN)
    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Cek apakah input berupa email atau username biasa
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Susun data untuk Auth::attempt
        $authData = [
            $fieldType => $request->username,
            'password' => $request->password
        ];

        // Jalankan proses login menggunakan fitur bawaan Laravel
        if (Auth::attempt($authData, $request->has('remember'))) {
            // Regenerasi session untuk keamanan (mencegah session fixation)
            $request->session()->regenerate();

            // REDIRECT UTAMA: ke halaman rab-apps.test/ (halaman welcome)
            return redirect()->intended('/');
        }

        // Jika gagal login, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Username/Email atau Password yang Anda masukkan salah.',
        ])->withInput($request->only('username', 'remember'));
    }

    // 3. PROSES KELUAR (LOGOUT)
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}