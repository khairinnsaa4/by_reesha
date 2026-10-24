<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Manajemen Pemesanan</title>
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
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-slate-800 bg-[#f8fafc]">

    @include('partials.owner_sidebar', ['active' => 'pemesanan'])

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA                          -->
    <!-- ========================================== -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar">

        {{-- Alert Notifikasi --}}
        @if(session('sukses'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-xl flex items-center gap-2.5 shadow-2xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-medium">{{ session('sukses') }}</span>
        </div>
        @endif

        <!-- Executive Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 pb-6 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
                    <span>Portal Manajemen</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-pink-600 font-semibold">Pemesanan</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Pemesanan</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Pemrosesan pesanan pelanggan, status pengemasan, dan ekspedisi pengiriman.</p>
            </div>

            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-medium text-slate-600 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Total: <strong class="text-slate-900">{{ $transaksis->count() }}</strong> Pesanan</span>
                </span>
            </div>
        </div>

        @php
            $countSemua     = $transaksis->count();
            $countDiproses  = $transaksis->filter(fn($t) => in_array($t->status, ['Diproses', 'Sedang Diproses']))->count();
            $countDikemas   = $transaksis->filter(fn($t) => in_array($t->status, ['Dikemas', 'Menunggu Dikirim']))->count();
            $countDikirim   = $transaksis->filter(fn($t) => in_array($t->status, ['Dikirim', 'Dalam Pengiriman']))->count();
            $countSelesai   = $transaksis->filter(fn($t) => in_array($t->status, ['Selesai', 'Diterima']))->count();
            $countBatal     = $transaksis->filter(fn($t) => in_array($t->status, ['Dibatalkan', 'Batal']))->count();
        @endphp

        <!-- Filter Status Tabs -->
        <div class="flex flex-wrap items-center gap-2 mb-6">
            <button type="button" onclick="filterStatusPemesanan('semua')" id="btn-filter-semua"
                class="status-filter-btn px-3.5 py-2 rounded-xl text-xs font-semibold bg-pink-600 text-white shadow-2xs border border-pink-600 transition flex items-center gap-1.5">
                <span>Semua</span>
                <span class="px-1.5 py-0.2 rounded-full bg-pink-700 text-white text-[10px]">{{ $countSemua }}</span>
            </button>
            <button type="button" onclick="filterStatusPemesanan('diproses')" id="btn-filter-diproses"
                class="status-filter-btn px-3.5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition flex items-center gap-1.5">
                <span>Diproses</span>
                <span class="px-1.5 py-0.2 rounded-full bg-slate-100 text-slate-600 text-[10px]">{{ $countDiproses }}</span>
            </button>
            <button type="button" onclick="filterStatusPemesanan('dikemas')" id="btn-filter-dikemas"
                class="status-filter-btn px-3.5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition flex items-center gap-1.5">
                <span>Dikemas</span>
                <span class="px-1.5 py-0.2 rounded-full bg-slate-100 text-slate-600 text-[10px]">{{ $countDikemas }}</span>
            </button>
            <button type="button" onclick="filterStatusPemesanan('dikirim')" id="btn-filter-dikirim"
                class="status-filter-btn px-3.5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition flex items-center gap-1.5">
                <span>Dikirim</span>
                <span class="px-1.5 py-0.2 rounded-full bg-slate-100 text-slate-600 text-[10px]">{{ $countDikirim }}</span>
            </button>
            <button type="button" onclick="filterStatusPemesanan('selesai')" id="btn-filter-selesai"
                class="status-filter-btn px-3.5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition flex items-center gap-1.5">
                <span>Selesai</span>
                <span class="px-1.5 py-0.2 rounded-full bg-slate-100 text-slate-600 text-[10px]">{{ $countSelesai }}</span>
            </button>
            <button type="button" onclick="filterStatusPemesanan('dibatalkan')" id="btn-filter-dibatalkan"
                class="status-filter-btn px-3.5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition flex items-center gap-1.5">
                <span>Dibatalkan</span>
                <span class="px-1.5 py-0.2 rounded-full bg-slate-100 text-slate-600 text-[10px]">{{ $countBatal }}</span>
            </button>
        </div>

        <!-- Table Card Container -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <!-- Table Toolbar -->
            <div class="p-4 sm:p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="relative flex-1 max-w-md">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-pemesanan" placeholder="Cari ID pesanan, nama pelanggan, atau produk..." oninput="cariPemesanan()"
                        class="w-full text-xs sm:text-sm border border-slate-200 rounded-xl pl-9 pr-3 py-2 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition">
                </div>

                <div class="text-xs text-slate-500">
                    <span id="result-count-pms" class="text-slate-400 font-medium"></span>
                </div>
            </div>

            <!-- Table Body -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-200 text-[11px] font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5">ID Transaksi</th>
                            <th class="px-5 py-3.5">Pelanggan</th>
                            <th class="px-5 py-3.5">Produk Dipesan</th>
                            <th class="px-5 py-3.5">Waktu Transaksi</th>
                            <th class="px-5 py-3.5">Total Bayar</th>
                            <th class="px-5 py-3.5 text-center">Status & Penanganan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="tabel-pemesanan">
                        @forelse($transaksis as $trx)
                        <tr class="hover:bg-slate-50/60 transition-colors pms-row" data-status="{{ strtolower($trx->status) }}">
                            <!-- ID -->
                            <td class="px-5 py-4 font-mono font-bold text-slate-800 text-xs">
                                <span class="px-2 py-0.5 rounded bg-slate-100 border border-slate-200 text-slate-700">
                                    #{{ $trx->kode_transaksi ?? 'TRX-' . str_pad($trx->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <!-- Pelanggan -->
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-full bg-pink-100 text-pink-700 flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($trx->user ? $trx->user->name : 'P', 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-slate-800 text-xs truncate">{{ $trx->user ? $trx->user->name : 'Pelanggan Tamu' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Produk & Qty -->
                            <td class="px-5 py-4 text-xs">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-medium text-slate-800">{{ $trx->nama_produk }}</span>
                                    <span class="inline-flex items-center px-1.5 py-0.2 rounded text-[10px] font-semibold bg-slate-100 text-slate-600">
                                        {{ $trx->qty }} item
                                    </span>
                                </div>
                            </td>

                            <!-- Tanggal -->
                            <td class="px-5 py-4 text-xs text-slate-500">
                                {{ $trx->created_at ? $trx->created_at->locale('id')->isoFormat('D MMM Y, HH:mm') : '-' }}
                            </td>

                            <!-- Total -->
                            <td class="px-5 py-4 font-bold text-slate-900 text-xs">
                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                            </td>

                            <!-- Status Dropdown & Action -->
                            <td class="px-5 py-4 text-center">
                                <div class="flex flex-col items-center gap-1.5">
                                    <form action="/pemesanan/{{ $trx->id }}/update-status" method="POST" class="inline-block">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-xs font-semibold px-2.5 py-1 rounded-lg border outline-none cursor-pointer shadow-2xs transition
                                            {{ in_array($trx->status, ['Diproses', 'Sedang Diproses']) ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                            {{ in_array($trx->status, ['Dikemas']) ? 'bg-purple-50 text-purple-700 border-purple-200' : '' }}
                                            {{ in_array($trx->status, ['Dikirim', 'Dalam Pengiriman']) ? 'bg-sky-50 text-sky-700 border-sky-200' : '' }}
                                            {{ in_array($trx->status, ['Selesai', 'Diterima']) ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' }}
                                            {{ in_array($trx->status, ['Dibatalkan', 'Batal']) ? 'bg-rose-50 text-rose-700 border-rose-200' : '' }}">
                                            <option value="Diproses" {{ in_array($trx->status, ['Diproses', 'Sedang Diproses']) ? 'selected' : '' }}>Diproses</option>
                                            <option value="Dikemas" {{ $trx->status === 'Dikemas' ? 'selected' : '' }}>Dikemas</option>
                                            <option value="Dikirim" {{ in_array($trx->status, ['Dikirim', 'Dalam Pengiriman']) ? 'selected' : '' }}>Dikirim</option>
                                            <option value="Selesai" {{ in_array($trx->status, ['Selesai', 'Diterima']) ? 'selected' : '' }}>Selesai</option>
                                            <option value="Dibatalkan" {{ in_array($trx->status, ['Dibatalkan', 'Batal']) ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </form>

                                    {{-- Quick Action Buttons with Crisp SVG Icons --}}
                                    @if(in_array($trx->status, ['Diproses', 'Sedang Diproses']))
                                        <form action="/pemesanan/{{ $trx->id }}/update-status" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Dikemas">
                                            <button type="submit" class="inline-flex items-center gap-1 text-[10px] font-semibold bg-purple-50 hover:bg-purple-100 text-purple-700 px-2 py-0.5 rounded border border-purple-200 transition">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                <span>Siap Dikemas</span>
                                            </button>
                                        </form>
                                    @elseif($trx->status === 'Dikemas')
                                        <form action="/pemesanan/{{ $trx->id }}/update-status" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Dikirim">
                                            <button type="submit" class="inline-flex items-center gap-1 text-[10px] font-semibold bg-sky-50 hover:bg-sky-100 text-sky-700 px-2 py-0.5 rounded border border-sky-200 transition">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                                <span>Kirim Kurir</span>
                                            </button>
                                        </form>
                                    @elseif(in_array($trx->status, ['Dikirim', 'Dalam Pengiriman']))
                                        <form action="/pemesanan/{{ $trx->id }}/update-status" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Selesai">
                                            <button type="submit" class="inline-flex items-center gap-1 text-[10px] font-semibold bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded border border-emerald-200 transition">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                <span>Tandai Selesai</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-pms">
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="max-w-xs mx-auto text-slate-400">
                                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <p class="text-sm font-semibold text-slate-600">Belum ada pesanan masuk</p>
                                    <p class="text-xs text-slate-400 mt-1">Pesanan pembeli akan muncul secara real-time di tabel ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Scripts -->
    <script>
        let activeStatusFilter = 'semua';

        function filterStatusPemesanan(status) {
            activeStatusFilter = status;

            document.querySelectorAll('.status-filter-btn').forEach(btn => {
                btn.classList.remove('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-2xs');
                btn.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
            });

            const activeBtn = document.getElementById('btn-filter-' + status);
            if (activeBtn) {
                activeBtn.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
                activeBtn.classList.add('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-2xs');
            }

            cariPemesanan();
        }

        function cariPemesanan() {
            const keyword = document.getElementById('search-pemesanan').value.toLowerCase();
            const rows    = document.querySelectorAll('#tabel-pemesanan .pms-row');
            let visible   = 0;

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const rowStatus = (row.getAttribute('data-status') || '').toLowerCase();

                const matchKeyword = text.includes(keyword);
                let matchStatus = false;
                if (activeStatusFilter === 'semua') {
                    matchStatus = true;
                } else if (activeStatusFilter === 'diproses') {
                    matchStatus = rowStatus.includes('proses');
                } else if (activeStatusFilter === 'dikemas') {
                    matchStatus = rowStatus.includes('kemas');
                } else if (activeStatusFilter === 'dikirim') {
                    matchStatus = rowStatus.includes('kirim');
                } else if (activeStatusFilter === 'selesai') {
                    matchStatus = rowStatus.includes('selesai') || rowStatus.includes('terima');
                } else if (activeStatusFilter === 'dibatalkan') {
                    matchStatus = rowStatus.includes('batal');
                }

                if (matchKeyword && matchStatus) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }
            });

            const countEl = document.getElementById('result-count-pms');
            if (countEl) {
                countEl.innerText = (keyword || activeStatusFilter !== 'semua') ? `${visible} pesanan ditemukan` : '';
            }
        }

        document.getElementById('search-pemesanan').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') cariPemesanan();
        });
    </script>
</body>
</html>
