<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// 1. RUTE AUTENTIKASI (Tetap di sini jika Anda nanti masih butuh akses admin)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// 2. RUTE BEBAS (Tanpa Login)
// Kita pindahkan rute '/' dan '/dashboard' ke sini
Route::get('/', function () {
    return view('welcome');
})->name('rab.input');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 3. RUTE DENGAN LOGIN (Hanya untuk fungsi yang butuh login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});