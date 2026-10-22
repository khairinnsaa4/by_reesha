<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Dashboard Pemilik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-slate-800 bg-[#f8fafc]">

    @include('partials.owner_sidebar', ['active' => 'dashboard'])

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA                          -->
    <!-- ========================================== -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar">

        <!-- Executive Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 pb-6 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
                    <span>Portal Manajemen</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-pink-600 font-semibold">Dashboard Pemilik</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Ringkasan Bisnis</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Pemantauan metrik finansial, pergerakan pesanan, dan tren penjualan By.Reesha.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <!-- Real-time Status Indicator -->
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs text-slate-600 shadow-2xs">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="font-medium text-slate-700">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>

                <!-- Primary Action Link -->
                <a href="/pemesanan" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-pink-600 hover:bg-pink-700 text-white text-xs font-semibold shadow-xs transition hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>Kelola Pesanan</span>
                </a>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- KPI METRICS GRID (4 Executive Stat Cards)  -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8">

            <!-- Card 1: Total Pendapatan -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs hover:border-slate-300 transition group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pendapatan</span>
                    <div class="w-10 h-10 rounded-xl bg-pink-50 border border-pink-100 flex items-center justify-center text-pink-600 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight truncate">
                    Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                </h3>
                <div class="mt-2.5 flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="inline-flex items-center text-emerald-600 font-semibold gap-0.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        Kumulatif
                    </span>
                    <span class="text-slate-400">• Seluruh transaksi</span>
                </div>
            </div>

            <!-- Card 2: Pesanan Aktif / Total -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs hover:border-slate-300 transition group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pesanan</span>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($pesanan_aktif, 0, ',', '.') }}
                </h3>
                <div class="mt-2.5 flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="font-medium text-slate-600">Pesanan terdaftar</span>
                    <span class="text-slate-400">• Dalam sistem</span>
                </div>
            </div>

            <!-- Card 3: Pelanggan Terdaftar -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs hover:border-slate-300 transition group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pelanggan</span>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($total_pelanggan, 0, ',', '.') }}
                </h3>
                <div class="mt-2.5 flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="font-medium text-slate-600">Akun terverifikasi</span>
                    <span class="text-slate-400">• Role pelanggan</span>
                </div>
            </div>

            <!-- Card 4: Produk Terjual -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-xs hover:border-slate-300 transition group">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Produk Terjual</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($produk_terjual, 0, ',', '.') }} <span class="text-sm font-semibold text-slate-400">pcs</span>
                </h3>
                <div class="mt-2.5 flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="font-medium text-slate-600">Total kuantitas</span>
                    <span class="text-slate-400">• Kue & pastry</span>
                </div>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- VISUAL ANALYTICS (Charts & Statistics)     -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            <!-- Chart 1: Daily Revenue Trend (7 Days) -->
            <div class="lg:col-span-2 bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-pink-50 border border-pink-100 flex items-center justify-center text-pink-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900">Tren Pendapatan Harian</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Perkembangan omzet transaksi selama 7 hari kalender terakhir</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 text-xs font-semibold">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                7 Hari Terakhir
                            </span>
                        </div>
                    </div>

                    <div class="relative h-64 sm:h-72 w-full">
                        <canvas id="chartTrenOmzet"></canvas>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Total Omzet Periode Ini:</span>
                    <span class="font-bold text-slate-800">Rp {{ number_format(array_sum($chartOmzet ?? []), 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Chart 2: Top 5 Products Breakdown -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/90 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-violet-50 border border-violet-100 flex items-center justify-center text-violet-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Distribusi Produk Terlaris</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Kontribusi nilai penjualan produk</p>
                        </div>
                    </div>

                    <div class="relative h-56 w-full flex items-center justify-center my-2">
                        <canvas id="chartProdukTerlaris"></canvas>
                    </div>
                </div>

                <!-- Ranked Top Products List -->
                <div class="mt-3 pt-3 border-t border-slate-100">
                    <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Peringkat Penjualan</div>
                    <div class="space-y-1.5 max-h-32 overflow-y-auto custom-scrollbar">
                        @forelse(array_slice($chartProdukLabels ?? [], 0, 4) as $idx => $prodName)
                        <div class="flex items-center justify-between text-xs py-1 px-1.5 rounded-lg hover:bg-slate-50">
                            <div class="flex items-center gap-2 truncate">
                                <span class="w-4 h-4 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold flex items-center justify-center shrink-0">
                                    {{ $idx + 1 }}
                                </span>
                                <span class="font-medium text-slate-700 truncate">{{ $prodName }}</span>
                            </div>
                            <span class="font-semibold text-slate-900 text-xs shrink-0 ml-2">
                                Rp {{ number_format($chartProdukOmzet[$idx] ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                        @empty
                        <p class="text-xs text-slate-400 text-center py-2">Belum ada data produk terjual.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- RECENT ORDERS TABLE                        -->
        <!-- ========================================== -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden mb-8">
            <div class="p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-700 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Pesanan Masuk Terbaru</h3>
                        <p class="text-xs text-slate-400">Transaksi terkini dari pelanggan By.Reesha yang tercatat</p>
                    </div>
                </div>

                <a href="/pemesanan" class="inline-flex items-center gap-1.5 text-xs font-semibold text-pink-600 hover:text-pink-700 hover:underline">
                    <span>Lihat Semua Pesanan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-200 text-[11px] font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5">ID Pesanan</th>
                            <th class="px-5 py-3.5">Waktu</th>
                            <th class="px-5 py-3.5">Pelanggan</th>
                            <th class="px-5 py-3.5">Produk</th>
                            <th class="px-5 py-3.5">Total Bayar</th>
                            <th class="px-5 py-3.5">Status</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($transaksis as $trx)
                        <tr class="hover:bg-slate-50/60 transition-colors">
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

                            <!-- Customer -->
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-pink-100 text-pink-700 flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($trx->user ? $trx->user->name : 'P', 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-slate-800 text-xs truncate">{{ $trx->user ? $trx->user->name : 'Pelanggan' }}</p>
                                        @if($trx->user && $trx->user->email)
                                            <p class="text-[10px] text-slate-400 truncate">{{ $trx->user->email }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Product & Quantity -->
                            <td class="px-5 py-4 text-xs">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-medium text-slate-800">{{ $trx->nama_produk }}</span>
                                    <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[10px] font-semibold bg-slate-100 text-slate-600">
                                        {{ $trx->qty }} item
                                    </span>
                                </div>
                            </td>

                            <!-- Total Price -->
                            <td class="px-5 py-4 font-bold text-slate-900 text-xs">
                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                            </td>

                            <!-- Status Badge -->
                            <td class="px-5 py-4">
                                @php
                                    $st = strtolower($trx->status);
                                @endphp
                                @if(in_array($st, ['selesai', 'diterima']))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-semibold rounded-md">
                                        <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $trx->status }}
                                    </span>
                                @elseif(in_array($st, ['dikirim', 'dalam pengiriman']))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-sky-50 text-sky-700 border border-sky-200 text-[11px] font-semibold rounded-md">
                                        <svg class="w-3 h-3 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                        </svg>
                                        {{ $trx->status }}
                                    </span>
                                @elseif(in_array($st, ['batal', 'dibatalkan']))
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-[11px] font-semibold rounded-md">
                                        <svg class="w-3 h-3 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $trx->status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 text-[11px] font-semibold rounded-md">
                                        <svg class="w-3 h-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $trx->status }}
                                    </span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="px-5 py-4 text-right">
                                <a href="/pemesanan" class="inline-flex items-center gap-1 text-xs font-semibold text-slate-600 hover:text-pink-600 transition">
                                    <span>Kelola</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="max-w-xs mx-auto text-slate-400">
                                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <p class="text-sm font-semibold text-slate-600">Belum ada pesanan terbaru</p>
                                    <p class="text-xs text-slate-400 mt-1">Transaksi yang masuk dari pembeli akan otomatis ditampilkan di sini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3.5 border-t border-slate-100 text-center bg-slate-50/50">
                <a href="/pemesanan" class="inline-flex items-center gap-1.5 text-xs font-semibold text-pink-600 hover:text-pink-700 transition">
                    <span>Akses Seluruh Manajemen Pesanan</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- EXECUTIVE QUICK ACTIONS PANEL              -->
        <!-- ========================================== -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mb-4">
            <a href="/laporan" class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-2xs hover:border-pink-300 hover:shadow-xs transition group">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-slate-800 truncate group-hover:text-pink-600 transition">Laporan Keuangan</h4>
                        <p class="text-[10px] text-slate-400 truncate">Rekapitulasi omzet & cetak</p>
                    </div>
                </div>
            </a>

            <a href="/karyawan" class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-2xs hover:border-pink-300 hover:shadow-xs transition group">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-slate-800 truncate group-hover:text-pink-600 transition">Kelola Karyawan</h4>
                        <p class="text-[10px] text-slate-400 truncate">Hak akses & staf toko</p>
                    </div>
                </div>
            </a>

            <a href="/logistik" class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-2xs hover:border-pink-300 hover:shadow-xs transition group">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-slate-800 truncate group-hover:text-pink-600 transition">Stok & Logistik</h4>
                        <p class="text-[10px] text-slate-400 truncate">Ketersediaan bahan baku</p>
                    </div>
                </div>
            </a>

            <a href="/supplier" class="p-4 rounded-xl bg-white border border-slate-200/90 shadow-2xs hover:border-pink-300 hover:shadow-xs transition group">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-slate-800 truncate group-hover:text-pink-600 transition">Data Supplier</h4>
                        <p class="text-[10px] text-slate-400 truncate">Vendor & mitra pasokan</p>
                    </div>
                </div>
            </a>
        </div>

    </main>

    <!-- ========================================== -->
    <!-- SCRIPTS (Chart.js & Mobile Drawer)         -->
    <!-- ========================================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Setup Chart.js global defaults
            Chart.defaults.font.family = "'Plus Jakarta Sans', 'Poppins', sans-serif";
            Chart.defaults.color = '#64748b';

            // 1. Grafik Tren Omzet Harian (7 Hari Terakhir)
            const ctxTren = document.getElementById('chartTrenOmzet');
            if (ctxTren) {
                const gradient = ctxTren.getContext('2d').createLinearGradient(0, 0, 0, 260);
                gradient.addColorStop(0, 'rgba(219, 39, 119, 0.22)');
                gradient.addColorStop(1, 'rgba(219, 39, 119, 0.00)');

                new Chart(ctxTren, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartLabels ?? []) !!},
                        datasets: [{
                            label: 'Omzet Harian',
                            data: {!! json_encode($chartOmzet ?? []) !!},
                            borderColor: '#db2777',
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.38,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#db2777',
                            pointBorderWidth: 2.5,
                            pointRadius: 4.5,
                            pointHoverRadius: 7,
                            pointHoverBackgroundColor: '#db2777',
                            pointHoverBorderColor: '#ffffff',
                            pointHoverBorderWidth: 2,
                            borderWidth: 2.5,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#0f172a',
                                titleColor: '#ffffff',
                                bodyColor: '#cbd5e1',
                                padding: 12,
                                cornerRadius: 8,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return 'Omzet: Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000000) return 'Rp ' + (value/1000000).toFixed(1) + ' jt';
                                        if (value >= 1000) return 'Rp ' + (value/1000).toFixed(0) + ' rb';
                                        return 'Rp ' + value;
                                    },
                                    font: { size: 10.5 }
                                },
                                grid: {
                                    color: 'rgba(226, 232, 240, 0.7)',
                                    drawBorder: false,
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 11 } }
                            }
                        }
                    }
                });
            }

            // 2. Grafik Produk Terlaris (Doughnut Chart)
            const ctxProduk = document.getElementById('chartProdukTerlaris');
            if (ctxProduk) {
                let labelsProduk = {!! json_encode($chartProdukLabels ?? []) !!};
                let omzetProduk = {!! json_encode($chartProdukOmzet ?? []) !!};

                if (!labelsProduk || labelsProduk.length === 0) {
                    labelsProduk = ['Belum ada transaksi'];
                    omzetProduk = [1];
                }

                new Chart(ctxProduk, {
                    type: 'doughnut',
                    data: {
                        labels: labelsProduk,
                        datasets: [{
                            data: omzetProduk,
                            backgroundColor: [
                                '#db2777', // Rose By.Reesha
                                '#8b5cf6', // Violet
                                '#f59e0b', // Amber
                                '#10b981', // Emerald
                                '#06b6d4'  // Cyan
                            ],
                            borderWidth: 3,
                            borderColor: '#ffffff',
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // List ditampilkan di bawah chart agar rapi dan tidak tumpang tindih
                            },
                            tooltip: {
                                backgroundColor: '#0f172a',
                                titleColor: '#ffffff',
                                bodyColor: '#cbd5e1',
                                padding: 10,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function(context) {
                                        return ' ' + context.label + ': Rp ' + context.parsed.toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        cutout: '72%'
                    }
                });
            }
        });
    </script>
</body>
</html>
