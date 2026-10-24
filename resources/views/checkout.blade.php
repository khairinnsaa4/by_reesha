<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { background-color: #f5f5f5; font-family: 'Poppins', sans-serif; }
        .checkout-step-active { color: #db2777; font-weight: 600; }
        .checkout-step { color: #9ca3af; }
    </style>
</head>
<body class="min-h-screen flex flex-col pb-16 md:pb-0">

    <!-- NAVIGATION BAR -->
    <nav class="bg-white shadow-sm border-b border-pink-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-2.5 sm:gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-11 w-11 sm:h-13 sm:w-13 object-contain rounded-full bg-pink-100 shadow-sm ring-2 ring-pink-100 p-0.5" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
                <a href="/" class="text-xl sm:text-2xl font-extrabold text-pink-600 tracking-wider border-r border-gray-200 pr-3 sm:pr-4">BY.REESHA</a>
                <span class="text-base sm:text-xl font-medium text-gray-700 pl-1 sm:pl-2">Checkout</span>
            </div>
            <a href="/keranjang" class="text-xs sm:text-sm font-semibold text-pink-600 hover:text-pink-700 transition">
                ← Keranjang
            </a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <form action="/checkout/proses" method="POST" onsubmit="localStorage.setItem('cart_cleared', 'true')" class="max-w-6xl mx-auto px-4 py-8 w-full flex-grow">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $id }}">
        <input type="hidden" name="nama_produk" value="{{ $nama }}">
        <input type="hidden" name="gambar_produk" value="{{ $gambar }}">
        <input type="hidden" name="varian" value="{{ $varian }}">
        <input type="hidden" name="ukuran" value="{{ $ukuran }}">
        <input type="hidden" name="qty" value="{{ $qty }}">
        <input type="hidden" name="harga_satuan" value="{{ $harga }}">
        <input type="hidden" name="total_harga" id="input-total-harga" value="{{ ($harga * $qty) + 15000 + 1000 }}">
        <input type="hidden" name="metode_pengiriman" id="input-metode-pengiriman" value="Kurir Instan / Grab (Rp 15.000)">
        <input type="hidden" name="metode_pembayaran" id="input-metode-pembayaran" value="QRIS">

        @if(session('error'))
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm rounded-xl flex items-center gap-2.5 shadow-sm">
            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-6">
            
            <!-- Left Side: Order Details -->
            <div class="w-full lg:w-2/3 space-y-6">
                
                <!-- Alamat Pengiriman -->
                <div class="rounded-xl border-2 border-pink-100 bg-white shadow-md relative overflow-hidden">
                    {{-- Header strip --}}
                    <div class="bg-gradient-to-r from-pink-500 to-pink-400 px-6 py-3 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-white font-bold text-sm tracking-wide">Alamat Pengiriman</span>
                    </div>

                    @php $userAddress = Auth::user()->address ?? ''; @endphp

                    {{-- Wrapper tunggal yang akan diganti JS setelah simpan --}}
                    <div id="address-section-wrapper" class="p-5">
                    @if($userAddress)
                        {{-- SUDAH ADA ALAMAT --}}
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3 flex-1">
                                <div class="mt-0.5 bg-green-100 rounded-full p-1.5 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">
                                        <span id="display-name">{{ Auth::user()->name }}</span>
                                        <span class="font-normal text-gray-400 ml-1" id="display-phone">{{ Auth::user()->phone ? '(' . Auth::user()->phone . ')' : '' }}</span>
                                    </p>
                                    <p class="text-gray-600 text-sm mt-0.5" id="display-address">{{ $userAddress }}</p>
                                    <span class="inline-flex items-center gap-1.5 mt-1.5 text-xs bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full px-2.5 py-0.5 font-medium">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Alamat tersimpan
                                    </span>
                                </div>
                            </div>
                            <button type="button" onclick="openAddressModal()"
                                class="flex-shrink-0 text-xs font-semibold text-pink-600 border border-pink-300 hover:bg-pink-50 px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                <span>Ubah</span>
                            </button>
                        </div>
                    @else
                        {{-- BELUM ADA ALAMAT --}}
                        <div class="flex flex-col gap-3">
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 bg-yellow-100 rounded-full p-1.5 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 3a9 9 0 100 18A9 9 0 0012 3z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-yellow-700 text-sm">Alamat belum diatur</p>
                                    <p class="text-gray-500 text-xs mt-0.5">Atur alamat pengiriman terlebih dahulu agar pesanan dapat diproses.</p>
                                </div>
                                <button type="button" onclick="openAddressModal()"
                                    class="flex-shrink-0 bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold px-4 py-2 rounded-lg transition flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Atur Alamat
                                </button>
                            </div>
                            <div id="alert-no-address" class="bg-red-50 border border-red-200 text-red-600 text-xs rounded-lg px-3 py-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                                Pesanan tidak dapat diproses. Silakan atur alamat pengiriman terlebih dahulu.
                            </div>
                        </div>
                    @endif
                    </div>
                </div>


                <!-- Modal Ubah Alamat -->
                <div id="address-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden opacity-0 transition-opacity">
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden transform scale-95 transition-transform duration-300" id="address-modal-content">
                        <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                            <div>
                                <h3 class="font-bold text-gray-800">Alamat Pengiriman</h3>
                                <p class="text-xs text-gray-400 mt-0.5">Gunakan lokasi terkini atau isi secara manual</p>
                            </div>
                            <button type="button" onclick="closeAddressModal()" class="text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>

                        <div class="p-6 space-y-4">
                            {{-- Tombol Gunakan Lokasi Saya --}}
                            <button type="button" onclick="gunakanLokasiSaya()"
                                id="btn-lokasi"
                                class="w-full flex items-center justify-center gap-2 border-2 border-dashed border-pink-300 text-pink-600 hover:bg-pink-50 rounded-xl py-3 font-semibold text-sm transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span id="btn-lokasi-text">Gunakan Lokasi Terkini (GPS)</span>
                            </button>

                            {{-- Status lokasi --}}
                            <div id="status-lokasi" class="hidden text-xs text-center py-2 px-3 rounded-lg"></div>

                            <div class="relative flex items-center">
                                <div class="flex-grow border-t border-gray-200"></div>
                                <span class="px-3 text-xs text-gray-400">atau isi manual</span>
                                <div class="flex-grow border-t border-gray-200"></div>
                            </div>

                            {{-- Form manual --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                                <input type="text" id="input-name"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-pink-500 focus:ring-1 focus:ring-pink-500 outline-none transition"
                                    value="{{ Auth::check() ? Auth::user()->name : 'Pelanggan By.Reesha' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="text" id="input-phone"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-pink-500 focus:ring-1 focus:ring-pink-500 outline-none transition"
                                    placeholder="Contoh: 0812-3456-7890">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea id="input-address" rows="3"
                                    class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:border-pink-500 focus:ring-1 focus:ring-pink-500 outline-none transition resize-none"
                                    placeholder="Jl. nama jalan, No., Kecamatan, Kota, Provinsi, Kode Pos"></textarea>
                                <p class="text-xs text-gray-400 mt-1">Alamat dapat disesuaikan atau diedit jika terdapat rincian yang kurang tepat.</p>
                            </div>
                        </div>

                        <div class="p-5 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                            <button type="button" onclick="closeAddressModal()" class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition text-sm">Batal</button>
                            <button type="button" onclick="saveAddress()" class="px-5 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 font-medium transition shadow-sm text-sm">Simpan Alamat</button>
                        </div>
                    </div>
                </div>


                <!-- Produk Dipesan -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <h3 class="font-semibold text-gray-800 border-b border-gray-100 pb-4 mb-4">Produk Dipesan</h3>
                    
                    <div class="flex flex-col gap-6">
                        <!-- Item 1 -->
                        <div class="flex gap-4">
                            <img src="{{ asset('images/' . $gambar) }}" alt="{{ $nama }}" class="w-16 h-16 object-cover rounded border border-gray-200" onerror="this.src='{{ asset('images/logo.png') }}'">
                            <div class="flex-grow">
                                <h4 class="font-medium text-gray-800 text-sm">{{ $nama }}</h4>
                                <p class="text-xs text-gray-500 mt-0.5">Varian: {{ $varian }} • Ukuran: {{ $ukuran }}</p>
                                <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-pink-700 bg-pink-50 border border-pink-100 px-2 py-0.5 rounded-md mt-1.5">
                                    Pre-Order 2 Hari • Kuota Tersedia: {{ $stok ?? 10 }} Slot
                                </span>
                            </div>
                            <div class="text-sm text-gray-800 font-medium text-right">
                                Rp {{ number_format($harga, 0, ',', '.') }} <br>
                                <span class="text-xs text-gray-500 font-normal">x{{ $qty }}</span>
                            </div>
                        </div>

                        <!-- Opsi Pengiriman -->
                        <div class="border-t border-gray-100 pt-5 mt-5">
                            <p class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                                Metode Pengiriman
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <!-- Option 1 -->
                                <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-pink-500 transition relative flex gap-3 items-start shipping-label border-pink-500 bg-pink-50">
                                    <input type="radio" name="shipping" value="15000" data-label="Kurir Instan / Grab (Rp 15.000)" class="mt-1 text-pink-600 focus:ring-pink-500" checked onchange="updateOngkirRadio(this)">
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-gray-800 text-sm">Kurir Instan / Grab</span>
                                            <span class="font-bold text-pink-600 text-sm">Rp 15.000</span>
                                        </div>
                                        <p class="text-xs text-gray-500">Lhokseumawe (Dalam Kota)</p>
                                    </div>
                                </label>
                                
                                <!-- Option 2 -->
                                <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-pink-500 transition relative flex gap-3 items-start shipping-label">
                                    <input type="radio" name="shipping" value="30000" data-label="Kurir Reguler (Rp 30.000)" class="mt-1 text-pink-600 focus:ring-pink-500" onchange="updateOngkirRadio(this)">
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-gray-800 text-sm">Kurir Reguler</span>
                                            <span class="font-bold text-gray-800 text-sm">Rp 30.000</span>
                                        </div>
                                        <p class="text-xs text-gray-500">Aceh Utara & Sekitarnya</p>
                                    </div>
                                </label>

                                <!-- Option 3 -->
                                <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-pink-500 transition relative flex gap-3 items-start shipping-label">
                                    <input type="radio" name="shipping" value="60000" data-label="Travel / Kargo (Rp 60.000)" class="mt-1 text-pink-600 focus:ring-pink-500" onchange="updateOngkirRadio(this)">
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-gray-800 text-sm">Travel / Kargo</span>
                                            <span class="font-bold text-gray-800 text-sm">Rp 60.000</span>
                                        </div>
                                        <p class="text-xs text-gray-500">Bireuen, Lhoksukon, Banda Aceh</p>
                                    </div>
                                </label>

                                <!-- Option 4: Ambil di tempat -->
                                <label class="border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-pink-500 transition relative flex gap-3 items-start shipping-label">
                                    <input type="radio" name="shipping" value="0" data-label="Ambil di Tempat (Toko)" class="mt-1 text-pink-600 focus:ring-pink-500" onchange="updateOngkirRadio(this)">
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-gray-800 text-sm">Ambil di Tempat (Toko)</span>
                                            <span class="font-bold text-green-600 text-sm">Gratis</span>
                                        </div>
                                        <p class="text-xs text-gray-500">Jemput sendiri pesanan di toko kami</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Pesan -->
                        <div class="flex items-center gap-4 mt-2 text-sm border-t border-gray-100 pt-4">
                            <label class="text-gray-700 whitespace-nowrap font-medium">Pesan:</label>
                            <input type="text" placeholder="(Opsional) Tinggalkan pesan ke penjual..." class="flex-grow border-b border-gray-300 focus:border-pink-500 pb-1 px-2 focus:outline-none bg-transparent">
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <h3 class="font-semibold text-gray-800 border-b border-gray-100 pb-4 mb-4">Metode Pembayaran</h3>
                    
                    <div class="grid grid-cols-2 gap-3" id="payment-container">
                        <button type="button" onclick="selectPayment(this, 'QRIS')" class="px-4 py-2 border rounded transition border-pink-500 text-pink-600 bg-pink-50 font-medium relative overflow-hidden group text-sm text-center payment-btn">
                            QRIS
                            <div class="absolute bottom-0 right-0 w-4 h-4 bg-pink-500 text-white flex items-center justify-center" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2 relative -right-[2px] bottom-[2px]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                        <button type="button" onclick="selectPayment(this, 'COD (Bayar di Tempat)')" class="px-4 py-2 border rounded transition border-gray-300 text-gray-600 hover:border-pink-500 hover:text-pink-600 font-medium text-sm text-center payment-btn">
                            COD (Bayar di Tempat)
                        </button>
                    </div>
                </div>
                
            </div>

            <!-- Right Side: Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-4 mb-4">Ringkasan Belanja</h2>
                    
                    <div class="space-y-3 text-sm text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($harga * $qty, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Ongkos Kirim</span>
                            <span id="summary-ongkir">Rp 15.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan</span>
                            <span>Rp 1.000</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center border-t border-gray-100 pt-4 mb-6">
                        <span class="font-bold text-gray-800">Total Tagihan</span>
                        <span class="font-bold text-2xl text-pink-600" id="total-tagihan">Rp {{ number_format(($harga * $qty) + 15000 + 1000, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" id="btn-buat-pesanan" class="w-full block text-center bg-pink-600 hover:bg-pink-700 text-white font-semibold py-4 px-4 rounded-lg shadow-md transition text-lg">
                        Buat Pesanan
                    </button>
                </div>
            </div>
            
        </div>
    </form>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 text-center py-6 text-xs text-gray-500 mt-auto">
        &copy; 2026 By.Reesha. All rights reserved.
    </footer>

    <script>
        // ── Modal ──────────────────────────────────────────────
        const modal = document.getElementById('address-modal');
        const modalContent = document.getElementById('address-modal-content');

        function openAddressModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
            }, 10);
        }

        function closeAddressModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function saveAddress() {
            const name    = document.getElementById('input-name').value.trim();
            const phone   = document.getElementById('input-phone').value.trim();
            const address = document.getElementById('input-address').value.trim();

            if (!address) {
                showStatus('Alamat tidak boleh kosong.', 'warn');
                return;
            }

            showStatus('Menyimpan alamat...', 'info');

            // Simpan ke database via fetch
            fetch('/profil/update-alamat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ phone, address }),
            })
            .then(r => r.json())
            .then(data => {
                if (data.status === 'ok') {
                    // Replace SELURUH wrapper dengan tampilan "sudah ada alamat"
                    // Ini mengatasi masalah: setelah simpan alamat masih tampil "belum diatur"
                    const wrapper = document.getElementById('address-section-wrapper');
                    const displayName  = name  || '{{ Auth::user()->name }}';
                    const displayPhone = phone ? `(${phone})` : '';

                    wrapper.innerHTML = `
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3 flex-1">
                                <div class="mt-0.5 bg-green-100 rounded-full p-1.5 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">
                                        <span id="display-name">${displayName}</span>
                                        <span class="font-normal text-gray-400 ml-1" id="display-phone">${displayPhone}</span>
                                    </p>
                                    <p class="text-gray-600 text-sm mt-0.5" id="display-address">${address}</p>
                                    <span class="inline-flex items-center gap-1.5 mt-1.5 text-xs bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full px-2.5 py-0.5 font-medium">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Alamat tersimpan
                                    </span>
                                </div>
                            </div>
                            <button type="button" onclick="openAddressModal()"
                                class="flex-shrink-0 text-xs font-semibold text-pink-600 border border-pink-300 hover:bg-pink-50 px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                <span>Ubah</span>
                            </button>
                        </div>
                    `;

                    // Aktifkan tombol Buat Pesanan
                    const btn = document.getElementById('btn-buat-pesanan');
                    btn.disabled = false;
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    btn.removeAttribute('title');

                    closeAddressModal();
                }
            })
            .catch(() => showStatus('Gagal menyimpan alamat. Coba lagi.', 'error'));
        }

        // Blokir submit jika belum ada alamat
        const hasAddress = {{ Auth::user()->address ? 'true' : 'false' }};
        window.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('btn-buat-pesanan');
            if (!hasAddress) {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
                btn.title = 'Atur alamat pengiriman terlebih dahulu';
            }
        });


        // ── GPS / Lokasi Terkini ───────────────────────────────
        function gunakanLokasiSaya() {
            if (!navigator.geolocation) {
                showStatus('Browser Anda tidak mendukung layanan lokasi GPS.', 'error');
                return;
            }

            const btn     = document.getElementById('btn-lokasi');
            const btnText = document.getElementById('btn-lokasi-text');

            btn.disabled = true;
            btnText.innerHTML = `<svg class="animate-spin h-4 w-4 mr-1 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg> Mendeteksi lokasi...`;
            showStatus('Sedang mendeteksi lokasi GPS Anda...', 'info');

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    const lat = pos.coords.latitude;
                    const lon = pos.coords.longitude;
                    showStatus('Lokasi ditemukan. Mengambil detail alamat...', 'info');

                    // Reverse geocoding via OpenStreetMap Nominatim (gratis)
                    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1`, {
                        headers: { 'Accept-Language': 'id' }
                    })
                    .then(r => r.json())
                    .then(data => {
                        const a = data.address || {};
                        // Susun alamat dari komponen yang tersedia
                        const parts = [
                            a.road || a.pedestrian || a.footway || '',
                            a.village || a.suburb || a.neighbourhood || '',
                            a.subdistrict || a.town || a.municipality || '',
                            a.city || a.county || '',
                            a.state || '',
                            a.postcode || ''
                        ].filter(Boolean);

                        const alamatLengkap = parts.join(', ');
                        document.getElementById('input-address').value = alamatLengkap;

                        showStatus('Alamat berhasil terdeteksi! Silakan periksa dan edit jika perlu.', 'success');
                    })
                    .catch(() => {
                        showStatus('Gagal mengambil detail alamat. Silakan isi manual.', 'warn');
                    })
                    .finally(() => {
                        btn.disabled = false;
                        btnText.innerHTML = 'Gunakan Lokasi Terkini (GPS)';
                    });
                },
                function(err) {
                    btn.disabled = false;
                    btnText.innerHTML = 'Gunakan Lokasi Terkini (GPS)';
                    if (err.code === 1) {
                        showStatus('Izin lokasi ditolak. Aktifkan izin lokasi di browser Anda.', 'error');
                    } else {
                        showStatus('Gagal mendeteksi lokasi. Coba lagi atau isi manual.', 'error');
                    }
                },
                { timeout: 10000, enableHighAccuracy: true }
            );
        }

        function showStatus(msg, type) {
            const el = document.getElementById('status-lokasi');
            el.classList.remove('hidden');
            const styles = {
                info:    'bg-blue-50 text-blue-600',
                success: 'bg-green-50 text-green-700',
                warn:    'bg-yellow-50 text-yellow-700',
                error:   'bg-red-50 text-red-600',
            };
            el.className = `text-xs text-center py-2 px-3 rounded-lg ${styles[type] || styles.info}`;
            el.innerText = msg;
        }

        // ── Ongkos Kirim ───────────────────────────────────────
        const subtotal     = {{ $harga * $qty }};
        const biayaLayanan = 1000;
        let currentOngkir  = 15000;

        function updateOngkirRadio(radioElem) {
            document.querySelectorAll('.shipping-label').forEach(label => {
                label.classList.remove('border-pink-500', 'bg-pink-50');
                label.classList.add('border-gray-200');
            });
            const parentLabel = radioElem.closest('.shipping-label');
            parentLabel.classList.remove('border-gray-200');
            parentLabel.classList.add('border-pink-500', 'bg-pink-50');

            const ongkir = parseInt(radioElem.value);
            currentOngkir = ongkir;
            document.getElementById('summary-ongkir').innerText = ongkir === 0 ? 'Gratis' : 'Rp ' + ongkir.toLocaleString('id-ID');

            const total = subtotal + ongkir + biayaLayanan;
            document.getElementById('total-tagihan').innerText  = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('input-total-harga').value  = total;
            document.getElementById('input-metode-pengiriman').value = radioElem.getAttribute('data-label') || 'Pengiriman';
        }

        // ── Pembayaran ──────────────────────────────────────────
        function selectPayment(clickedBtn, paymentName) {
            const buttons = document.getElementById('payment-container').querySelectorAll('.payment-btn');
            buttons.forEach(btn => {
                btn.className = 'px-4 py-2 border rounded transition border-gray-300 text-gray-600 hover:border-pink-500 hover:text-pink-600 font-medium text-sm text-center payment-btn';
                const checkmark = btn.querySelector('div.absolute');
                if (checkmark) btn.removeChild(checkmark);
            });

            clickedBtn.className = 'px-4 py-2 border rounded transition border-pink-500 text-pink-600 bg-pink-50 font-medium relative overflow-hidden group text-sm text-center payment-btn';
            clickedBtn.insertAdjacentHTML('beforeend', `
                <div class="absolute bottom-0 right-0 w-4 h-4 bg-pink-500 text-white flex items-center justify-center" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2 relative -right-[2px] bottom-[2px]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </div>`);
            document.getElementById('input-metode-pembayaran').value = paymentName || 'QRIS';
        }
    </script>

    @include('partials.bottom_nav', ['active' => 'keranjang'])
</body>
</html>
