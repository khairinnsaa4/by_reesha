<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Laporan Bisnis & Penjualan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; color: #1e293b; }

        /* ===== PRINT STYLES ===== */
        @media print {
            body * { visibility: hidden !important; }
            #print-area, #print-area * { visibility: visible !important; }
            #print-area { position: absolute; left: 0; top: 0; width: 100%; padding: 20px 24px; color: #000 !important; background: #fff !important; }
            .no-print { display: none !important; }
            table { border-collapse: collapse !important; width: 100% !important; margin-bottom: 16px !important; }
            th, td { border: 1px solid #1f2937 !important; padding: 6px 10px !important; font-size: 11px !important; color: #000 !important; }
            th { background-color: #f3f4f6 !important; -webkit-print-color-adjust: exact; font-weight: 700 !important; }
            tr { page-break-inside: avoid !important; }
            .print-footer { page-break-inside: avoid !important; }
        }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-gray-800 bg-[#f9fafb]">

    <!-- Mobile Topbar for Laporan -->
    <header class="md:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between sticky top-0 z-30 shadow-sm no-print">
        <a href="/profil" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-xs leading-tight">{{ Auth::user()->name }}</h4>
                <p class="text-[10px] text-gray-400 capitalize">{{ Auth::user()->role }}</p>
            </div>
        </a>
        <button id="mobile-dash-btn" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none" aria-label="Buka Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </header>

    <!-- Mobile Dropdown Navigation -->
    <div id="mobile-dash-menu" class="hidden md:hidden bg-white border-b border-gray-200 px-4 py-3 shadow-md space-y-1 no-print">
        <nav class="space-y-1">
            <a href="/dashboard-owner" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Dashboard
            </a>
            @if(Auth::check() && Auth::user()->role === 'owner')
            <a href="/karyawan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Karyawan
            </a>
            <a href="/pelanggan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Pelanggan
            </a>
            @endif
            <a href="/pemesanan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Pemesanan
            </a>
            @if(Auth::check() && Auth::user()->role === 'owner')
            <a href="/transaksi" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Transaksi
            </a>
            @endif
            <a href="/logistik" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Logistik
            </a>
            <a href="/supplier" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Supplier
            </a>
            @if(Auth::check() && Auth::user()->isPembuatKue())
            <a href="/resep" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm flex items-center justify-between">
                <span>Resep Produk</span>
                <span class="text-[10px] bg-pink-100 text-pink-700 px-1.5 py-0.5 rounded font-semibold">Baker</span>
            </a>
            @endif
            @if(Auth::check() && Auth::user()->role === 'owner')
            <a href="/laporan" class="block w-full text-left px-3 py-2 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
                Laporan
            </a>
            @endif
        </nav>
        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between">
            <a href="/" class="text-xs text-gray-500 font-medium hover:text-gray-800">Lihat Website</a>
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-xs text-red-500 font-medium hover:underline">Keluar</button>
            </form>
        </div>
    </div>

    {{-- ===== SIDEBAR DESKTOP ===== --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-screen sticky top-0 p-5 hidden md:flex no-print shrink-0">
        <div>
            <a href="/profil" class="flex items-center gap-3 mb-8 p-2 -ml-2 rounded-xl hover:bg-gray-50 transition cursor-pointer group">
                <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h4 class="font-medium text-gray-800 text-sm group-hover:text-pink-600 transition">{{ Auth::user()->name }}</h4>
                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                </div>
            </a>

            <nav class="space-y-1">
                <a href="/dashboard-owner" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Dashboard
                </a>
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/karyawan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Karyawan
                </a>
                <a href="/pelanggan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Pelanggan
                </a>
                @endif
                <a href="/pemesanan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Pemesanan
                </a>
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/transaksi" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Transaksi
                </a>
                @endif
                <a href="/logistik" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Logistik
                </a>
                <a href="/supplier" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Supplier
                </a>
                @if(Auth::check() && Auth::user()->isPembuatKue())
                <a href="/resep" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm flex items-center justify-between">
                    <span>Resep Produk</span>
                    <span class="text-[10px] bg-pink-100 text-pink-700 px-1.5 py-0.5 rounded font-semibold">Baker</span>
                </a>
                @endif
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/laporan" class="block w-full text-left px-4 py-2.5 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm mb-4">
                    Laporan
                </a>
                @endif
            </nav>
        </div>

        <div class="mt-8 border-t border-gray-100 pt-4">
            <a href="/" class="block w-full text-left px-4 py-2 text-gray-500 font-medium hover:text-gray-800 transition text-sm mb-2">
                Lihat Website
            </a>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-500 font-medium hover:bg-red-50 rounded-lg transition text-sm">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="flex-1 p-4 sm:p-6 md:p-8 min-w-0 max-w-7xl">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 no-print">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Laporan Bisnis & Penjualan</h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">Pantau omzet, performa pesanan, dan keuangan toko kue By.Reesha</p>
            </div>
            
            <div class="flex items-center gap-2">
                <button onclick="cetakLaporan('penjualan')"
                    class="bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-pink-100 transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak Lembar Laporan</span>
                </button>
            </div>
        </div>

        {{-- ===== DEDICATED FILTER CARD ===== --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-100 p-4 sm:p-6 mb-6 no-print">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 pb-4 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-pink-500"></span>
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Filter Periode Laporan</h3>
                </div>
                <div class="text-xs text-gray-400">
                    Pilih periode laporan: Harian, Mingguan, Bulanan, atau Tahunan
                </div>
            </div>

            <form action="/laporan" method="GET" id="form-filter" class="pt-4 space-y-4">
                {{-- Period Selector Pills --}}
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="selectFilterMode('semua')" id="pill-semua"
                        class="filter-pill px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'semua' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        🌐 Semua Waktu
                    </button>
                    <button type="button" onclick="selectFilterMode('harian')" id="pill-harian"
                        class="filter-pill px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'harian' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        📅 Harian (Pilih Tanggal)
                    </button>
                    <button type="button" onclick="selectFilterMode('mingguan')" id="pill-mingguan"
                        class="filter-pill px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'mingguan' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        📆 Mingguan (Pilih Minggu)
                    </button>
                    <button type="button" onclick="selectFilterMode('bulanan')" id="pill-bulanan"
                        class="filter-pill px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'bulanan' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        🗓️ Bulanan (Pilih Bulan)
                    </button>
                    <button type="button" onclick="selectFilterMode('tahunan')" id="pill-tahunan"
                        class="filter-pill px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'tahunan' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        📊 Tahunan (Pilih Tahun)
                    </button>
                </div>

                <input type="hidden" name="filter" id="input-filter-mode" value="{{ $filter }}">

                {{-- Interactive Selector Inputs Area --}}
                <div class="bg-gray-50/80 rounded-2xl p-4 border border-gray-100">
                    
                    {{-- 1. Input Harian --}}
                    <div id="box-harian" class="{{ $filter === 'harian' ? 'block' : 'hidden' }} space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih Tanggal Spesifik:
                        </label>
                        <div class="flex flex-wrap items-center gap-2">
                            <input type="date" name="tanggal" id="input-tanggal" value="{{ $tanggal ?? now()->toDateString() }}"
                                class="bg-white border border-gray-300 rounded-xl px-3.5 py-2 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                            <button type="button" onclick="setQuickDate('today')"
                                class="text-xs bg-white hover:bg-pink-50 text-pink-600 border border-pink-200 font-semibold px-3 py-2 rounded-xl transition">
                                Hari Ini
                            </button>
                            <button type="button" onclick="setQuickDate('yesterday')"
                                class="text-xs bg-white hover:bg-gray-100 text-gray-600 border border-gray-300 font-medium px-3 py-2 rounded-xl transition">
                                Kemarin
                            </button>
                        </div>
                    </div>

                    {{-- 2. Input Mingguan --}}
                    <div id="box-mingguan" class="{{ $filter === 'mingguan' ? 'block' : 'hidden' }} space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih Pekan / Minggu Kalender:
                        </label>
                        <div class="flex flex-wrap items-center gap-3">
                            <input type="week" name="minggu" id="input-minggu" value="{{ $minggu ?? now()->format('Y-\WW') }}"
                                class="bg-white border border-gray-300 rounded-xl px-3.5 py-2 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                            @if($tanggal_awal && $tanggal_akhir)
                            <span class="text-xs font-semibold bg-pink-100 text-pink-700 px-3 py-1.5 rounded-lg">
                                📅 Rentang: {{ $tanggal_awal }} s/d {{ $tanggal_akhir }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- 3. Input Bulanan --}}
                    <div id="box-bulanan" class="{{ $filter === 'bulanan' ? 'block' : 'hidden' }} space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih Bulan & Tahun:
                        </label>
                        <div class="flex flex-wrap items-center gap-3">
                            <input type="month" name="bulan" id="input-bulan" value="{{ $bulan_input ?? now()->format('Y-m') }}"
                                class="bg-white border border-gray-300 rounded-xl px-3.5 py-2 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                            @if($nama_bulan && $tahun_bulan)
                            <span class="text-xs font-semibold bg-pink-100 text-pink-700 px-3 py-1.5 rounded-lg">
                                🗓️ Bulan Terpilih: {{ $nama_bulan }} {{ $tahun_bulan }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- 4. Input Tahunan --}}
                    <div id="box-tahunan" class="{{ $filter === 'tahunan' ? 'block' : 'hidden' }} space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih Tahun Rekap:
                        </label>
                        <div class="flex items-center gap-3">
                            <select name="tahun" id="input-tahun"
                                class="bg-white border border-gray-300 rounded-xl px-4 py-2 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                                @foreach($allYears as $y)
                                    <option value="{{ $y }}" {{ (int)$tahun === (int)$y ? 'selected' : '' }}>Tahun {{ $y }}</option>
                                @endforeach
                            </select>
                            <span class="text-xs text-gray-500">Mencakup rekap 12 bulan (Januari - Desember)</span>
                        </div>
                    </div>

                    {{-- 5. Semua Waktu Info --}}
                    <div id="box-semua" class="{{ $filter === 'semua' ? 'block' : 'hidden' }}">
                        <p class="text-xs text-gray-500">
                            Menampilkan seluruh riwayat transaksi By.Reesha dari awal toko beroperasi hingga saat ini tanpa batasan rentang waktu.
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-3 flex items-center gap-2 border-t border-gray-200 mt-3">
                        <button type="submit"
                            class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span>Terapkan Filter</span>
                        </button>
                        @if($filter !== 'semua')
                        <a href="/laporan"
                            class="bg-white hover:bg-gray-100 text-gray-600 border border-gray-300 text-xs font-semibold px-4 py-2.5 rounded-xl transition">
                            Reset ke Semua Waktu
                        </a>
                        @endif
                    </div>
                </div>
            </form>

            {{-- Active Period Status Banner --}}
            <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3 bg-pink-50/60 rounded-xl border border-pink-100 text-xs">
                <div class="flex items-center gap-2">
                    <span class="text-base">📌</span>
                    <span class="text-gray-600">Periode Aktif:</span>
                    <strong class="text-pink-700 text-sm font-bold">{{ $label_periode }}</strong>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 rounded-full font-semibold bg-white border border-pink-200 text-pink-700">
                        {{ $total_pesanan }} Transaksi Ditemukan
                    </span>
                </div>
            </div>
        </div>

        {{-- ===== 4 KEY STATISTIC METRICS ===== --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 mb-8 no-print">
            {{-- Omzet --}}
            <div class="bg-gradient-to-br from-pink-500 to-rose-600 p-4 sm:p-5 rounded-2xl shadow-sm text-white flex flex-col justify-between">
                <div>
                    <span class="text-xs font-medium opacity-85 block uppercase tracking-wider mb-1">Total Omzet</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold truncate">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                </div>
                <div class="text-[11px] opacity-75 mt-2 flex items-center gap-1">
                    <span>💰 Pendapatan kotor</span>
                </div>
            </div>

            {{-- Pesanan Masuk --}}
            <div class="bg-gradient-to-br from-purple-500 to-indigo-600 p-4 sm:p-5 rounded-2xl shadow-sm text-white flex flex-col justify-between">
                <div>
                    <span class="text-xs font-medium opacity-85 block uppercase tracking-wider mb-1">Pesanan Masuk</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold">{{ $total_pesanan }} Transaksi</h3>
                </div>
                <div class="text-[11px] opacity-75 mt-2 flex items-center gap-1">
                    <span>🧾 Total pesanan terdata</span>
                </div>
            </div>

            {{-- Produk Terjual --}}
            <div class="bg-gradient-to-br from-amber-500 to-orange-500 p-4 sm:p-5 rounded-2xl shadow-sm text-white flex flex-col justify-between">
                <div>
                    <span class="text-xs font-medium opacity-85 block uppercase tracking-wider mb-1">Produk Terjual</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold">{{ $total_produk }} Item</h3>
                </div>
                <div class="text-[11px] opacity-75 mt-2 flex items-center gap-1">
                    <span>🍰 Volume kue keluar</span>
                </div>
            </div>

            {{-- Rata-rata Pesanan (AOV) --}}
            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 p-4 sm:p-5 rounded-2xl shadow-sm text-white flex flex-col justify-between">
                <div>
                    <span class="text-xs font-medium opacity-85 block uppercase tracking-wider mb-1">Rata-Rata Order</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold truncate">Rp {{ number_format($rata_rata_pesanan, 0, ',', '.') }}</h3>
                </div>
                <div class="text-[11px] opacity-75 mt-2 flex items-center gap-1">
                    <span>📈 Average Order Value</span>
                </div>
            </div>
        </div>

        {{-- ===== TAB NAVIGATION BAR ===== --}}
        <div class="no-print flex gap-2 mb-6 border-b border-gray-200 overflow-x-auto pb-0.5">
            <button onclick="showTab('penjualan')" id="tab-penjualan"
                class="tab-btn whitespace-nowrap px-4 sm:px-5 py-2.5 text-xs sm:text-sm font-semibold rounded-t-xl border-b-2 border-pink-600 text-pink-700 bg-white -mb-px transition flex items-center gap-2">
                <span>📊</span> <span>Laporan Penjualan</span>
            </button>
            <button onclick="showTab('keuangan')" id="tab-keuangan"
                class="tab-btn whitespace-nowrap px-4 sm:px-5 py-2.5 text-xs sm:text-sm font-semibold rounded-t-xl border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition flex items-center gap-2">
                <span>💰</span> <span>Laporan Keuangan</span>
            </button>
            <button onclick="showTab('tahunan')" id="tab-tahunan"
                class="tab-btn whitespace-nowrap px-4 sm:px-5 py-2.5 text-xs sm:text-sm font-semibold rounded-t-xl border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition flex items-center gap-2">
                <span>📅</span> <span>Rekap Tahunan & Bulanan</span>
            </button>
            <button onclick="showTab('logistik')" id="tab-logistik"
                class="tab-btn whitespace-nowrap px-4 sm:px-5 py-2.5 text-xs sm:text-sm font-semibold rounded-t-xl border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition flex items-center gap-2">
                <span>📦</span> <span>Logistik & Stok Bahan</span>
            </button>
        </div>

        {{-- ========================================== --}}
        {{-- TAB 1: LAPORAN PENJUALAN --}}
        {{-- ========================================== --}}
        <div id="panel-penjualan" class="tab-panel">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                
                {{-- Panel Top Toolbar --}}
                <div class="p-4 sm:p-5 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900">Rincian Penjualan Kue</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Daftar transaksi dan kontribusi omzet per produk</p>
                    </div>
                    <button onclick="cetakLaporan('penjualan')"
                        class="no-print flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3.5 py-2 rounded-xl transition">
                        🖨️ Cetak Tab Ini
                    </button>
                </div>

                {{-- Printable Content Area --}}
                <div id="print-penjualan" class="p-4 sm:p-6 space-y-6">
                    <div class="hidden print-header border-b-2 border-black pb-3 mb-4 text-center">
                        <div class="flex items-center justify-center gap-3 mb-1">
                            <img src="{{ asset('images/logo.png') }}" class="h-14 w-14 object-contain rounded-full" alt="Logo">
                            <div class="text-left">
                                <h1 class="text-xl font-extrabold tracking-wider text-black uppercase">BY.REESHA CAKE & BAKERY</h1>
                                <p class="text-xs text-gray-700 font-medium">Spesialisasi Custom Cake, Bento Cake, & Artisan Pastry</p>
                                <p class="text-[11px] text-gray-500">Jl. By Reesha No. 1, Jakarta • Telp/WhatsApp: 0812-3456-7890 • byreesha.vercel.app</p>
                            </div>
                        </div>
                        <div class="text-center mt-3 pt-2 border-t border-gray-300">
                            <h2 class="text-base font-bold uppercase tracking-wide text-black underline">
                                LAPORAN REKAPITULASI PENJUALAN KUE
                            </h2>
                            <p class="text-xs text-gray-700 font-semibold mt-0.5">Periode Laporan: {{ $label_periode }}</p>
                        </div>
                        <div class="flex justify-between items-center text-[11px] text-gray-700 mt-2">
                            <span>Dicetak Oleh: <strong>Owner By.Reesha</strong> ({{ Auth::user()->email }})</span>
                            <span>Tanggal Cetak: <strong>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB</strong></span>
                        </div>
                    </div>

                    {{-- 1. Rekap Per Produk --}}
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <span>🎂</span> <span>Rekapitulasi Penjualan Per Produk</span>
                        </h4>
                        <div class="overflow-x-auto border border-gray-200 rounded-xl">
                            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                                <thead>
                                    <tr class="bg-gray-50 text-gray-600 border-b border-gray-200 font-semibold">
                                        <th class="px-4 py-3">Nama Produk Kue</th>
                                        <th class="px-4 py-3 text-center">Qty Terjual</th>
                                        <th class="px-4 py-3 text-right">Total Pendapatan</th>
                                        <th class="px-4 py-3 text-right">Kontribusi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($per_produk as $p)
                                    @php
                                        $kontribusi = $total_pendapatan > 0 ? round(($p['total'] / $total_pendapatan) * 100, 1) : 0;
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3.5 font-semibold text-gray-800">{{ $p['nama'] }}</td>
                                        <td class="px-4 py-3.5 text-center text-gray-700">{{ $p['qty'] }} item</td>
                                        <td class="px-4 py-3.5 text-right font-bold text-pink-600">
                                            Rp {{ number_format($p['total'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3.5 text-right font-medium text-gray-500">
                                            {{ $kontribusi }}%
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-400">
                                            Tidak ada produk terjual pada rentang periode ini.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @if($per_produk->count() > 0)
                                <tfoot>
                                    <tr class="bg-pink-50/70 font-bold border-t border-pink-200 text-gray-900">
                                        <td class="px-4 py-3 text-gray-800">TOTAL KESELURUHAN</td>
                                        <td class="px-4 py-3 text-center text-gray-800">{{ $total_produk }} item</td>
                                        <td class="px-4 py-3 text-right text-pink-700 text-base">
                                            Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 text-right text-gray-700">100%</td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>

                    {{-- 2. Detail Seluruh Transaksi --}}
                    <div class="pt-2">
                        <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <span>🧾</span> <span>Daftar Detail Transaksi Lengkap</span>
                        </h4>
                        <div class="overflow-x-auto border border-gray-200 rounded-xl">
                            <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                                <thead>
                                    <tr class="bg-gray-50 text-gray-600 border-b border-gray-200 font-semibold">
                                        <th class="px-4 py-3">ID Transaksi</th>
                                        <th class="px-4 py-3">Tanggal & Waktu</th>
                                        <th class="px-4 py-3">Nama Produk</th>
                                        <th class="px-4 py-3">Nama Pembeli</th>
                                        <th class="px-4 py-3 text-center">Qty</th>
                                        <th class="px-4 py-3">Pembayaran</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3 text-right">Total Bayar</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($transaksis as $i => $trx)
                                    @php
                                        $badgeStatus = 'bg-gray-100 text-gray-700';
                                        if (in_array($trx->status, ['Selesai', 'Diterima'])) $badgeStatus = 'bg-emerald-100 text-emerald-800';
                                        elseif (in_array($trx->status, ['Dikemas', 'Sedang Diproses', 'Diproses'])) $badgeStatus = 'bg-amber-100 text-amber-800';
                                        elseif (in_array($trx->status, ['Dalam Pengiriman', 'Dikirim'])) $badgeStatus = 'bg-blue-100 text-blue-800';
                                        elseif (in_array($trx->status, ['Dibatalkan', 'Batal'])) $badgeStatus = 'bg-red-100 text-red-800';
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3.5 font-bold text-gray-800">
                                            #TRX-{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-4 py-3.5 text-gray-500">
                                            {{ $trx->created_at ? $trx->created_at->format('d/m/Y H:i') : '-' }}
                                        </td>
                                        <td class="px-4 py-3.5 font-semibold text-gray-900">
                                            {{ $trx->nama_produk }}
                                        </td>
                                        <td class="px-4 py-3.5 text-gray-700">
                                            {{ $trx->user?->name ?? 'Pelanggan Tamu' }}
                                        </td>
                                        <td class="px-4 py-3.5 text-center text-gray-800 font-semibold">
                                            {{ $trx->qty }}
                                        </td>
                                        <td class="px-4 py-3.5">
                                            <span class="px-2 py-0.5 rounded-md text-[11px] font-bold
                                                {{ $trx->metode_pembayaran === 'QRIS' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                                {{ $trx->metode_pembayaran ?? 'QRIS' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3.5">
                                            <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $badgeStatus }}">
                                                {{ $trx->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3.5 text-right font-extrabold text-pink-600">
                                            Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-10 text-center text-gray-400">
                                            Belum ada data transaksi yang tercatat pada periode ini.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Formal Signature Block --}}
                    <div class="hidden print-footer pt-6 grid grid-cols-2 text-center text-xs text-black" style="page-break-inside: avoid;">
                        <div>
                            <p class="text-gray-600 mb-1">Dibuat & Diverifikasi Oleh:</p>
                            <p class="font-bold">Staff Administrasi By.Reesha</p>
                            <div class="h-16"></div>
                            <p class="font-bold">( __________________________ )</p>
                            <p class="text-[10px] text-gray-500">Bagian Keuangan & Kasir</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Mengetahui & Menyetujui:</p>
                            <p class="font-bold">Owner By.Reesha</p>
                            <div class="h-16"></div>
                            <p class="font-bold underline">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-gray-500">Pemilik Usaha / Manajemen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- TAB 2: LAPORAN KEUANGAN --}}
        {{-- ========================================== --}}
        <div id="panel-keuangan" class="tab-panel hidden">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-4 sm:p-5 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900">Laporan Arus Kas & Keuangan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Analisis omzet, estimasi biaya produksi (HPP), dan laba bersih</p>
                    </div>
                    <button onclick="cetakLaporan('keuangan')"
                        class="no-print flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3.5 py-2 rounded-xl transition">
                        🖨️ Cetak Tab Ini
                    </button>
                </div>

                <div id="print-keuangan" class="p-4 sm:p-6 space-y-6">
                    <div class="hidden print-header border-b-2 border-black pb-3 mb-4 text-center">
                        <div class="flex items-center justify-center gap-3 mb-1">
                            <img src="{{ asset('images/logo.png') }}" class="h-14 w-14 object-contain rounded-full" alt="Logo">
                            <div class="text-left">
                                <h1 class="text-xl font-extrabold tracking-wider text-black uppercase">BY.REESHA CAKE & BAKERY</h1>
                                <p class="text-xs text-gray-700 font-medium">Spesialisasi Custom Cake, Bento Cake, & Artisan Pastry</p>
                                <p class="text-[11px] text-gray-500">Jl. By Reesha No. 1, Jakarta • Telp/WhatsApp: 0812-3456-7890 • byreesha.vercel.app</p>
                            </div>
                        </div>
                        <div class="text-center mt-3 pt-2 border-t border-gray-300">
                            <h2 class="text-base font-bold uppercase tracking-wide text-black underline">
                                LAPORAN KEUANGAN & ARUS KAS
                            </h2>
                            <p class="text-xs text-gray-700 font-semibold mt-0.5">Periode Laporan: {{ $label_periode }}</p>
                        </div>
                        <div class="flex justify-between items-center text-[11px] text-gray-700 mt-2">
                            <span>Dicetak Oleh: <strong>Owner By.Reesha</strong> ({{ Auth::user()->email }})</span>
                            <span>Tanggal Cetak: <strong>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB</strong></span>
                        </div>
                    </div>

                    {{-- Cards Ringkasan Keuangan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5">
                            <span class="text-xs text-emerald-700 font-bold uppercase tracking-wider block mb-1">Total Pemasukan</span>
                            <p class="text-2xl font-extrabold text-emerald-800">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
                            <p class="text-xs text-emerald-600 mt-1">Dari {{ $total_pesanan }} transaksi penjualan</p>
                        </div>
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
                            <span class="text-xs text-amber-700 font-bold uppercase tracking-wider block mb-1">Estimasi HPP Bahan Baku (40%)</span>
                            <p class="text-2xl font-extrabold text-amber-800">Rp {{ number_format($total_pendapatan * 0.4, 0, ',', '.') }}</p>
                            <p class="text-xs text-amber-600 mt-1">Biaya tepung, mentega, telur, packaging</p>
                        </div>
                        <div class="bg-indigo-50 border border-indigo-200 rounded-2xl p-5">
                            <span class="text-xs text-indigo-700 font-bold uppercase tracking-wider block mb-1">Estimasi Margin Laba Kotor (60%)</span>
                            <p class="text-2xl font-extrabold text-indigo-800">Rp {{ number_format($total_pendapatan * 0.6, 0, ',', '.') }}</p>
                            <p class="text-xs text-indigo-600 mt-1">Sebelum operasional toko & overhead</p>
                        </div>
                    </div>

                    {{-- Rekap Metode Pembayaran --}}
                    @php
                        $per_metode = $transaksis->groupBy('metode_pembayaran');
                    @endphp
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <span>💳</span> <span>Penerimaan Berdasarkan Metode Pembayaran</span>
                        </h4>
                        <div class="overflow-x-auto border border-gray-200 rounded-xl">
                            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                                <thead>
                                    <tr class="bg-gray-50 text-gray-600 border-b border-gray-200 font-semibold">
                                        <th class="px-4 py-3">Metode Pembayaran</th>
                                        <th class="px-4 py-3 text-center">Jumlah Transaksi</th>
                                        <th class="px-4 py-3 text-right">Total Dana Masuk</th>
                                        <th class="px-4 py-3 text-right">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($per_metode as $metode => $items)
                                    @php
                                        $subtotal = $items->sum('total_harga');
                                        $persen = $total_pendapatan > 0 ? round(($subtotal / $total_pendapatan) * 100, 1) : 0;
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3.5 font-semibold text-gray-800">
                                            <span class="px-2.5 py-1 rounded-md text-xs font-bold
                                                {{ $metode === 'QRIS' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                                {{ $metode ?: 'QRIS' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3.5 text-center text-gray-700">{{ $items->count() }} transaksi</td>
                                        <td class="px-4 py-3.5 text-right font-bold text-gray-900">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3.5 text-right text-gray-500 font-medium">{{ $persen }}%</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="px-4 py-8 text-center text-gray-400">Belum ada data keuangan tercatat.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                    </div>

                    {{-- Formal Signature Block --}}
                    <div class="hidden print-footer pt-6 grid grid-cols-2 text-center text-xs text-black" style="page-break-inside: avoid;">
                        <div>
                            <p class="text-gray-600 mb-1">Dibuat & Diverifikasi Oleh:</p>
                            <p class="font-bold">Staff Administrasi By.Reesha</p>
                            <div class="h-16"></div>
                            <p class="font-bold">( __________________________ )</p>
                            <p class="text-[10px] text-gray-500">Bagian Keuangan & Kasir</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Mengetahui & Menyetujui:</p>
                            <p class="font-bold">Owner By.Reesha</p>
                            <div class="h-16"></div>
                            <p class="font-bold underline">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-gray-500">Pemilik Usaha / Manajemen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- TAB 3: LAPORAN TAHUNAN & BULANAN --}}
        {{-- ========================================== --}}
        <div id="panel-tahunan" class="tab-panel hidden">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-4 sm:p-5 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900">Rekapitulasi Tahunan (Tahun {{ $tahun }})</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Performa penjualan bulanan dari Januari hingga Desember {{ $tahun }}</p>
                    </div>
                    <button onclick="cetakLaporan('tahunan')"
                        class="no-print flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3.5 py-2 rounded-xl transition">
                        🖨️ Cetak Tab Ini
                    </button>
                </div>

                <div id="print-tahunan" class="p-4 sm:p-6 space-y-6">
                    <div class="hidden print-header border-b-2 border-black pb-3 mb-4 text-center">
                        <div class="flex items-center justify-center gap-3 mb-1">
                            <img src="{{ asset('images/logo.png') }}" class="h-14 w-14 object-contain rounded-full" alt="Logo">
                            <div class="text-left">
                                <h1 class="text-xl font-extrabold tracking-wider text-black uppercase">BY.REESHA CAKE & BAKERY</h1>
                                <p class="text-xs text-gray-700 font-medium">Spesialisasi Custom Cake, Bento Cake, & Artisan Pastry</p>
                                <p class="text-[11px] text-gray-500">Jl. By Reesha No. 1, Jakarta • Telp/WhatsApp: 0812-3456-7890 • byreesha.vercel.app</p>
                            </div>
                        </div>
                        <div class="text-center mt-3 pt-2 border-t border-gray-300">
                            <h2 class="text-base font-bold uppercase tracking-wide text-black underline">
                                LAPORAN REKAPITULASI TAHUNAN {{ $tahun }}
                            </h2>
                            <p class="text-xs text-gray-700 font-semibold mt-0.5">Periode Laporan: Rekap 12 Bulan (Januari - Desember {{ $tahun }})</p>
                        </div>
                        <div class="flex justify-between items-center text-[11px] text-gray-700 mt-2">
                            <span>Dicetak Oleh: <strong>Owner By.Reesha</strong> ({{ Auth::user()->email }})</span>
                            <span>Tanggal Cetak: <strong>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB</strong></span>
                        </div>
                    </div>

                    @php
                        $pendapatan_tahunan = $per_bulan->sum('pendapatan');
                        $transaksi_tahunan  = $per_bulan->sum('transaksi');
                        $produk_tahunan     = $per_bulan->sum('produk');
                        $bulan_terbaik      = $per_bulan->sortByDesc('pendapatan')->first();
                        $max_pendapatan     = $per_bulan->max('pendapatan');
                    @endphp

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                        <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-xl">
                            <span class="text-[11px] font-bold text-indigo-600 uppercase block mb-1">Total Omzet {{ $tahun }}</span>
                            <p class="text-lg sm:text-xl font-extrabold text-indigo-900">Rp {{ number_format($pendapatan_tahunan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-pink-50 border border-pink-100 p-4 rounded-xl">
                            <span class="text-[11px] font-bold text-pink-600 uppercase block mb-1">Total Pesanan</span>
                            <p class="text-lg sm:text-xl font-extrabold text-pink-900">{{ $transaksi_tahunan }} Order</p>
                        </div>
                        <div class="bg-amber-50 border border-amber-100 p-4 rounded-xl">
                            <span class="text-[11px] font-bold text-amber-600 uppercase block mb-1">Produk Terjual</span>
                            <p class="text-lg sm:text-xl font-extrabold text-amber-900">{{ $produk_tahunan }} Item</p>
                        </div>
                        <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-xl">
                            <span class="text-[11px] font-bold text-emerald-600 uppercase block mb-1">Bulan Tertinggi</span>
                            <p class="text-lg sm:text-xl font-extrabold text-emerald-900">{{ $bulan_terbaik['label'] ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Tabel 12 Bulan --}}
                    <div class="overflow-x-auto border border-gray-200 rounded-xl">
                        <table class="w-full text-left border-collapse text-xs sm:text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 border-b border-gray-200 font-semibold">
                                    <th class="px-4 py-3">Bulan</th>
                                    <th class="px-4 py-3 text-center">Jumlah Transaksi</th>
                                    <th class="px-4 py-3 text-center">Produk Terjual</th>
                                    <th class="px-4 py-3 text-right">Total Pendapatan</th>
                                    <th class="px-4 py-3 text-center">Performa</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($per_bulan as $bln)
                                @php $isTerbaik = $bln['pendapatan'] === $max_pendapatan && $max_pendapatan > 0; @endphp
                                <tr class="hover:bg-gray-50 transition {{ $isTerbaik ? 'bg-pink-50/40' : '' }}">
                                    <td class="px-4 py-3 font-semibold text-gray-800">
                                        {{ $bln['label'] }}
                                        @if($isTerbaik)
                                        <span class="ml-1 text-[11px] bg-pink-100 text-pink-700 px-2 py-0.5 rounded-full font-bold">🏆 Tertinggi</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-600">{{ $bln['transaksi'] }} transaksi</td>
                                    <td class="px-4 py-3 text-center text-gray-600">{{ $bln['produk'] }} item</td>
                                    <td class="px-4 py-3 text-right font-bold {{ $bln['pendapatan'] > 0 ? 'text-pink-600' : 'text-gray-400' }}">
                                        Rp {{ number_format($bln['pendapatan'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($bln['transaksi'] === 0)
                                            <span class="px-2 py-0.5 bg-gray-100 text-gray-400 text-[11px] rounded-full">Belum ada</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[11px] font-semibold rounded-full">Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-100 font-bold text-gray-900 border-t-2 border-gray-300">
                                    <td class="px-4 py-3.5">TOTAL TAHUN {{ $tahun }}</td>
                                    <td class="px-4 py-3.5 text-center">{{ $transaksi_tahunan }} transaksi</td>
                                    <td class="px-4 py-3.5 text-center">{{ $produk_tahunan }} item</td>
                                    <td class="px-4 py-3.5 text-right text-pink-700 text-base">
                                        Rp {{ number_format($pendapatan_tahunan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3.5 text-center text-gray-500 text-xs font-normal">
                                        Rata-rata: Rp {{ number_format($pendapatan_tahunan / 12, 0, ',', '.') }}/bln
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- Formal Signature Block --}}
                    <div class="hidden print-footer pt-6 grid grid-cols-2 text-center text-xs text-black" style="page-break-inside: avoid;">
                        <div>
                            <p class="text-gray-600 mb-1">Dibuat & Diverifikasi Oleh:</p>
                            <p class="font-bold">Staff Administrasi By.Reesha</p>
                            <div class="h-16"></div>
                            <p class="font-bold">( __________________________ )</p>
                            <p class="text-[10px] text-gray-500">Bagian Keuangan & Kasir</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Mengetahui & Menyetujui:</p>
                            <p class="font-bold">Owner By.Reesha</p>
                            <div class="h-16"></div>
                            <p class="font-bold underline">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-gray-500">Pemilik Usaha / Manajemen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- TAB 4: LAPORAN LOGISTIK & STOK --}}
        {{-- ========================================== --}}
        <div id="panel-logistik" class="tab-panel hidden">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-4 sm:p-5 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-gray-900">Laporan Stok & Bahan Baku</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Kondisi persediaan logistik di dapur By.Reesha</p>
                    </div>
                    <button onclick="cetakLaporan('logistik')"
                        class="no-print flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3.5 py-2 rounded-xl transition">
                        🖨️ Cetak Tab Ini
                    </button>
                </div>

                <div id="print-logistik" class="p-4 sm:p-6 space-y-6">
                    <div class="hidden print-header border-b-2 border-black pb-3 mb-4 text-center">
                        <div class="flex items-center justify-center gap-3 mb-1">
                            <img src="{{ asset('images/logo.png') }}" class="h-14 w-14 object-contain rounded-full" alt="Logo">
                            <div class="text-left">
                                <h1 class="text-xl font-extrabold tracking-wider text-black uppercase">BY.REESHA CAKE & BAKERY</h1>
                                <p class="text-xs text-gray-700 font-medium">Spesialisasi Custom Cake, Bento Cake, & Artisan Pastry</p>
                                <p class="text-[11px] text-gray-500">Jl. By Reesha No. 1, Jakarta • Telp/WhatsApp: 0812-3456-7890 • byreesha.vercel.app</p>
                            </div>
                        </div>
                        <div class="text-center mt-3 pt-2 border-t border-gray-300">
                            <h2 class="text-base font-bold uppercase tracking-wide text-black underline">
                                LAPORAN KETERSEDIAAN STOK & LOGISTIK BAHAN BAKU
                            </h2>
                            <p class="text-xs text-gray-700 font-semibold mt-0.5">Inventaris Bahan Dapur & Packaging By.Reesha</p>
                        </div>
                        <div class="flex justify-between items-center text-[11px] text-gray-700 mt-2">
                            <span>Dicetak Oleh: <strong>Owner By.Reesha</strong> ({{ Auth::user()->email }})</span>
                            <span>Tanggal Cetak: <strong>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB</strong></span>
                        </div>
                    </div>

                    @php
                        $stok_kritis  = collect($logistik)->where('status','Kritis')->count();
                        $stok_menipis = collect($logistik)->where('status','Menipis')->count();
                        $stok_aman    = collect($logistik)->where('status','Aman')->count();
                    @endphp
                    <div class="grid grid-cols-3 gap-3 sm:gap-4">
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                            <p class="text-xl sm:text-2xl font-extrabold text-green-700">{{ $stok_aman }}</p>
                            <p class="text-xs text-green-600 font-semibold mt-1">Stok Aman</p>
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-center">
                            <p class="text-xl sm:text-2xl font-extrabold text-yellow-700">{{ $stok_menipis }}</p>
                            <p class="text-xs text-yellow-600 font-semibold mt-1">Stok Menipis</p>
                        </div>
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                            <p class="text-xl sm:text-2xl font-extrabold text-red-700">{{ $stok_kritis }}</p>
                            <p class="text-xs text-red-600 font-semibold mt-1">Stok Kritis</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto border border-gray-200 rounded-xl">
                        <table class="w-full text-left border-collapse text-xs sm:text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 border-b border-gray-200 font-semibold">
                                    <th class="px-4 py-3">Nama Bahan Baku</th>
                                    <th class="px-4 py-3">Kategori</th>
                                    <th class="px-4 py-3 text-center">Sisa Stok</th>
                                    <th class="px-4 py-3 text-center">Satuan</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($logistik as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $item['nama'] }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $item['kategori'] }}</td>
                                    <td class="px-4 py-3 text-center font-bold text-gray-800">{{ $item['stok'] }}</td>
                                    <td class="px-4 py-3 text-center text-gray-500">{{ $item['satuan'] }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if($item['status'] === 'Aman')
                                            <span class="px-2.5 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded-full">✓ Aman</span>
                                        @elseif($item['status'] === 'Menipis')
                                            <span class="px-2.5 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">⚡ Menipis</span>
                                        @else
                                            <span class="px-2.5 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded-full">🔴 Kritis</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada data stok logistik.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Formal Signature Block --}}
                    <div class="hidden print-footer pt-6 grid grid-cols-2 text-center text-xs text-black" style="page-break-inside: avoid;">
                        <div>
                            <p class="text-gray-600 mb-1">Dibuat & Diverifikasi Oleh:</p>
                            <p class="font-bold">Staff Gudang & Logistik</p>
                            <div class="h-16"></div>
                            <p class="font-bold">( __________________________ )</p>
                            <p class="text-[10px] text-gray-500">Penanggung Jawab Stok Dapur</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Mengetahui & Menyetujui:</p>
                            <p class="font-bold">Owner By.Reesha</p>
                            <div class="h-16"></div>
                            <p class="font-bold underline">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-gray-500">Pemilik Usaha / Manajemen</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    {{-- Hidden Print Container --}}
    <div id="print-area" class="hidden"></div>

    <script>
        // Pill filter switcher
        function selectFilterMode(mode) {
            document.getElementById('input-filter-mode').value = mode;

            // Reset all pills
            document.querySelectorAll('.filter-pill').forEach(pill => {
                pill.classList.remove('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-sm');
                pill.classList.add('bg-gray-50', 'text-gray-600', 'border-gray-200');
            });

            // Activate chosen pill
            const activePill = document.getElementById('pill-' + mode);
            if (activePill) {
                activePill.classList.remove('bg-gray-50', 'text-gray-600', 'border-gray-200');
                activePill.classList.add('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-sm');
            }

            // Toggle selector input boxes
            const boxes = ['semua', 'harian', 'mingguan', 'bulanan', 'tahunan'];
            boxes.forEach(b => {
                const el = document.getElementById('box-' + b);
                if (el) {
                    if (b === mode) {
                        el.classList.remove('hidden');
                        el.classList.add('block');
                    } else {
                        el.classList.add('hidden');
                        el.classList.remove('block');
                    }
                }
            });

            // If "semua" clicked, immediately submit form
            if (mode === 'semua') {
                document.getElementById('form-filter').submit();
            }
        }

        // Quick date setter for Harian
        function setQuickDate(type) {
            const dateInput = document.getElementById('input-tanggal');
            const today = new Date();
            if (type === 'yesterday') {
                today.setDate(today.getDate() - 1);
            }
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            dateInput.value = `${yyyy}-${mm}-${dd}`;
            document.getElementById('form-filter').submit();
        }

        // Tab Switching
        function showTab(name) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('border-pink-600','text-pink-700','bg-white','-mb-px');
                b.classList.add('border-transparent','text-gray-500');
            });
            const panel = document.getElementById('panel-' + name);
            if (panel) panel.classList.remove('hidden');
            const btn = document.getElementById('tab-' + name);
            if (btn) {
                btn.classList.add('border-pink-600','text-pink-700','bg-white','-mb-px');
                btn.classList.remove('border-transparent','text-gray-500');
            }
        }

        // Print utility
        function cetakLaporan(type) {
            const area   = document.getElementById('print-area');
            const source = document.getElementById('print-' + type);
            if (!area || !source) return;
            area.innerHTML = source.innerHTML;
            area.querySelectorAll('.print-header').forEach(el => el.classList.remove('hidden'));
            area.querySelectorAll('.print-footer').forEach(el => el.classList.remove('hidden'));
            area.classList.remove('hidden');
            window.print();
            area.classList.add('hidden');
            area.innerHTML = '';
        }

        // If yearly filter is active on page load, switch to yearly tab
        @if(isset($filter) && $filter === 'tahunan')
        window.addEventListener('DOMContentLoaded', () => showTab('tahunan'));
        @endif

        // Mobile sidebar menu toggle
        const dashBtn = document.getElementById('mobile-dash-btn');
        const dashMenu = document.getElementById('mobile-dash-menu');
        if (dashBtn && dashMenu) {
            dashBtn.addEventListener('click', () => {
                dashMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
