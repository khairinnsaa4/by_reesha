<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Katalog Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #FFF8F9; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between pb-16 md:pb-0">

    <!-- NAVIGATION BAR -->
    @include('partials.navbar', ['active' => 'produk'])

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-8 md:py-12 w-full flex-grow">
        <div class="text-center mb-8 md:mb-10">
            <span class="text-pink-600 font-bold text-xs uppercase tracking-widest bg-pink-100 px-3 py-1 rounded-full">Katalog Lengkap</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-3">Koleksi Kue By.Reesha</h1>
            <p class="text-gray-500 text-xs sm:text-sm mt-2">Pilih kue impianmu untuk merayakan momen berharga</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 sm:gap-6 md:gap-8">
            @foreach($semua_cake as $cake)
            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-100 overflow-hidden flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition duration-300">
                <div class="relative overflow-hidden h-48 sm:h-56">
                    <img src="{{ asset('images/' . $cake->gambar) }}" alt="{{ $cake->nama_kue }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/logo.png') }}'">
                </div>
                <div class="p-4 sm:p-6 flex flex-col justify-between flex-grow space-y-3 sm:space-y-4">
                    <div>
                        <h3 class="font-bold text-gray-800 text-base sm:text-lg">{{ $cake->nama_kue }}</h3>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $cake->deskripsi }}</p>
                    </div>
                    <div class="pt-2 flex items-center justify-between">
                        <span class="text-pink-600 font-extrabold text-sm sm:text-base">Rp {{ number_format($cake->harga, 0, ',', '.') }}</span>
                        <a href="/produk/{{ $cake->id }}" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold px-3.5 py-2 sm:px-4 sm:py-2 rounded-xl transition shadow-md shadow-pink-100">
                            Detail / Pesan
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <footer class="bg-white border-t border-pink-100 text-center py-6 text-xs text-gray-400 mt-12">
        &copy; 2026 By.Reesha. All rights reserved.
    </footer>

    @include('partials.bottom_nav', ['active' => 'produk'])
</body>
</html>