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
<body class="min-h-screen flex flex-col justify-between">

    <!-- NAVIGATION BAR -->
    <nav class="bg-white shadow-sm border-b border-pink-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-10 w-10 object-contain rounded-full bg-pink-100">
                <a href="/" class="text-2xl font-bold text-pink-600 tracking-wider">BY.REESHA</a>
            </div>

            <div class="flex flex-wrap justify-center gap-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-pink-600 transition">HOME</a>
                <a href="/produk" class="text-pink-600 border-b-2 border-pink-600 pb-1">SEMUA PRODUK</a>
                <a href="/keranjang" class="hover:text-pink-600 transition">KERANJANG</a>
                <a href="/kontak" class="hover:text-pink-600 transition">KONTAK KAMI</a>
                <a href="/tentang-kami" class="hover:text-pink-600 transition">TENTANG KAMI</a>
            </div>

            <div class="flex items-center gap-4">
               @auth
                    <a href="/profil" class="text-sm font-semibold text-gray-700 bg-pink-50 px-3 py-1.5 rounded-xl border border-pink-100 hover:bg-pink-100 transition block">
                         Halo, <strong class="text-pink-600">{{ Auth::user()->name }}</strong>
                    </a>
                    
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-gray-400 hover:text-red-500 transition">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="/login" class="text-sm font-bold text-pink-600 hover:text-pink-700 px-4 py-2 border border-pink-200 rounded-xl hover:bg-pink-50 transition">
                        Masuk
                    </a>
                    <a href="/register" class="text-sm font-bold bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-xl shadow-md shadow-pink-100 transition">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto px-6 py-12 w-full flex-grow">
        <div class="text-center mb-10">
            <span class="text-pink-600 font-bold text-xs uppercase tracking-widest bg-pink-100 px-3 py-1 rounded-full">Katalog Lengkap</span>
            <h1 class="text-3xl font-extrabold text-gray-800 mt-3">Koleksi Kue By.Reesha</h1>
            <p class="text-gray-500 text-sm mt-2">Pilih kue impianmu untuk merayakan momen berharga</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($semua_cake as $cake)
            <div class="bg-white rounded-3xl shadow-sm border border-pink-100 overflow-hidden flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition duration-300">
                <div class="relative overflow-hidden h-56">
                    <img src="{{ asset('images/' . $cake->gambar) }}" alt="{{ $cake->nama_kue }}" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col justify-between flex-grow space-y-4">
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">{{ $cake->nama_kue }}</h3>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $cake->deskripsi }}</p>
                    </div>
                    <div class="pt-2 flex items-center justify-between">
                        <span class="text-pink-600 font-extrabold text-base">Rp {{ number_format($cake->harga, 0, ',', '.') }}</span>
                        <a href="/produk/{{ $cake->id }}" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-md shadow-pink-100">
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

</body>
</html>