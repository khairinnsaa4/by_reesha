<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Pesanan Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #fce7f3; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">

    <div class="bg-white max-w-md w-full rounded-2xl shadow-xl overflow-hidden text-center relative">
        <div class="bg-pink-600 h-2 w-full absolute top-0 left-0"></div>
        
        <div class="p-5 sm:p-8 pb-8 sm:pb-10">
            <!-- Checkmark Icon -->
            <div class="mx-auto w-16 h-16 sm:w-20 sm:h-20 bg-green-100 rounded-full flex items-center justify-center mb-5 sm:mb-6 shadow-sm border-4 border-white ring-2 ring-green-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Pesanan Berhasil Dibuat!</h1>
            <p class="text-gray-500 text-xs sm:text-sm mb-6 sm:mb-8">Terima kasih telah berbelanja di By.Reesha. Mohon segera lakukan pembayaran agar pesanan Anda bisa diproses.</p>
            
            <!-- Order Info -->
            <div class="bg-gray-50 rounded-xl p-5 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-3 text-sm">
                    <span class="text-gray-500">Nomor Pesanan</span>
                    <span class="font-bold text-gray-800">#TRX-{{ $trx ? str_pad($trx->id, 3, '0', STR_PAD_LEFT) : '001' }}</span>
                </div>
                <div class="flex justify-between items-center mb-3 text-sm">
                    <span class="text-gray-500">Metode Pembayaran</span>
                    <span class="font-bold text-gray-800">{{ $trx ? $trx->metode_pembayaran : 'COD (Bayar di Tempat)' }}</span>
                </div>
                <div class="flex justify-between items-center border-t border-gray-200 pt-3 text-sm">
                    <span class="text-gray-500">Total Pembayaran</span>
                    <span class="font-bold text-lg text-pink-600">Rp {{ $trx ? number_format($trx->total_harga, 0, ',', '.') : '0' }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="/riwayat-transaksi" class="block w-full py-3 px-4 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-xl shadow-md transition">
                    Lihat Status Pesanan
                </a>
                <a href="/" class="block w-full py-3 px-4 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

</body>
</html>
