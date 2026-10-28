<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner • By.Reesha Cake & Bakery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        .font-mono-nums {
            font-family: 'JetBrains Mono', monospace;
            font-feature-settings: "tnum" 1;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
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

    <main class="flex-1 p-3.5 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar space-y-5 sm:space-y-6 pb-28 md:pb-12">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-5 border-b border-slate-200/80">
            <div>
                <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Toko Buka • Operasional Aktif
                    </span>
                    <span class="text-xs text-slate-400 font-mono-nums">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Dashboard Eksekutif
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                    Selamat datang, <span class="font-semibold text-slate-700">{{ Auth::user()->name ?? 'Owner' }}</span>. Ringkasan performa penjualan dan operasional By.Reesha.
                </p>
            </div>

            <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
                <a href="/laporan" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3.5 py-2.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition shadow-2xs">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Laporan</span>
                </a>

                <a href="/pemesanan" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1.5 sm:gap-2 px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold shadow-xs transition hover:shadow">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>Pesanan</span>
                    @if($pesanan_aktif > 0)
                        <span class="bg-white/25 text-white px-1.5 py-0.5 rounded-full text-[10px] font-bold">{{ $pesanan_aktif }}</span>
                    @endif
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">
            <div class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-200/80 shadow-2xs hover:shadow-xs transition relative overflow-hidden group">
                <div class="flex items-center justify-between mb-2 sm:mb-3">
                    <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Omzet</span>
                    <div class="w-7 h-7 sm:w-9 sm:h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-base sm:text-2xl font-extrabold text-slate-900 tracking-tight font-mono-nums truncate">
                    Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                </div>
                <div class="mt-2 sm:mt-2.5 flex items-center justify-between text-[10px] sm:text-xs text-slate-500 pt-1.5 sm:pt-2 border-t border-slate-100">
                    <span>Hari ini:</span>
                    <span class="font-bold text-rose-600 font-mono-nums truncate ml-1">
                        +Rp {{ number_format($omzet_hari_ini ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <div class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-200/80 shadow-2xs hover:shadow-xs transition relative overflow-hidden group">
                <div class="flex items-center justify-between mb-2 sm:mb-3">
                    <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400">Pesanan Aktif</span>
                    <div class="w-7 h-7 sm:w-9 sm:h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
                <div class="text-base sm:text-2xl font-extrabold text-slate-900 tracking-tight font-mono-nums flex items-baseline gap-1">
                    <span>{{ number_format($pesanan_aktif, 0, ',', '.') }}</span>
                    <span class="text-[10px] sm:text-xs font-semibold text-slate-400 font-sans">Pesanan</span>
                </div>
                <div class="mt-2 sm:mt-2.5 flex items-center justify-between text-[10px] sm:text-xs text-slate-500 pt-1.5 sm:pt-2 border-t border-slate-100">
                    <a href="/pemesanan" class="font-semibold text-amber-600 hover:text-amber-700 flex items-center gap-0.5">
                        <span>Antrean</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <span class="font-mono-nums text-[10px] text-slate-400">{{ $pesanan_hari_ini ?? 0 }} hari ini</span>
                </div>
            </div>

            <div class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-200/80 shadow-2xs hover:shadow-xs transition relative overflow-hidden group">
                <div class="flex items-center justify-between mb-2 sm:mb-3">
                    <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400">Kue Terjual</span>
                    <div class="w-7 h-7 sm:w-9 sm:h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
                <div class="text-base sm:text-2xl font-extrabold text-slate-900 tracking-tight font-mono-nums flex items-baseline gap-1">
                    <span>{{ number_format($produk_terjual, 0, ',', '.') }}</span>
                    <span class="text-[10px] sm:text-xs font-semibold text-slate-400 font-sans">Pcs</span>
                </div>
                <div class="mt-2 sm:mt-2.5 flex items-center justify-between text-[10px] sm:text-xs text-slate-500 pt-1.5 sm:pt-2 border-t border-slate-100">
                    <span class="truncate">Rata-rata/order:</span>
                    <span class="font-semibold text-slate-700 font-mono-nums truncate ml-1">
                        Rp {{ number_format($rata_rata_order ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <div class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-200/80 shadow-2xs hover:shadow-xs transition relative overflow-hidden group">
                <div class="flex items-center justify-between mb-2 sm:mb-3">
                    <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-slate-400">Pelanggan</span>
                    <div class="w-7 h-7 sm:w-9 sm:h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-base sm:text-2xl font-extrabold text-slate-900 tracking-tight font-mono-nums flex items-baseline gap-1">
                    <span>{{ number_format($total_pelanggan, 0, ',', '.') }}</span>
                    <span class="text-[10px] sm:text-xs font-semibold text-slate-400 font-sans">Member</span>
                </div>
                <div class="mt-2 sm:mt-2.5 flex items-center justify-between text-[10px] sm:text-xs text-slate-500 pt-1.5 sm:pt-2 border-t border-slate-100">
                    <a href="/pelanggan" class="font-semibold text-sky-600 hover:text-sky-700 flex items-center gap-0.5">
                        <span>Database</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <span class="text-[10px] text-slate-400">{{ $total_transaksi }} transaksi</span>
                </div>
            </div>
        </div>

        @if($low_stock_count > 0)
        <div class="bg-gradient-to-r from-amber-50/90 to-orange-50/80 border border-amber-200/90 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 shadow-2xs">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-xs sm:text-sm font-bold text-amber-900">Perhatian: Stok & Kuota {{ $low_stock_count }} Varian Kue Menipis</h4>
                    <p class="text-xs text-amber-700 mt-0.5">Sisa &le; 3 slot. Perbarui kuota baking agar pelanggan tetap dapat memesan.</p>
                    <div class="flex flex-wrap gap-1.5 mt-2">
                        @foreach($low_stock_products as $lp)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg text-[11px] font-semibold bg-white border border-amber-200 text-amber-900 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                {{ $lp->nama_kue }} <span class="text-amber-600 font-mono-nums font-bold">(sisa {{ $lp->stok }})</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="/produk" class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-2xs transition shrink-0 self-start sm:self-center">
                <span>Perbarui Stok</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
            <div class="lg:col-span-7 bg-white p-4 sm:p-6 rounded-2xl border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm sm:text-base font-extrabold text-slate-900 tracking-tight">Tren Penjualan 7 Hari</h3>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-100">Harian</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">Grafik dinamika omzet penjualan</p>
                        </div>
                        <div class="px-3 py-1.5 sm:px-3.5 sm:py-2 rounded-xl bg-slate-50 border border-slate-100 text-right">
                            <p class="text-[9px] sm:text-[10px] font-semibold uppercase tracking-wider text-slate-400">Total 7 Hari</p>
                            <p class="text-xs sm:text-sm font-extrabold text-slate-900 font-mono-nums">
                                Rp {{ number_format(array_sum($chartOmzet ?? []), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="relative h-56 sm:h-72 w-full">
                        <canvas id="chartVelocityOmzet"></canvas>
                    </div>
                </div>

                <div class="mt-4 pt-3.5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-500">
                    <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                        <span>Tertinggi: <strong class="text-slate-800 font-mono-nums">Rp {{ number_format(count($chartOmzet ?? []) > 0 ? max($chartOmzet) : 0, 0, ',', '.') }}</strong></span>
                        <span class="text-slate-300">•</span>
                        <span>Rata-rata: <strong class="text-slate-800 font-mono-nums">Rp {{ number_format(count($chartOmzet ?? []) > 0 ? round(array_sum($chartOmzet) / count($chartOmzet)) : 0, 0, ',', '.') }}</strong>/hari</span>
                    </div>
                    <span class="text-[10px] sm:text-[11px] text-slate-400">Sinkronisasi otomatis</span>
                </div>
            </div>

            <div class="lg:col-span-5 bg-white p-4 sm:p-6 rounded-2xl border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 mb-4">
                        <div>
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 tracking-tight">Kue Terlaris (Best Seller)</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Varian kue paling diminati pelanggan</p>
                        </div>
                        <span class="px-2.5 py-1 rounded-lg bg-rose-50 text-rose-700 text-[10px] font-bold tracking-wider uppercase border border-rose-100">
                            Top 5
                        </span>
                    </div>

                    @php
                        $totalOmzetTop = array_sum($chartProdukOmzet ?? []) > 0 ? array_sum($chartProdukOmzet) : 1;
                    @endphp

                    <div class="space-y-3.5 sm:space-y-4">
                        @forelse($chartProdukLabels ?? [] as $idx => $prodName)
                            @php
                                $nominal = $chartProdukOmzet[$idx] ?? 0;
                                $qty = $chartProdukQty[$idx] ?? 0;
                                $percentage = round(($nominal / $totalOmzetTop) * 100);
                            @endphp
                            <div class="group">
                                <div class="flex items-center justify-between text-xs mb-1.5">
                                    <div class="flex items-center gap-2 min-w-0">
                                        @if($idx === 0)
                                            <span class="w-5 h-5 rounded-md flex items-center justify-center font-mono-nums text-[10px] font-extrabold shrink-0 bg-amber-100 text-amber-800 border border-amber-200 shadow-2xs">1</span>
                                        @elseif($idx === 1)
                                            <span class="w-5 h-5 rounded-md flex items-center justify-center font-mono-nums text-[11px] font-extrabold shrink-0 bg-slate-200 text-slate-700">2</span>
                                        @elseif($idx === 2)
                                            <span class="w-5 h-5 rounded-md flex items-center justify-center font-mono-nums text-[11px] font-extrabold shrink-0 bg-orange-100 text-orange-800">3</span>
                                        @else
                                            <span class="w-5 h-5 rounded-md flex items-center justify-center font-mono-nums text-[11px] font-extrabold shrink-0 bg-slate-100 text-slate-500">{{ $idx + 1 }}</span>
                                        @endif
                                        <span class="font-bold text-slate-800 truncate group-hover:text-rose-600 transition">{{ $prodName }}</span>
                                    </div>
                                    <div class="text-right shrink-0 ml-2">
                                        <span class="font-extrabold text-slate-900 font-mono-nums">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
                                        <span class="text-[10px] text-slate-400 font-mono-nums ml-0.5">({{ $qty }})</span>
                                    </div>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden flex">
                                    <div class="h-full rounded-full transition-all duration-700 {{ $idx === 0 ? 'bg-gradient-to-r from-rose-500 to-pink-500' : ($idx === 1 ? 'bg-rose-400' : 'bg-slate-300') }}" style="width: {{ max($percentage, 6) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-xs text-slate-400">Belum ada transaksi kue tercatat.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                    <span>Menu kue aktif</span>
                    <a href="/produk" class="font-semibold text-rose-600 hover:text-rose-700 flex items-center gap-1">
                        <span>Katalog Kue</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
            <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 tracking-tight">Pesanan Masuk Terbaru</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Daftar transaksi terkini pelanggan</p>
                        </div>
                        <a href="/pemesanan" class="text-xs font-semibold text-rose-600 hover:text-rose-700 flex items-center gap-1">
                            <span>Semua Pesanan</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <div class="md:hidden divide-y divide-slate-100">
                        @forelse($transaksis as $trx)
                            <div class="p-3.5 hover:bg-slate-50/70 transition space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 font-mono-nums font-bold text-[11px] flex items-center justify-center shrink-0">
                                            #{{ $trx->id }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-bold text-xs text-slate-900 truncate">{{ $trx->user ? $trx->user->name : 'Pelanggan' }}</p>
                                            <p class="text-[10px] text-slate-400 font-mono-nums">{{ $trx->created_at ? $trx->created_at->format('d M H:i') : '-' }}</p>
                                        </div>
                                    </div>
                                    @php $st = strtolower($trx->status); @endphp
                                    @if(in_array($st, ['selesai', 'diterima', 'sukses']))
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">Selesai</span>
                                    @elseif(in_array($st, ['dikirim', 'dalam pengiriman']))
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200 shrink-0">Dikirim</span>
                                    @elseif(in_array($st, ['batal', 'dibatalkan']))
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200 shrink-0">Batal</span>
                                    @elseif(in_array($st, ['menunggu konfirmasi', 'menunggu pembayaran']))
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 shrink-0">Menunggu</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 shrink-0">{{ $trx->status }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between text-xs pt-1 border-t border-slate-50">
                                    <span class="text-slate-600 font-medium truncate max-w-[200px]">{{ $trx->nama_produk }} <span class="text-slate-400">({{ $trx->qty }}x)</span></span>
                                    <span class="font-bold text-slate-900 font-mono-nums shrink-0">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="py-8 text-center text-xs text-slate-400">Belum ada riwayat pesanan.</div>
                        @endforelse
                    </div>

                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs whitespace-nowrap">
                            <thead>
                                <tr class="bg-slate-50/80 text-slate-400 border-b border-slate-100 text-[10px] font-bold uppercase tracking-wider">
                                    <th class="px-5 py-3">Order ID & Waktu</th>
                                    <th class="px-5 py-3">Pelanggan</th>
                                    <th class="px-5 py-3">Menu Kue</th>
                                    <th class="px-5 py-3">Pembayaran</th>
                                    <th class="px-5 py-3 text-right">Total</th>
                                    <th class="px-5 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($transaksis as $trx)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-5 py-3.5">
                                        <div class="font-mono-nums font-bold text-slate-800">#{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono-nums">{{ $trx->created_at ? $trx->created_at->format('d M H:i') : '-' }}</div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <div class="font-semibold text-slate-800 truncate max-w-[130px]">{{ $trx->user ? $trx->user->name : 'Pelanggan' }}</div>
                                        <div class="text-[10px] text-slate-400 truncate max-w-[130px]">{{ $trx->user ? ($trx->user->phone ?? $trx->user->email) : '-' }}</div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <div class="font-medium text-slate-700 truncate max-w-[140px]">{{ $trx->nama_produk }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono-nums">{{ $trx->qty }} item {{ $trx->varian ? '• '.$trx->varian : '' }}</div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        @php $method = strtoupper($trx->metode_pembayaran ?? 'QRIS'); @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold {{ str_contains($method, 'QRIS') ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-slate-100 text-slate-700' }}">
                                            {{ $method }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 text-right font-mono-nums font-bold text-slate-900">
                                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        @php $st = strtolower($trx->status); @endphp
                                        @if(in_array($st, ['selesai', 'diterima', 'sukses']))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai</span>
                                        @elseif(in_array($st, ['dikirim', 'dalam pengiriman']))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200">Dikirim</span>
                                        @elseif(in_array($st, ['batal', 'dibatalkan']))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">Batal</span>
                                        @elseif(in_array($st, ['menunggu konfirmasi', 'menunggu pembayaran']))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">Menunggu</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">{{ $trx->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-xs text-slate-400">Belum ada riwayat pesanan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="p-3 sm:p-3.5 border-t border-slate-100 bg-slate-50/50 text-center">
                    <a href="/pemesanan" class="text-xs font-semibold text-rose-600 hover:text-rose-700 transition flex items-center justify-center gap-1">
                        <span>Buka Manajemen Pesanan</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5 bg-white p-4 sm:p-6 rounded-2xl border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="pb-3.5 border-b border-slate-100 mb-4">
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 tracking-tight">Pusat Kendali Operasional</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Akses cepat manajemen toko By.Reesha</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2.5">
                        <a href="/produk" class="flex items-center justify-between p-2.5 sm:p-3 rounded-xl border border-slate-100 hover:border-rose-200 hover:bg-rose-50/30 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition shrink-0">
                                    <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-rose-600 transition truncate">Katalog & Stok Kue</h4>
                                    <p class="text-[10px] text-slate-400 truncate">Harga, varian & kuota slot baking</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>

                        <a href="/pemesanan" class="flex items-center justify-between p-2.5 sm:p-3 rounded-xl border border-slate-100 hover:border-amber-200 hover:bg-amber-50/30 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition shrink-0">
                                    <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-amber-600 transition truncate">Pemesanan & Status</h4>
                                    <p class="text-[10px] text-slate-400 truncate">Verifikasi pembayaran & pengiriman</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>

                        <a href="/logistik" class="flex items-center justify-between p-2.5 sm:p-3 rounded-xl border border-slate-100 hover:border-sky-200 hover:bg-sky-50/30 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition shrink-0">
                                    <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-sky-600 transition truncate">Logistik & Bahan Baku</h4>
                                    <p class="text-[10px] text-slate-400 truncate">Persediaan tepung, butter & supplier</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>

                        <a href="/resep" class="flex items-center justify-between p-2.5 sm:p-3 rounded-xl border border-slate-100 hover:border-pink-200 hover:bg-pink-50/30 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center group-hover:bg-pink-600 group-hover:text-white transition shrink-0">
                                    <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-pink-600 transition truncate">Resep Dapur Baker</h4>
                                    <p class="text-[10px] text-slate-400 truncate">Standar takaran & panduan baking</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>

                        <a href="/karyawan" class="flex items-center justify-between p-2.5 sm:p-3 rounded-xl border border-slate-100 hover:border-slate-200 hover:bg-slate-50 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center group-hover:bg-slate-900 group-hover:text-white transition shrink-0">
                                    <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-slate-900 transition truncate">Staf & Baker Dapur</h4>
                                    <p class="text-[10px] text-slate-400 truncate">Kelola akun kasir dan baker dapur</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    </div>
                </div>

                <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                    <span>By.Reesha Cake & Bakery</span>
                    <span class="font-mono-nums text-slate-500 font-semibold">Portal Eksekutif</span>
                </div>
            </div>
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
            Chart.defaults.color = '#94a3b8';

            const ctx = document.getElementById('chartVelocityOmzet');
            if (ctx) {
                const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 260);
                gradient.addColorStop(0, 'rgba(225, 29, 72, 0.16)');
                gradient.addColorStop(1, 'rgba(225, 29, 72, 0.00)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartLabels ?? []) !!},
                        datasets: [{
                            label: 'Omzet Harian',
                            data: {!! json_encode($chartOmzet ?? []) !!},
                            borderColor: '#e11d48',
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.38,
                            borderWidth: 2.5,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#e11d48',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#e11d48',
                            pointHoverBorderColor: '#ffffff',
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
                                titleColor: '#f8fafc',
                                bodyColor: '#cbd5e1',
                                padding: 12,
                                cornerRadius: 10,
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
                                    color: 'rgba(241, 245, 249, 1)',
                                    drawBorder: false,
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10.5 } }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>