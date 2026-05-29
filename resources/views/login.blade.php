<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAB - Masuk ke Sistem</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Plus Jakarta Sans & Inter -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .heading-font {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* BACKGROUND UTAMA GELAP (Sama dengan Welcome) */
    .bg-aurora-mesh {
        background-color: #0b1329;
        background-image:
            radial-gradient(at 0% 0%, rgba(30, 64, 175, 0.4) 0px, transparent 45%),
            radial-gradient(at 100% 0%, rgba(124, 58, 237, 0.35) 0px, transparent 45%),
            radial-gradient(at 50% 100%, rgba(6, 182, 212, 0.25) 0px, transparent 50%);
    }

    /* CARD GRADIENT PUTIH - BIRU - HIJAU - CYAN */
    .card-login-gradient {
        background: linear-gradient(135deg, #ffffff 0%, #f0fdfa 40%, #e0f2fe 75%, #ecfdf5 100%);
    }

    /* Input Base Style */
    .input-login-style {
        color: #0f172a !important;
        font-weight: 600 !important;
        border: 1px solid rgba(15, 23, 42, 0.1) !important;
        background: rgba(255, 255, 255, 0.8) !important;
        transition: all 0.2s ease-in-out;
    }

    .input-login-style:focus {
        outline: none !important;
        border-color: #06b6d4 !important;
        box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.15) !important;
        background: #ffffff !important;
    }
    </style>
</head>

<body class="bg-aurora-mesh min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="w-full max-w-md">
        <!-- LOGO UTAMA -->
        <div class="flex items-center justify-center gap-3.5 mb-8">
            <div
                class="bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 text-white p-3.5 rounded-2xl shadow-lg shadow-blue-950/50 flex items-center justify-center leading-none">
                <span class="font-extrabold text-xl tracking-tight heading-font block">TH</span>
            </div>
            <div>
                <h1
                    class="text-2xl font-black heading-font bg-gradient-to-r from-blue-400 via-indigo-200 to-cyan-300 bg-clip-text text-transparent tracking-tight">
                    SmartRAB</h1>
                <p class="text-xs font-semibold text-slate-400 tracking-wide mt-0.5">Sistem Estimasi Anggaran Konstruksi
                </p>
            </div>
        </div>

        <!-- LOGIN CARD -->
        <div
            class="card-login-gradient p-8 rounded-[2.5rem] shadow-2xl shadow-slate-950/50 border border-white/40 relative overflow-hidden">
            <!-- Garis dekoratif atas -->
            <div
                class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-blue-500 via-cyan-400 to-emerald-400">
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-extrabold text-slate-800 heading-font tracking-tight">Selamat Datang Kembali
                </h2>
                <p class="text-xs font-medium text-slate-500 mt-1">Silakan masuk menggunakan akun Anda untuk mengelola
                    RAB.</p>
            </div>

            <!-- Form Proses ke Laravel Backend -->
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Username / Email -->
                <div>
                    <label for="username"
                        class="text-[11px] uppercase tracking-wider font-extrabold text-slate-500 block mb-2 heading-font">Username
                        / Email</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-user text-sm"></i>
                        </div>
                        <input type="text" id="username" name="username" required autofocus
                            class="input-login-style w-full rounded-2xl pl-11 pr-4 py-3.5 text-sm placeholder-slate-400"
                            placeholder="Masukkan username atau email...">
                    </div>
                    @error('username')
                    <span class="text-xs text-rose-500 font-medium mt-1 block px-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password"
                            class="text-[11px] uppercase tracking-wider font-extrabold text-slate-500 block heading-font">Kata
                            Sandi (Password)</label>
                        <a href="#"
                            class="text-[11px] font-bold text-blue-600 hover:text-cyan-600 transition-colors">Lupa
                            Sandi?</a>
                    </div>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="input-login-style w-full rounded-2xl pl-11 pr-4 py-3.5 text-sm placeholder-slate-400"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                    <span class="text-xs text-rose-500 font-medium mt-1 block px-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between pt-1">
                    <label class="relative flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-cyan-600 border-slate-300 rounded focus:ring-cyan-500 bg-white/80">
                        <span class="text-xs font-semibold text-slate-600">Ingat Sesi Saya</span>
                    </label>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 text-xs font-black uppercase tracking-widest heading-font bg-gradient-to-r from-blue-600 via-cyan-600 to-emerald-500 text-white py-4 px-5 rounded-2xl hover:opacity-95 transition-all shadow-lg shadow-cyan-950/20 active:scale-[0.99]">
                        <span>MASUK KE SISTEM</span>
                        <i class="fa-solid fa-arrow-right-to-bracket text-sm"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- FOOTER LOGIN -->
        <p class="text-center text-xs font-semibold text-slate-500 mt-8">
            &copy; {{ date('Y') }} SmartRAB Pro. Aplikasi Manajemen Konstruksi Rumah.
        </p>
    </div>

</body>

</html>