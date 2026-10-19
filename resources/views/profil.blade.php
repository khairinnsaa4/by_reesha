<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Akun Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { background-color: #FFF8F9; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between pb-20 md:pb-8">

    <!-- NAVIGATION BAR -->
    @include('partials.navbar', ['active' => 'profil'])

    <!-- MAIN CONTAINER -->
    <main class="max-w-2xl mx-auto px-4 py-6 sm:py-10 w-full flex-grow">
        
        <!-- Header Title -->
        <div class="mb-5 sm:mb-6 text-center">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Akun Saya</h1>
            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Kelola informasi profil, alamat pengiriman, dan keamanan akun Anda</p>
        </div>

        <!-- Alert Notifikasi -->
        @if(session('sukses'))
        <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-2xl flex items-center gap-2.5 shadow-sm">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('sukses') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm rounded-2xl shadow-sm">
            <div class="flex items-center gap-2 font-bold mb-1 text-red-700">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Mohon periksa kembali:</span>
            </div>
            <ul class="list-disc list-inside text-xs space-y-0.5 text-red-600 pl-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- KARTU 1: PROFIL RINGKAS PENGGUNA -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border border-pink-100 flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-5 mb-5 transition hover:shadow-md">
            <!-- Avatar -->
            <div class="h-20 w-20 sm:h-24 sm:w-24 rounded-full bg-gradient-to-tr from-pink-500 to-rose-400 text-white shadow-md flex items-center justify-center border-4 border-pink-100 overflow-hidden flex-shrink-0">
                @if(Auth::user()->avatar)
                    <img src="{{ url('/') . '/' . Auth::user()->avatar }}" class="h-full w-full object-cover">
                @else
                    <span class="text-2xl sm:text-3xl font-extrabold tracking-wider">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                @endif
            </div>

            <!-- Detail Info -->
            <div class="text-center sm:text-left flex-grow">
                <div class="flex flex-col sm:flex-row sm:items-center gap-1.5 sm:gap-2.5">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-800 capitalize">{{ Auth::user()->name }}</h2>
                    
                    @if(Auth::user()->role === 'owner')
                        <span class="inline-block bg-gray-900 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider self-center sm:self-auto">Owner</span>
                    @elseif(Auth::user()->role === 'karyawan')
                        <span class="inline-block bg-pink-100 text-pink-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider self-center sm:self-auto">
                            Staf • {{ Auth::user()->divisi ?? 'Operasional' }}
                        </span>
                    @else
                        <span class="inline-block bg-pink-50 text-pink-600 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider border border-pink-200 self-center sm:self-auto">
                            Pelanggan
                        </span>
                    @endif
                </div>

                <p class="text-gray-500 text-xs sm:text-sm mt-1 flex items-center justify-center sm:justify-start gap-1.5">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>{{ Auth::user()->email }}</span>
                </p>

                <p class="text-gray-500 text-xs mt-1 flex items-center justify-center sm:justify-start gap-1.5">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>{{ Auth::user()->phone ? Auth::user()->phone : 'Nomor WhatsApp belum diisi' }}</span>
                </p>
            </div>
        </div>

        <!-- KARTU 2: PINTASAN UTAMA (SESUAI PERAN PENGGUNA) -->
        <div class="mb-6">
            @if(Auth::user()->role === 'owner')
                <div class="bg-gradient-to-r from-gray-900 to-black text-white rounded-2xl p-4 sm:p-5 shadow-md flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-sm sm:text-base">Dashboard Manajemen Toko</h3>
                        <p class="text-xs text-gray-300 mt-0.5">Kelola laporan penjualan, produk, dan staf</p>
                    </div>
                    <a href="/dashboard-owner" class="bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs sm:text-sm px-4 py-2 rounded-xl transition flex items-center gap-1.5 flex-shrink-0">
                        <span>Buka Dashboard</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            @elseif(Auth::user()->role === 'karyawan')
                <div class="space-y-3">
                    <a href="/dashboard-karyawan" class="bg-gray-900 hover:bg-black text-white rounded-2xl p-4 shadow-md flex items-center justify-between transition">
                        <div>
                            <h3 class="font-bold text-sm">Dashboard Karyawan</h3>
                            <p class="text-xs text-gray-300 mt-0.5">Kelola status pesanan & logistik harian</p>
                        </div>
                        <span class="text-pink-400 font-bold text-xs flex items-center gap-1">Masuk →</span>
                    </a>
                    @if(Auth::user()->isPembuatKue())
                    <a href="/resep" class="bg-pink-600 hover:bg-pink-700 text-white rounded-2xl p-4 shadow-md shadow-pink-100 flex items-center justify-between transition">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-pink-700 rounded-xl">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-sm">Buku Resep & Bahan Kue</h3>
                                <p class="text-xs text-pink-100">Panduan takaran & bahan baku produksi</p>
                            </div>
                        </div>
                        <span class="text-white font-bold text-xs">Buka →</span>
                    </a>
                    @endif
                </div>
            @else
                <!-- Pintasan Khusus Pelanggan: Riwayat Pesanan & Keranjang -->
                <div class="grid grid-cols-2 gap-3 sm:gap-4">
                    <a href="/riwayat-transaksi" class="bg-white hover:bg-pink-50/50 border border-pink-100 rounded-2xl p-3.5 sm:p-4 shadow-xs transition hover:shadow-sm flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm text-gray-800 group-hover:text-pink-600 transition">Riwayat Pesanan</h3>
                            <p class="text-[11px] text-gray-400 mt-0.5">Status pembelian kue</p>
                        </div>
                    </a>

                    <a href="/keranjang" class="bg-white hover:bg-pink-50/50 border border-pink-100 rounded-2xl p-3.5 sm:p-4 shadow-xs transition hover:shadow-sm flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm text-gray-800 group-hover:text-pink-600 transition">Keranjang Belanja</h3>
                            <p class="text-[11px] text-gray-400 mt-0.5">Lihat pesanan siap checkout</p>
                        </div>
                    </a>
                </div>
            @endif
        </div>

        <!-- KARTU 3: PUSAT PENGATURAN AKUN (PENTING & HARUS) -->
        <div class="bg-white rounded-3xl shadow-sm border border-pink-100 overflow-hidden mb-6">
            
            <!-- Tab Navigation Header -->
            <div class="border-b border-pink-100 bg-pink-50/40 p-2 flex items-center gap-1 sm:gap-2">
                @php
                    $initialTab = session('active_tab') ?? ($errors->has('current_password') || $errors->has('new_password') ? 'keamanan' : ($errors->has('address') ? 'alamat' : 'data-diri'));
                @endphp
                
                {{-- Tab 1: Data Diri --}}
                <button type="button" onclick="switchSettingTab('data-diri')" id="tab-btn-data-diri" class="flex-1 py-2 sm:py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition flex items-center justify-center gap-1.5 {{ $initialTab === 'data-diri' ? 'bg-white text-pink-600 shadow-xs' : 'text-gray-500 hover:text-pink-600' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Data Diri</span>
                </button>

                {{-- Tab 2: Alamat Pengiriman --}}
                <button type="button" onclick="switchSettingTab('alamat')" id="tab-btn-alamat" class="flex-1 py-2 sm:py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition flex items-center justify-center gap-1.5 {{ $initialTab === 'alamat' ? 'bg-white text-pink-600 shadow-xs' : 'text-gray-500 hover:text-pink-600' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Alamat</span>
                </button>

                {{-- Tab 3: Keamanan --}}
                <button type="button" onclick="switchSettingTab('keamanan')" id="tab-btn-keamanan" class="flex-1 py-2 sm:py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition flex items-center justify-center gap-1.5 {{ $initialTab === 'keamanan' ? 'bg-white text-pink-600 shadow-xs' : 'text-gray-500 hover:text-pink-600' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>Keamanan</span>
                </button>
            </div>

            <!-- Content Panel Tab -->
            <div class="p-5 sm:p-6">
                
                {{-- PANEL 1: DATA DIRI --}}
                <div id="panel-data-diri" class="{{ $initialTab === 'data-diri' ? 'block' : 'hidden' }}">
                    <div class="mb-4">
                        <h3 class="text-sm sm:text-base font-bold text-gray-800">Informasi Pribadi & Kontak</h3>
                        <p class="text-xs text-gray-500">Perbarui nama dan nomor WhatsApp untuk mempermudah konfirmasi pesanan kue.</p>
                    </div>

                    <form action="/profil/update" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-pink-600">*</span></label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full text-xs sm:text-sm border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nomor WhatsApp / HP</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Contoh: 082141519323" class="w-full text-xs sm:text-sm border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:outline-none transition">
                            <span class="text-[11px] text-gray-400 mt-1 block">Digunakan kurir & baker untuk konfirmasi pengiriman.</span>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                            <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-gray-600">
                                <span>{{ Auth::user()->email }}</span>
                                <span class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-md">Terdaftar</span>
                            </div>
                            <span class="text-[11px] text-gray-400 mt-1 block">Email akun Anda terhubung untuk login sistem.</span>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs sm:text-sm py-3 rounded-xl shadow-md shadow-pink-100 transition">
                                Simpan Perubahan Data Diri
                            </button>
                        </div>
                    </form>
                </div>

                {{-- PANEL 2: ALAMAT PENGIRIMAN --}}
                <div id="panel-alamat" class="{{ $initialTab === 'alamat' ? 'block' : 'hidden' }}">
                    <div class="mb-4">
                        <h3 class="text-sm sm:text-base font-bold text-gray-800">Alamat Pengiriman Utama</h3>
                        <p class="text-xs text-gray-500">Alamat ini otomatis digunakan saat Anda checkout pemesanan kue.</p>
                    </div>

                    <form action="/profil/update-alamat-form" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Lengkap <span class="text-pink-600">*</span></label>
                            <textarea name="address" rows="3" required placeholder="Tuliskan nama jalan, no. rumah, RT/RW, kelurahan, patokan (Kota Lhokseumawe/Aceh)..." class="w-full text-xs sm:text-sm border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:outline-none transition">{{ old('address', Auth::user()->address) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">No. Telepon Penerima</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="0821xxxx" class="w-full text-xs sm:text-sm border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:outline-none transition">
                        </div>

                        <div class="p-3 bg-pink-50/60 rounded-xl border border-pink-100 text-[11px] text-gray-600 flex items-start gap-2">
                            <svg class="w-4 h-4 text-pink-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Pastikan alamat mencantumkan patokan jelas agar kurir dapat mengantar cake dalam kondisi aman dan tepat waktu.</span>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs sm:text-sm py-3 rounded-xl shadow-md shadow-pink-100 transition">
                                Simpan Alamat Pengiriman
                            </button>
                        </div>
                    </form>
                </div>

                {{-- PANEL 3: KEAMANAN (GANTI SANDI) --}}
                <div id="panel-keamanan" class="{{ $initialTab === 'keamanan' ? 'block' : 'hidden' }}">
                    <div class="mb-4">
                        <h3 class="text-sm sm:text-base font-bold text-gray-800">Ubah Kata Sandi</h3>
                        <p class="text-xs text-gray-500">Perbarui kata sandi secara berkala untuk menjaga keamanan akun Anda.</p>
                    </div>

                    <form action="/profil/update-password" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Kata Sandi Saat Ini <span class="text-pink-600">*</span></label>
                            <input type="password" name="current_password" required placeholder="Masukkan kata sandi lama" class="w-full text-xs sm:text-sm border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Kata Sandi Baru <span class="text-pink-600">*</span></label>
                            <input type="password" name="new_password" required placeholder="Minimal 6 karakter" class="w-full text-xs sm:text-sm border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Konfirmasi Kata Sandi Baru <span class="text-pink-600">*</span></label>
                            <input type="password" name="new_password_confirmation" required placeholder="Ulangi kata sandi baru" class="w-full text-xs sm:text-sm border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:outline-none transition">
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs sm:text-sm py-3 rounded-xl shadow-md shadow-pink-100 transition">
                                Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- KARTU 4: BANTUAN & LOGOUT -->
        <div class="bg-white rounded-3xl p-5 shadow-sm border border-pink-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3 text-center sm:text-left">
                <div class="w-10 h-10 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-xs sm:text-sm text-gray-800">Butuh Bantuan Pesanan?</h4>
                    <p class="text-[11px] text-gray-400">Hubungi tim customer service By.Reesha</p>
                </div>
            </div>
            
            <a href="https://wa.me/6282141519323" target="_blank" class="w-full sm:w-auto text-center bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold text-xs px-4 py-2.5 rounded-xl border border-emerald-200 transition">
                Chat WhatsApp
            </a>
        </div>

        <!-- TOMBOL KELUAR & KEMBALI KE BERANDA -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="/" class="w-full sm:w-auto text-center border border-gray-200 text-gray-600 hover:bg-gray-100 font-bold text-xs sm:text-sm py-2.5 px-6 rounded-xl transition">
                ← Kembali ke Beranda
            </a>

            <form action="/logout" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari akun?')">
                @csrf
                <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-bold text-xs sm:text-sm py-2.5 px-6 rounded-xl transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar dari Akun</span>
                </button>
            </form>
        </div>

    </main>

    <!-- TAB SWITCHING SCRIPT -->
    <script>
        function switchSettingTab(tabName) {
            const tabs = ['data-diri', 'alamat', 'keamanan'];
            
            tabs.forEach(tab => {
                const btn = document.getElementById('tab-btn-' + tab);
                const panel = document.getElementById('panel-' + tab);
                
                if (tab === tabName) {
                    panel.classList.remove('hidden');
                    panel.classList.add('block');
                    btn.className = 'flex-1 py-2 sm:py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition flex items-center justify-center gap-1.5 bg-white text-pink-600 shadow-xs';
                } else {
                    panel.classList.add('hidden');
                    panel.classList.remove('block');
                    btn.className = 'flex-1 py-2 sm:py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition flex items-center justify-center gap-1.5 text-gray-500 hover:text-pink-600';
                }
            });
        }
    </script>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>