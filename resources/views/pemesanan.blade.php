<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Pemesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-gray-800 bg-[#f9fafb]">

    <!-- Mobile Topbar for Pemesanan -->
    <header class="md:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between sticky top-0 z-30 shadow-sm">
        <a href="/profil" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-xs leading-tight">{{ Auth::user()->name }}</h4>
                <p class="text-[10px] text-gray-400 capitalize">{{ Auth::user()->divisi ? Auth::user()->divisi : Auth::user()->role }}</p>
            </div>
        </a>
        <button id="mobile-dash-btn" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none" aria-label="Buka Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </header>

    <!-- Mobile Dropdown Navigation -->
    <div id="mobile-dash-menu" class="hidden md:hidden bg-white border-b border-gray-200 px-4 py-3 shadow-md space-y-1">
        <nav class="space-y-1">
            @if(Auth::check() && Auth::user()->role === 'owner')
            <a href="/dashboard-owner" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Dashboard
            </a>
            <a href="/karyawan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Karyawan
            </a>
            <a href="/pelanggan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Pelanggan
            </a>
            @endif
            <a href="/pemesanan" class="block w-full text-left px-3 py-2 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
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

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-screen sticky top-0 p-5 hidden md:flex shrink-0">
        <div>
            <a href="/profil" class="flex items-center gap-3 mb-8 p-2 -ml-2 rounded-xl hover:bg-gray-50 transition cursor-pointer group">
                <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h4 class="font-medium text-gray-800 text-sm group-hover:text-pink-600 transition">{{ Auth::user()->name }}</h4>
                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->divisi ? Auth::user()->divisi : Auth::user()->role }}</p>
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
                <a href="/pemesanan" class="block w-full text-left px-4 py-2.5 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
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
    <main class="flex-1 p-4 sm:p-6 md:p-8 min-w-0">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-semibold">Pemesanan</h1>
        </div>

        @if(session('sukses'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
            ✓ {{ session('sukses') }}
        </div>
        @endif

        @php
            $countSemua     = $transaksis->count();
            $countDiproses  = $transaksis->filter(fn($t) => in_array($t->status, ['Diproses', 'Sedang Diproses']))->count();
            $countDikemas   = $transaksis->filter(fn($t) => in_array($t->status, ['Dikemas', 'Menunggu Dikirim']))->count();
            $countDikirim   = $transaksis->filter(fn($t) => in_array($t->status, ['Dikirim', 'Dalam Pengiriman']))->count();
            $countSelesai   = $transaksis->filter(fn($t) => in_array($t->status, ['Selesai', 'Diterima']))->count();
            $countBatal     = $transaksis->filter(fn($t) => in_array($t->status, ['Dibatalkan', 'Batal']))->count();
        @endphp

        {{-- Filter Status Pills --}}
        <div class="flex flex-wrap items-center gap-2 mb-4">
            <button type="button" onclick="filterStatusPemesanan('semua')" id="btn-filter-semua"
                class="status-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-pink-600 text-white shadow-sm border border-pink-600 transition">
                Semua ({{ $countSemua }})
            </button>
            <button type="button" onclick="filterStatusPemesanan('diproses')" id="btn-filter-diproses"
                class="status-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                🍳 Diproses ({{ $countDiproses }})
            </button>
            <button type="button" onclick="filterStatusPemesanan('dikemas')" id="btn-filter-dikemas"
                class="status-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                📦 Dikemas ({{ $countDikemas }})
            </button>
            <button type="button" onclick="filterStatusPemesanan('dikirim')" id="btn-filter-dikirim"
                class="status-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                🚚 Dikirim ({{ $countDikirim }})
            </button>
            <button type="button" onclick="filterStatusPemesanan('selesai')" id="btn-filter-selesai"
                class="status-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                ✓ Selesai ({{ $countSelesai }})
            </button>
            <button type="button" onclick="filterStatusPemesanan('dibatalkan')" id="btn-filter-dibatalkan"
                class="status-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition">
                ❌ Dibatalkan ({{ $countBatal }})
            </button>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="p-3.5 sm:p-4 border-b border-gray-200 flex flex-wrap sm:flex-nowrap items-center gap-2">
                <div class="relative flex-1 min-w-[200px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-pemesanan" placeholder="Cari ID, pelanggan, produk, atau status..." oninput="cariPemesanan()"
                        class="text-xs sm:text-sm border border-gray-300 rounded-lg pl-9 pr-3 py-2 focus:outline-none focus:border-pink-500 w-full transition">
                </div>
                <button onclick="cariPemesanan()" class="bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-medium px-4 py-2 rounded-lg transition flex items-center gap-1.5 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
                <span id="result-count-pms" class="text-xs text-gray-400 w-full sm:w-auto"></span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                            <th class="px-6 py-3 font-medium">ID Pesanan</th>
                            <th class="px-6 py-3 font-medium">Pelanggan</th>
                            <th class="px-6 py-3 font-medium">Produk</th>
                            <th class="px-6 py-3 font-medium">Tanggal</th>
                            <th class="px-6 py-3 font-medium">Total</th>
                            <th class="px-6 py-3 font-medium text-center">Status Pesanan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="tabel-pemesanan">
                        @forelse($transaksis as $trx)
                        <tr class="hover:bg-gray-50 pms-row" data-status="{{ strtolower($trx->status) }}">
                            <td class="px-6 py-4 font-semibold text-gray-800">#TRX-{{ str_pad($trx->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $trx->user ? $trx->user->name : 'Pelanggan' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $trx->nama_produk }} ({{ $trx->qty }} pcs)</td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $trx->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 font-semibold text-pink-600">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center gap-1.5">
                                    <form action="/pemesanan/{{ $trx->id }}/update-status" method="POST" class="inline-block">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" 
                                            class="text-xs font-bold px-3 py-1.5 rounded-full border outline-none cursor-pointer shadow-sm transition
                                            {{ in_array($trx->status, ['Diproses', 'Sedang Diproses']) ? 'bg-amber-100 text-amber-800 border-amber-300' : '' }}
                                            {{ in_array($trx->status, ['Dikemas']) ? 'bg-purple-100 text-purple-800 border-purple-300' : '' }}
                                            {{ in_array($trx->status, ['Dikirim', 'Dalam Pengiriman']) ? 'bg-blue-100 text-blue-800 border-blue-300' : '' }}
                                            {{ in_array($trx->status, ['Selesai', 'Diterima']) ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : '' }}
                                            {{ in_array($trx->status, ['Dibatalkan', 'Batal']) ? 'bg-rose-100 text-rose-800 border-rose-300' : '' }}">
                                            <option value="Diproses" {{ in_array($trx->status, ['Diproses', 'Sedang Diproses']) ? 'selected' : '' }}>🍳 Diproses</option>
                                            <option value="Dikemas" {{ $trx->status === 'Dikemas' ? 'selected' : '' }}>📦 Dikemas</option>
                                            <option value="Dikirim" {{ in_array($trx->status, ['Dikirim', 'Dalam Pengiriman']) ? 'selected' : '' }}>🚚 Dikirim</option>
                                            <option value="Selesai" {{ in_array($trx->status, ['Selesai', 'Diterima']) ? 'selected' : '' }}>✓ Selesai</option>
                                            <option value="Dibatalkan" {{ in_array($trx->status, ['Dibatalkan', 'Batal']) ? 'selected' : '' }}>❌ Dibatalkan</option>
                                        </select>
                                    </form>

                                    {{-- Quick Action Button --}}
                                    @if(in_array($trx->status, ['Diproses', 'Sedang Diproses']))
                                        <form action="/pemesanan/{{ $trx->id }}/update-status" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Dikemas">
                                            <button type="submit" class="text-[10px] font-bold bg-purple-50 hover:bg-purple-100 text-purple-700 px-2 py-0.5 rounded border border-purple-200 transition" title="Lanjut ke tahap Packing">
                                                Siap Dikemas →
                                            </button>
                                        </form>
                                    @elseif($trx->status === 'Dikemas')
                                        <form action="/pemesanan/{{ $trx->id }}/update-status" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Dikirim">
                                            <button type="submit" class="text-[10px] font-bold bg-blue-50 hover:bg-blue-100 text-blue-700 px-2 py-0.5 rounded border border-blue-200 transition" title="Kirim ke Kurir">
                                                Kirim Kurir →
                                            </button>
                                        </form>
                                    @elseif(in_array($trx->status, ['Dikirim', 'Dalam Pengiriman']))
                                        <form action="/pemesanan/{{ $trx->id }}/update-status" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Selesai">
                                            <button type="submit" class="text-[10px] font-bold bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded border border-emerald-200 transition" title="Tandai Selesai">
                                                Selesaikan ✓
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-pms">
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan masuk dari pembeli.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        let activeStatusFilter = 'semua';

        function filterStatusPemesanan(status) {
            activeStatusFilter = status;

            document.querySelectorAll('.status-filter-btn').forEach(btn => {
                btn.classList.remove('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-sm');
                btn.classList.add('bg-white', 'text-gray-600', 'border-gray-200');
            });

            const activeBtn = document.getElementById('btn-filter-' + status);
            if (activeBtn) {
                activeBtn.classList.remove('bg-white', 'text-gray-600', 'border-gray-200');
                activeBtn.classList.add('bg-pink-600', 'text-white', 'border-pink-600', 'shadow-sm');
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
