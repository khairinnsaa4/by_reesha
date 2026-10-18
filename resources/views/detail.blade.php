<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Detail {{ $cake->nama_kue }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f5f5f5; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

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
                        <button type="submit" class="text-sm font-bold text-gray-400 hover:text-red-500 transition">Keluar</button>
                    </form>
                @else
                    <a href="/login" class="text-sm font-bold text-pink-600 hover:text-pink-700 px-4 py-2 border border-pink-200 rounded-xl hover:bg-pink-50 transition">Masuk</a>
                    <a href="/register" class="text-sm font-bold bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-xl shadow-md shadow-pink-100 transition">Daftar</a>
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

    <div class="max-w-6xl mx-auto px-4 py-6 w-full flex-grow">
  
        <div class="text-sm text-gray-500 mb-4 flex items-center gap-2">
            <a href="/" class="text-blue-600 hover:text-pink-600 transition">By.Reesha</a> <span class="text-gray-400">></span>
            <a href="/produk" class="text-blue-600 hover:text-pink-600 transition">Cakes & Desserts</a> <span class="text-gray-400">></span>
            <span class="text-gray-800 truncate">{{ $cake->nama_kue }}</span>
        </div>

        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-100 p-4 sm:p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-10 mb-6 sm:mb-8">
            <div class="w-full md:w-[420px] shrink-0">
                <div class="aspect-square w-full rounded-2xl border border-pink-100 overflow-hidden flex items-center justify-center bg-pink-50/30 shadow-sm relative group">
                    @if($cake->gambar)
                        <img src="{{ asset('images/' . $cake->gambar) }}" alt="{{ $cake->nama_kue }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105" onerror="this.src='{{ asset('images/logo.png') }}'">
                    @else
                        <div class="text-gray-400 text-sm">Tidak ada foto</div>
                    @endif
                </div>
            </div>

            <div class="flex-grow flex flex-col">
                <div class="mb-3">
                    <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 leading-snug">{{ $cake->nama_kue }}</h1>
                </div>
                
                <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs sm:text-sm mb-4">
                    <div class="flex items-center text-pink-600 gap-1 font-bold">
                        <span>5.0</span>
                        <span class="text-amber-400">★★★★★</span>
                    </div>
                    <div class="w-px h-3.5 bg-gray-200"></div>
                    <div class="text-gray-500"><span class="font-bold text-gray-800">124</span> Penilaian</div>
                    <div class="w-px h-3.5 bg-gray-200"></div>
                    <div class="text-gray-500"><span class="font-bold text-gray-800">358</span> Terjual</div>
                </div>

                <div class="bg-pink-50/60 p-4 sm:p-5 rounded-2xl border border-pink-100 flex items-baseline gap-2 mb-6">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-pink-600">Rp {{ number_format($cake->harga, 0, ',', '.') }}</div>
                    <span class="text-xs text-gray-400 font-medium">/ porsi</span>
                </div>

                <div class="space-y-4 sm:space-y-5 text-sm mb-6 flex-grow">
            
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                        <div class="w-auto sm:w-28 text-gray-500 text-xs sm:text-sm font-semibold">Ukuran</div>
                        <div class="flex flex-wrap gap-2" id="ukuran-container">
                            <button onclick="selectOption(this, 'ukuran')" class="px-3.5 py-1.5 sm:px-4 sm:py-2 border rounded-xl transition border-pink-500 text-pink-600 bg-pink-50 font-semibold text-xs sm:text-sm">
                                Standard (16 cm)
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                        <div class="w-auto sm:w-28 text-gray-500 text-xs sm:text-sm font-semibold">Rasa / Varian</div>
                        <div class="flex flex-wrap gap-2" id="rasa-container">
                            <button onclick="selectOption(this, 'rasa')" class="px-3.5 py-1.5 sm:px-4 sm:py-2 border rounded-xl transition border-pink-500 text-pink-600 bg-pink-50 font-semibold text-xs sm:text-sm">Vanilla Milky</button>
                            <button onclick="selectOption(this, 'rasa')" class="px-3.5 py-1.5 sm:px-4 sm:py-2 border rounded-xl transition border-gray-200 text-gray-700 hover:border-pink-500 hover:text-pink-600 font-medium text-xs sm:text-sm">Coklat Premium</button>
                            <button onclick="selectOption(this, 'rasa')" class="px-3.5 py-1.5 sm:px-4 sm:py-2 border rounded-xl transition border-gray-200 text-gray-700 hover:border-pink-500 hover:text-pink-600 font-medium text-xs sm:text-sm">Red Velvet</button>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 pt-1">
                        <div class="w-auto sm:w-28 text-gray-500 text-xs sm:text-sm font-semibold">Kuantitas</div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden bg-white">
                                <button onclick="decreaseQty()" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-r border-gray-200 font-bold">-</button>
                                <input type="text" id="qty-input" value="1" class="w-12 h-8 text-center text-gray-800 font-semibold text-sm focus:outline-none" readonly>
                                <button onclick="increaseQty()" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-l border-gray-200 font-bold">+</button>
                            </div>
                            <span class="text-gray-400 text-xs">Pre-Order 2 Hari</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4 sm:pt-6 mt-auto w-full">
                    <a href="javascript:void(0)" onclick="addToCart()" class="flex-1 flex items-center justify-center gap-2 bg-pink-50 border-2 border-pink-500 text-pink-600 hover:bg-pink-100 font-bold py-3.5 px-4 rounded-xl transition text-sm shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                        <span>Masukkan Keranjang</span>
                    </a>
                    <a href="javascript:void(0)" onclick="checkout()" class="flex-1 flex items-center justify-center bg-pink-600 hover:bg-pink-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-pink-200 transition text-sm">
                        <span>Beli Sekarang</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-100 p-5 sm:p-8 mb-8">
            <h2 class="bg-pink-50 text-pink-700 px-4 py-3 rounded-xl text-sm sm:text-base font-bold mb-5 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Spesifikasi Produk
            </h2>
            
            <div class="text-xs sm:text-sm text-gray-700 mb-8 divide-y divide-gray-100">
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Kategori</div>
                    <div class="flex-1 flex flex-wrap items-center gap-1.5 text-gray-800">
                        <a href="/" class="text-pink-600 hover:underline">By.Reesha</a> 
                        <span class="text-gray-300">/</span> 
                        <a href="/produk" class="text-pink-600 hover:underline">Semua Kue</a> 
                        <span class="text-gray-300">/</span> 
                        <span class="font-semibold text-gray-700">Cake Premium</span>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Masa Penyimpanan</div>
                    <div class="flex-1 font-semibold text-gray-800">3 Hari di dalam chiller / kulkas</div>
                </div>
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Menu Diet</div>
                    <div class="flex-1 text-gray-800">Tidak (Mengandung Gula & Butter Asli)</div>
                </div>
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Berat Produk</div>
                    <div class="flex-1 text-gray-800">500g - 1500g (tergantung varian)</div>
                </div>
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Dikirim Dari</div>
                    <div class="flex-1">
                        <a href="https://maps.app.goo.gl/zhTvGPQhEThNEfEi9" target="_blank" class="text-pink-600 hover:underline font-semibold flex items-center gap-1">
                            📍 Lhokseumawe, Aceh
                        </a>
                    </div>
                </div>
            </div>

            <h2 class="bg-pink-50 text-pink-700 px-4 py-3 rounded-xl text-sm sm:text-base font-bold mb-5 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Deskripsi Produk
            </h2>
            <div class="text-xs sm:text-sm text-gray-600 leading-relaxed whitespace-pre-line px-2">
                {{ $cake->deskripsi ?? '✨ Cake istimewa dari By.Reesha yang dibuat khusus dengan bahan-bahan premium dan sentuhan cinta. Cocok untuk merayakan momen berharga Anda.

                Mengapa memilih cake dari By.Reesha?
                - Dibuat dari 100% bahan premium, butter asli, dan coklat impor berkualitas
                - Freshly baked! Cake hanya dibuat saat pesanan masuk
                - Desain elegan dan bisa dicustom sesuai keinginan Anda
                - Tekstur lembut, manisnya pas, dan lumer di mulut
                
                📌 CARA PEMESANAN:
                1. Pilih ukuran dan varian rasa yang diinginkan.
                2. Untuk custom desain / tulisan, mohon cantumkan di kolom catatan saat checkout atau hubungi kami via WhatsApp setelah pembayaran.
                3. Harap order H-2 atau H-3 sebelum kue digunakan.
                
                ⚠️ PENGIRIMAN:
                Disarankan menggunakan pengiriman instant (Gojek/Grab) atau diambil sendiri ke toko untuk menghindari kerusakan kue di perjalanan.' }}
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 text-center py-6 text-xs text-gray-500 mt-auto">
        &copy; 2026 By.Reesha. All rights reserved.
    </footer>

    <script>
        let selectedUkuran = 'Standard';
        let selectedVarian = 'Vanilla Milky';

        const qtyInput = document.getElementById('qty-input');
        function increaseQty() {
            let val = parseInt(qtyInput.value) || 1;
            qtyInput.value = val + 1;
        }
        function decreaseQty() {
            let val = parseInt(qtyInput.value) || 1;
            if (val > 1) {
                qtyInput.value = val - 1;
            }
        }

        function selectOption(clickedBtn, group) {
            const container = document.getElementById(group + '-container');
            const buttons = container.querySelectorAll('button');
            
            buttons.forEach(btn => {
                btn.className = 'px-4 py-2 border rounded transition border-gray-200 text-gray-700 hover:border-pink-500 hover:text-pink-600';
                const checkmark = btn.querySelector('div.absolute');
                if(checkmark) {
                    btn.removeChild(checkmark);
                }
            });

            clickedBtn.className = 'px-4 py-2 border rounded transition border-pink-500 text-pink-600 bg-pink-50 font-medium relative overflow-hidden group';
            const optionText = clickedBtn.innerText.trim().split('\n')[0];
            if (group === 'ukuran') selectedUkuran = optionText;
            if (group === 'rasa') selectedVarian = optionText;

            const checkmarkHtml = `
                <div class="absolute bottom-0 right-0 w-4 h-4 bg-pink-500 text-white flex items-center justify-center" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2 relative -right-[2px] bottom-[2px]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            `;
            clickedBtn.insertAdjacentHTML('beforeend', checkmarkHtml);
        }

        function addToCart() {
            const id = "{{ $cake->id }}";
            const nama = "{{ $cake->nama_kue }}";
            const gambar = "{{ $cake->gambar }}";
            const harga = parseInt("{{ $cake->harga }}");
            const qty = parseInt(qtyInput.value);
            const ukuran = selectedUkuran;
            const varian = selectedVarian;

            const newItem = { id, nama, gambar, harga, qty, ukuran, varian };

            // Ambil keranjang lama dari localStorage
            let cart = JSON.parse(localStorage.getItem('my_cart')) || [];
            
            // Cek apakah item dengan varian dan ukuran sama sudah ada
            const existingIndex = cart.findIndex(item => item.id === id && item.varian === varian && item.ukuran === ukuran);
            
            if (existingIndex > -1) {
                cart[existingIndex].qty += qty;
            } else {
                cart.push(newItem);
            }

            localStorage.setItem('my_cart', JSON.stringify(cart));
            localStorage.removeItem('cart_cleared'); // Pastikan keranjang tidak kosong
            
            window.location.href = '/keranjang';
        }

        function checkout() {
            const id = "{{ $cake->id }}";
            const nama = encodeURIComponent("{{ $cake->nama_kue }}");
            const gambar = encodeURIComponent("{{ $cake->gambar }}");
            const harga = "{{ $cake->harga }}";
            const qty = qtyInput.value;
            const ukuran = encodeURIComponent(selectedUkuran);
            const varian = encodeURIComponent(selectedVarian);

            window.location.href = `/checkout?id=${id}&nama=${nama}&gambar=${gambar}&harga=${harga}&qty=${qty}&ukuran=${ukuran}&varian=${varian}`;
        }

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