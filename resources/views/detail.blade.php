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
<body class="min-h-screen flex flex-col pb-20 md:pb-0">

    <!-- NAVIGATION BAR -->
    @include('partials.navbar', ['active' => 'produk'])

    <div class="max-w-6xl mx-auto px-4 py-6 w-full flex-grow">
  
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-4 flex items-center gap-2 flex-wrap">
            <a href="/" class="text-pink-600 hover:text-pink-700 transition">By.Reesha</a>
            <span class="text-gray-400">></span>
            <a href="/produk" class="text-pink-600 hover:text-pink-700 transition">Katalog Produk</a>
            <span class="text-gray-400">></span>
            @if($cake->category)
                <a href="/produk?kategori={{ $cake->category->slug }}" class="text-pink-600 hover:text-pink-700 transition">{{ $cake->category->nama }}</a>
                <span class="text-gray-400">></span>
            @endif
            <span class="text-gray-800 font-semibold truncate">{{ $cake->nama_kue }}</span>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs sm:text-sm font-semibold flex items-center gap-2.5">
            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-100 p-4 sm:p-6 md:p-8 flex flex-col md:flex-row gap-6 md:gap-10 mb-6 sm:mb-8">
            <div class="w-full md:w-[420px] shrink-0">
                <div class="aspect-square w-full rounded-2xl border border-pink-100 overflow-hidden flex items-center justify-center bg-pink-50/30 shadow-sm relative group">
                    @if($cake->gambar)
                        <img src="{{ asset('images/' . $cake->gambar) }}" alt="{{ $cake->nama_kue }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105" onerror="this.src='{{ asset('images/logo.png') }}'">
                    @else
                        <div class="text-gray-400 text-sm">Tidak ada foto</div>
                    @endif
                    
                    @if($cake->sku)
                    <div class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-xs text-white text-xs font-mono font-semibold px-2.5 py-1 rounded-lg">
                        {{ $cake->sku }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="flex-grow flex flex-col">
                <div class="mb-2">
                    <div class="text-xs font-bold uppercase tracking-wider text-pink-600 mb-1">
                        {{ $cake->category->nama ?? 'Cake Premium By.Reesha' }}
                    </div>
                    <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 leading-snug">{{ $cake->nama_kue }}</h1>
                </div>
                
                <div class="flex items-center gap-3 text-xs text-gray-500 mb-4">
                    <div class="flex items-center text-pink-600 gap-1 font-bold">
                        <span>5.0</span>
                        <span class="text-amber-400">★★★★★</span>
                    </div>
                    <div class="w-px h-3.5 bg-gray-200"></div>
                    <div><span class="font-bold text-gray-800">{{ $cake->sold_count ?? 0 }}</span> Terjual</div>
                </div>

                <div class="bg-pink-50/60 p-4 sm:p-5 rounded-2xl border border-pink-100 flex items-center justify-between gap-3 mb-5">
                    <div class="text-2xl sm:text-3xl font-extrabold text-pink-600">
                        Rp {{ number_format($cake->harga, 0, ',', '.') }}
                    </div>
                    <div>
                        @if($cake->stock <= 0)
                            <span class="text-xs font-semibold text-rose-700 bg-rose-100 px-3 py-1 rounded-full">
                                Stok Habis
                            </span>
                        @else
                            <span class="text-xs font-semibold text-emerald-800 bg-emerald-100 px-3 py-1 rounded-full">
                                Stok: {{ $cake->stock }}
                            </span>
                        @endif
                    </div>
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
                                <button type="button" onclick="decreaseQty()" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-r border-gray-200 font-bold">-</button>
                                <input type="text" id="qty-input" value="1" class="w-12 h-8 text-center text-gray-800 font-semibold text-sm focus:outline-none" readonly>
                                <button type="button" onclick="increaseQty()" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-l border-gray-200 font-bold">+</button>
                            </div>
                            <span class="text-gray-400 text-xs">Maks: {{ $cake->stock }}</span>
                        </div>
                    </div>
                </div>

                <!-- CTA Order Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4 sm:pt-6 mt-auto w-full">
                    @if($cake->stock > 0)
                        <a href="javascript:void(0)" onclick="addToCart()" class="flex-1 flex items-center justify-center gap-2 bg-pink-50 border-2 border-pink-500 text-pink-600 hover:bg-pink-100 font-bold py-3.5 px-4 rounded-xl transition text-sm shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                            <span>Masukkan Keranjang</span>
                        </a>
                        <a href="javascript:void(0)" onclick="checkout()" class="flex-1 flex items-center justify-center bg-pink-600 hover:bg-pink-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-pink-200 transition text-sm">
                            <span>Beli Sekarang</span>
                        </a>
                    @else
                        <button type="button" disabled class="w-full bg-gray-200 text-gray-400 cursor-not-allowed font-bold py-3.5 px-4 rounded-xl text-sm shadow-none select-none flex items-center justify-center gap-2" title="Stok Produk Habis">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                            <span>Stok Habis</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Spesifikasi Produk -->
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-100 p-5 sm:p-8 mb-8">
            <h2 class="bg-pink-50 text-pink-700 px-4 py-3 rounded-xl text-sm sm:text-base font-bold mb-5 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Spesifikasi & Informasi Produk
            </h2>
            
            <div class="text-xs sm:text-sm text-gray-700 mb-8 divide-y divide-gray-100">
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">SKU / Kode Produk</div>
                    <div class="flex-1 font-mono font-bold text-gray-800">{{ $cake->sku ?? '-' }}</div>
                </div>
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Kategori Kue</div>
                    <div class="flex-1 flex flex-wrap items-center gap-1.5 text-gray-800">
                        <a href="/" class="text-pink-600 hover:underline">By.Reesha</a> 
                        <span class="text-gray-300">/</span> 
                        <a href="/produk" class="text-pink-600 hover:underline">Semua Kue</a> 
                        <span class="text-gray-300">/</span> 
                        <span class="font-semibold text-gray-700">{{ $cake->category->nama ?? 'Cake' }}</span>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Sistem Pemesanan</div>
                    <div class="flex-1 font-semibold text-gray-800">Pre-Order (PO 2 Hari Kerja) • Freshly Baked</div>
                </div>
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Masa Penyimpanan</div>
                    <div class="flex-1 font-semibold text-gray-800">3 Hari di dalam chiller / kulkas pendingin</div>
                </div>
                <div class="flex flex-col sm:flex-row py-3 px-2 gap-1 sm:gap-4 hover:bg-pink-50/40 rounded-lg transition">
                    <div class="w-full sm:w-44 text-gray-400 shrink-0 font-medium">Dikirim Dari</div>
                    <div class="flex-1">
                        <a href="https://maps.app.goo.gl/zhTvGPQhEThNEfEi9" target="_blank" class="text-pink-600 hover:underline font-semibold flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 inline flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Kitchen By.Reesha, Lhokseumawe, Aceh
                        </a>
                    </div>
                </div>
            </div>

            <h2 class="bg-pink-50 text-pink-700 px-4 py-3 rounded-xl text-sm sm:text-base font-bold mb-5 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Deskripsi Produk
            </h2>
            <div class="text-xs sm:text-sm text-gray-600 leading-relaxed whitespace-pre-line px-2">
                {{ $cake->deskripsi ?? 'Cake istimewa dari By.Reesha yang dibuat khusus dengan bahan-bahan premium dan sentuhan cinta. Cocok untuk merayakan momen berharga Anda.' }}
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 text-center py-6 text-xs text-gray-500 mt-auto">
        &copy; 2026 By.Reesha. All rights reserved.
    </footer>

    <script>
        const maxStock = {{ (int) $cake->stock }};
        let selectedUkuran = 'Standard';
        let selectedVarian = 'Vanilla Milky';

        const qtyInput = document.getElementById('qty-input');
        function increaseQty() {
            let val = parseInt(qtyInput.value) || 1;
            if (val < maxStock) {
                qtyInput.value = val + 1;
            } else {
                alert('Maksimal pemesanan sesuai kuota slot PO tersedia: ' + maxStock + ' slot.');
            }
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

            let cart = JSON.parse(localStorage.getItem('my_cart')) || [];
            const existingIndex = cart.findIndex(item => item.id === id && item.varian === varian && item.ukuran === ukuran);
            
            if (existingIndex > -1) {
                cart[existingIndex].qty += qty;
            } else {
                cart.push(newItem);
            }

            localStorage.setItem('my_cart', JSON.stringify(cart));
            localStorage.removeItem('cart_cleared');
            
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

    @include('partials.bottom_nav', ['active' => 'produk'])
</body>
</html>
