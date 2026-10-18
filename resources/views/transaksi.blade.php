<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-gray-800 bg-[#f9fafb]">

    <!-- Mobile Topbar for Transaksi -->
    <header class="md:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between sticky top-0 z-30 shadow-sm">
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
    <div id="mobile-dash-menu" class="hidden md:hidden bg-white border-b border-gray-200 px-4 py-3 shadow-md space-y-1">
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

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-screen sticky top-0 p-5 hidden md:flex shrink-0">
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
    <main class="flex-1 p-4 sm:p-6 md:p-8 min-w-0">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl sm:text-2xl font-semibold">Transaksi</h1>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="p-3.5 sm:p-4 border-b border-gray-200 flex flex-wrap sm:flex-nowrap items-center gap-2">
                <div class="relative flex-1 min-w-[200px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-transaksi" placeholder="Cari ID, keterangan, tanggal..." oninput="cariTransaksi()"
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
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                            <th class="px-6 py-3 font-medium">ID Transaksi</th>
                            <th class="px-6 py-3 font-medium">Tanggal</th>
                            <th class="px-6 py-3 font-medium">Keterangan</th>
                            <th class="px-6 py-3 font-medium">Metode</th>
                            <th class="px-6 py-3 font-medium">Jumlah</th>
                            <th class="px-6 py-3 font-medium">Jenis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="tabel-transaksi">
                        @forelse($transaksis as $trx)
                        <tr class="hover:bg-gray-50 trx-row">
                            <td class="px-6 py-4 font-medium">#TRX-{{ str_pad($trx->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $trx->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">Pembayaran Pesanan {{ $trx->nama_produk }} oleh {{ $trx->user ? $trx->user->name : 'Pelanggan' }}</td>
                            <td class="px-6 py-4">
                                @if(in_array($trx->metode_pembayaran, ['Cash', 'COD', 'Cash/COD']))
                                    <span class="text-blue-600 font-semibold">{{ $trx->metode_pembayaran }}</span>
                                @else
                                    <span class="text-purple-600 font-semibold">{{ $trx->metode_pembayaran ?? 'QRIS' }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-pink-600 font-semibold">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-md">Pemasukan</span></td>
                        </tr>
                        @empty
                        <tr id="row-empty-trx">
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada transaksi recorded.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
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

            document.getElementById('result-count-trx').innerText =
                keyword ? `${visible} hasil ditemukan` : '';

            const noResult = document.getElementById('no-result-trx');
            if (noResult) noResult.classList.toggle('hidden', visible > 0 || !keyword);
        }

        document.getElementById('search-transaksi').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') cariTransaksi();
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
