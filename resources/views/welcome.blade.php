<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #FFF8F9;
        }
        #hero-slider {
            transition: background-image 0.8s ease-in-out;
        }
    </style>
</head>
<body class="font-[Poppins] min-h-screen flex flex-col justify-between">

    <nav class="bg-white shadow-sm border-b border-pink-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3.5 flex justify-between items-center">
            
            <!-- Logo & Brand -->
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-9 w-9 sm:h-10 sm:w-10 object-contain rounded-full bg-pink-100" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
                <a href="/" class="text-xl sm:text-2xl font-bold text-pink-600 tracking-wider">BY.REESHA</a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-6 text-sm font-semibold text-gray-600">
                <a href="/" class="text-pink-600 border-b-2 border-pink-600 pb-1">HOME</a>
                <a href="/produk" class="hover:text-pink-600 transition">SEMUA PRODUK</a>
                <a href="/keranjang" class="hover:text-pink-600 transition">KERANJANG</a>
                <a href="/kontak" class="hover:text-pink-600 transition">KONTAK KAMI</a>
                <a href="/tentang-kami" class="hover:text-pink-600 transition">TENTANG KAMI</a>
            </div>

            <!-- Desktop Auth -->
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

            <!-- Mobile Hamburger Button & Cart Quick Link -->
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
            <a href="/" class="block px-3 py-2 rounded-lg font-semibold text-sm text-pink-600 bg-pink-50">HOME</a>
            <a href="/produk" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">SEMUA PRODUK</a>
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

    <main id="hero-slider" class="w-full min-h-[70vh] md:min-h-[85vh] bg-cover bg-center flex items-center justify-center relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 py-12 md:py-20 text-center space-y-4 md:space-y-6 w-full">
            <div class="inline-block bg-pink-600 px-3.5 py-1 md:px-4 md:py-1.5 rounded-full shadow-md">
                <span class="text-[11px] sm:text-xs font-bold uppercase tracking-widest text-white">Welcome To By.Reesha</span>
            </div>
            <h2 class="text-2xl sm:text-4xl md:text-6xl font-extrabold text-white leading-tight tracking-tight drop-shadow-[0_5px_8px_rgba(0,0,0,0.9)]">
                Wujudkan Cake Impianmu<br> 
                <span class="text-pink-300 drop-shadow-[0_5px_8px_rgba(0,0,0,0.9)]">Bersama By.reesha</span>
            </h2>
            <p class="max-w-2xl mx-auto text-white font-medium leading-relaxed text-xs sm:text-base md:text-lg drop-shadow-[0_3px_6px_rgba(0,0,0,0.9)]">
                Kami menyajikan koleksi kue terbaik premium yang dihadirkan secara artistik untuk menyenangkan pelanggan dan berbagai jenis rasa dan tekstur dengan harga yang terjangkau.
            </p>
        </div>

    </main>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20 w-full">
        <div class="text-center mb-8 md:mb-12">
            <span class="text-pink-600 font-bold text-xs sm:text-sm uppercase tracking-wider">Koleksi Terpopuler</span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-2">Produk Best Seller</h3>
            <div class="w-20 sm:w-24 h-1 bg-pink-600 mx-auto mt-3 rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
            @foreach($produkBestSeller as $produk)
            <div class="bg-white rounded-2xl shadow-lg border border-pink-100 overflow-hidden flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                <div class="relative overflow-hidden h-48 sm:h-56 md:h-64">
                    <img src="{{ asset('images/' . $produk->gambar) }}"
                         alt="{{ $produk->nama_kue }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-pink-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Best Seller</span>
                    </div>
                </div>
                <div class="p-4 sm:p-6 space-y-3 flex-grow flex flex-col justify-between">
                    <div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-800">{{ $produk->nama_kue }}</h4>
                        <p class="text-gray-500 text-xs sm:text-sm mt-1 line-clamp-2">{{ $produk->deskripsi }}</p>
                    </div>
                    <div class="pt-3 sm:pt-4 flex items-center justify-between">
                        <span class="text-pink-600 font-extrabold text-base sm:text-lg">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <a href="/produk/{{ $produk->id }}" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold px-3.5 py-2 sm:px-4 sm:py-2 rounded-xl transition shadow-md shadow-pink-100">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8 md:mt-10">
            <a href="/produk" class="inline-block border-2 border-pink-600 text-pink-600 hover:bg-pink-600 hover:text-white font-bold px-6 py-2.5 sm:px-8 sm:py-3 rounded-2xl transition text-xs sm:text-sm">
                Lihat Semua Produk →
            </a>
        </div>
    </section>

    <footer class="bg-white border-t border-pink-100 text-center py-6 text-xs text-gray-400">&copy; 2026 By.Reesha. All rights reserved.</footer>

    <script>
        const daftarSampul = [
            "{{ asset('images/sampul1.jpg') }}",
            "{{ asset('images/sampul2.jpg') }}"
        ];

        let indexSekarang = 0;
        const heroElement = document.getElementById('hero-slider');

        function putarSampul() {
            heroElement.style.backgroundImage = `url('${daftarSampul[indexSekarang]}')`;
            indexSekarang = (indexSekarang + 1) % daftarSampul.length;
        }

        putarSampul();
        setInterval(putarSampul, 4000);

        // Mobile menu toggle
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