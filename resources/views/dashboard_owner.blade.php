<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; }
    </style>
</head>
<body class="flex min-h-screen text-gray-800">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-screen sticky top-0 p-5 hidden md:flex">
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
                <a href="/dashboard-owner" class="block w-full text-left px-4 py-2.5 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
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

    <main class="flex-1 p-8">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Halo, <span class="font-medium text-gray-800">{{ Auth::user()->name }}</span></span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500 mb-1">Pendapatan</p>
                <h3 class="text-xl font-semibold">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500 mb-1">Pesanan Aktif</p>
                <h3 class="text-xl font-semibold">{{ $pesanan_aktif }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500 mb-1">Pelanggan</p>
                <h3 class="text-xl font-semibold">{{ $total_pelanggan }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500 mb-1">Produk Terjual</p>
                <h3 class="text-xl font-semibold">{{ $produk_terjual }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="p-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-800">Pesanan Masuk Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                            <th class="px-6 py-3 font-medium">ID Pesanan</th>
                            <th class="px-6 py-3 font-medium">Pelanggan</th>
                            <th class="px-6 py-3 font-medium">Total Bayar</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($transaksis as $trx)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">#TRX-{{ str_pad($trx->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $trx->user ? $trx->user->name : 'Pelanggan' }}</td>
                            <td class="px-6 py-4 font-semibold text-pink-600">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-md">{{ $trx->status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan masuk dari pembeli.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100 text-center">
                <a href="/pemesanan" class="text-sm text-blue-600 hover:underline">Lihat Semua Pesanan</a>
            </div>
        </div>
    </main>

</body>
</html>