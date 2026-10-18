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
<body class="min-h-screen flex flex-col">

    <!-- NAVIGATION BAR -->
    <nav class="bg-white shadow-sm border-b border-pink-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-10 w-10 object-contain rounded-full bg-pink-100" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
                <a href="/" class="text-2xl font-bold text-pink-600 tracking-wider">BY.REESHA</a>
            </div>

            <div class="flex flex-wrap justify-center gap-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-pink-600 transition">HOME</a>
                <a href="/produk" class="hover:text-pink-600 transition">SEMUA PRODUK</a>
                <a href="/keranjang" class="text-pink-600 border-b-2 border-pink-600 pb-1">KERANJANG</a>
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
                    <div class="cart-item grid grid-cols-1 md:grid-cols-12 gap-4 p-4 border-b border-gray-100 items-center transition-all duration-300" data-index="${index}" data-id="${item.id}" data-price="${item.harga}">
                        <div class="col-span-1 md:col-span-6 flex items-center gap-4">
                            <input type="checkbox" class="item-checkbox w-4 h-4 text-pink-600 rounded border-gray-300 focus:ring-pink-500 cursor-pointer" checked onchange="updateTotal()">
                            <img src="{{ url('/') }}/images/${item.gambar}" alt="${item.nama}" class="w-20 h-20 object-cover rounded border border-gray-200" onerror="this.src='{{ asset('images/logo.png') }}'">
                            <div>
                                <h3 class="font-medium text-gray-800">${item.nama}</h3>
                                <p class="text-xs text-gray-500 mt-1">Varian: ${item.varian}</p>
                                <p class="text-xs text-gray-500">Ukuran: ${item.ukuran}</p>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2 text-left md:text-center mt-2 md:mt-0">
                            <span class="text-gray-800">${formatRupiah(item.harga)}</span>
                        </div>
                        <div class="col-span-1 md:col-span-2 flex justify-start md:justify-center mt-2 md:mt-0">
                            <div class="flex items-center border border-gray-300 rounded overflow-hidden h-8">
                                <button type="button" class="btn-min w-8 h-full flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-r border-gray-300" onclick="updateQty(this, -1)">-</button>
                                <input type="text" value="${item.qty}" class="qty-input w-10 h-full text-center text-sm text-gray-800 focus:outline-none" readonly>
                                <button type="button" class="btn-plus w-8 h-full flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 border-l border-gray-300" onclick="updateQty(this, 1)">+</button>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2 text-left md:text-right mt-2 md:mt-0">
                            <span class="item-total text-pink-600 font-semibold">${formatRupiah(itemTotal)}</span>
                            <button type="button" class="text-red-500 hover:text-red-700 text-sm block md:inline mt-2 md:ml-4" onclick="removeItem(this)">Hapus</button>
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
        }
    </script>
</body>
</html>
