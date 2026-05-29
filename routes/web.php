<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// 1. RUTE AUTENTIKASI
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 2. RUTE HALAMAN UTAMA (Input RAB)
    Route::get('/', function () {
        return view('welcome');
    })->name('rab.input');

    // 3. RUTE DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});