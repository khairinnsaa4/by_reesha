<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Manajemen Logistik & Stok</title>
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

    @include('partials.owner_sidebar', ['active' => 'logistik'])

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA                          -->
    <!-- ========================================== -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar pb-24 md:pb-8">

        {{-- Alerts --}}
        @if(session('sukses'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-xl flex items-center gap-2.5 shadow-2xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-medium">{{ session('sukses') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm rounded-xl flex items-center gap-2.5 shadow-2xs">
            <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
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
                    <span class="text-pink-600 font-semibold">Logistik & Inventaris</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Logistik & Stok Bahan</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Pemantauan ketersediaan bahan baku produksi, persediaan kemasan, dan pencatatan restock kuota PO.</p>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="toggleModal('modal-tambah')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Barang</span>
                </button>
            </div>
        </div>

        @php
            $totalBarang = $logistiks->count();
            $stokAman    = $logistiks->where('status', 'Aman')->count();
            $stokMenipis = $logistiks->where('status', 'Menipis')->count();
            $stokKritis  = $logistiks->where('status', 'Kritis')->count();
        @endphp

        <!-- KPI Metric Cards Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-pink-50 border border-pink-100 text-pink-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Total Logistik</span>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900">{{ $totalBarang }} <span class="text-xs font-normal text-slate-500">Item</span></h3>
                </div>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-emerald-600 uppercase tracking-wider block">Stok Aman</span>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900">{{ $stokAman }} <span class="text-xs font-normal text-slate-500">Bahan</span></h3>
                </div>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-amber-600 uppercase tracking-wider block">Stok Menipis</span>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900">{{ $stokMenipis }} <span class="text-xs font-normal text-slate-500">Perlu Pantau</span></h3>
                </div>
            </div>

            <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/90 shadow-xs flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <span class="text-[11px] font-semibold text-rose-600 uppercase tracking-wider block">Stok Kritis</span>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900">{{ $stokKritis }} <span class="text-xs font-normal text-slate-500">Segera Pesan</span></h3>
                </div>
            </div>
        </div>

        <!-- Table Card Container 1: Bahan Baku & Packaging -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <!-- Table Toolbar -->
            <div class="p-4 sm:p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="relative flex-1 max-w-md">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-logistik" placeholder="Cari nama barang atau kategori bahan..." oninput="cariLogistik()"
                        class="w-full text-xs sm:text-sm border border-slate-200 rounded-xl pl-9 pr-3 py-2 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition">
                </div>

                <div class="text-xs text-slate-500">
                    <span id="result-count-log" class="text-slate-400 font-medium"></span>
                    <span class="ml-2 font-medium text-slate-600">Total: <strong id="log-count" class="text-slate-900">{{ $logistiks->count() }}</strong> Jenis</span>
                </div>
            </div>

            <!-- Table Body -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-200 text-[11px] font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5">Nama Barang / Bahan</th>
                            <th class="px-5 py-3.5">Kategori</th>
                            <th class="px-5 py-3.5 text-center">Jumlah Stok</th>
                            <th class="px-5 py-3.5 text-center">Satuan</th>
                            <th class="px-5 py-3.5 text-center">Status Stok</th>
                            <th class="px-5 py-3.5 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="tabel-logistik">
                        @forelse($logistiks as $item)
                        @php
                            $autoStatus = $item->stok <= 5 ? 'Kritis' : ($item->stok <= 15 ? 'Menipis' : 'Aman');
                        @endphp
                        <tr class="hover:bg-slate-50/60 transition-colors log-row">
                            <!-- Name -->
                            <td class="px-5 py-4 font-semibold text-slate-800 text-xs sm:text-sm">
                                {{ $item->nama }}
                            </td>

                            <!-- Category -->
                            <td class="px-5 py-4 text-xs text-slate-500">
                                <span class="px-2 py-0.5 rounded-md bg-slate-100 border border-slate-200 text-slate-600 text-[11px] font-medium">
                                    {{ $item->kategori }}
                                </span>
                            </td>

                            <!-- Stock -->
                            <td class="px-5 py-4 text-center font-bold text-xs sm:text-sm {{ $autoStatus === 'Kritis' ? 'text-rose-600' : ($autoStatus === 'Menipis' ? 'text-amber-600' : 'text-slate-900') }}">
                                {{ $item->stok }}
                            </td>

                            <!-- Unit -->
                            <td class="px-5 py-4 text-center text-xs text-slate-500 font-medium">
                                {{ $item->satuan }}
                            </td>

                            <!-- Status Badge -->
                            <td class="px-5 py-4 text-center">
                                @if($autoStatus === 'Aman')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-semibold rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aman
                                    </span>
                                @elseif($autoStatus === 'Menipis')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 text-[11px] font-semibold rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menipis
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-200 text-[11px] font-semibold rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Kritis
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <button onclick="openRestockModal({{ $item }})" class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-semibold rounded-lg transition" title="Catat Stok Masuk">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span>Restock</span>
                                    </button>

                                    <button onclick="openEditModal({{ $item }})" class="p-1.5 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-lg transition" title="Ubah Data Barang">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <form action="/logistik/{{ $item->id }}/hapus" method="POST" onsubmit="return confirm('Konfirmasi: Hapus data barang {{ $item->nama }}?')" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-100 rounded-lg transition" title="Hapus Barang">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-log">
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                Belum ada data barang logistik yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ======================================================= -->
        <!-- MANAJEMEN STOK PRODUK & RESTOCK (FINISHED GOODS)        -->
        <!-- ======================================================= -->
        <div class="mt-8 bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <!-- Header -->
            <div class="p-4 sm:p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-slate-50/50">
                <div>
                    <h2 class="text-base font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        <span>Stok Produk & Katalog Kue</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">Pemantauan persediaan stok produk dan kuantitas terjual.</p>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="text-xs font-semibold text-slate-600 bg-white border border-slate-200 px-3 py-1.5 rounded-xl shadow-2xs">
                        Total: {{ isset($produks) ? $produks->count() : 0 }} Varian Kue
                    </span>
                    <button type="button" onclick="toggleModal('modal-tambah-produk')"
                        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs font-semibold shadow-xs transition hover:shadow">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Tambah Produk</span>
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-200 text-[11px] font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5">SKU & Varian Kue</th>
                            <th class="px-5 py-3.5">Kategori</th>
                            <th class="px-5 py-3.5 text-right">HPP (Modal)</th>
                            <th class="px-5 py-3.5 text-right">Harga Jual</th>
                            <th class="px-5 py-3.5 text-center">Batas Min.</th>
                            <th class="px-5 py-3.5 text-center">Stok Tersedia</th>
                            <th class="px-5 py-3.5 text-center">Terjual</th>
                            <th class="px-5 py-3.5 text-right">Aksi & Restock</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($produks ?? [] as $p)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/' . $p->gambar) }}" alt="{{ $p->nama_kue }}" class="w-10 h-10 object-cover rounded-lg border border-slate-100 shrink-0" onerror="this.src='{{ asset('images/logo.png') }}'">
                                    <div>
                                        <div class="font-bold text-slate-900 text-xs sm:text-sm">{{ $p->nama_kue }}</div>
                                        <div class="font-mono text-[10px] text-slate-400">{{ $p->sku }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="px-2 py-0.5 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700">
                                    {{ $p->category->nama ?? 'Bakery' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-right font-mono text-slate-500">
                                Rp {{ number_format($p->harga_modal ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3.5 text-right font-mono font-bold text-slate-800">
                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3.5 text-center font-mono text-slate-500">
                                {{ $p->stok_minimum ?? 3 }} unit
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                @if($p->stock <= 0)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold bg-rose-50 text-rose-600 border border-rose-200">
                                        Habis
                                    </span>
                                @elseif($p->isLowStock())
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        {{ $p->stock }} (Kritis)
                                    </span>
                                @else
                                    <span class="text-xs font-semibold text-slate-800">
                                        {{ $p->stock }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-center font-bold text-slate-700">
                                {{ $p->sold_count ?? 0 }}
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="inline-flex items-center gap-1.5 justify-end">
                                    <!-- Edit Button (Mengubah Stok & Data Produk) -->
                                    <button type="button" onclick="openEditProdukModal({{ json_encode($p) }})"
                                        class="inline-flex items-center gap-1 px-2.5 py-1 text-slate-600 hover:text-blue-600 bg-slate-100 hover:bg-blue-50 border border-slate-200 rounded-lg text-xs font-semibold transition" title="Ubah Data & Stok Produk">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Quick Restock Button -->
                                    <form action="/produk/{{ $p->id }}/restock-kuota" method="POST" class="inline-flex items-center gap-1">
                                        @csrf
                                        <input type="number" name="tambah_slot" value="5" min="1" max="100" class="w-12 text-center text-xs border border-slate-200 rounded-lg py-1 px-1 font-semibold focus:outline-none focus:ring-1 focus:ring-pink-500" title="Jumlah restock">
                                        <button type="submit" class="inline-flex items-center gap-0.5 px-2 py-1 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg transition shadow-2xs" title="Tambah Stok Cepat">
                                            <span>+Stok</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-slate-400">Belum ada data produk kue.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Modal Tambah Barang -->
    <div id="modal-tambah" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-200">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <h3 class="text-base font-bold text-slate-900">Tambah Barang Logistik</h3>
                <button type="button" onclick="toggleModal('modal-tambah')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="/logistik/tambah" method="POST" class="space-y-4 text-xs sm:text-sm">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Barang / Bahan</label>
                    <input type="text" name="nama" required placeholder="Contoh: Tepung Terigu Protein Sedang" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kategori</label>
                    <select name="kategori" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 bg-white">
                        <option value="Bahan Utama">Bahan Utama</option>
                        <option value="Bahan Penunjang">Bahan Penunjang</option>
                        <option value="Packaging">Packaging</option>
                        <option value="Peralatan">Peralatan</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah Stok</label>
                        <input type="number" name="stok" min="0" required placeholder="10" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Satuan</label>
                        <input type="text" name="satuan" required placeholder="Kg / Tray / Pcs" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                </div>
                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="toggleModal('modal-tambah')" class="px-4 py-2 border border-slate-200 rounded-xl font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-xl font-semibold transition shadow-xs">Simpan Barang</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Barang -->
    <div id="modal-edit" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-200">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <h3 class="text-base font-bold text-slate-900">Edit Data Barang</h3>
                <button type="button" onclick="toggleModal('modal-edit')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="form-edit" method="POST" class="space-y-4 text-xs sm:text-sm">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Barang / Bahan</label>
                    <input type="text" id="edit-nama" name="nama" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kategori</label>
                    <select id="edit-kategori" name="kategori" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 bg-white">
                        <option value="Bahan Utama">Bahan Utama</option>
                        <option value="Bahan Penunjang">Bahan Penunjang</option>
                        <option value="Packaging">Packaging</option>
                        <option value="Peralatan">Peralatan</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah Stok</label>
                        <input type="number" id="edit-stok" name="stok" min="0" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Satuan</label>
                        <input type="text" id="edit-satuan" name="satuan" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                </div>
                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="toggleModal('modal-edit')" class="px-4 py-2 border border-slate-200 rounded-xl font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-xl font-semibold transition shadow-xs">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Catat Stok Masuk (Restock) -->
    <div id="modal-restock" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-200">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Catat Barang Masuk (Restock)</h3>
                        <p class="text-[11px] text-slate-400">Pencatatan pasokan masuk dari supplier</p>
                    </div>
                </div>
                <button type="button" onclick="toggleModal('modal-restock')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="form-restock" method="POST" class="space-y-4 text-xs sm:text-sm">
                @csrf
                <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                    <p class="text-xs text-slate-500 mb-0.5">Nama Bahan / Barang:</p>
                    <h4 id="restock-nama" class="font-bold text-slate-900 text-sm"></h4>
                    <p class="text-xs text-slate-500 mt-1">Stok Saat Ini: <strong id="restock-stok-saat-ini" class="text-pink-600 font-bold"></strong></p>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Jumlah Masuk Diterima:</label>
                    <div class="flex items-center gap-2">
                        <input type="number" name="jumlah_masuk" min="1" required placeholder="Contoh: 10" class="w-full font-bold border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                        <span id="restock-satuan" class="text-xs font-bold text-slate-600 bg-slate-100 px-3.5 py-2.5 rounded-xl border border-slate-200">Kg</span>
                    </div>
                </div>
                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="toggleModal('modal-restock')" class="px-4 py-2 border border-slate-200 rounded-xl font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold transition shadow-xs">Simpan Stok Masuk</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Produk Kue -->
    <div id="modal-tambah-produk" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Tambah Produk Kue Baru</h3>
                    <p class="text-xs text-slate-400">Tambahkan varian kue baru ke katalog dan atur stok awal.</p>
                </div>
                <button type="button" onclick="toggleModal('modal-tambah-produk')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="/produk/tambah" method="POST" enctype="multipart/form-data" class="space-y-3.5 text-xs sm:text-sm">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Kue *</label>
                    <input type="text" name="nama_kue" required placeholder="Contoh: Strawberry Cheese Tart" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">SKU (Kode Produk)</label>
                        <input type="text" name="sku" placeholder="Contoh: BR-STRW-09" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kategori</label>
                        <select name="category_id" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 bg-white">
                            @foreach($categories ?? [] as $c)
                                <option value="{{ $c->id }}">{{ $c->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Harga Jual (Rp) *</label>
                        <input type="number" name="harga" required placeholder="45000" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 font-semibold focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">HPP / Modal (Rp)</label>
                        <input type="number" name="harga_modal" placeholder="25000" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 p-3 bg-pink-50/50 rounded-xl border border-pink-100">
                    <div>
                        <label class="block font-bold text-pink-700 mb-1">Stok Awal (Stock) *</label>
                        <input type="number" name="stock" value="10" min="0" required class="w-full border border-pink-200 rounded-xl px-3.5 py-2 font-bold text-slate-800 bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/30 focus:border-pink-500">
                        <span class="text-[10px] text-pink-500">Sinkron dengan tombol katalog</span>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Batas Min. Stok Alert</label>
                        <input type="number" name="stok_minimum" value="3" min="0" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                        <span class="text-[10px] text-slate-400">Peringatan stok kritis</span>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">File Gambar Kue</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="2" placeholder="Deskripsi rasa, bahan premium, atau informasi ukuran..." class="w-full border border-slate-200 rounded-xl px-3.5 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 text-xs"></textarea>
                </div>
                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="toggleModal('modal-tambah-produk')" class="px-4 py-2 border border-slate-200 rounded-xl font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-xl font-semibold transition shadow-xs">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Produk Kue (Restock & Update Stok) -->
    <div id="modal-edit-produk" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Edit Data Produk & Kelola Stok</h3>
                    <p class="text-xs text-slate-400">Ubah kuantitas stok untuk restock atau sesuaikan harga produk.</p>
                </div>
                <button type="button" onclick="toggleModal('modal-edit-produk')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="form-edit-produk" method="POST" enctype="multipart/form-data" class="space-y-3.5 text-xs sm:text-sm">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Kue *</label>
                    <input type="text" id="edit-prod-nama" name="nama_kue" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">SKU (Kode)</label>
                        <input type="text" id="edit-prod-sku" name="sku" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 font-mono text-xs focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kategori</label>
                        <select id="edit-prod-category" name="category_id" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 bg-white">
                            @foreach($categories ?? [] as $c)
                                <option value="{{ $c->id }}">{{ $c->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Harga Jual (Rp) *</label>
                        <input type="number" id="edit-prod-harga" name="harga" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2 font-semibold focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">HPP / Modal (Rp)</label>
                        <input type="number" id="edit-prod-modal" name="harga_modal" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    </div>
                </div>
                <!-- Highlight Stok Input for Restock -->
                <div class="p-3.5 bg-pink-50/70 rounded-xl border border-pink-200 grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-extrabold text-pink-700 mb-1">Stok Tersedia (Stock) *</label>
                        <input type="number" id="edit-prod-stock" name="stock" min="0" required class="w-full border-2 border-pink-300 rounded-xl px-3.5 py-2 font-bold text-slate-900 bg-white text-base focus:outline-none focus:ring-2 focus:ring-pink-500/40 focus:border-pink-600">
                        <span class="text-[10px] text-pink-600 font-medium">Ubah angka ini untuk restock produk</span>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Batas Min. Alert</label>
                        <input type="number" id="edit-prod-min" name="stok_minimum" min="0" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                        <span class="text-[10px] text-slate-400">Ambang peringatan kritis</span>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Ganti File Gambar (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Deskripsi Kue</label>
                    <textarea id="edit-prod-deskripsi" name="deskripsi" rows="2" class="w-full border border-slate-200 rounded-xl px-3.5 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 text-xs"></textarea>
                </div>
                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="toggleModal('modal-edit-produk')" class="px-4 py-2 border border-slate-200 rounded-xl font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-xl font-semibold transition shadow-xs">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function openEditProdukModal(prod) {
            document.getElementById('form-edit-produk').action = '/produk/' + prod.id + '/update';
            document.getElementById('edit-prod-nama').value = prod.nama_kue || '';
            document.getElementById('edit-prod-sku').value = prod.sku || '';
            if (prod.category_id) {
                document.getElementById('edit-prod-category').value = prod.category_id;
            }
            document.getElementById('edit-prod-harga').value = prod.harga || 0;
            document.getElementById('edit-prod-modal').value = prod.harga_modal || 0;
            document.getElementById('edit-prod-stock').value = prod.stock !== undefined ? prod.stock : (prod.stok || 0);
            document.getElementById('edit-prod-min').value = prod.stok_minimum || 3;
            document.getElementById('edit-prod-deskripsi').value = prod.deskripsi || '';
            toggleModal('modal-edit-produk');
        }

        function openRestockModal(item) {
            document.getElementById('form-restock').action = '/logistik/' + item.id + '/restock';
            document.getElementById('restock-nama').innerText = item.nama;
            document.getElementById('restock-stok-saat-ini').innerText = item.stok + ' ' + item.satuan;
            document.getElementById('restock-satuan').innerText = item.satuan;
            toggleModal('modal-restock');
        }

        function openEditModal(item) {
            document.getElementById('form-edit').action = '/logistik/' + item.id + '/update';
            document.getElementById('edit-nama').value = item.nama;
            document.getElementById('edit-kategori').value = item.kategori;
            document.getElementById('edit-stok').value = item.stok;
            document.getElementById('edit-satuan').value = item.satuan;
            toggleModal('modal-edit');
        }

        function cariLogistik() {
            const keyword = document.getElementById('search-logistik').value.toLowerCase();
            const rows    = document.querySelectorAll('#tabel-logistik .log-row');
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

            document.getElementById('result-count-log').innerText =
                keyword ? `${visible} item ditemukan` : '';
            document.getElementById('log-count').innerText =
                keyword ? visible : {{ $logistiks->count() }};
        }

        document.getElementById('search-logistik').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') cariLogistik();
        });
    </script>
</body>
</html>
