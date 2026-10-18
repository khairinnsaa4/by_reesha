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
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-10 w-10 object-contain rounded-full bg-pink-100" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
                <a href="/" class="text-2xl font-bold text-pink-600 tracking-wider">BY.REESHA</a>
            </div>

            <div class="flex flex-wrap justify-center gap-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-pink-600 transition">HOME</a>
                <a href="/produk" class="hover:text-pink-600 transition">SEMUA PRODUK</a>
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
                        <button type="submit" class="text-sm font-bold text-gray-400 hover:text-red-500 transition">Keluar</button>
                    </form>
                @else
                    <a href="/login" class="text-sm font-bold text-pink-600 hover:text-pink-700 px-4 py-2 border border-pink-200 rounded-xl hover:bg-pink-50 transition">Masuk</a>
                    <a href="/register" class="text-sm font-bold bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-xl shadow-md shadow-pink-100 transition">Daftar</a>
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

        <div class="bg-white rounded shadow-sm p-4 md:p-8 flex flex-col md:flex-row gap-8 mb-6">
            <div class="w-full md:w-[450px] shrink-0">
                <div class="aspect-square w-full rounded border border-gray-100 overflow-hidden flex items-center justify-center bg-gray-50">
                    @if($cake->gambar)
                        <img src="{{ asset('images/' . $cake->gambar) }}" alt="{{ $cake->nama_kue }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-gray-400">Tidak ada foto</div>
                    @endif
                </div>
                <div class="flex gap-2 mt-4 overflow-x-auto">
                    @if($cake->gambar)
                    <div class="w-20 h-20 shrink-0 border-2 border-pink-500 rounded cursor-pointer overflow-hidden">
                        <img src="{{ asset('images/' . $cake->gambar) }}" class="w-full h-full object-cover">
                    </div>
                    @endif
                    <div class="w-20 h-20 shrink-0 border border-transparent hover:border-pink-500 rounded cursor-pointer overflow-hidden opacity-70 hover:opacity-100 bg-gray-100 flex items-center justify-center">
                        <span class="text-xs text-gray-400">Detail 2</span>
                    </div>
                    <div class="w-20 h-20 shrink-0 border border-transparent hover:border-pink-500 rounded cursor-pointer overflow-hidden opacity-70 hover:opacity-100 bg-gray-100 flex items-center justify-center">
                        <span class="text-xs text-gray-400">Detail 3</span>
                    </div>
                </div>
            </div>

            <div class="flex-grow flex flex-col">
                <div class="mb-4">
                    <h1 class="text-xl md:text-2xl font-medium text-gray-900 leading-snug">{{ $cake->nama_kue }}</h1>
                </div>
                
                <div class="flex items-center gap-4 text-sm mb-4">
                    <div class="flex items-center text-pink-500 gap-1">
                        <span class="border-b border-pink-500 text-pink-600 font-medium">5.0</span>
                        <span>⭐⭐⭐⭐⭐</span>
                    </div>
                    <div class="w-px h-4 bg-gray-300"></div>
                    <div><span class="border-b border-gray-800 font-medium">124</span> Penilaian</div>
                    <div class="w-px h-4 bg-gray-300"></div>
                    <div><span class="font-medium">358</span> Terjual</div>
                </div>

                <div class="bg-gray-50 p-4 md:p-6 rounded-lg flex items-center gap-4 mb-6">
                    <div class="text-3xl md:text-4xl font-semibold text-pink-600">Rp {{ number_format($cake->harga, 0, ',', '.') }}</div>
                </div>

                <div class="space-y-6 text-sm mb-8 flex-grow">
            
                    <div class="flex items-center gap-6">
                        <div class="w-24 text-gray-500 shrink-0">Ukuran</div>
                        <div class="flex flex-wrap gap-2" id="ukuran-container">
                            <button onclick="selectOption(this, 'ukuran')" class="px-4 py-2 border rounded transition border-pink-500 text-pink-600 bg-pink-50 font-medium relative overflow-hidden group">
                                Standard
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-pink-500 text-white flex items-center justify-center" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2 relative -right-[2px] bottom-[2px]" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <div class="w-24 text-gray-500 shrink-0">Rasa / Varian</div>
                        <div class="flex flex-wrap gap-2" id="rasa-container">
                            <button onclick="selectOption(this, 'rasa')" class="px-4 py-2 border rounded transition border-gray-200 text-gray-700 hover:border-pink-500 hover:text-pink-600">Coklat Premium</button>
                            <button onclick="selectOption(this, 'rasa')" class="px-4 py-2 border rounded transition border-pink-500 text-pink-600 bg-pink-50 font-medium relative overflow-hidden group">
                                Vanilla Milky
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-pink-500 text-white flex items-center justify-center" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2 relative -right-[2px] bottom-[2px]" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            <button onclick="selectOption(this, 'rasa')" class="px-4 py-2 border rounded transition border-gray-200 text-gray-700 hover:border-pink-500 hover:text-pink-600">Red Velvet</button>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 pt-2">
                        <div class="w-24 text-gray-500 shrink-0">Kuantitas</div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center border border-gray-300 rounded overflow-hidden">
                                <button onclick="decreaseQty()" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-r border-gray-300">-</button>
                                <input type="text" id="qty-input" value="1" class="w-12 h-8 text-center text-gray-800 focus:outline-none" readonly>
                                <button onclick="increaseQty()" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-l border-gray-300">+</button>
                            </div>
                            <span class="text-gray-500 text-sm">Tersedia (Sistem PO 2 Hari)</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-4 pt-6 mt-auto w-full">
                    <a href="javascript:void(0)" onclick="addToCart()" class="w-full md:flex-1 flex items-center justify-center gap-2 bg-pink-50 border border-pink-500 text-pink-600 hover:bg-pink-100 font-medium py-3 px-4 rounded shadow-sm transition whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                        Masukkan Keranjang
                    </a>
                    <a href="javascript:void(0)" onclick="checkout()" class="w-full md:flex-1 flex items-center justify-center bg-pink-600 hover:bg-pink-700 text-white font-medium py-3 px-4 rounded shadow-sm transition whitespace-nowrap">
                        Beli Sekarang
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded shadow-sm p-6 mb-8">
            <h2 class="bg-gray-50 p-3 rounded text-lg font-medium text-gray-800 mb-6 uppercase tracking-wider">Spesifikasi Produk</h2>
            
            <div class="text-sm text-gray-700 mb-8 w-full md:max-w-3xl">
                <div class="flex py-3 border-b border-gray-100 hover:bg-gray-50 px-2 transition">
                    <div class="w-1/3 text-gray-500 shrink-0">Kategori</div>
                    <div class="w-2/3 flex items-center gap-2">
                        <a href="/" class="text-blue-600 hover:underline">By.Reesha</a> 
                        <span class="text-gray-400">></span> 
                        <a href="/produk" class="text-blue-600 hover:underline">Semua Kue</a> 
                        <span class="text-gray-400">></span> 
                        <span class="text-gray-800">Cake Premium</span>
                    </div>
                </div>
                <div class="flex py-3 border-b border-gray-100 hover:bg-gray-50 px-2 transition">
                    <div class="w-1/3 text-gray-500 shrink-0">Masa Penyimpanan</div>
                    <div class="w-2/3">3 Hari di dalam chiller / kulkas</div>
                </div>
                <div class="flex py-3 border-b border-gray-100 hover:bg-gray-50 px-2 transition">
                    <div class="w-1/3 text-gray-500 shrink-0">Menu Diet</div>
                    <div class="w-2/3">Tidak</div>
                </div>
                <div class="flex py-3 border-b border-gray-100 hover:bg-gray-50 px-2 transition">
                    <div class="w-1/3 text-gray-500 shrink-0">Berat Produk</div>
                    <div class="w-2/3">500g - 1500g (tergantung varian)</div>
                </div>
                <div class="flex py-3 border-b border-gray-100 hover:bg-gray-50 px-2 transition">
                    <div class="w-1/3 text-gray-500 shrink-0">Dikirim Dari</div>
                    <div class="w-2/3"><a href="https://maps.app.goo.gl/zhTvGPQhEThNEfEi9" target="_blank" class="text-blue-600 hover:underline">Lhokseumawe, Aceh</a></div>
                </div>
            </div>

            <h2 class="bg-gray-50 p-3 rounded text-lg font-medium text-gray-800 mb-6 uppercase tracking-wider">Deskripsi Produk</h2>
            <div class="text-sm text-gray-700 leading-loose whitespace-pre-line px-2">
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
    </script>
</body>
</html>