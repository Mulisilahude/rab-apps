<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>RAB - Solusi Manajemen Anggaran Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .heading-font {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* BACKGROUND UTAMA GELAP (DARK MODE) */
    .bg-aurora-mesh {
        background-color: #0b1329;
        background-image:
            radial-gradient(at 0% 0%, rgba(30, 64, 175, 0.4) 0px, transparent 45%),
            radial-gradient(at 100% 0%, rgba(124, 58, 237, 0.35) 0px, transparent 45%),
            radial-gradient(at 50% 100%, rgba(6, 182, 212, 0.25) 0px, transparent 50%);
    }

    /* Base Style untuk teks dan border di dalam elemen input angka */
    .input-base-style {
        color: #0f172a !important;
        font-weight: 700 !important;
        border: 1px solid rgba(15, 23, 42, 0.08) !important;
        transition: all 0.2s ease-in-out;
    }

    .input-base-style::placeholder {
        color: #94a3b8 !important;
    }

    /* 2 PILIHAN GRADIENT UNTUK KOTAK INPUT KECIL */
    .grad-input-teal {
        background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 60%, #ccfbf1 100%) !important;
    }

    .grad-input-teal:focus {
        outline: none !important;
        border-color: #0d9488 !important;
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15) !important;
    }

    .grad-input-indigo {
        background: linear-gradient(135deg, #ffffff 0%, #f5f3ff 60%, #e0e7ff 100%) !important;
    }

    .grad-input-indigo:focus {
        outline: none !important;
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15) !important;
    }

    /* 2 CONTAINER UTAMA GRADIENT TERANG (LIGHT MODE CONTAINER) */
    .card-light-teal {
        background: linear-gradient(135deg, #ffffff 0%, #f0fdfa 45%, #e6fffa 100%);
    }

    .card-light-indigo {
        background: linear-gradient(135deg, #ffffff 0%, #f5f3ff 45%, #eef2ff 100%);
    }

    /* Textarea reset custom styling */
    .textarea-description {
        resize: none;
        overflow-y: hidden;
        word-wrap: break-word;
        white-space: pre-wrap;
    }
    </style>
</head>

<body class="bg-aurora-mesh text-slate-100 antialiased min-h-screen flex flex-col justify-between">

    <header class="bg-slate-900/60 backdrop-blur-xl border-b border-slate-800/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-2">
            <div class="flex items-center gap-3">
                <div
                    class="bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 text-white p-2.5 sm:p-3 rounded-2xl shadow-lg shadow-blue-900/50 flex items-center justify-center leading-none">
                    <span class="font-extrabold text-base sm:text-lg tracking-tight heading-font block">TH</span>
                </div>
                <div>
                    <h1
                        class="text-base sm:text-xl font-extrabold heading-font bg-gradient-to-r from-blue-400 via-indigo-200 to-cyan-300 bg-clip-text text-transparent tracking-tight">
                        RINCIAN ANGGARAN BIAYA</h1>
                    <p class="text-[10px] sm:text-xs font-medium text-slate-400 tracking-wide mt-0.5">Sistem Estimasi
                        Biaya Proyek </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden sm:flex flex-col text-right">
                    <span id="txt_hari_tanggal" class="text-[11px] font-semibold text-slate-300 heading-font">Memuat
                        Tanggal...</span>
                    <span id="txt_jam"
                        class="text-xs font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent tracking-widest mt-0.5">00:00:00</span>
                </div>
                <button onclick="toggleSidebar()"
                    class="relative inline-flex items-center gap-1.5 text-[11px] sm:text-xs font-bold text-slate-300 bg-slate-800/80 border border-slate-700/60 px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl hover:bg-slate-700 transition-all">
                    <i class="fa-solid fa-folder-open text-cyan-400"></i>
                    <span>DATA KLIEN</span>
                    <span id="badge_count"
                        class="absolute -top-1.5 -right-1.5 bg-rose-500 text-white text-[9px] w-4.5 h-4.5 rounded-full flex items-center justify-center font-bold hidden">0</span>
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="group inline-flex items-center gap-2 text-[11px] sm:text-xs font-bold text-rose-400 bg-rose-500/10 border border-rose-500/20 px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl hover:bg-rose-500 hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-right-from-bracket text-xs"></i>
                        <span class="hidden sm:inline">KELUAR</span>
                    </button>
                </form>
            </div>
        </div>

    </header>

    <main class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-10 flex-grow w-full">

        <div class="bg-slate-900/40 border border-slate-800/60 backdrop-blur-md p-4 sm:p-6 rounded-3xl mb-6 sm:mb-10">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 sm:get-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 flex-grow">
                    <div>
                        <label
                            class="text-[10px] sm:text-[11px] uppercase tracking-wider font-bold text-slate-400 block mb-1.5 heading-font">Nama
                            Pemilik Proyek</label>
                        <input type="text" id="klien_nama"
                            class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-3.5 py-2 sm:py-2.5 text-xs sm:text-sm font-semibold text-slate-200 focus:outline-none focus:border-indigo-500"
                            placeholder="Masukkan nama...">
                    </div>
                    <div>
                        <label
                            class="text-[10px] sm:text-[11px] uppercase tracking-wider font-bold text-slate-400 block mb-1.5 heading-font">No.
                            Telepon / WhatsApp</label>
                        <input type="text" id="klien_telepon"
                            class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-3.5 py-2 sm:py-2.5 text-xs sm:text-sm font-semibold text-slate-200 focus:outline-none focus:border-indigo-500"
                            placeholder="Contoh: 081234567xx">
                    </div>
                    <div>
                        <label
                            class="text-[10px] sm:text-[11px] uppercase tracking-wider font-bold text-slate-400 block mb-1.5 heading-font">Tanggal
                            Perencanaan</label>
                        <input type="date" id="klien_tanggal"
                            class="w-full bg-slate-950/60 border border-slate-800 rounded-xl px-3.5 py-2 sm:py-2.5 text-xs sm:text-sm font-semibold text-slate-200 focus:outline-none focus:border-indigo-500">
                    </div>
                </div>
                <div class="grid grid-cols-2 lg:flex items-end gap-2.5 w-full lg:w-auto mt-2 lg:mt-0">
                    <input type="hidden" id="current_project_id" value="">
                    <button onclick="simpanKeRiwayat()"
                        class="w-full lg:w-auto inline-flex items-center justify-center gap-1.5 text-[11px] sm:text-xs font-extrabold heading-font bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-3 rounded-xl hover:opacity-90 transition-all shadow-lg shadow-indigo-950/40">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                    <button onclick="resetFormKlien()"
                        class="w-full lg:w-auto inline-flex items-center justify-center gap-1.5 text-[11px] sm:text-xs font-bold heading-font bg-slate-800 text-slate-300 border border-slate-700/60 px-4 py-3 rounded-xl hover:bg-slate-700 transition-all">
                        <i class="fa-solid fa-file-circle-plus"></i> Sesi Baru
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-10">

            <div
                class="card-light-teal border border-teal-100 p-5 sm:p-6 rounded-3xl shadow-xl shadow-slate-950/20 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-teal-500 to-cyan-500"></div>
                <div class="flex items-center justify-between mb-2">
                    <span
                        class="text-[10px] sm:text-xs uppercase tracking-wider font-bold text-slate-500 heading-font">Rencana
                        Anggaran (Budget)</span>
                    <div class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-700 text-xs">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <div class="flex items-center gap-1 text-slate-900 font-black text-2xl sm:text-3xl heading-font py-1">
                    <span>Rp</span>
                    <input type="text" id="budget_awal"
                        class="w-full bg-transparent border-0 p-0 font-black text-2xl sm:text-3xl heading-font text-slate-900 focus:ring-0 focus:outline-none placeholder-slate-400"
                        placeholder="0" onkeyup="formatRupiahInput(this); hitungRAB();">
                </div>
            </div>

            <div
                class="card-light-indigo border border-indigo-100 p-5 sm:p-6 rounded-3xl shadow-xl shadow-slate-950/20 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-indigo-500 to-blue-600"></div>
                <div class="flex items-center justify-between mb-2">
                    <span
                        class="text-[10px] sm:text-xs uppercase tracking-wider font-bold text-slate-500 heading-font">Total
                        Pengeluaran RAB</span>
                    <div
                        class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight heading-font py-1"
                    id="total_pengeluaran_display">Rp 0</div>
                <p class="text-[10px] text-slate-400 mt-1">Akumulasi otomatis pengeluaran</p>
            </div>

            <div id="card_sisa"
                class="bg-white border border-slate-200 p-5 sm:p-6 rounded-3xl shadow-xl shadow-slate-950/20 relative overflow-hidden sm:col-span-2 lg:col-span-1">
                <div id="stripe_sisa" class="absolute top-0 left-0 w-full h-[3px] bg-slate-300"></div>
                <div class="flex items-center justify-between mb-2">
                    <span
                        class="text-[10px] sm:text-xs uppercase tracking-wider font-bold text-slate-500 heading-font">Sisa
                        / Margin Anggaran</span>
                    <div id="icon_sisa_box"
                        class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500 text-xs">
                        <i id="icon_sisa" class="fa-solid fa-scale-balanced"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-black tracking-tight heading-font text-slate-900 py-1"
                    id="sisa_anggaran">Rp 0</div>
                <p class="text-[10px] text-slate-400 mt-1 font-medium" id="status_keterangan">Menunggu input data...</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">

            <div class="space-y-6 lg:col-span-1">
                <div
                    class="card-light-indigo border border-indigo-100 rounded-3xl shadow-xl shadow-slate-950/10 overflow-hidden">
                    <div class="p-4 sm:p-6 border-b border-indigo-100/50 bg-white/40 flex items-center gap-3">
                        <div class="p-2 rounded-lg bg-indigo-100 text-indigo-600 text-xs sm:text-sm">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h2 class="font-bold heading-font text-slate-800 text-sm sm:text-base tracking-tight">Manajemen
                            Tenaga Kerja</h2>
                    </div>

                    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
                        <div class="p-4 bg-white/60 border border-indigo-100/30 rounded-2xl space-y-3">
                            <div class="flex justify-between items-center gap-2">
                                <span
                                    class="font-bold text-xs sm:text-sm text-slate-700 heading-font tracking-wide">Kepala
                                    Tukang (Basi)</span>
                                <span
                                    class="text-[11px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-lg heading-font whitespace-nowrap"
                                    id="subtotal_basi_display">Rp 0</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <label
                                        class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 block mb-1">Jumlah</label>
                                    <input type="number" id="qty_basi"
                                        class="input-base-style grad-input-indigo w-full text-xs rounded-xl p-2 text-center"
                                        placeholder="0" oninput="hitungRAB()">
                                </div>
                                <div>
                                    <label
                                        class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 block mb-1">Upah/Hari</label>
                                    <input type="number" id="harga_basi"
                                        class="input-base-style grad-input-indigo w-full text-xs rounded-xl p-2 text-center"
                                        placeholder="0" oninput="hitungRAB()">
                                </div>
                                <div>
                                    <label
                                        class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 block mb-1">Hari</label>
                                    <input type="number" id="hari_basi"
                                        class="input-base-style grad-input-indigo w-full text-xs rounded-xl p-2 text-center"
                                        placeholder="0" oninput="hitungRAB()">
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-white/60 border border-indigo-100/30 rounded-2xl space-y-3">
                            <div class="flex justify-between items-center gap-2">
                                <span
                                    class="font-bold text-xs sm:text-sm text-slate-700 heading-font tracking-wide">Pekerja
                                    / Anak Buah</span>
                                <span
                                    class="text-[11px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-lg heading-font whitespace-nowrap"
                                    id="subtotal_ab_display">Rp 0</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <label
                                        class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 block mb-1">Jumlah</label>
                                    <input type="number" id="qty_ab"
                                        class="input-base-style grad-input-indigo w-full text-xs rounded-xl p-2 text-center"
                                        placeholder="0" oninput="hitungRAB()">
                                </div>
                                <div>
                                    <label
                                        class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 block mb-1">Upah/Hari</label>
                                    <input type="number" id="harga_ab"
                                        class="input-base-style grad-input-indigo w-full text-xs rounded-xl p-2 text-center"
                                        placeholder="0" oninput="hitungRAB()">
                                </div>
                                <div>
                                    <label
                                        class="text-[9px] uppercase tracking-wider font-extrabold text-slate-400 block mb-1">Hari</label>
                                    <input type="number" id="hari_ab"
                                        class="input-base-style grad-input-indigo w-full text-xs rounded-xl p-2 text-center"
                                        placeholder="0" oninput="hitungRAB()">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6 sm:space-y-8">

                <div
                    class="card-light-teal border border-teal-100 rounded-3xl shadow-xl shadow-slate-950/10 overflow-hidden">
                    <div
                        class="p-4 sm:p-6 border-b border-teal-100/50 bg-white/40 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 sm:get-3">
                            <div class="p-2 rounded-lg bg-teal-100 text-teal-600 text-xs sm:text-sm">
                                <i class="fa-solid fa-cubes"></i>
                            </div>
                            <h2 class="font-bold heading-font text-slate-800 text-sm sm:text-base tracking-tight">1.
                                Material & Bahan</h2>
                        </div>
                        <button type="button"
                            onclick="tambahBaris('tabel_material', 'Contoh: Semen Portland / Zak', 'grad-input-teal')"
                            class="inline-flex items-center gap-1.5 text-[11px] font-extrabold heading-font bg-gradient-to-r from-teal-600 to-emerald-500 text-white px-3 py-2 rounded-xl hover:opacity-90 transition-all shadow-md">
                            <i class="fa-solid fa-plus"></i> <span class="hidden xs:inline">Tambah Bahan</span><span
                                class="inline xs:hidden">Item</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[100%] block md:table">
                            <thead class="hidden md:table-header-group">
                                <tr
                                    class="border-b border-teal-100/30 bg-white/20 text-[10px] uppercase tracking-widest font-extrabold text-slate-400">
                                    <th class="py-4 px-5 w-[45%]">Deskripsi Material</th>
                                    <th class="py-4 px-4 w-[20%]">Harga Satuan</th>
                                    <th class="py-4 px-4 w-[15%] text-center">Volume/Qty</th>
                                    <th class="py-4 px-5 w-[15%] text-right">Total Biaya</th>
                                    <th class="py-4 px-4 w-[5%] text-center"></th>
                                </tr>
                            </thead>
                            <tbody id="tabel_material"
                                class="divide-y divide-teal-100/20 text-sm block md:table-row-group">
                                <tr
                                    class="hover:bg-white/40 transition-all flex flex-col md:table-row p-4 md:p-0 space-y-2 md:space-y-0 align-top">
                                    <td class="p-0 md:p-4 block md:table-cell">
                                        <span
                                            class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">Deskripsi
                                            Material</span>
                                        <textarea rows="1"
                                            class="w-full border-0 focus:ring-0 p-1 font-semibold text-slate-700 bg-transparent placeholder-slate-400 text-sm focus:outline-none description_item textarea-description"
                                            placeholder="Contoh: Semen Portland / Zak"
                                            oninput="autoResizeTextarea(this)"></textarea>
                                    </td>
                                    <td class="p-0 md:p-4 grid grid-cols-2 md:table-cell gap-2">
                                        <div>
                                            <span
                                                class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">Harga
                                                Satuan</span>
                                            <input type="number"
                                                class="input-base-style grad-input-teal w-full rounded-xl text-xs p-2.5 harga_item"
                                                placeholder="0" oninput="hitungRAB()">
                                        </div>
                                        <div class="block md:hidden">
                                            <span
                                                class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">Volume/Qty</span>
                                            <input type="number"
                                                class="input-base-style grad-input-teal w-full rounded-xl text-xs p-2.5 vol_item text-center"
                                                placeholder="0" oninput="hitungRAB()">
                                        </div>
                                    </td>
                                    <td class="p-0 md:p-4 hidden md:table-cell">
                                        <input type="number"
                                            class="input-base-style grad-input-teal w-full rounded-xl text-xs p-2.5 vol_item text-center"
                                            placeholder="0" oninput="hitungRAB()">
                                    </td>
                                    <td
                                        class="p-0 md:p-4 flex md:table-cell justify-between items-center pt-2 md:pt-6 border-t border-dashed border-teal-100/50 md:border-none">
                                        <span
                                            class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400">Total
                                            Biaya</span>
                                        <span class="font-bold text-teal-600 heading-font text-sm total_item_display">Rp
                                            0</span>
                                    </td>
                                    <td class="p-0 md:p-4 text-right md:text-center pt-2 md:pt-6 block md:table-cell">
                                        <button onclick="hapusBaris(this)"
                                            class="text-slate-400 hover:text-rose-500 transition-colors inline-flex items-center gap-1.5 text-xs font-semibold md:font-normal bg-rose-50 md:bg-transparent px-3 py-1.5 md:p-0 rounded-xl"><i
                                                class="fa-solid fa-trash-can text-sm"></i><span
                                                class="inline md:hidden text-rose-600">Hapus</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div
                    class="card-light-indigo border border-indigo-100 rounded-3xl shadow-xl shadow-slate-950/10 overflow-hidden">
                    <div
                        class="p-4 sm:p-6 border-b border-indigo-100/50 bg-white/40 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 sm:get-3">
                            <div class="p-2 rounded-lg bg-indigo-100 text-indigo-600 text-xs sm:text-sm">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                            </div>
                            <h2 class="font-bold heading-font text-slate-800 text-sm sm:text-base tracking-tight">2.
                                Item Pekerjaan & Jasa</h2>
                        </div>
                        <button type="button"
                            onclick="tambahBaris('tabel_pekerjaan', 'Contoh: Pekerjaan Pintu Set Jendela', 'grad-input-indigo')"
                            class="inline-flex items-center gap-1.5 text-[11px] font-extrabold heading-font bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-3 py-2 rounded-xl hover:opacity-90 transition-all shadow-md">
                            <i class="fa-solid fa-plus"></i> <span class="hidden xs:inline">Tambah Kerja</span><span
                                class="inline xs:hidden">Item</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[100%] block md:table">
                            <thead class="hidden md:table-header-group">
                                <tr
                                    class="border-b border-indigo-100/30 bg-white/20 text-[10px] uppercase tracking-widest font-extrabold text-slate-400">
                                    <th class="py-4 px-5 w-[45%]">Deskripsi Jasa / Borongan</th>
                                    <th class="py-4 px-4 w-[20%]">Estimasi Harga</th>
                                    <th class="py-4 px-4 w-[15%] text-center">Volume/Unit</th>
                                    <th class="py-4 px-5 w-[15%] text-right">Total Biaya</th>
                                    <th class="py-4 px-4 w-[5%] text-center"></th>
                                </tr>
                            </thead>
                            <tbody id="tabel_pekerjaan"
                                class="divide-y divide-indigo-100/20 text-sm block md:table-row-group">
                                <tr
                                    class="hover:bg-white/40 transition-all flex flex-col md:table-row p-4 md:p-0 space-y-2 md:space-y-0 align-top">
                                    <td class="p-0 md:p-4 block md:table-cell">
                                        <span
                                            class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">Deskripsi
                                            Jasa / Borongan</span>
                                        <textarea rows="1"
                                            class="w-full border-0 focus:ring-0 p-1 font-semibold text-slate-700 bg-transparent placeholder-slate-400 text-sm focus:outline-none description_item textarea-description"
                                            placeholder="Contoh: Pekerjaan Pintu Set Jendela"
                                            oninput="autoResizeTextarea(this)"></textarea>
                                    </td>
                                    <td class="p-0 md:p-4 grid grid-cols-2 md:table-cell gap-2">
                                        <div>
                                            <span
                                                class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">Estimasi
                                                Harga</span>
                                            <input type="number"
                                                class="input-base-style grad-input-indigo w-full rounded-xl text-xs p-2.5 harga_item"
                                                placeholder="0" oninput="hitungRAB()">
                                        </div>
                                        <div class="block md:hidden">
                                            <span
                                                class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">Volume/Unit</span>
                                            <input type="number"
                                                class="input-base-style grad-input-indigo w-full rounded-xl text-xs p-2.5 vol_item text-center"
                                                placeholder="0" oninput="hitungRAB()">
                                        </div>
                                    </td>
                                    <td class="p-0 md:p-4 hidden md:table-cell">
                                        <input type="number"
                                            class="input-base-style grad-input-indigo w-full rounded-xl text-xs p-2.5 vol_item text-center"
                                            placeholder="0" oninput="hitungRAB()">
                                    </td>
                                    <td
                                        class="p-0 md:p-4 flex md:table-cell justify-between items-center pt-2 md:pt-6 border-t border-dashed border-indigo-100/50 md:border-none">
                                        <span
                                            class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400">Total
                                            Biaya</span>
                                        <span
                                            class="font-bold text-indigo-600 heading-font text-sm total_item_display">Rp
                                            0</span>
                                    </td>
                                    <td class="p-0 md:p-4 text-right md:text-center pt-2 md:pt-6 block md:table-cell">
                                        <button onclick="hapusBaris(this)"
                                            class="text-slate-400 hover:text-rose-500 transition-colors inline-flex items-center gap-1.5 text-xs font-semibold md:font-normal bg-rose-50 md:bg-transparent px-3 py-1.5 md:p-0 rounded-xl"><i
                                                class="fa-solid fa-trash-can text-sm"></i><span
                                                class="inline md:hidden text-rose-600">Hapus</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <div id="sidebar_riwayat"
        class="fixed top-0 right-0 h-full w-full sm:w-80 bg-slate-900 border-l border-slate-800 shadow-2xl z-50 transform translate-x-full transition-transform duration-300 flex flex-col">
        <div class="p-5 border-b border-slate-800 flex items-center justify-between bg-slate-950/40">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-box-archive text-indigo-400"></i>
                <span class="font-bold text-sm heading-font text-slate-200">Riwayat Proyek Klien</span>
            </div>
            <button onclick="toggleSidebar()" class="text-slate-400 hover:text-white p-2 bg-slate-800 rounded-lg">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="p-4 border-b border-slate-800/60 bg-slate-950/20 grid grid-cols-2 gap-2 text-[11px] font-bold">
            <button onclick="eksporSeluruhData()"
                class="bg-emerald-600/20 border border-emerald-500/30 hover:bg-emerald-600 text-emerald-400 hover:text-white py-2.5 px-3 rounded-lg flex items-center justify-center gap-1.5 transition-all">
                <i class="fa-solid fa-cloud-arrow-down"></i> Ekspor
            </button>
            <label
                class="bg-indigo-600/20 border border-indigo-500/30 hover:bg-indigo-600 text-indigo-400 hover:text-white py-2.5 px-3 rounded-lg flex items-center justify-center gap-1.5 transition-all cursor-pointer text-center">
                <i class="fa-solid fa-cloud-arrow-up"></i> Impor
                <input type="file" id="file_impor" class="hidden" accept=".json" onchange="imporSeluruhData(this)">
            </label>
        </div>

        <div id="list_riwayat_container" class="p-4 space-y-3 flex-grow overflow-y-auto">
            <p class="text-xs text-slate-500 text-center py-6">Belum ada data klien yang disimpan.</p>
        </div>
    </div>

    <footer class="bg-slate-950/40 border-t border-slate-900/60 py-6 mt-12 backdrop-blur-md">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs font-medium text-slate-500 text-center md:text-left">
            <div class="flex flex-col sm:flex-row items-center gap-1 sm:get-2">
                <span class="font-bold text-slate-400 heading-font text-sm tracking-wide">SmartRAB</span>
                <span>&copy; {{ date('Y') }} MULISILAHUDE__</span>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6">
                <span class="hover:text-slate-300 transition-colors cursor-pointer">Syarat & Ketentuan</span>
                <span class="hover:text-slate-300 transition-colors cursor-pointer">Kebijakan Privasi</span>
                <div
                    class="text-slate-400 font-semibold bg-slate-900 border border-slate-800 px-3 py-1 rounded-md heading-font">
                    v1.0.0 Pro</div>
            </div>
        </div>
    </footer>

    <script>
    function updateTime() {
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember'
        ];

        const now = new Date();
        const dayName = days[now.getDay()];
        const day = String(now.getDate()).padStart(2, '0');
        const monthName = months[now.getMonth()];
        const year = now.getFullYear();

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        if (document.getElementById('txt_hari_tanggal')) {
            document.getElementById('txt_hari_tanggal').innerText = `${dayName}, ${day} ${monthName} ${year}`;
            document.getElementById('txt_jam').innerText = `${hours}:${minutes}:${seconds}`;
        }
    }
    setInterval(updateTime, 1000);
    updateTime();

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(angka);
    }

    /* Menghilangkan tanda Rp bawaan input manual */
    function formatRupiahInput(elemen) {
        let value = elemen.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        elemen.value = rupiah;
    }

    function dapatkanAngkaMurni(stringFormat) {
        if (!stringFormat) return 0;
        return parseFloat(stringFormat.replace(/\./g, '')) || 0;
    }

    function autoResizeTextarea(element) {
        element.style.height = 'auto';
        element.style.height = element.scrollHeight + 'px';
    }

    function tambahBaris(targetTabelId, placeholderText, gradientInputClass, descValue = '', hargaValue = '', volValue =
        '') {
        let tbody = document.getElementById(targetTabelId);
        let tr = document.createElement('tr');
        tr.className =
            "hover:bg-white/40 transition-all flex flex-col md:table-row p-4 md:p-0 space-y-2 md:space-y-0 align-top";

        let labelDesc = targetTabelId === 'tabel_material' ? 'Deskripsi Material' : 'Deskripsi Jasa / Borongan';
        let labelHarga = targetTabelId === 'tabel_material' ? 'Harga Satuan' : 'Estimasi Harga';
        let labelVol = targetTabelId === 'tabel_material' ? 'Volume/Qty' : 'Volume/Unit';

        tr.innerHTML = `
                <td class="p-0 md:p-4 block md:table-cell">
                    <span class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">${labelDesc}</span>
                    <textarea rows="1" class="w-full border-0 focus:ring-0 p-1 font-semibold text-slate-700 bg-transparent placeholder-slate-400 text-sm focus:outline-none description_item textarea-description" placeholder="${placeholderText}" oninput="autoResizeTextarea(this)">${descValue}</textarea>
                </td>
                <td class="p-0 md:p-4 grid grid-cols-2 md:table-cell gap-2">
                    <div>
                        <span class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">${labelHarga}</span>
                        <input type="number" class="input-base-style ${gradientInputClass} w-full rounded-xl text-xs p-2.5 harga_item" placeholder="0" oninput="hitungRAB()" value="${hargaValue}">
                    </div>
                    <div class="block md:hidden">
                        <span class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400 mb-1">${labelVol}</span>
                        <input type="number" class="input-base-style ${gradientInputClass} w-full rounded-xl text-xs p-2.5 vol_item text-center" placeholder="0" oninput="hitungRAB()" value="${volValue}">
                    </div>
                </td>
                <td class="p-0 md:p-4 hidden md:table-cell">
                    <input type="number" class="input-base-style ${gradientInputClass} w-full rounded-xl text-xs p-2.5 vol_item text-center" placeholder="0" oninput="hitungRAB()" value="${volValue}">
                </td>
                <td class="p-0 md:p-4 flex md:table-cell justify-between items-center pt-2 md:pt-6 border-t border-dashed ${targetTabelId === 'tabel_material' ? 'border-teal-100/50':'border-indigo-100/50'} md:border-none">
                    <span class="block md:hidden text-[9px] uppercase tracking-wider font-extrabold text-slate-400">Total Biaya</span>
                    <span class="font-bold ${targetTabelId === 'tabel_material' ? 'text-teal-600' : 'text-indigo-600'} heading-font text-sm total_item_display">Rp 0</span>
                </td>
                <td class="p-0 md:p-4 text-right md:text-center pt-2 md:pt-6 block md:table-cell">
                    <button onclick="hapusBaris(this)" class="text-slate-400 hover:text-rose-500 transition-colors inline-flex items-center gap-1.5 text-xs font-semibold md:font-normal bg-rose-50 md:bg-transparent px-3 py-1.5 md:p-0 rounded-xl"><i class="fa-solid fa-trash-can text-sm"></i><span class="inline md:hidden text-rose-600">Hapus</span></button>
                </td>
            `;
        tbody.appendChild(tr);

        const txtArea = tr.querySelector('.textarea-description');
        autoResizeTextarea(txtArea);

        hitungRAB();
    }

    function hapusBaris(btn) {
        let row = btn.closest('tr');
        row.parentNode.removeChild(row);
        hitungRAB();
    }

    function hitungSubtotalTabel(tabelId, activeColorClass) {
        let subtotal = 0;
        let baris = document.querySelectorAll(`#${tabelId} tr`);
        baris.forEach(row => {
            let harga = parseFloat(row.querySelector('.harga_item').value) || 0;
            let vol = parseFloat(row.querySelector('.vol_item').value) || 0;
            let totalBaris = harga * vol;
            subtotal += totalBaris;

            let display = row.querySelector('.total_item_display');
            display.innerText = formatRupiah(totalBaris);
            if (totalBaris > 0) {
                display.className = `font-bold ${activeColorClass} heading-font text-sm total_item_display`;
            } else {
                display.className = `font-bold text-slate-400 heading-font text-sm total_item_display`;
            }
        });
        return subtotal;
    }

    function hitungRAB() {
        let budgetAwal = dapatkanAngkaMurni(document.getElementById('budget_awal').value);

        let qtyBasi = parseFloat(document.getElementById('qty_basi').value) || 0;
        let hargaBasi = parseFloat(document.getElementById('harga_basi').value) || 0;
        let hariBasi = parseFloat(document.getElementById('hari_basi').value) || 0;
        let jumlahBasi = qtyBasi * hargaBasi * hariBasi;
        document.getElementById('subtotal_basi_display').innerText = formatRupiah(jumlahBasi);

        let qtyAB = parseFloat(document.getElementById('qty_ab').value) || 0;
        let hargaAB = parseFloat(document.getElementById('harga_ab').value) || 0;
        let hariAB = parseFloat(document.getElementById('hari_ab').value) || 0;
        let jumlahAB = qtyAB * hargaAB * hariAB;
        document.getElementById('subtotal_ab_display').innerText = formatRupiah(jumlahAB);

        let totalMaterial = hitungSubtotalTabel('tabel_material', 'text-teal-600');
        let totalPekerjaan = hitungSubtotalTabel('tabel_pekerjaan', 'text-indigo-600');

        let totalPengeluaran = jumlahBasi + jumlahAB + totalMaterial + totalPekerjaan;
        let sisaAnggaran = budgetAwal - totalPengeluaran;

        document.getElementById('total_pengeluaran_display').innerText = formatRupiah(totalPengeluaran);

        let sisaDisplay = document.getElementById('sisa_anggaran');
        let cardSisa = document.getElementById('card_sisa');
        let stripeSisa = document.getElementById('stripe_sisa');
        let iconBox = document.getElementById('icon_sisa_box');
        let icon = document.getElementById('icon_sisa');
        let statusKet = document.getElementById('status_keterangan');

        sisaDisplay.innerText = formatRupiah(sisaAnggaran);

        if (budgetAwal === 0 && totalPengeluaran === 0) {
            cardSisa.className =
                "bg-white border border-slate-200 p-5 sm:p-6 rounded-3xl shadow-xl relative overflow-hidden transition-all group sm:col-span-2 lg:col-span-1";
            stripeSisa.className = "absolute top-0 left-0 w-full h-[3px] bg-slate-300";
            sisaDisplay.className = "text-2xl sm:text-3xl font-black text-slate-900 py-1 heading-font";
            iconBox.className =
                "w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500 text-xs";
            icon.className = "fa-solid fa-scale-balanced";
            statusKet.innerText = "Menunggu input data...";
            statusKet.className = "text-[10px] text-slate-400 mt-1 font-medium";
            return;
        }

        if (sisaAnggaran < 0) {
            cardSisa.className =
                "bg-gradient-to-br from-white via-rose-50 to-rose-100 border border-rose-200 p-5 sm:p-6 rounded-3xl shadow-xl relative overflow-hidden transition-all group sm:col-span-2 lg:col-span-1";
            stripeSisa.className = "absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-rose-500 to-pink-500";
            sisaDisplay.className = "text-2xl sm:text-3xl font-black text-rose-600 py-1 heading-font";
            iconBox.className = "w-8 h-8 rounded-lg bg-rose-100 flex items-center justify-center text-rose-600 text-xs";
            icon.className = "fa-solid fa-triangle-exclamation";
            statusKet.innerText = "Over-budget! Melebihi anggaran rencana.";
            statusKet.className = "text-[10px] text-rose-500 mt-1 font-semibold tracking-wide";
        } else {
            cardSisa.className =
                "bg-gradient-to-br from-white via-emerald-50 to-emerald-100 border border-emerald-200 p-5 sm:p-6 rounded-3xl shadow-xl relative overflow-hidden transition-all group sm:col-span-2 lg:col-span-1";
            stripeSisa.className = "absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-emerald-500 to-cyan-400";
            sisaDisplay.className = "text-2xl sm:text-3xl font-black text-emerald-600 py-1 heading-font";
            iconBox.className =
                "w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-500 text-xs";
            icon.className = "fa-solid fa-circle-check";
            statusKet.innerText = "Anggaran Aman. Efisiensi terjaga.";
            statusKet.className = "text-[10px] text-emerald-600 mt-1 font-semibold tracking-wide";
        }
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar_riwayat');
        sidebar.classList.toggle('translate-x-full');
    }

    function getTabelRowsData(tabelId) {
        let items = [];
        let rows = document.querySelectorAll(`#${tabelId} tr`);
        rows.forEach(row => {
            let desc = row.querySelector('.description_item').value;
            let harga = row.querySelector('.harga_item').value;
            let vol = row.querySelector('.vol_item').value;
            if (desc || harga || vol) {
                items.push({
                    desc,
                    harga,
                    vol
                });
            }
        });
        return items;
    }

    function simpanKeRiwayat() {
        const nama = document.getElementById('klien_nama').value.trim();
        const telepon = document.getElementById('klien_telepon').value.trim();
        const tanggal = document.getElementById('klien_tanggal').value;

        if (!nama) {
            alert('Mohon isi nama pemilik proyek terlebih dahulu untuk menyimpan!');
            return;
        }

        let projects = JSON.parse(localStorage.getItem('smartrab_projects')) || [];
        let currentId = document.getElementById('current_project_id').value;

        const payloadData = {
            id: currentId ? currentId : 'project_' + Date.now(),
            nama: nama,
            telepon: telepon,
            tanggal: tanggal ? tanggal : new Date().toISOString().split('T')[0],
            budget: dapatkanAngkaMurni(document.getElementById('budget_awal').value),
            tenaga: {
                qty_basi: document.getElementById('qty_basi').value,
                harga_basi: document.getElementById('harga_basi').value,
                hari_basi: document.getElementById('hari_basi').value,
                qty_ab: document.getElementById('qty_ab').value,
                harga_ab: document.getElementById('harga_ab').value,
                hari_ab: document.getElementById('hari_ab').value,
            },
            materials: getTabelRowsData('tabel_material'),
            pekerjaans: getTabelRowsData('tabel_pekerjaan'),
            totalPengeluaran: document.getElementById('total_pengeluaran_display').innerText
        };

        if (currentId) {
            let idx = projects.findIndex(p => p.id === currentId);
            if (idx !== -1) projects[idx] = payloadData;
        } else {
            projects.unshift(payloadData);
            document.getElementById('current_project_id').value = payloadData.id;
        }

        localStorage.setItem('smartrab_projects', JSON.stringify(projects));
        renderRiwayatList();
        alert('Sukses! Data anggaran ' + nama + ' berhasil disimpan.');
    }

    function renderRiwayatList() {
        let projects = JSON.parse(localStorage.getItem('smartrab_projects')) || [];
        let container = document.getElementById('list_riwayat_container');
        let badge = document.getElementById('badge_count');

        if (projects.length > 0) {
            badge.innerText = projects.length;
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }

        if (projects.length === 0) {
            container.innerHTML =
                `<p class="text-xs text-slate-500 text-center py-6">Belum ada data klien yang disimpan.</p>`;
            return;
        }

        container.innerHTML = '';
        projects.forEach(p => {
            let card = document.createElement('div');
            card.className =
                "bg-slate-950/60 border border-slate-800 p-4 rounded-xl flex flex-col justify-between gap-3 hover:border-slate-700 transition-all";
            card.innerHTML = `
                    <div>
                        <h4 class="font-bold text-sm text-slate-200 heading-font truncate">${p.nama}</h4>
                        <p class="text-[11px] text-slate-400 mt-0.5"><i class="fa-solid fa-phone text-[9px] text-slate-500 mr-1"></i>${p.telepon || '-'}</p>
                        <p class="text-[11px] text-slate-400"><i class="fa-solid fa-calendar text-[9px] text-slate-500 mr-1"></i>${p.tanggal}</p>
                        <div class="text-xs font-extrabold text-cyan-400 mt-2">${p.totalPengeluaran}</div>
                    </div>
                    <div class="flex items-center gap-2 border-t border-slate-800/80 pt-2 mt-1">
                        <button onclick="loadProject('${p.id}')" class="flex-grow bg-indigo-600/20 hover:bg-indigo-600 text-indigo-400 hover:text-white font-semibold text-[10px] uppercase tracking-wider py-1.5 px-3 rounded-lg transition-all text-center">Buka / Edit</button>
                        <button onclick="deleteProject('${p.id}')" class="bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white p-1.5 rounded-lg transition-all"><i class="fa-solid fa-trash-can text-xs"></i></button>
                    </div>
                `;
            container.appendChild(card);
        });
    }

    function loadProject(id) {
        let projects = JSON.parse(localStorage.getItem('smartrab_projects')) || [];
        let p = projects.find(proj => proj.id === id);
        if (!p) return;

        document.getElementById('current_project_id').value = p.id;
        document.getElementById('klien_nama').value = p.nama;
        document.getElementById('klien_telepon').value = p.telepon;
        document.getElementById('klien_tanggal').value = p.tanggal;

        let inputBudget = document.getElementById('budget_awal');
        inputBudget.value = p.budget || '';
        formatRupiahInput(inputBudget);

        document.getElementById('qty_basi').value = p.tenaga.qty_basi;
        document.getElementById('harga_basi').value = p.tenaga.harga_basi;
        document.getElementById('hari_basi').value = p.tenaga.hari_basi;
        document.getElementById('qty_ab').value = p.tenaga.qty_ab;
        document.getElementById('harga_ab').value = p.tenaga.harga_ab;
        document.getElementById('hari_ab').value = p.tenaga.hari_ab;

        document.getElementById('tabel_material').innerHTML = '';
        if (!p.materials || p.materials.length === 0) {
            tambahBaris('tabel_material', 'Contoh: Semen Portland / Zak', 'grad-input-teal');
        } else {
            p.materials.forEach(m => tambahBaris('tabel_material', 'Contoh: Semen Portland / Zak', 'grad-input-teal', m
                .desc, m.harga, m.vol));
        }

        document.getElementById('tabel_pekerjaan').innerHTML = '';
        if (!p.pekerjaans || p.pekerjaans.length === 0) {
            tambahBaris('tabel_pekerjaan', 'Contoh: Pekerjaan Pintu Set Jendela', 'grad-input-indigo');
        } else {
            p.pekerjaans.forEach(j => tambahBaris('tabel_pekerjaan', 'Contoh: Pekerjaan Pintu Set Jendela',
                'grad-input-indigo', j.desc, j.harga, j.vol));
        }

        hitungRAB();
        toggleSidebar();
    }

    function deleteProject(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus permanent riwayat klien ini?')) return;
        let projects = JSON.parse(localStorage.getItem('smartrab_projects')) || [];
        projects = projects.filter(p => p.id !== id);
        localStorage.setItem('smartrab_projects', JSON.stringify(projects));

        if (document.getElementById('current_project_id').value === id) {
            resetFormKlien();
        }
        renderRiwayatList();
    }

    function resetFormKlien() {
        document.getElementById('current_project_id').value = '';
        document.getElementById('klien_nama').value = '';
        document.getElementById('klien_telepon').value = '';
        document.getElementById('klien_tanggal').value = '';
        document.getElementById('budget_awal').value = '';

        document.getElementById('qty_basi').value = '';
        document.getElementById('harga_basi').value = '';
        document.getElementById('hari_basi').value = '';
        document.getElementById('qty_ab').value = '';
        document.getElementById('harga_ab').value = '';
        document.getElementById('hari_ab').value = '';

        document.getElementById('tabel_material').innerHTML = '';
        tambahBaris('tabel_material', 'Contoh: Semen Portland / Zak', 'grad-input-teal');

        document.getElementById('tabel_pekerjaan').innerHTML = '';
        tambahBaris('tabel_pekerjaan', 'Contoh: Pekerjaan Pintu Set Jendela', 'grad-input-indigo');

        hitungRAB();
    }

    function eksporSeluruhData() {
        let projects = localStorage.getItem('smartrab_projects');
        if (!projects || JSON.parse(projects).length === 0) {
            alert('Tidak ada riwayat data klien untuk diekspor!');
            return;
        }

        let dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(projects);
        let downloadAnchor = document.createElement('a');
        downloadAnchor.setAttribute("href", dataStr);
        downloadAnchor.setAttribute("download", "Backup_Data_SmartRAB_" + new Date().toISOString().split('T')[0] +
            ".json");
        document.body.appendChild(downloadAnchor);
        downloadAnchor.click();
        downloadAnchor.remove();
    }

    function imporSeluruhData(input) {
        let file = input.files[0];
        if (!file) return;

        let reader = new FileReader();
        reader.onload = function(e) {
            try {
                let importedData = JSON.parse(e.target.result);
                if (Array.isArray(importedData)) {
                    if (confirm(
                            'Impor data akan menggabungkan riwayat klien baru ke dalam browser ini. Lanjutkan?')) {
                        let localData = JSON.parse(localStorage.getItem('smartrab_projects')) || [];

                        let combinedData = [...importedData, ...localData];
                        let uniqueData = combinedData.filter((v, i, a) => a.findIndex(t => (t.id === v.id)) === i);

                        localStorage.setItem('smartrab_projects', JSON.stringify(uniqueData));
                        renderRiwayatList();
                        alert('Selesai! Seluruh data dari perangkat lain sukses dimasukkan.');
                    }
                } else {
                    alert('Format file cadangan tidak valid!');
                }
            } catch (err) {
                alert('Gagal membaca file backup, pastikan file berformat .json asli!');
            }
        };
        reader.readAsText(file);
        input.value = '';
    }

    window.onload = function() {
        hitungRAB();
        renderRiwayatList();
    };
    </script>
</body>

</html>