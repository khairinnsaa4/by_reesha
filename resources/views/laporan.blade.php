<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; }

        /* ===== PRINT STYLES ===== */
        @media print {
            body * { visibility: hidden !important; }
            #print-area, #print-area * { visibility: visible !important; }
            #print-area { position: absolute; left: 0; top: 0; width: 100%; padding: 24px; }
            .no-print { display: none !important; }
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #e5e7eb; padding: 8px 12px; font-size: 13px; }
            th { background-color: #f3f4f6 !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body class="flex min-h-screen text-gray-800">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-screen sticky top-0 p-5 hidden md:flex no-print">
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
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/dashboard-owner" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Dashboard
                </a>
                @endif
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/karyawan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Karyawan
                </a>
                @endif
                @if(Auth::check() && Auth::user()->role === 'owner')
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
    <main class="flex-1 p-8">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 no-print">
            <div>
                <h1 class="text-2xl font-semibold">Laporan</h1>
                <p class="text-sm text-gray-500 mt-0.5">Dibuat pada: {{ now()->format('d F Y, H:i') }} WIB</p>
            </div>
            
            <form action="/laporan" method="GET" class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm flex-wrap">
                <label for="filter" class="text-sm text-gray-600 font-medium">Periode:</label>
                <select name="filter" id="filter" onchange="handleFilterChange(this)" class="border-0 bg-transparent text-sm font-semibold text-gray-800 focus:ring-0 cursor-pointer">
                    <option value="semua"   {{ (isset($filter) && $filter === 'semua')   ? 'selected' : '' }}>Semua Waktu</option>
                    <option value="harian"  {{ (isset($filter) && $filter === 'harian')  ? 'selected' : '' }}>Harian (Pilih Tanggal)</option>
                    <option value="mingguan"{{ (isset($filter) && $filter === 'mingguan')? 'selected' : '' }}>Mingguan (Pilih Minggu)</option>
                    <option value="bulanan" {{ (isset($filter) && $filter === 'bulanan') ? 'selected' : '' }}>Bulanan (Pilih Bulan)</option>
                    <option value="tahunan" {{ (isset($filter) && $filter === 'tahunan') ? 'selected' : '' }}>Laporan Tahunan</option>
                </select>
                <div id="tahun-selector" class="{{ (isset($filter) && $filter === 'tahunan') ? 'flex' : 'hidden' }} items-center gap-2">
                    <span class="text-gray-400 text-sm">|</span>
                    <label class="text-sm text-gray-600">Tahun:</label>
                    <select name="tahun" class="border border-gray-200 bg-white rounded-lg text-sm font-semibold text-gray-800 px-2 py-1 focus:ring-0 focus:border-pink-400">
                        @foreach($allYears as $y)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">Tampilkan</button>
                </div>
                <div id="tanggal-selector" class="{{ (isset($filter) && $filter === 'harian') ? 'flex' : 'hidden' }} items-center gap-2">
                    <span class="text-gray-400 text-sm">|</span>
                    <label class="text-sm text-gray-600">Tanggal:</label>
                    <input type="date" name="tanggal" value="{{ $tanggal ?? now()->toDateString() }}" class="border border-gray-200 bg-white rounded-lg text-sm font-semibold text-gray-800 px-2 py-1 focus:ring-0 focus:border-pink-400">
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">Tampilkan</button>
                </div>
                <div id="minggu-selector" class="{{ (isset($filter) && $filter === 'mingguan') ? 'flex' : 'hidden' }} items-center gap-2">
                    <span class="text-gray-400 text-sm">|</span>
                    <label class="text-sm text-gray-600">Minggu:</label>
                    <input type="week" name="minggu" value="{{ $minggu ?? now()->format('Y-\WW') }}" class="border border-gray-200 bg-white rounded-lg text-sm font-semibold text-gray-800 px-2 py-1 focus:ring-0 focus:border-pink-400">
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">Tampilkan</button>
                </div>
                <div id="bulan-selector" class="{{ (isset($filter) && $filter === 'bulanan') ? 'flex' : 'hidden' }} items-center gap-2">
                    <span class="text-gray-400 text-sm">|</span>
                    <label class="text-sm text-gray-600">Bulan:</label>
                    <input type="month" name="bulan" value="{{ $bulan_input ?? now()->format('Y-m') }}" class="border border-gray-200 bg-white rounded-lg text-sm font-semibold text-gray-800 px-2 py-1 focus:ring-0 focus:border-pink-400">
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">Tampilkan</button>
                </div>
            </form>
        </div>

        {{-- ===== RINGKASAN STATISTIK ===== --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8 no-print">
            <div class="bg-gradient-to-br from-pink-500 to-rose-500 p-5 rounded-xl shadow text-white">
                <p class="text-sm font-medium opacity-80 mb-1">Total Pendapatan</p>
                <h3 class="text-2xl font-bold">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-violet-600 p-5 rounded-xl shadow text-white">
                <p class="text-sm font-medium opacity-80 mb-1">Total Pesanan</p>
                <h3 class="text-2xl font-bold">{{ $total_pesanan }} Transaksi</h3>
            </div>
            <div class="bg-gradient-to-br from-amber-400 to-orange-500 p-5 rounded-xl shadow text-white">
                <p class="text-sm font-medium opacity-80 mb-1">Produk Terjual</p>
                <h3 class="text-2xl font-bold">{{ $total_produk }} Item</h3>
            </div>
        </div>

        {{-- ===== TAB NAVIGATION ===== --}}
        <div class="no-print flex gap-2 mb-6 border-b border-gray-200 overflow-x-auto">
            <button onclick="showTab('penjualan')" id="tab-penjualan"
                class="tab-btn whitespace-nowrap px-5 py-2.5 text-sm font-medium rounded-t-lg border-b-2 border-pink-600 text-pink-700 bg-white -mb-px transition">
                📊 Laporan Penjualan
            </button>
            <button onclick="showTab('keuangan')" id="tab-keuangan"
                class="tab-btn whitespace-nowrap px-5 py-2.5 text-sm font-medium rounded-t-lg border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
                💰 Laporan Keuangan
            </button>
            <button onclick="showTab('logistik')" id="tab-logistik"
                class="tab-btn whitespace-nowrap px-5 py-2.5 text-sm font-medium rounded-t-lg border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
                📦 Laporan Logistik & Stok
            </button>
            <button onclick="showTab('tahunan')" id="tab-tahunan"
                class="tab-btn whitespace-nowrap px-5 py-2.5 text-sm font-medium rounded-t-lg border-b-2 border-transparent text-gray-500 hover:text-gray-700 transition">
                📅 Laporan Tahunan
            </button>
        </div>

        {{-- ========================================== --}}
        {{-- TAB 1: LAPORAN PENJUALAN --}}
        {{-- ========================================== --}}
        <div id="panel-penjualan" class="tab-panel">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                {{-- Header --}}
                <div class="p-5 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Laporan Penjualan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Rekap seluruh transaksi penjualan kue By.Reesha</p>
                    </div>
                    <button onclick="cetakLaporan('penjualan')"
                        class="no-print flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition shadow">
                        🖨️ Cetak / Unduh
                    </button>
                </div>

                {{-- Print Area Penjualan --}}
                <div id="print-penjualan" class="p-6">
                    <div class="hidden print-header text-center mb-6">
                        <h2 class="text-xl font-bold">BY.REESHA — Toko Kue Custom</h2>
                        <p class="text-sm text-gray-500">
                            Laporan Penjualan 
                            @if($filter === 'harian') (Harian: {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }})
                            @elseif($filter === 'mingguan') (Mingguan: {{ $tanggal_awal }} - {{ $tanggal_akhir }})
                            @elseif($filter === 'bulanan') (Bulanan: {{ $nama_bulan }} {{ $tahun_bulan }})
                            @elseif($filter === 'tahunan') (Tahun {{ $tahun }})
                            @else (Semua Waktu)
                            @endif
                            — Dicetak: {{ now()->format('d F Y') }}
                        </p>
                        <hr class="my-3">
                    </div>

                    {{-- Ringkasan per produk --}}
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Rekap Per Produk</h4>
                    <div class="overflow-x-auto mb-6">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                                    <th class="px-4 py-3 font-medium">Nama Produk</th>
                                    <th class="px-4 py-3 font-medium text-center">Qty Terjual</th>
                                    <th class="px-4 py-3 font-medium text-right">Total Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($per_produk as $p)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $p['nama'] }}</td>
                                    <td class="px-4 py-3 text-center text-gray-600">{{ $p['qty'] }} item</td>
                                    <td class="px-4 py-3 text-right font-semibold text-pink-600">
                                        Rp {{ number_format($p['total'], 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="px-4 py-8 text-center text-gray-400">Belum ada data penjualan.</td></tr>
                                @endforelse
                            </tbody>
                            @if($per_produk->count() > 0)
                            <tfoot>
                                <tr class="bg-pink-50 font-semibold">
                                    <td class="px-4 py-3 text-gray-800">TOTAL</td>
                                    <td class="px-4 py-3 text-center text-gray-800">{{ $total_produk }} item</td>
                                    <td class="px-4 py-3 text-right text-pink-700 text-base">
                                        Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>

                    {{-- Detail semua transaksi --}}
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Detail Semua Transaksi</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                                    <th class="px-4 py-3 font-medium">#</th>
                                    <th class="px-4 py-3 font-medium">Produk</th>
                                    <th class="px-4 py-3 font-medium">Pembeli</th>
                                    <th class="px-4 py-3 font-medium text-center">Qty</th>
                                    <th class="px-4 py-3 font-medium">Pembayaran</th>
                                    <th class="px-4 py-3 font-medium text-right">Total</th>
                                    <th class="px-4 py-3 font-medium">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($transaksis as $i => $trx)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-400 text-xs">{{ $i+1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $trx->nama_produk }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $trx->user?->name ?? 'Tamu' }}</td>
                                    <td class="px-4 py-3 text-center text-gray-600">{{ $trx->qty }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                            {{ $trx->metode_pembayaran === 'QRIS' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                                            {{ $trx->metode_pembayaran }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right font-semibold text-pink-600">
                                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-400 text-xs">{{ $trx->created_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">Belum ada transaksi tercatat.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- TAB 2: LAPORAN KEUANGAN --}}
        {{-- ========================================== --}}
        <div id="panel-keuangan" class="tab-panel hidden">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-5 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Laporan Keuangan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Arus kas dan rekapitulasi pemasukan dari penjualan</p>
                    </div>
                    <button onclick="cetakLaporan('keuangan')"
                        class="no-print flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition shadow">
                        🖨️ Cetak / Unduh
                    </button>
                </div>
                <div id="print-keuangan" class="p-6">
                    <div class="hidden print-header text-center mb-6">
                        <h2 class="text-xl font-bold">BY.REESHA — Toko Kue Custom</h2>
                        <p class="text-sm text-gray-500">
                            Laporan Keuangan
                            @if($filter === 'harian') (Harian: {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }})
                            @elseif($filter === 'mingguan') (Mingguan: {{ $tanggal_awal }} - {{ $tanggal_akhir }})
                            @elseif($filter === 'bulanan') (Bulanan: {{ $nama_bulan }} {{ $tahun_bulan }})
                            @elseif($filter === 'tahunan') (Tahun {{ $tahun }})
                            @else (Semua Waktu)
                            @endif
                            — Dicetak: {{ now()->format('d F Y') }}
                        </p>
                        <hr class="my-3">
                    </div>
                    {{-- Ringkasan kartu keuangan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                        <div class="bg-green-50 border border-green-100 rounded-xl p-5">
                            <p class="text-xs text-green-600 font-medium mb-1">Total Pemasukan</p>
                            <p class="text-xl font-bold text-green-700">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Dari {{ $total_pesanan }} transaksi</p>
                        </div>
                        <div class="bg-amber-50 border border-amber-100 rounded-xl p-5">
                            <p class="text-xs text-amber-600 font-medium mb-1">Perkiraan HPP (Estimasi 40%)</p>
                            <p class="text-xl font-bold text-amber-700">Rp {{ number_format($total_pendapatan * 0.4, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Biaya bahan baku & produksi</p>
                        </div>
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                            <p class="text-xs text-blue-600 font-medium mb-1">Estimasi Laba Bersih (60%)</p>
                            <p class="text-xl font-bold text-blue-700">Rp {{ number_format($total_pendapatan * 0.6, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Sebelum pajak & overhead</p>
                        </div>
                    </div>

                    {{-- Detail per metode pembayaran --}}
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Rekap Per Metode Pembayaran</h4>
                    @php
                        $per_metode = $transaksis->groupBy('metode_pembayaran');
                    @endphp
                    <div class="overflow-x-auto mb-8">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                                    <th class="px-4 py-3 font-medium">Metode Pembayaran</th>
                                    <th class="px-4 py-3 font-medium text-center">Jumlah Transaksi</th>
                                    <th class="px-4 py-3 font-medium text-right">Total Pemasukan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($per_metode as $metode => $items)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium
                                            {{ $metode === 'QRIS' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                                            {{ $metode }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-600">{{ $items->count() }} transaksi</td>
                                    <td class="px-4 py-3 text-right font-semibold text-gray-800">
                                        Rp {{ number_format($items->sum('total_harga'), 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="px-4 py-8 text-center text-gray-400">Belum ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Catatan Keuangan --}}
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Catatan Pengeluaran Operasional (Estimasi)</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                                    <th class="px-4 py-3 font-medium">Jenis Biaya</th>
                                    <th class="px-4 py-3 font-medium">Keterangan</th>
                                    <th class="px-4 py-3 font-medium text-right">Estimasi/Bulan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-800">Bahan Baku</td>
                                    <td class="px-4 py-3 text-gray-500">Tepung, telur, mentega, gula, dll.</td>
                                    <td class="px-4 py-3 text-right text-gray-700">Rp {{ number_format($total_pendapatan * 0.35, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-800">Packaging</td>
                                    <td class="px-4 py-3 text-gray-500">Box, pita, label, dll.</td>
                                    <td class="px-4 py-3 text-right text-gray-700">Rp {{ number_format($total_pendapatan * 0.05, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="bg-red-50 font-semibold">
                                    <td class="px-4 py-3 text-gray-800">TOTAL PENGELUARAN</td>
                                    <td class="px-4 py-3 text-gray-500">Estimasi total biaya</td>
                                    <td class="px-4 py-3 text-right text-red-600">Rp {{ number_format($total_pendapatan * 0.4, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- TAB 3: LAPORAN LOGISTIK & STOK --}}
        {{-- ========================================== --}}
        <div id="panel-logistik" class="tab-panel hidden">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-5 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Laporan Logistik & Stok</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Data ketersediaan bahan baku dan status gudang</p>
                    </div>
                    <button onclick="cetakLaporan('logistik')"
                        class="no-print flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition shadow">
                        🖨️ Cetak / Unduh
                    </button>
                </div>
                <div id="print-logistik" class="p-6">
                    <div class="hidden print-header text-center mb-6">
                        <h2 class="text-xl font-bold">BY.REESHA — Toko Kue Custom</h2>
                        <p class="text-sm text-gray-500">Laporan Logistik & Stok — Dicetak: {{ now()->format('d F Y') }}</p>
                        <hr class="my-3">
                    </div>

                    {{-- Ringkasan status stok --}}
                    @php
                        $stok_kritis  = collect($logistik)->where('status','Kritis')->count();
                        $stok_menipis = collect($logistik)->where('status','Menipis')->count();
                        $stok_aman    = collect($logistik)->where('status','Aman')->count();
                    @endphp
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="bg-green-50 border border-green-100 rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-green-600">{{ $stok_aman }}</p>
                            <p class="text-xs text-green-600 font-medium mt-1">Stok Aman</p>
                        </div>
                        <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-yellow-600">{{ $stok_menipis }}</p>
                            <p class="text-xs text-yellow-600 font-medium mt-1">Stok Menipis</p>
                        </div>
                        <div class="bg-red-50 border border-red-100 rounded-xl p-4 text-center">
                            <p class="text-2xl font-bold text-red-600">{{ $stok_kritis }}</p>
                            <p class="text-xs text-red-600 font-medium mt-1">Stok Kritis</p>
                        </div>
                    </div>

                    @if($stok_kritis > 0 || $stok_menipis > 0)
                    <div class="mb-5 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                        ⚠️ <strong>Perhatian!</strong> Ada {{ $stok_kritis }} bahan kritis dan {{ $stok_menipis }} bahan yang hampir habis. Segera lakukan restock.
                    </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                                    <th class="px-4 py-3 font-medium">Nama Barang</th>
                                    <th class="px-4 py-3 font-medium">Kategori</th>
                                    <th class="px-4 py-3 font-medium text-center">Stok</th>
                                    <th class="px-4 py-3 font-medium text-center">Satuan</th>
                                    <th class="px-4 py-3 font-medium text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($logistik as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $item['nama'] }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $item['kategori'] }}</td>
                                    <td class="px-4 py-3 text-center font-semibold
                                        {{ $item['status'] === 'Kritis' ? 'text-red-600' : ($item['status'] === 'Menipis' ? 'text-yellow-600' : 'text-gray-800') }}">
                                        {{ $item['stok'] }}
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-500">{{ $item['satuan'] }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if($item['status'] === 'Aman')
                                            <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">✓ Aman</span>
                                        @elseif($item['status'] === 'Menipis')
                                            <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">⚡ Menipis</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">🔴 Kritis</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <p class="mt-4 text-xs text-gray-400">Laporan stok diperbarui otomatis setiap kali halaman dibuka. Tanggal: {{ now()->format('d F Y, H:i') }} WIB.</p>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- TAB 4: LAPORAN TAHUNAN --}}
        {{-- ========================================== --}}
        <div id="panel-tahunan" class="tab-panel hidden">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-5 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Laporan Tahunan {{ $tahun }}</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Rekap pendapatan & transaksi per bulan selama tahun {{ $tahun }}</p>
                    </div>
                    <button onclick="cetakLaporan('tahunan')"
                        class="no-print flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition shadow">
                        🖨️ Cetak / Unduh
                    </button>
                </div>

                <div id="print-tahunan" class="p-6">
                    <div class="hidden print-header text-center mb-6">
                        <h2 class="text-xl font-bold">BY.REESHA — Toko Kue Custom</h2>
                        <p class="text-sm text-gray-500">Laporan Tahunan {{ $tahun }} — Dicetak: {{ now()->format('d F Y') }}</p>
                        <hr class="my-3">
                    </div>

                    {{-- Kartu Ringkasan Tahunan --}}
                    @php
                        $pendapatan_tahunan = $per_bulan->sum('pendapatan');
                        $transaksi_tahunan  = $per_bulan->sum('transaksi');
                        $produk_tahunan     = $per_bulan->sum('produk');
                        $bulan_terbaik      = $per_bulan->sortByDesc('pendapatan')->first();
                        $max_pendapatan     = $per_bulan->max('pendapatan');
                    @endphp
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                        <div class="bg-gradient-to-br from-indigo-500 to-violet-600 p-4 rounded-xl text-white">
                            <p class="text-xs font-medium opacity-80 mb-1">Total Pendapatan {{ $tahun }}</p>
                            <p class="text-lg font-bold">Rp {{ number_format($pendapatan_tahunan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-pink-500 to-rose-500 p-4 rounded-xl text-white">
                            <p class="text-xs font-medium opacity-80 mb-1">Total Transaksi</p>
                            <p class="text-lg font-bold">{{ $transaksi_tahunan }} Pesanan</p>
                        </div>
                        <div class="bg-gradient-to-br from-amber-400 to-orange-500 p-4 rounded-xl text-white">
                            <p class="text-xs font-medium opacity-80 mb-1">Total Produk Terjual</p>
                            <p class="text-lg font-bold">{{ $produk_tahunan }} Item</p>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 p-4 rounded-xl text-white">
                            <p class="text-xs font-medium opacity-80 mb-1">Bulan Terbaik</p>
                            <p class="text-lg font-bold">{{ $bulan_terbaik['label'] }}</p>
                        </div>
                    </div>

                   

                    {{-- Tabel Rekap Per Bulan --}}
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">📋 Rekap Detail Per Bulan</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                                    <th class="px-4 py-3 font-medium">Bulan</th>
                                    <th class="px-4 py-3 font-medium text-center">Jumlah Transaksi</th>
                                    <th class="px-4 py-3 font-medium text-center">Produk Terjual</th>
                                    <th class="px-4 py-3 font-medium text-right">Total Pendapatan</th>
                                    <th class="px-4 py-3 font-medium text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($per_bulan as $bln)
                                @php $isTerbaik = $bln['pendapatan'] === $max_pendapatan && $max_pendapatan > 0; @endphp
                                <tr class="hover:bg-gray-50 {{ $isTerbaik ? 'bg-indigo-50' : '' }}">
                                    <td class="px-4 py-3 font-semibold text-gray-800">
                                        {{ $bln['label'] }}
                                        @if($isTerbaik)
                                        <span class="ml-1 text-xs bg-indigo-100 text-indigo-700 px-1.5 py-0.5 rounded-full font-medium">🏆 Terbaik</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-600">{{ $bln['transaksi'] }} transaksi</td>
                                    <td class="px-4 py-3 text-center text-gray-600">{{ $bln['produk'] }} item</td>
                                    <td class="px-4 py-3 text-right font-semibold {{ $bln['pendapatan'] > 0 ? 'text-indigo-700' : 'text-gray-400' }}">
                                        Rp {{ number_format($bln['pendapatan'], 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($bln['transaksi'] === 0)
                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-400 text-xs rounded-full">Tidak ada</span>
                                        @elseif($bln['pendapatan'] >= ($pendapatan_tahunan / 12 * 1.2))
                                        <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full font-medium">↑ Di atas rata-rata</span>
                                        @elseif($bln['pendapatan'] >= ($pendapatan_tahunan / 12 * 0.8))
                                        <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">→ Normal</span>
                                        @else
                                        <span class="px-2 py-0.5 bg-amber-100 text-amber-700 text-xs rounded-full font-medium">↓ Di bawah rata-rata</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-indigo-50 font-bold border-t-2 border-indigo-200">
                                    <td class="px-4 py-3 text-gray-800">TOTAL {{ $tahun }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800">{{ $transaksi_tahunan }} transaksi</td>
                                    <td class="px-4 py-3 text-center text-gray-800">{{ $produk_tahunan }} item</td>
                                    <td class="px-4 py-3 text-right text-indigo-700 text-base">Rp {{ number_format($pendapatan_tahunan, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-center text-gray-500 text-xs font-normal">Rata-rata: Rp {{ number_format($transaksi_tahunan > 0 ? $pendapatan_tahunan / 12 : 0, 0, ',', '.') }}/bln</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <p class="mt-4 text-xs text-gray-400">Laporan tahunan {{ $tahun }} | Dicetak: {{ now()->format('d F Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>

    </main>

    {{-- Hidden print area --}}
    <div id="print-area" class="hidden"></div>

    <script>
        // Tab switching
        function showTab(name) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('border-pink-600','text-pink-700','bg-white','-mb-px');
                b.classList.add('border-transparent','text-gray-500');
            });
            document.getElementById('panel-' + name).classList.remove('hidden');
            const btn = document.getElementById('tab-' + name);
            btn.classList.add('border-pink-600','text-pink-700','bg-white','-mb-px');
            btn.classList.remove('border-transparent','text-gray-500');
        }

        // Tampilkan/sembunyikan pilihan tahun/tanggal ketika filter berubah
        function handleFilterChange(sel) {
            const boxTahun = document.getElementById('tahun-selector');
            const boxTanggal = document.getElementById('tanggal-selector');
            const boxMinggu = document.getElementById('minggu-selector');
            const boxBulan = document.getElementById('bulan-selector');
            
            boxTahun.classList.add('hidden');
            boxTahun.classList.remove('flex');
            boxTanggal.classList.add('hidden');
            boxTanggal.classList.remove('flex');
            boxMinggu.classList.add('hidden');
            boxMinggu.classList.remove('flex');
            boxBulan.classList.add('hidden');
            boxBulan.classList.remove('flex');

            if (sel.value === 'tahunan') {
                boxTahun.classList.remove('hidden');
                boxTahun.classList.add('flex');
            } else if (sel.value === 'harian') {
                boxTanggal.classList.remove('hidden');
                boxTanggal.classList.add('flex');
            } else if (sel.value === 'mingguan') {
                boxMinggu.classList.remove('hidden');
                boxMinggu.classList.add('flex');
            } else if (sel.value === 'bulanan') {
                boxBulan.classList.remove('hidden');
                boxBulan.classList.add('flex');
            } else {
                sel.form.submit();
            }
        }

        // Cetak laporan tertentu
        function cetakLaporan(type) {
            const area   = document.getElementById('print-area');
            const source = document.getElementById('print-' + type);
            area.innerHTML = source.innerHTML;
            area.querySelectorAll('.print-header').forEach(el => el.classList.remove('hidden'));
            area.classList.remove('hidden');
            window.print();
            area.classList.add('hidden');
            area.innerHTML = '';
        }

        // Jika filter tahunan aktif saat load, langsung buka tab tahunan
        @if(isset($filter) && $filter === 'tahunan')
        window.addEventListener('DOMContentLoaded', () => showTab('tahunan'));
        @endif
    </script>

</body>
</html>
