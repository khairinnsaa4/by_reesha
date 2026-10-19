<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; color: #1e293b; }

        /* ===== PRINT STYLES ===== */
        @media print {
            body * { visibility: hidden !important; }
            #print-area, #print-area * { visibility: visible !important; }
            #print-area { position: absolute; left: 0; top: 0; width: 100%; padding: 24px; }
            .no-print { display: none !important; }
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #1f2937; padding: 7px 10px; font-size: 11px; }
            th { background-color: #f3f4f6 !important; -webkit-print-color-adjust: exact; color: #111827 !important; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-gray-800 bg-[#f9fafb]">

    <!-- Mobile Topbar for Transaksi -->
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
            <a href="/transaksi" class="block w-full text-left px-3 py-2 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
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
            <a href="/laporan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
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
                <a href="/transaksi" class="block w-full text-left px-4 py-2.5 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
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
                <a href="/laporan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm mb-4">
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
        
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 no-print">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Data Transaksi Penjualan</h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">Rekap seluruh pembayaran pesanan masuk dan cetak laporan transaksi</p>
            </div>
            <button onclick="cetakLaporanTransaksi()"
                class="bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-pink-100 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Cetak Laporan Transaksi</span>
            </button>
        </div>

        {{-- ===== DEDICATED FILTER CARD UNTUK TRANSAKSI ===== --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-100 p-4 sm:p-6 mb-6 no-print">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 pb-4 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-pink-500"></span>
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Filter Periode Transaksi</h3>
                </div>
                <div class="text-xs text-gray-400">
                    Pilih periode: Harian, Mingguan, Bulanan, atau Tahunan
                </div>
            </div>

            <form action="/transaksi" method="GET" id="form-filter-trx" class="pt-4 space-y-4">
                {{-- Period Selector Pills --}}
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="selectFilterModeTrx('semua')" id="pill-trx-semua"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'semua' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        🌐 Semua Waktu
                    </button>
                    <button type="button" onclick="selectFilterModeTrx('harian')" id="pill-trx-harian"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'harian' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        📅 Harian (Pilih Tanggal)
                    </button>
                    <button type="button" onclick="selectFilterModeTrx('mingguan')" id="pill-trx-mingguan"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'mingguan' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        📆 Mingguan (Pilih Minggu)
                    </button>
                    <button type="button" onclick="selectFilterModeTrx('bulanan')" id="pill-trx-bulanan"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'bulanan' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        🗓️ Bulanan (Pilih Bulan)
                    </button>
                    <button type="button" onclick="selectFilterModeTrx('tahunan')" id="pill-trx-tahunan"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'tahunan' ? 'bg-pink-600 text-white border-pink-600 shadow-sm' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        📊 Tahunan (Pilih Tahun)
                    </button>
                </div>

                <input type="hidden" name="filter" id="input-filter-trx-mode" value="{{ $filter }}">

                {{-- Interactive Selector Inputs Area --}}
                <div class="bg-gray-50/80 rounded-2xl p-4 border border-gray-100">
                    
                    {{-- 1. Input Harian --}}
                    <div id="box-trx-harian" class="{{ $filter === 'harian' ? 'block' : 'hidden' }} space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih Tanggal Transaksi:
                        </label>
                        <div class="flex flex-wrap items-center gap-2">
                            <input type="date" name="tanggal" id="input-trx-tanggal" value="{{ $tanggal ?? now()->toDateString() }}"
                                class="bg-white border border-gray-300 rounded-xl px-3.5 py-2 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                            <button type="button" onclick="setQuickDateTrx('today')"
                                class="text-xs bg-white hover:bg-pink-50 text-pink-600 border border-pink-200 font-semibold px-3 py-2 rounded-xl transition">
                                Hari Ini
                            </button>
                            <button type="button" onclick="setQuickDateTrx('yesterday')"
                                class="text-xs bg-white hover:bg-gray-100 text-gray-600 border border-gray-300 font-medium px-3 py-2 rounded-xl transition">
                                Kemarin
                            </button>
                        </div>
                    </div>

                    {{-- 2. Input Mingguan --}}
                    <div id="box-trx-mingguan" class="{{ $filter === 'mingguan' ? 'block' : 'hidden' }} space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih Pekan / Minggu Kalender:
                        </label>
                        <div class="flex flex-wrap items-center gap-3">
                            <input type="week" name="minggu" id="input-trx-minggu" value="{{ $minggu ?? now()->format('Y-\WW') }}"
                                class="bg-white border border-gray-300 rounded-xl px-3.5 py-2 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                            @if($tanggal_awal && $tanggal_akhir)
                            <span class="text-xs font-semibold bg-pink-100 text-pink-700 px-3 py-1.5 rounded-lg">
                                📅 Rentang: {{ $tanggal_awal }} s/d {{ $tanggal_akhir }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- 3. Input Bulanan --}}
                    <div id="box-trx-bulanan" class="{{ $filter === 'bulanan' ? 'block' : 'hidden' }} space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih Bulan & Tahun Transaksi:
                        </label>
                        <div class="flex flex-wrap items-center gap-3">
                            <input type="month" name="bulan" id="input-trx-bulan" value="{{ $bulan_input ?? now()->format('Y-m') }}"
                                class="bg-white border border-gray-300 rounded-xl px-3.5 py-2 text-sm font-medium text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                            @if($nama_bulan && $tahun_bulan)
                            <span class="text-xs font-semibold bg-pink-100 text-pink-700 px-3 py-1.5 rounded-lg">
                                🗓️ Bulan Terpilih: {{ $nama_bulan }} {{ $tahun_bulan }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- 4. Input Tahunan --}}
                    <div id="box-trx-tahunan" class="{{ $filter === 'tahunan' ? 'block' : 'hidden' }} space-y-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Pilih Tahun Transaksi:
                        </label>
                        <div class="flex items-center gap-3">
                            <select name="tahun" id="input-trx-tahun"
                                class="bg-white border border-gray-300 rounded-xl px-4 py-2 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-300 shadow-sm">
                                @foreach($allYears as $y)
                                    <option value="{{ $y }}" {{ (int)$tahun === (int)$y ? 'selected' : '' }}>Tahun {{ $y }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 5. Semua Waktu Info --}}
                    <div id="box-trx-semua" class="{{ $filter === 'semua' ? 'block' : 'hidden' }}">
                        <p class="text-xs text-gray-500">
                            Menampilkan seluruh riwayat transaksi By.Reesha tanpa batas rentang waktu.
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
                        <a href="/transaksi"
                            class="bg-white hover:bg-gray-100 text-gray-600 border border-gray-300 text-xs font-semibold px-4 py-2.5 rounded-xl transition">
                            Reset ke Semua Waktu
                        </a>
                        @endif
                    </div>
                </div>
            </form>

            {{-- Status Banner --}}
            <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3 bg-pink-50/60 rounded-xl border border-pink-100 text-xs">
                <div class="flex items-center gap-2">
                    <span class="text-base">📌</span>
                    <span class="text-gray-600">Periode Transaksi:</span>
                    <strong class="text-pink-700 text-sm font-bold">{{ $label_periode }}</strong>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 rounded-full font-semibold bg-white border border-pink-200 text-pink-700">
                        {{ $total_transaksi }} Transaksi
                    </span>
                    <span class="px-2.5 py-1 rounded-full font-bold bg-pink-600 text-white">
                        Total: Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- ===== TABEL TRANSAKSI ===== --}}
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm no-print">
            {{-- Search Bar --}}
            <div class="p-3.5 sm:p-4 border-b border-gray-200 flex flex-wrap sm:flex-nowrap items-center gap-2">
                <div class="relative flex-1 min-w-[200px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-transaksi" placeholder="Cari no. transaksi, nama pembeli, atau kue..." oninput="cariTransaksi()"
                        class="text-xs sm:text-sm border border-gray-300 rounded-lg pl-9 pr-3 py-2 focus:outline-none focus:border-pink-500 w-full transition">
                </div>
                <button onclick="cariTransaksi()" class="bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-medium px-4 py-2 rounded-lg transition flex items-center gap-1.5 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
                <span id="result-count-trx" class="text-xs text-gray-400 w-full sm:w-auto"></span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 border-b border-gray-200 font-semibold">
                            <th class="px-5 py-3">ID Transaksi</th>
                            <th class="px-5 py-3">Tanggal & Jam</th>
                            <th class="px-5 py-3">Keterangan Pesanan</th>
                            <th class="px-5 py-3 text-center">Qty</th>
                            <th class="px-5 py-3">Metode</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-right">Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="tabel-transaksi">
                        @forelse($transaksis as $trx)
                        @php
                            $badgeStatus = 'bg-gray-100 text-gray-700';
                            if (in_array($trx->status, ['Selesai', 'Diterima'])) $badgeStatus = 'bg-emerald-100 text-emerald-800';
                            elseif (in_array($trx->status, ['Dikemas', 'Sedang Diproses', 'Diproses'])) $badgeStatus = 'bg-amber-100 text-amber-800';
                            elseif (in_array($trx->status, ['Dalam Pengiriman', 'Dikirim'])) $badgeStatus = 'bg-blue-100 text-blue-800';
                            elseif (in_array($trx->status, ['Dibatalkan', 'Batal'])) $badgeStatus = 'bg-red-100 text-red-800';
                        @endphp
                        <tr class="hover:bg-gray-50 transition trx-row">
                            <td class="px-5 py-4 font-bold text-gray-800">#TRX-{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-5 py-4 text-gray-500">{{ $trx->created_at ? $trx->created_at->format('d M Y, H:i') : '-' }}</td>
                            <td class="px-5 py-4 font-medium text-gray-800">
                                <div>{{ $trx->nama_produk }}</div>
                                <div class="text-[11px] text-gray-400">Pembeli: {{ $trx->user ? $trx->user->name : 'Pelanggan Tamu' }}</div>
                            </td>
                            <td class="px-5 py-4 text-center font-semibold text-gray-700">{{ $trx->qty }}</td>
                            <td class="px-5 py-4">
                                <span class="px-2 py-0.5 rounded-md text-[11px] font-bold
                                    {{ $trx->metode_pembayaran === 'QRIS' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                    {{ $trx->metode_pembayaran ?? 'QRIS' }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $badgeStatus }}">
                                    {{ $trx->status }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right font-extrabold text-pink-600">
                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-trx">
                            <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                Belum ada transaksi yang tercatat pada periode ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($transaksis->count() > 0)
                    <tfoot>
                        <tr class="bg-pink-50/70 font-bold border-t border-pink-200">
                            <td colspan="3" class="px-5 py-3.5 text-gray-900">TOTAL TRANSAKSI ({{ $total_transaksi }} Pesanan)</td>
                            <td class="px-5 py-3.5 text-center text-gray-900">{{ $total_produk }} Item</td>
                            <td colspan="2"></td>
                            <td class="px-5 py-3.5 text-right text-pink-700 text-base font-extrabold">
                                Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>

        {{-- ===== OFFICIAL FORMAL PRINT LAYOUT (KOP SURAT & FORMAT RESMI) ===== --}}
        <div id="print-transaksi-formal" class="hidden">
            {{-- Kop Surat Resmi --}}
            <div class="border-b-2 border-black pb-3 mb-4 text-center">
                <div class="flex items-center justify-center gap-3 mb-1">
                    <img src="{{ asset('images/logo.png') }}" class="h-14 w-14 object-contain rounded-full" alt="Logo">
                    <div class="text-left">
                        <h1 class="text-xl font-extrabold tracking-wider text-black uppercase">BY.REESHA CAKE & BAKERY</h1>
                        <p class="text-xs text-gray-700 font-medium">Spesialisasi Custom Cake, Bento Cake, & Artisan Pastry</p>
                        <p class="text-[11px] text-gray-500">Jl. By Reesha No. 1, Jakarta • Telp/WhatsApp: 0812-3456-7890 • byreesha.vercel.app</p>
                    </div>
                </div>
            </div>

            {{-- Judul Laporan & Metadata --}}
            <div class="text-center mb-4">
                <h2 class="text-base font-bold uppercase tracking-wide text-black underline">
                    LAPORAN REKAPITULASI TRANSAKSI PENJUALAN
                </h2>
                <p class="text-xs text-gray-700 font-semibold mt-1">
                    Periode Laporan: {{ $label_periode }}
                </p>
            </div>

            <div class="flex justify-between items-center text-[11px] text-gray-700 mb-3 border-b border-gray-300 pb-2">
                <div>
                    <span>Dicetak Oleh: <strong>Owner By.Reesha</strong> ({{ Auth::user()->email }})</span>
                </div>
                <div>
                    <span>Tanggal Cetak: <strong>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB</strong></span>
                </div>
            </div>

            {{-- Ringkasan Angka --}}
            <div class="grid grid-cols-3 gap-3 mb-4 text-[11px]">
                <div class="p-2.5 border border-gray-400 rounded bg-gray-50">
                    <span class="text-gray-600 block">Total Transaksi:</span>
                    <strong class="text-sm font-bold text-black">{{ $total_transaksi }} Pesanan</strong>
                </div>
                <div class="p-2.5 border border-gray-400 rounded bg-gray-50">
                    <span class="text-gray-600 block">Total Produk Terjual:</span>
                    <strong class="text-sm font-bold text-black">{{ $total_produk }} Item Kue</strong>
                </div>
                <div class="p-2.5 border border-gray-400 rounded bg-gray-50">
                    <span class="text-gray-600 block">Total Penerimaan Dana:</span>
                    <strong class="text-sm font-bold text-black">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</strong>
                </div>
            </div>

            {{-- Tabel Transaksi Formal --}}
            <table class="w-full text-left text-[11px] mb-6 border border-black">
                <thead>
                    <tr class="bg-gray-100 border-b border-black font-bold">
                        <th class="p-2 text-center" style="width: 35px;">No</th>
                        <th class="p-2" style="width: 90px;">No. TRX</th>
                        <th class="p-2" style="width: 110px;">Tanggal</th>
                        <th class="p-2">Rincian Produk & Pembeli</th>
                        <th class="p-2 text-center" style="width: 50px;">Qty</th>
                        <th class="p-2 text-center" style="width: 70px;">Metode</th>
                        <th class="p-2 text-center" style="width: 80px;">Status</th>
                        <th class="p-2 text-right" style="width: 110px;">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $idx => $t)
                    <tr class="border-b border-gray-300">
                        <td class="p-2 text-center">{{ $idx + 1 }}</td>
                        <td class="p-2 font-bold">#TRX-{{ str_pad($t->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="p-2">{{ $t->created_at ? $t->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td class="p-2">
                            <strong>{{ $t->nama_produk }}</strong>
                            <div class="text-[10px] text-gray-600">Pelanggan: {{ $t->user?->name ?? 'Tamu' }}</div>
                        </td>
                        <td class="p-2 text-center">{{ $t->qty }}</td>
                        <td class="p-2 text-center">{{ $t->metode_pembayaran ?? 'QRIS' }}</td>
                        <td class="p-2 text-center">{{ $t->status }}</td>
                        <td class="p-2 text-right font-bold">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-gray-500">Tidak ada transaksi tercatat pada periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-100 font-bold border-t-2 border-black">
                        <td colspan="4" class="p-2 text-black">TOTAL KESELURUHAN</td>
                        <td class="p-2 text-center">{{ $total_produk }}</td>
                        <td colspan="2"></td>
                        <td class="p-2 text-right text-black font-extrabold text-xs">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

            {{-- Blok Tanda Tangan & Pengesahan --}}
            <div class="pt-6 grid grid-cols-2 text-center text-xs text-black" style="page-break-inside: avoid;">
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

    </main>

    {{-- Hidden Print Container --}}
    <div id="print-area" class="hidden"></div>

    <script>
        // Pill filter switcher untuk transaksi
        function selectFilterModeTrx(mode) {
            document.getElementById('input-filter-trx-mode').value = mode;

            document.querySelectorAll('.filter-pill-trx').forEach(pill => {
                pill.classList.remove('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-sm');
                pill.classList.add('bg-gray-50', 'text-gray-600', 'border-gray-200');
            });

            const activePill = document.getElementById('pill-trx-' + mode);
            if (activePill) {
                activePill.classList.remove('bg-gray-50', 'text-gray-600', 'border-gray-200');
                activePill.classList.add('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-sm');
            }

            const boxes = ['semua', 'harian', 'mingguan', 'bulanan', 'tahunan'];
            boxes.forEach(b => {
                const el = document.getElementById('box-trx-' + b);
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

            if (mode === 'semua') {
                document.getElementById('form-filter-trx').submit();
            }
        }

        // Quick date switcher
        function setQuickDateTrx(type) {
            const dateInput = document.getElementById('input-trx-tanggal');
            const today = new Date();
            if (type === 'yesterday') {
                today.setDate(today.getDate() - 1);
            }
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            dateInput.value = `${yyyy}-${mm}-${dd}`;
            document.getElementById('form-filter-trx').submit();
        }

        // Live search filter table
        function cariTransaksi() {
            const keyword = document.getElementById('search-transaksi').value.toLowerCase();
            const rows    = document.querySelectorAll('#tabel-transaksi .trx-row');
            let visible   = 0;

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(keyword)) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }
            });

            const resultText = document.getElementById('result-count-trx');
            if (resultText) {
                resultText.innerText = keyword ? `${visible} transaksi ditemukan` : '';
            }
        }

        document.getElementById('search-transaksi').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') cariTransaksi();
        });

        // Cetak Laporan Transaksi Resmi
        function cetakLaporanTransaksi() {
            const area = document.getElementById('print-area');
            const source = document.getElementById('print-transaksi-formal');
            if (!area || !source) return;
            area.innerHTML = source.innerHTML;
            area.classList.remove('hidden');
            window.print();
            area.classList.add('hidden');
            area.innerHTML = '';
        }

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
