<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Konsol Eksekutif</title>
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

    <!-- ========================================== -->
    <!-- MAIN EXECUTIVE CONSOLE                     -->
    <!-- ========================================== -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar space-y-6">

        <!-- ========================================== -->
        <!-- EXECUTIVE COMMAND HEADER                   -->
        <!-- ========================================== -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 pb-6 border-b border-slate-200/80">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Konsol Operasional Aktif
                    </span>
                    <span class="text-xs text-slate-400 font-mono-nums">• {{ now()->locale('id')->isoFormat('D MMMM Y') }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Konsol Bisnis & Penjualan</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Pemantauan trajektori omzet, volume pesanan, dan kontribusi produk By.Reesha.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <a href="/laporan" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition shadow-2xs">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak Laporan</span>
                </a>

                <a href="/pemesanan" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold shadow-xs transition hover:shadow">
                    <svg class="w-3.5 h-3.5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>Kelola Pesanan</span>
                </a>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- INTEGRATED FINANCIAL & OPERATIONAL SLAB    -->
        <!-- (Replacing generic 4 separate boxes)       -->
        <!-- ========================================== -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
                
                <!-- Metric 1: Total Revenue -->
                <div class="p-5 sm:p-6 transition hover:bg-slate-50/50">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Omzet Bruto</span>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 font-mono-nums">
                            +100%
                        </span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-mono-nums">
                        Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                    </div>
                    <div class="mt-2 text-[11px] text-slate-500 flex items-center justify-between">
                        <span>Rata-rata order:</span>
                        <span class="font-semibold text-slate-700 font-mono-nums">
                            Rp {{ number_format($pesanan_aktif > 0 ? round($total_pendapatan / $pesanan_aktif) : 0, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Metric 2: Order Pipeline -->
                <div class="p-5 sm:p-6 transition hover:bg-slate-50/50">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Volume Transaksi</span>
                        <span class="text-[10px] font-semibold text-slate-400">Database</span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-mono-nums flex items-baseline gap-1.5">
                        <span>{{ number_format($pesanan_aktif, 0, ',', '.') }}</span>
                        <span class="text-xs font-semibold text-slate-400 font-sans">Pesanan</span>
                    </div>
                    <div class="mt-2 text-[11px] text-slate-500 flex items-center justify-between">
                        <span>Integritas sistem:</span>
                        <span class="font-semibold text-emerald-600">100% Terverifikasi</span>
                    </div>
                </div>

                <!-- Metric 3: Client Base -->
                <div class="p-5 sm:p-6 transition hover:bg-slate-50/50">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Basis Konsumen</span>
                        <span class="text-[10px] font-semibold text-slate-400">Akun</span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-mono-nums flex items-baseline gap-1.5">
                        <span>{{ number_format($total_pelanggan, 0, ',', '.') }}</span>
                        <span class="text-xs font-semibold text-slate-400 font-sans">Pelanggan</span>
                    </div>
                    <div class="mt-2 text-[11px] text-slate-500 flex items-center justify-between">
                        <span>Status registrasi:</span>
                        <span class="font-semibold text-slate-700">Role Pelanggan</span>
                    </div>
                </div>

                <!-- Metric 4: Low-Stock Alert & Kuota -->
                <div class="p-5 sm:p-6 transition hover:bg-slate-50/50">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Peringatan Kuota & Stok</span>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold {{ $low_stock_count > 0 ? 'bg-amber-100 text-amber-800' : 'bg-emerald-50 text-emerald-700' }}">
                            {{ $low_stock_count > 0 ? 'Perlu Restock' : 'Semua Aman' }}
                        </span>
                    </div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-mono-nums flex items-baseline gap-1.5">
                        <span class="{{ $low_stock_count > 0 ? 'text-amber-600' : 'text-slate-900' }}">{{ $low_stock_count }}</span>
                        <span class="text-xs font-semibold text-slate-400 font-sans">Produk Menipis</span>
                    </div>
                    <div class="mt-2 text-[11px] text-slate-500 flex items-center justify-between">
                        <span>Batas minimum:</span>
                        <span class="font-semibold text-slate-700 font-mono-nums">&le; 3 Kuota PO</span>
                    </div>
                </div>

            </div>
        </div>

        @if($low_stock_count > 0)
        <!-- Visual Low-Stock Alert Banner -->
        <div class="bg-amber-50/90 border border-amber-200 rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-xs">
            <div class="flex items-start sm:items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-xs sm:text-sm font-bold text-amber-900">Peringatan: Kuota Slot Baking Mendekati Batas Kritis</h4>
                    <p class="text-xs text-amber-700 mt-0.5">Terdapat {{ $low_stock_count }} varian kue dengan kuota PO tersisa &le; 3 slot. Lakukan penambahan kuota batch agar pelanggan tetap dapat memesan.</p>
                    <div class="flex flex-wrap gap-1.5 mt-2">
                        @foreach($low_stock_products as $lp)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-white border border-amber-300 text-amber-900 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                {{ $lp->nama_kue }} (Sisa {{ $lp->stok }} slot)
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="/logistik" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition shrink-0">
                <span>Restock Kuota Batch</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        @endif

        <!-- ========================================== -->
        <!-- CORE ANALYTICS: VELOCITY & LEADERBOARD     -->
        <!-- (Asymmetric Bento Grid)                    -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Financial Velocity & Curve Monitor (7 Cols on large screen) -->
            <div class="lg:col-span-7 bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col justify-between">
                <div>
                    <!-- Header with Period Chips -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Trajektori Omzet 7 Hari</h3>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 uppercase tracking-wider">Harian</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">Dinamika perolehan penjualan harian selama siklus 7 hari terakhir</p>
                        </div>

                        <!-- 3 Stat Micro Badges -->
                        <div class="flex items-center gap-2">
                            <div class="px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200/80 text-right">
                                <p class="text-[9px] font-bold uppercase tracking-wider text-slate-400">Omzet Siklus</p>
                                <p class="text-xs font-extrabold text-slate-900 font-mono-nums">
                                    Rp {{ number_format(array_sum($chartOmzet ?? []), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Canvas -->
                    <div class="relative h-64 sm:h-72 w-full">
                        <canvas id="chartVelocityOmzet"></canvas>
                    </div>
                </div>

                <!-- Footer Summary Bar -->
                <div class="mt-4 pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500">
                    <div class="flex items-center gap-4">
                        <span>Puncak Penjualan: <strong class="text-slate-800 font-mono-nums">Rp {{ number_format(count($chartOmzet ?? []) > 0 ? max($chartOmzet) : 0, 0, ',', '.') }}</strong></span>
                        <span class="text-slate-300">|</span>
                        <span>Rata-rata: <strong class="text-slate-800 font-mono-nums">Rp {{ number_format(count($chartOmzet ?? []) > 0 ? round(array_sum($chartOmzet) / count($chartOmzet)) : 0, 0, ',', '.') }}</strong>/hari</span>
                    </div>
                    <span class="text-[11px] text-slate-400">Data live tersinkron</span>
                </div>
            </div>

            <!-- Ranked Product Leaderboard (5 Cols on large screen - Replacing generic donut) -->
            <div class="lg:col-span-5 bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col justify-between">
                <div>
                    <!-- Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Peringkat Kontribusi Produk</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Produk terlaris berdasarkan volume dan omzet</p>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-pink-50 text-pink-700 text-[10px] font-bold tracking-wider uppercase">
                            Top 5
                        </span>
                    </div>

                    @php
                        $totalOmzetTop = array_sum($chartProdukOmzet ?? []) > 0 ? array_sum($chartProdukOmzet) : 1;
                    @endphp

                    <!-- Leaderboard Items with Visual Volume Bars -->
                    <div class="space-y-4">
                        @forelse($chartProdukLabels ?? [] as $idx => $prodName)
                            @php
                                $nominal = $chartProdukOmzet[$idx] ?? 0;
                                $qty = $chartProdukQty[$idx] ?? 0;
                                $percentage = round(($nominal / $totalOmzetTop) * 100);
                            @endphp
                            <div class="group">
                                <div class="flex items-center justify-between text-xs mb-1.5">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <span class="w-5 h-5 rounded-md flex items-center justify-center font-mono-nums text-[11px] font-extrabold shrink-0 {{ $idx === 0 ? 'bg-amber-100 text-amber-800 border border-amber-200' : ($idx === 1 ? 'bg-slate-200 text-slate-700' : ($idx === 2 ? 'bg-amber-50 text-amber-700' : 'bg-slate-100 text-slate-500')) }}">
                                            #{{ $idx + 1 }}
                                        </span>
                                        <span class="font-bold text-slate-800 truncate group-hover:text-pink-600 transition">{{ $prodName }}</span>
                                    </div>
                                    <div class="text-right shrink-0 ml-3">
                                        <span class="font-extrabold text-slate-900 font-mono-nums">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
                                        <span class="text-[10px] text-slate-400 font-mono-nums ml-1">({{ $qty }} pcs)</span>
                                    </div>
                                </div>
                                <!-- Proportional Progress Bar -->
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden flex">
                                    <div class="h-full rounded-full transition-all duration-700 {{ $idx === 0 ? 'bg-gradient-to-r from-pink-500 to-rose-600' : ($idx === 1 ? 'bg-slate-700' : 'bg-slate-400') }}" style="width: {{ max($percentage, 5) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-xs text-slate-400">Belum ada data transaksi produk yang tercatat.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Leaderboard Micro Footer -->
                <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                    <span>Analisis proporsi kontribusi</span>
                    <a href="/produk" class="font-semibold text-pink-600 hover:text-pink-700 hover:underline">Kelola Menu →</a>
                </div>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- OPERATIONAL HUB & REAL-TIME ACTIVITY       -->
        <!-- (Recent Order Ledger + Shortcuts)          -->
        <!-- ========================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Recent Orders Audit Feed (7 Cols) -->
            <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Audit Pesanan Masuk</h3>
                            <p class="text-xs text-slate-400 mt-0.5">5 transaksi pesanan terakhir yang terdata dalam sistem</p>
                        </div>
                        <a href="/pemesanan" class="text-xs font-semibold text-pink-600 hover:text-pink-700 hover:underline flex items-center gap-1">
                            <span>Buka Semua</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs whitespace-nowrap">
                            <thead>
                                <tr class="bg-slate-50/70 text-slate-400 border-b border-slate-100 text-[10px] font-bold uppercase tracking-wider">
                                    <th class="px-5 py-3">ID & Waktu</th>
                                    <th class="px-5 py-3">Pelanggan</th>
                                    <th class="px-5 py-3">Pesanan</th>
                                    <th class="px-5 py-3 text-right">Nominal</th>
                                    <th class="px-5 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($transaksis as $trx)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <!-- ID & Timestamp -->
                                    <td class="px-5 py-3.5">
                                        <div class="font-mono-nums font-bold text-slate-800">
                                            #{{ str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                                        </div>
                                        <div class="text-[10px] text-slate-400">
                                            {{ $trx->created_at ? $trx->created_at->format('d/m/y H:i') : '-' }}
                                        </div>
                                    </td>

                                    <!-- Customer -->
                                    <td class="px-5 py-3.5">
                                        <div class="font-semibold text-slate-800 truncate max-w-[140px]">
                                            {{ $trx->user ? $trx->user->name : 'Pelanggan' }}
                                        </div>
                                        <div class="text-[10px] text-slate-400 truncate max-w-[140px]">
                                            {{ $trx->user ? $trx->user->email : '-' }}
                                        </div>
                                    </td>

                                    <!-- Item & Qty -->
                                    <td class="px-5 py-3.5">
                                        <div class="font-medium text-slate-700 truncate max-w-[130px]">
                                            {{ $trx->nama_produk }}
                                        </div>
                                        <div class="text-[10px] text-slate-400 font-mono-nums">
                                            {{ $trx->qty }} item
                                        </div>
                                    </td>

                                    <!-- Total -->
                                    <td class="px-5 py-3.5 text-right font-mono-nums font-bold text-slate-900">
                                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="px-5 py-3.5 text-center">
                                        @php $st = strtolower($trx->status); @endphp
                                        @if(in_array($st, ['selesai', 'diterima']))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Lunas
                                            </span>
                                        @elseif(in_array($st, ['dikirim', 'dalam pengiriman']))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                                Dikirim
                                            </span>
                                        @elseif(in_array($st, ['batal', 'dibatalkan']))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                Batal
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                Proses
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-xs text-slate-400">
                                        Belum ada riwayat pesanan tercatat.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="p-3 border-t border-slate-100 bg-slate-50/50 text-center">
                    <a href="/transaksi" class="text-xs font-semibold text-slate-600 hover:text-slate-900 transition">
                        Buka Pembukuan Transaksi Lengkap →
                    </a>
                </div>
            </div>

            <!-- Quick Management Direct Shortcuts (5 Cols) -->
            <div class="lg:col-span-5 bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="pb-4 border-b border-slate-100 mb-4">
                        <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Hub Pengendalian Operasional</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Navigasi langsung modul manajemen dan administrasi toko</p>
                    </div>

                    <div class="space-y-2.5">
                        <a href="/karyawan" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-slate-300 hover:bg-slate-50 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-700 group-hover:bg-slate-900 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-pink-600 transition">Manajemen Staf & Baker</h4>
                                    <p class="text-[10px] text-slate-400">Hak akses divisi dapur dan kasir</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <a href="/logistik" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-slate-300 hover:bg-slate-50 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-700 group-hover:bg-slate-900 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-pink-600 transition">Stok Bahan & Logistik</h4>
                                    <p class="text-[10px] text-slate-400">Tepung, butter, kemasan, dan restock</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <a href="/resep" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-slate-300 hover:bg-slate-50 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-700 group-hover:bg-slate-900 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-pink-600 transition">Standarisasi Resep Dapur</h4>
                                    <p class="text-[10px] text-slate-400">Formula gramatur resmi kue By.Reesha</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <a href="/laporan" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-slate-300 hover:bg-slate-50 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-700 group-hover:bg-slate-900 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-pink-600 transition">Audit Finansial & Omzet</h4>
                                    <p class="text-[10px] text-slate-400">Rekapitulasi berkas laporan keuangan</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                    <span>By.Reesha Operating System</span>
                    <span class="font-mono-nums text-slate-500">v2.4 Console</span>
                </div>
            </div>

        </div>

    </main>

    <!-- ========================================== -->
    <!-- CHART VELOCITY INITIALIZATION              -->
    <!-- ========================================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
            Chart.defaults.color = '#94a3b8';

            const ctx = document.getElementById('chartVelocityOmzet');
            if (ctx) {
                const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 280);
                gradient.addColorStop(0, 'rgba(15, 23, 42, 0.16)');
                gradient.addColorStop(1, 'rgba(15, 23, 42, 0.00)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartLabels ?? []) !!},
                        datasets: [{
                            label: 'Omzet Harian',
                            data: {!! json_encode($chartOmzet ?? []) !!},
                            borderColor: '#0f172a',
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.35,
                            borderWidth: 2.2,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#0f172a',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#0f172a',
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
