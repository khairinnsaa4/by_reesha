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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3.5 flex justify-between items-center">
            
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-9 w-9 sm:h-10 sm:w-10 object-contain rounded-full bg-pink-100" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
                <a href="/" class="text-xl sm:text-2xl font-bold text-pink-600 tracking-wider">BY.REESHA</a>
            </div>

            <div class="hidden md:flex items-center gap-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-pink-600 transition">HOME</a>
                <a href="/produk" class="text-pink-600 border-b-2 border-pink-600 pb-1">SEMUA PRODUK</a>
                <a href="/keranjang" class="hover:text-pink-600 transition">KERANJANG</a>
                <a href="/kontak" class="hover:text-pink-600 transition">KONTAK KAMI</a>
                <a href="/tentang-kami" class="hover:text-pink-600 transition">TENTANG KAMI</a>
            </div>

            <div class="hidden md:flex items-center gap-4">
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

            <!-- Mobile Actions -->
            <div class="flex items-center gap-2 md:hidden">
                <a href="/keranjang" class="p-2 text-gray-600 hover:text-pink-600 transition rounded-lg hover:bg-pink-50" aria-label="Keranjang">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </a>
                <button type="button" id="mobile-menu-btn" class="p-2 text-gray-700 hover:text-pink-600 rounded-lg hover:bg-pink-50 transition focus:outline-none" aria-label="Buka Menu">
                    <svg id="hamburger-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-pink-100 bg-white px-4 pt-3 pb-5 space-y-2.5 shadow-lg">
            <a href="/" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">HOME</a>
            <a href="/produk" class="block px-3 py-2 rounded-lg font-semibold text-sm text-pink-600 bg-pink-50">SEMUA PRODUK</a>
            <a href="/keranjang" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">KERANJANG</a>
            <a href="/kontak" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">KONTAK KAMI</a>
            <a href="/tentang-kami" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">TENTANG KAMI</a>

            <div class="border-t border-gray-100 pt-3 mt-3">
                @auth
                    <div class="flex items-center justify-between mb-2">
                        <a href="/profil" class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                            <span>👤</span>
                            <span>Halo, <strong class="text-pink-600">{{ Auth::user()->name }}</strong></span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <a href="/profil" class="text-center text-xs font-bold text-gray-700 bg-pink-50 py-2.5 rounded-xl border border-pink-100 hover:bg-pink-100 transition">
                            Akun Saya
                        </a>
                        <form action="/logout" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-center text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 py-2.5 rounded-xl transition">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <a href="/login" class="text-center text-sm font-bold text-pink-600 py-2.5 border border-pink-200 rounded-xl hover:bg-pink-50 transition">
                            Masuk
                        </a>
                        <a href="/register" class="text-center text-sm font-bold bg-pink-600 text-white py-2.5 rounded-xl shadow-md shadow-pink-100 hover:bg-pink-700 transition">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

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
                    <img src="{{ asset('images/' . $cake->gambar) }}" alt="{{ $cake->nama_kue }}" class="w-full h-full object-cover">
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

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>