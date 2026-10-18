<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FFF8F9] font-[Poppins] min-h-screen">

    <!-- Header -->
    <header class="bg-white border-b border-pink-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 h-16 flex items-center gap-4">
            <a href="/profil" class="text-pink-600 hover:bg-pink-50 p-2 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl font-bold text-gray-800">Riwayat Transaksi</h1>
        </div>
    </header>

    <!-- Content -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        
        <div class="flex flex-col gap-4">
            @forelse($transaksis as $trx)
            <div class="bg-white rounded-xl shadow-sm border border-pink-50 overflow-hidden">
                <div class="border-b border-gray-100 p-3.5 sm:p-4 flex justify-between items-center bg-gray-50/50">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-pink-500 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-xs sm:text-sm font-semibold text-gray-700">Belanja</span>
                        <span class="text-gray-400 text-[11px] sm:text-xs ml-1 sm:ml-2">{{ $trx->created_at->format('d M Y') }}</span>
                    </div>
                    <span class="bg-yellow-100 text-yellow-700 text-[11px] sm:text-xs font-bold px-2 sm:px-2.5 py-0.5 sm:py-1 rounded">{{ $trx->status }}</span>
                </div>
                <div class="p-3.5 sm:p-4 flex flex-col sm:flex-row gap-3 sm:gap-4 items-start sm:items-center">
                    <div class="flex gap-3 sm:gap-4 items-start flex-1 min-w-0 w-full">
                        <img src="{{ asset('images/' . $trx->gambar_produk) }}" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg border border-gray-100 shrink-0" alt="{{ $trx->nama_produk }}" onerror="this.src='{{ asset('images/logo.png') }}'">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-800 text-sm md:text-base mb-0.5 truncate">{{ $trx->nama_produk }}</h3>
                            <p class="text-xs text-gray-500 mb-0.5">Varian: {{ $trx->varian }} | Ukuran: {{ $trx->ukuran }}</p>
                            <p class="text-xs text-gray-500 mb-2">{{ $trx->qty }} barang x Rp {{ number_format($trx->harga_satuan, 0, ',', '.') }}</p>
                            
                            <!-- Info Tambahan -->
                            <div class="bg-pink-50/50 p-2 rounded-lg text-[11px] sm:text-xs text-gray-600 space-y-0.5">
                                <p><span class="font-medium text-gray-700">Pengiriman:</span> {{ $trx->metode_pengiriman }}</p>
                                <p><span class="font-medium text-gray-700">Pembayaran:</span> {{ $trx->metode_pembayaran }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-auto sm:border-l sm:border-gray-100 sm:pl-4 flex sm:flex-col justify-between items-center sm:items-end pt-2 sm:pt-0 border-t sm:border-t-0 border-gray-100">
                        <p class="text-xs text-gray-500 mb-0 sm:mb-1">Total Belanja</p>
                        <p class="font-bold text-base sm:text-lg text-pink-600">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="border-t border-gray-100 p-3 sm:p-4 text-right bg-white">
                    <a href="/produk" class="inline-block bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold py-1.5 sm:py-2 px-4 sm:px-6 rounded-lg transition shadow-sm">
                        Beli Lagi
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl p-8 text-center border border-pink-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-pink-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <p class="text-gray-600 font-medium">Belum ada riwayat transaksi</p>
                <p class="text-gray-400 text-xs mt-1 mb-4">Yuk mulai pesan kue favoritmu sekarang!</p>
                <a href="/produk" class="inline-block bg-pink-600 hover:bg-pink-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Lihat Katalog Produk
                </a>
            </div>
            @endforelse
        </div>

    </main>

</body>
</html>
