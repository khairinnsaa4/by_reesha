<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Rekapitulasi Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

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
        }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-slate-800 bg-[#f8fafc]">

    @include('partials.owner_sidebar', ['active' => 'transaksi'])

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA                          -->
    <!-- ========================================== -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar pb-24 md:pb-8">

        <!-- Executive Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 pb-6 border-b border-slate-200 no-print">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
                    <span>Portal Manajemen</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-pink-600 font-semibold">Transaksi</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Data Transaksi Penjualan</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Pembukuan riwayat pembayaran, filter periode laporan, dan pencetakan berkas transaksi resmi.</p>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="cetakLaporanTransaksi()"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak Lembar Transaksi</span>
                </button>
            </div>
        </div>

        <!-- Filter Periode Card -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs p-5 mb-6 no-print">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Filter Periode Transaksi</h3>
                </div>
                <span class="text-xs text-slate-400">Pilih rentang waktu untuk memfilter catatan</span>
            </div>

            <form action="/transaksi" method="GET" id="form-filter-trx" class="pt-4 space-y-4">
                {{-- Period Selector Pills --}}
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="selectFilterModeTrx('semua')" id="pill-trx-semua"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'semua' ? 'bg-pink-600 text-white border-pink-600 shadow-2xs' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                        Semua Waktu
                    </button>
                    <button type="button" onclick="selectFilterModeTrx('harian')" id="pill-trx-harian"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'harian' ? 'bg-pink-600 text-white border-pink-600 shadow-2xs' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                        Harian
                    </button>
                    <button type="button" onclick="selectFilterModeTrx('mingguan')" id="pill-trx-mingguan"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'mingguan' ? 'bg-pink-600 text-white border-pink-600 shadow-2xs' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                        Mingguan
                    </button>
                    <button type="button" onclick="selectFilterModeTrx('bulanan')" id="pill-trx-bulanan"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'bulanan' ? 'bg-pink-600 text-white border-pink-600 shadow-2xs' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                        Bulanan
                    </button>
                    <button type="button" onclick="selectFilterModeTrx('tahunan')" id="pill-trx-tahunan"
                        class="filter-pill-trx px-3.5 py-2 rounded-xl text-xs font-semibold transition border {{ $filter === 'tahunan' ? 'bg-pink-600 text-white border-pink-600 shadow-2xs' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                        Tahunan
                    </button>
                </div>

                <input type="hidden" name="filter" id="input-filter-trx-mode" value="{{ $filter }}">

                {{-- Interactive Selector Inputs Area --}}
                <div class="bg-slate-50/70 rounded-xl p-4 border border-slate-100">
                    {{-- 1. Input Harian --}}
                    <div id="box-trx-harian" class="{{ $filter === 'harian' ? 'block' : 'hidden' }} space-y-2">
                        <label class="block text-xs font-semibold text-slate-700">Tanggal Transaksi:</label>
                        <div class="flex flex-wrap items-center gap-2">
                            <input type="date" name="tanggal" id="input-trx-tanggal" value="{{ $tanggal ?? now()->toDateString() }}"
                                class="bg-white border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                            <button type="button" onclick="setQuickDateTrx('today')"
                                class="text-xs bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 font-semibold px-3 py-2 rounded-xl transition">
                                Hari Ini
                            </button>
                            <button type="button" onclick="setQuickDateTrx('yesterday')"
                                class="text-xs bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 font-semibold px-3 py-2 rounded-xl transition">
                                Kemarin
                            </button>
                        </div>
                    </div>

                    {{-- 2. Input Mingguan --}}
                    <div id="box-trx-mingguan" class="{{ $filter === 'mingguan' ? 'block' : 'hidden' }} space-y-2">
                        <label class="block text-xs font-semibold text-slate-700">Minggu / Pekan:</label>
                        <div class="flex flex-wrap items-center gap-3">
                            <input type="week" name="minggu" id="input-trx-minggu" value="{{ $minggu ?? now()->format('Y-\WW') }}"
                                class="bg-white border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                            @if($tanggal_awal && $tanggal_akhir)
                            <span class="text-xs font-semibold bg-pink-100 text-pink-700 px-3 py-1.5 rounded-lg">
                                Rentang: {{ $tanggal_awal }} s/d {{ $tanggal_akhir }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- 3. Input Bulanan --}}
                    <div id="box-trx-bulanan" class="{{ $filter === 'bulanan' ? 'block' : 'hidden' }} space-y-2">
                        <label class="block text-xs font-semibold text-slate-700">Bulan & Tahun:</label>
                        <div class="flex flex-wrap items-center gap-3">
                            <input type="month" name="bulan" id="input-trx-bulan" value="{{ $bulan_input ?? now()->format('Y-m') }}"
                                class="bg-white border border-slate-200 rounded-xl px-3.5 py-2 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                            @if($nama_bulan && $tahun_bulan)
                            <span class="text-xs font-semibold bg-pink-100 text-pink-700 px-3 py-1.5 rounded-lg">
                                Periode: {{ $nama_bulan }} {{ $tahun_bulan }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- 4. Input Tahunan --}}
                    <div id="box-trx-tahunan" class="{{ $filter === 'tahunan' ? 'block' : 'hidden' }} space-y-2">
                        <label class="block text-xs font-semibold text-slate-700">Tahun:</label>
                        <div class="flex items-center gap-3">
                            <select name="tahun" id="input-trx-tahun"
                                class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                                @foreach($allYears as $y)
                                    <option value="{{ $y }}" {{ (int)$tahun === (int)$y ? 'selected' : '' }}>Tahun {{ $y }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 5. Semua Waktu Info --}}
                    <div id="box-trx-semua" class="{{ $filter === 'semua' ? 'block' : 'hidden' }}">
                        <p class="text-xs text-slate-500">
                            Menampilkan seluruh riwayat transaksi By.Reesha secara menyeluruh.
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-3 flex items-center gap-2 border-t border-slate-200/80 mt-3">
                        <button type="submit"
                            class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-xs transition flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Terapkan Filter</span>
                        </button>
                        @if($filter !== 'semua')
                        <a href="/transaksi"
                            class="bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 text-xs font-semibold px-3.5 py-2 rounded-xl transition">
                            Reset Filter
                        </a>
                        @endif
                    </div>
                </div>
            </form>

            {{-- Summary Pill Bar --}}
            <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 bg-slate-50 rounded-xl border border-slate-200 text-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-pink-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-slate-500">Periode:</span>
                    <strong class="text-slate-900 font-bold">{{ $label_periode }}</strong>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 rounded-lg font-semibold bg-white border border-slate-200 text-slate-700">
                        {{ $total_transaksi }} Transaksi
                    </span>
                    <span class="px-2.5 py-1 rounded-lg font-bold bg-pink-600 text-white shadow-2xs">
                        Total: Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Table Card Container -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden no-print">
            <!-- Toolbar -->
            <div class="p-4 sm:p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="relative flex-1 max-w-md">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-transaksi" placeholder="Cari ID transaksi, pembeli, atau nama produk..." oninput="cariTransaksi()"
                        class="w-full text-xs sm:text-sm border border-slate-200 rounded-xl pl-9 pr-3 py-2 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition">
                </div>

                <div class="text-xs text-slate-500">
                    <span id="result-count-trx" class="text-slate-400 font-medium"></span>
                </div>
            </div>

            <!-- Table Body -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-200 text-[11px] font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5">ID Transaksi</th>
                            <th class="px-5 py-3.5">Waktu Transaksi</th>
                            <th class="px-5 py-3.5">Detail Produk & Pembeli</th>
                            <th class="px-5 py-3.5 text-center">Jumlah</th>
                            <th class="px-5 py-3.5">Metode Bayar</th>
                            <th class="px-5 py-3.5">Status</th>
                            <th class="px-5 py-3.5 text-right">Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="tabel-transaksi">
                        @forelse($transaksis as $trx)
                        @php
                            $st = strtolower($trx->status);
                        @endphp
                        <tr class="hover:bg-slate-50/60 transition-colors trx-row">
                            <!-- ID -->
                            <td class="px-5 py-4 font-mono font-bold text-slate-800 text-xs">
                                <span class="px-2 py-0.5 rounded bg-slate-100 border border-slate-200 text-slate-700">
                                    #TRX-{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <!-- Date / Time -->
                            <td class="px-5 py-4 text-xs text-slate-500">
                                {{ $trx->created_at ? $trx->created_at->locale('id')->isoFormat('D MMM Y, HH:mm') : '-' }}
                            </td>

                            <!-- Product & Buyer -->
                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-800 text-xs sm:text-sm">{{ $trx->nama_produk }}</p>
                                <p class="text-[11px] text-slate-400">Pembeli: {{ $trx->user ? $trx->user->name : 'Pelanggan Tamu' }}</p>
                            </td>

                            <!-- Qty -->
                            <td class="px-5 py-4 text-center font-semibold text-slate-700 text-xs">
                                {{ $trx->qty }} item
                            </td>

                            <!-- Method -->
                            <td class="px-5 py-4">
                                <span class="px-2 py-0.5 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $trx->metode_pembayaran ?? 'QRIS' }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-5 py-4">
                                @if(in_array($st, ['selesai', 'diterima']))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-semibold rounded-md">
                                        <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $trx->status }}
                                    </span>
                                @elseif(in_array($st, ['dikirim', 'dalam pengiriman']))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-sky-50 text-sky-700 border border-sky-200 text-[11px] font-semibold rounded-md">
                                        {{ $trx->status }}
                                    </span>
                                @elseif(in_array($st, ['batal', 'dibatalkan']))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-[11px] font-semibold rounded-md">
                                        {{ $trx->status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 text-[11px] font-semibold rounded-md">
                                        {{ $trx->status }}
                                    </span>
                                @endif
                            </td>

                            <!-- Total -->
                            <td class="px-5 py-4 text-right font-bold text-slate-900 text-xs">
                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-trx">
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                Belum ada transaksi yang tercatat pada periode ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($transaksis->count() > 0)
                    <tfoot>
                        <tr class="bg-slate-50 font-bold border-t border-slate-200 text-xs">
                            <td colspan="3" class="px-5 py-3.5 text-slate-800 uppercase tracking-wider">TOTAL KESELURUHAN ({{ $total_transaksi }} Transaksi)</td>
                            <td class="px-5 py-3.5 text-center text-slate-800">{{ $total_produk }} Item</td>
                            <td colspan="2"></td>
                            <td class="px-5 py-3.5 text-right text-pink-700 font-extrabold text-sm">
                                Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- FORMAL PRINT LAYOUT                        -->
        <!-- ========================================== -->
        <div id="print-transaksi-formal" class="hidden">
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

            <div class="grid grid-cols-3 gap-3 mb-4 text-[11px]">
                <div class="p-2.5 border border-gray-400 rounded bg-gray-50">
                    <span class="text-gray-600 block">Total Transaksi:</span>
                    <strong class="text-sm font-bold text-black">{{ $total_transaksi }} Pesanan</strong>
                </div>
                <div class="p-2.5 border border-gray-400 rounded bg-gray-50">
                    <span class="text-gray-600 block">Total Produk Terjual:</span>
                    <strong class="text-sm font-bold text-black">{{ $total_produk }} Item</strong>
                </div>
                <div class="p-2.5 border border-gray-400 rounded bg-gray-50">
                    <span class="text-gray-600 block">Total Penerimaan Dana:</span>
                    <strong class="text-sm font-bold text-black">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</strong>
                </div>
            </div>

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

    <div id="print-area" class="hidden"></div>

    <!-- Scripts -->
    <script>
        function selectFilterModeTrx(mode) {
            document.getElementById('input-filter-trx-mode').value = mode;

            document.querySelectorAll('.filter-pill-trx').forEach(pill => {
                pill.classList.remove('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-2xs');
                pill.classList.add('bg-slate-50', 'text-slate-600', 'border-slate-200');
            });

            const activePill = document.getElementById('pill-trx-' + mode);
            if (activePill) {
                activePill.classList.remove('bg-slate-50', 'text-slate-600', 'border-slate-200');
                activePill.classList.add('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-2xs');
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
    </script>
</body>
</html>
