<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f5f5f5; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col pb-20 md:pb-0">

    <!-- NAVIGATION BAR -->
    @include('partials.navbar', ['active' => 'keranjang'])

    <!-- MAIN CONTENT -->
    <div class="max-w-6xl mx-auto px-4 py-8 w-full flex-grow">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Keranjang Belanja Anda</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left: Cart Items -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    
                    <!-- Table Header -->
                    <div class="grid grid-cols-12 gap-4 p-4 border-b border-gray-100 text-sm font-medium text-gray-500 bg-gray-50 hidden md:grid">
                        <div class="col-span-6">Produk</div>
                        <div class="col-span-2 text-center">Harga Satuan</div>
                        <div class="col-span-2 text-center">Kuantitas</div>
                        <div class="col-span-2 text-right">Total Harga</div>
                    </div>

                    <div id="cart-items-container">
                        <!-- Items akan di render disini oleh JavaScript -->
                    </div>
                    
                    <!-- Empty Cart Message (Hidden by default) -->
                    <div id="empty-cart-message" class="hidden p-8 text-center text-gray-500">
                        <p class="mb-4">Keranjang belanja Anda kosong.</p>
                        <a href="/produk" class="inline-block bg-pink-100 text-pink-600 px-6 py-2 rounded-full font-medium hover:bg-pink-200 transition">Belanja Sekarang</a>
                    </div>

                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-4 mb-4">Ringkasan Belanja</h2>
                    
                    <div class="flex justify-between items-center mb-4 text-sm text-gray-600">
                        <span id="summary-items-count">Total Harga (3 Barang)</span>
                        <span id="summary-price">Rp 115.000</span>
                    </div>
                    
                    <div class="flex justify-between items-center border-t border-gray-100 pt-4 mb-6">
                        <span class="font-bold text-gray-800">Total Tagihan</span>
                        <span id="summary-total-price" class="font-bold text-xl text-pink-600">Rp 115.000</span>
                    </div>

                    <a href="/checkout" id="btn-checkout" class="w-full block text-center bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition">
                        Beli (3)
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 text-center py-6 text-xs text-gray-500 mt-auto">
        &copy; 2026 By.Reesha. All rights reserved.
    </footer>

    <script>
        function formatRupiah(angka) {
            return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }

        function updateQty(btn, change) {
            const input = btn.parentElement.querySelector('input');
            let newValue = parseInt(input.value) + change;
            if (newValue < 1) newValue = 1;
            input.value = newValue;
            
            const cartItem = btn.closest('.cart-item');
            const price = parseInt(cartItem.dataset.price);
            const totalElem = cartItem.querySelector('.item-total');
            totalElem.innerText = formatRupiah(newValue * price);
            
            updateCartStorage();
            updateTotal();
        }

        function removeItem(btn) {
            const cartItem = btn.closest('.cart-item');
            const index = cartItem.dataset.index;
            
            let cart = JSON.parse(localStorage.getItem('my_cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('my_cart', JSON.stringify(cart));
            if (typeof window.updateCartBadges === 'function') window.updateCartBadges();
            
            cartItem.style.opacity = '0';
            setTimeout(() => {
                renderCart(); // Re-render to update indexes and HTML
            }, 300);
        }

        function updateTotal() {
            const items = document.querySelectorAll('.cart-item');
            let totalQty = 0;
            let totalPrice = 0;
            let checkedItems = 0;

            items.forEach(item => {
                // Jangan hitung item jika sedang di-hide karena keranjang kosong
                if (item.style.display !== 'none' && item.style.opacity !== '0') {
                    const checkbox = item.querySelector('.item-checkbox');
                    if (checkbox && checkbox.checked) {
                        const qty = parseInt(item.querySelector('.qty-input').value);
                        const price = parseInt(item.dataset.price);
                        totalQty += qty;
                        totalPrice += (qty * price);
                        checkedItems++;
                    }
                }
            });

            document.getElementById('summary-items-count').innerText = `Total Harga (${totalQty} Barang)`;
            document.getElementById('summary-price').innerText = formatRupiah(totalPrice);
            document.getElementById('summary-total-price').innerText = formatRupiah(totalPrice);
            
            const btnCheckout = document.getElementById('btn-checkout');
            btnCheckout.innerText = `Beli (${totalQty})`;
            
            if (checkedItems === 0) {
                btnCheckout.classList.add('opacity-50', 'cursor-not-allowed');
                btnCheckout.classList.remove('hover:bg-pink-700');
                btnCheckout.href = 'javascript:void(0)';
            } else {
                btnCheckout.classList.remove('opacity-50', 'cursor-not-allowed');
                btnCheckout.classList.add('hover:bg-pink-700');
                
                const firstCheckedItem = Array.from(items).find(item => item.style.display !== 'none' && item.style.opacity !== '0' && item.querySelector('.item-checkbox').checked);
                if (firstCheckedItem) {
                    const id = firstCheckedItem.dataset.id;
                    const nama = encodeURIComponent(firstCheckedItem.querySelector('h3').innerText);
                    const imgUrl = firstCheckedItem.querySelector('img').src;
                    const gambar = encodeURIComponent(imgUrl.substring(imgUrl.lastIndexOf('/') + 1));
                    
                    const price = firstCheckedItem.dataset.price;
                    const qty = firstCheckedItem.querySelector('.qty-input').value;
                    
                    const pTags = firstCheckedItem.querySelectorAll('p');
                    const varian = pTags.length > 0 ? encodeURIComponent(pTags[0].innerText.replace('Varian: ', '')) : 'Default';
                    const ukuran = pTags.length > 1 ? encodeURIComponent(pTags[1].innerText.replace('Ukuran: ', '')) : 'Standard';
                    
                    btnCheckout.href = `/checkout?id=${id}&nama=${nama}&gambar=${gambar}&harga=${price}&qty=${qty}&ukuran=${ukuran}&varian=${varian}`;
                } else {
                    btnCheckout.href = '/checkout';
                }
            }

            // Cek apakah tidak ada item sama sekali yang tampil
            const visibleItems = Array.from(items).filter(item => item.style.display !== 'none' && item.style.opacity !== '0');
            if (visibleItems.length === 0) {
                document.getElementById('cart-items-container').classList.add('hidden');
                document.getElementById('empty-cart-message').classList.remove('hidden');
            }
        }

        // Initialize total on page load
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('cart_cleared') === 'true') {
                localStorage.removeItem('my_cart');
            }
            renderCart();
        });

        function renderCart() {
            const container = document.getElementById('cart-items-container');
            const cart = JSON.parse(localStorage.getItem('my_cart')) || [];
            container.innerHTML = '';

            if (cart.length === 0) {
                container.classList.add('hidden');
                document.getElementById('empty-cart-message').classList.remove('hidden');
                updateTotal();
                return;
            } else {
                container.classList.remove('hidden');
                document.getElementById('empty-cart-message').classList.add('hidden');
            }

            cart.forEach((item, index) => {
                const itemTotal = item.harga * item.qty;
                const html = `
                    <div class="cart-item p-4 border-b border-gray-100 transition-all duration-300 md:grid md:grid-cols-12 md:gap-4 md:items-center" data-index="${index}" data-id="${item.id}" data-price="${item.harga}">
                        
                        <!-- Product Info (Mobile & Desktop) -->
                        <div class="md:col-span-6 flex items-start sm:items-center gap-3">
                            <input type="checkbox" class="item-checkbox mt-1 sm:mt-0 w-4 h-4 text-pink-600 rounded border-gray-300 focus:ring-pink-500 cursor-pointer shrink-0" checked onchange="updateTotal()">
                            <img src="{{ url('/') }}/images/${item.gambar}" alt="${item.nama}" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-xl border border-gray-200 shrink-0" onerror="this.src='{{ asset('images/logo.png') }}'">
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-semibold text-gray-800 text-sm sm:text-base leading-snug">${item.nama}</h3>
                                    <!-- Mobile Delete Button -->
                                    <button type="button" class="md:hidden text-gray-400 hover:text-red-500 p-1 -mr-1 transition" onclick="removeItem(this)" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-0.5">Varian: ${item.varian}</p>
                                <p class="text-xs text-gray-500">Ukuran: ${item.ukuran}</p>
                                
                                <!-- Mobile Only: Subtotal & Qty in one compact row -->
                                <div class="flex md:hidden items-center justify-between mt-3 pt-2 border-t border-gray-50">
                                    <span class="text-pink-600 font-bold text-sm item-total">${formatRupiah(itemTotal)}</span>
                                    <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden h-7">
                                        <button type="button" class="btn-min w-7 h-full flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-r border-gray-200" onclick="updateQty(this, -1)">-</button>
                                        <input type="text" value="${item.qty}" class="qty-input w-8 h-full text-center text-xs text-gray-800 focus:outline-none" readonly>
                                        <button type="button" class="btn-plus w-7 h-full flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-l border-gray-200" onclick="updateQty(this, 1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Desktop Unit Price -->
                        <div class="hidden md:block md:col-span-2 text-center">
                            <span class="text-gray-800 text-sm">${formatRupiah(item.harga)}</span>
                        </div>

                        <!-- Desktop Qty Controls -->
                        <div class="hidden md:flex md:col-span-2 justify-center">
                            <div class="flex items-center border border-gray-300 rounded overflow-hidden h-8">
                                <button type="button" class="btn-min w-8 h-full flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-r border-gray-300" onclick="updateQty(this, -1)">-</button>
                                <input type="text" value="${item.qty}" class="qty-input w-10 h-full text-center text-sm text-gray-800 focus:outline-none" readonly>
                                <button type="button" class="btn-plus w-8 h-full flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-l border-gray-300" onclick="updateQty(this, 1)">+</button>
                            </div>
                        </div>

                        <!-- Desktop Total Price & Action -->
                        <div class="hidden md:block md:col-span-2 text-right">
                            <span class="item-total text-pink-600 font-semibold text-sm">${formatRupiah(itemTotal)}</span>
                            <button type="button" class="text-red-500 hover:text-red-700 text-xs ml-3 transition" onclick="removeItem(this)">Hapus</button>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });
            updateTotal();
        }

        function updateCartStorage() {
            let cart = JSON.parse(localStorage.getItem('my_cart')) || [];
            const items = document.querySelectorAll('.cart-item');
            items.forEach(item => {
                const index = item.dataset.index;
                const qty = parseInt(item.querySelector('.qty-input').value);
                if (cart[index]) {
                    cart[index].qty = qty;
                }
            });
            localStorage.setItem('my_cart', JSON.stringify(cart));
            if (typeof window.updateCartBadges === 'function') window.updateCartBadges();
        }
    </script>

    @include('partials.bottom_nav', ['active' => 'keranjang'])
</body>
</html>
