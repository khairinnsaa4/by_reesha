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
    <main class="max-w-xl mx-auto px-4 py-6 sm:py-8 w-full flex-grow">
        
        <!-- HEADER IDENTITAS PENGGUNA BY.REESHA -->
        <div class="bg-white rounded-3xl p-5 shadow-sm border border-pink-100 flex items-center gap-4 mb-4">
            <div class="relative flex-shrink-0">
                <div id="header-avatar-container" class="h-16 w-16 sm:h-20 sm:w-20 rounded-full bg-gradient-to-tr from-pink-500 to-rose-400 text-white shadow-md flex items-center justify-center border-2 border-pink-100 overflow-hidden">
                    @if(Auth::user()->avatar)
                        <img id="header-avatar-img" src="{{ asset(Auth::user()->avatar) }}" class="h-full w-full object-cover">
                    @else
                        <span id="header-avatar-initial" class="text-2xl font-bold uppercase tracking-wider">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    @endif
                </div>
                <!-- Tombol Kamera Cepat untuk Ganti Foto -->
                <button type="button" onclick="openProfileEdit()" class="absolute -bottom-1 -right-1 w-7 h-7 bg-pink-600 hover:bg-pink-700 text-white rounded-full flex items-center justify-center shadow-md border-2 border-white transition transform hover:scale-110 active:scale-95" title="Ganti Foto Profil">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>

            <div class="flex-grow min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-gray-800 truncate capitalize">{{ Auth::user()->name }}</h2>
                    @if(Auth::user()->role === 'owner')
                        <span class="bg-gray-900 text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Owner</span>
                    @elseif(Auth::user()->role === 'karyawan')
                        <span class="bg-pink-100 text-pink-700 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Staf</span>
                    @else
                        <span class="bg-pink-50 text-pink-600 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase border border-pink-100">Member</span>
                    @endif
                </div>
                <p class="text-gray-400 text-xs truncate mt-0.5">{{ Auth::user()->email }}</p>
                @if(Auth::user()->phone)
                    <p class="text-gray-500 text-xs truncate mt-0.5">{{ Auth::user()->phone }}</p>
                @endif
                <button type="button" onclick="openProfileEdit()" class="inline-flex items-center gap-1 text-[11px] font-semibold text-pink-600 hover:text-pink-700 mt-1">
                    <span>Ubah Profil & Foto</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <!-- NOTIFIKASI SUKSES / ERROR -->
        @if(session('sukses'))
        <div class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-2xl flex items-center gap-2.5 shadow-xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('sukses') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-4 p-3.5 bg-red-50 border border-red-200 text-red-800 text-xs rounded-2xl shadow-xs">
            <div class="flex items-center gap-1.5 font-bold mb-1 text-red-700">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Mohon periksa kembali:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- AKSES KHUSUS OWNER & KARYAWAN -->
        @if(Auth::user()->role === 'owner')
            <div class="mb-4">
                <a href="/dashboard-owner" class="flex items-center justify-between p-4 bg-gray-900 hover:bg-black text-white rounded-2xl shadow-sm transition">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gray-800 flex items-center justify-center text-pink-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm">Panel Manajemen Owner</h3>
                            <p class="text-[11px] text-gray-300">Laporan penjualan, keuangan & staf</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        @elseif(Auth::user()->role === 'karyawan')
            <div class="mb-4">
                <a href="/dashboard-karyawan" class="flex items-center justify-between p-4 bg-gray-900 hover:bg-black text-white rounded-2xl shadow-sm transition">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gray-800 flex items-center justify-center text-pink-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm">Panel Operasional Karyawan</h3>
                            <p class="text-[11px] text-gray-300">Kelola antrean kue & pesanan harian</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        @endif

        <!-- DAFTAR MENU UTAMA AKUN (BERSIH, RAPI, ACCORDION BY.REESHA) -->
        <div class="bg-white rounded-3xl shadow-sm border border-pink-100 overflow-hidden divide-y divide-gray-100 mb-6">
            
            {{-- 1. PESANAN SAYA --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('pesanan')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-gray-800 text-sm sm:text-base block">Pesanan Saya</span>
                            <span class="text-[11px] text-gray-400 block">Riwayat transaksi & status kue yang dipesan</span>
                        </div>
                    </div>
                    <svg id="chevron-pesanan" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-pesanan" class="menu-drawer hidden px-5 pb-5 pt-3 bg-pink-50/20 border-t border-gray-100">
                    <div class="bg-white p-3.5 rounded-2xl border border-pink-100 mb-3 flex items-center justify-between text-xs">
                        <span class="text-gray-600">Total Transaksi Selesai</span>
                        <strong class="text-pink-600 font-extrabold text-sm">{{ Auth::user()->transaksis()->count() }} Pesanan</strong>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="/riwayat-transaksi" class="text-center bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs py-2.5 px-3 rounded-xl shadow-xs transition">
                            Lihat Riwayat Pesanan
                        </a>
                        <a href="/produk" class="text-center bg-white hover:bg-pink-50 text-pink-600 border border-pink-200 font-bold text-xs py-2.5 px-3 rounded-xl transition">
                            Pesan Kue Baru
                        </a>
                    </div>
                </div>
            </div>

            {{-- 2. ALAMAT PENGIRIMAN --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('alamat')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-gray-800 text-sm sm:text-base block">Alamat Pengiriman</span>
                            <span class="text-[11px] text-gray-400 block">Tujuan pengantaran kue & patokan rumah</span>
                        </div>
                    </div>
                    <svg id="chevron-alamat" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-alamat" class="menu-drawer hidden px-5 pb-5 pt-3 bg-pink-50/20 border-t border-gray-100">
                    <form action="/profil/update-alamat-form" method="POST" class="space-y-3 pt-1">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Lengkap Pengiriman <span class="text-pink-600">*</span></label>
                            <textarea name="address" rows="3" required placeholder="Contoh: Jl. Merdeka No. 12, Gampong Kuta Blang, Lhokseumawe (Depan Toko Beras)" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:outline-none transition">{{ old('address', Auth::user()->address) }}</textarea>
                            <span class="text-[11px] text-gray-400 mt-0.5 block">Alamat ini otomatis muncul di formulir checkout kue Anda.</span>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">No. WhatsApp / HP Penerima</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="0821xxxx" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition">
                            Simpan Alamat Pengiriman
                        </button>
                    </form>
                </div>
            </div>

            {{-- 3. INFORMASI AKUN (DATA DIRI) --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('profil')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-gray-800 text-sm sm:text-base block">Informasi Akun</span>
                            <span class="text-[11px] text-gray-400 block">Nama lengkap & nomor kontak pelanggan</span>
                        </div>
                    </div>
                    <svg id="chevron-profil" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-profil" class="menu-drawer hidden px-5 pb-5 pt-3 bg-pink-50/20 border-t border-gray-100">
                    <form action="/profil/update" method="POST" enctype="multipart/form-data" class="space-y-4 pt-1">
                        @csrf

                        <!-- UPLOAD & KELOLA FOTO PROFIL -->
                        <div class="bg-white p-3.5 rounded-2xl border border-pink-100">
                            <label class="block text-xs font-bold text-gray-700 mb-2">Foto Profil Pengguna</label>
                            <div class="flex items-center gap-3.5">
                                <!-- Lingkaran Avatar Preview -->
                                <div class="relative w-14 h-14 rounded-full overflow-hidden bg-pink-100 flex-shrink-0 border-2 border-pink-200 flex items-center justify-center">
                                    <img id="avatar-preview-img" 
                                         src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : '' }}" 
                                         class="w-full h-full object-cover {{ Auth::user()->avatar ? '' : 'hidden' }}"
                                         alt="Avatar Preview">
                                    <span id="avatar-preview-fallback" class="text-lg font-bold text-pink-600 uppercase {{ Auth::user()->avatar ? 'hidden' : '' }}">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <input type="file" id="avatar-input" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" onchange="previewAvatar(event)">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <button type="button" onclick="document.getElementById('avatar-input').click()" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-pink-50 hover:bg-pink-100 text-pink-600 border border-pink-200 text-xs font-semibold rounded-xl transition cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            <span>Pilih Foto Baru</span>
                                        </button>

                                        @if(Auth::user()->avatar)
                                            <label class="inline-flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer select-none">
                                                <input type="checkbox" name="hapus_avatar" value="1" id="hapus-avatar-cb" onchange="toggleHapusAvatar(this)" class="rounded text-red-600 focus:ring-red-400">
                                                <span>Hapus Foto</span>
                                            </label>
                                        @endif
                                    </div>
                                    <p id="avatar-filename-label" class="text-[10px] text-gray-400 mt-1 truncate">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap <span class="text-pink-600">*</span></label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor WhatsApp / HP</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Contoh: 0821xxxx" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Email Terdaftar</label>
                            <input type="email" value="{{ Auth::user()->email }}" disabled class="w-full text-xs sm:text-sm bg-gray-100 text-gray-500 border border-gray-200 rounded-xl px-3.5 py-2 cursor-not-allowed">
                        </div>
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span>Simpan Perubahan</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- 4. KEAMANAN & KATA SANDI --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('keamanan')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-gray-800 text-sm sm:text-base block">Keamanan & Sandi</span>
                            <span class="text-[11px] text-gray-400 block">Ubah kata sandi akun secara berkala</span>
                        </div>
                    </div>
                    <svg id="chevron-keamanan" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-keamanan" class="menu-drawer hidden px-5 pb-5 pt-3 bg-pink-50/20 border-t border-gray-100">
                    <form action="/profil/update-password" method="POST" class="space-y-3 pt-1">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Kata Sandi Saat Ini <span class="text-pink-600">*</span></label>
                            <input type="password" name="current_password" required placeholder="Masukkan kata sandi lama" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Kata Sandi Baru <span class="text-pink-600">*</span></label>
                            <input type="password" name="new_password" required placeholder="Minimal 6 karakter" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Ulangi Kata Sandi Baru <span class="text-pink-600">*</span></label>
                            <input type="password" name="new_password_confirmation" required placeholder="Konfirmasi kata sandi baru" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition">
                            Perbarui Kata Sandi
                        </button>
                    </form>
                </div>
            </div>

            {{-- 5. PUSAT BANTUAN PELANGGAN --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('bantuan')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-gray-800 text-sm sm:text-base block">Bantuan & Customer Service</span>
                            <span class="text-[11px] text-gray-400 block">Konsultasi custom cake & kendala pesanan</span>
                        </div>
                    </div>
                    <svg id="chevron-bantuan" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-bantuan" class="menu-drawer hidden px-5 pb-5 pt-3 bg-pink-50/20 border-t border-gray-100">
                    <p class="text-xs text-gray-600 mb-3 leading-relaxed">
                        Punya pertanyaan seputar pesanan kue, desain custom, atau jadwal pengiriman? Tim By.Reesha siap membantu Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <a href="https://wa.me/6282141519323" target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-2.5 px-3 rounded-xl shadow-xs transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>Chat WhatsApp Toko</span>
                        </a>
                        <a href="https://maps.app.goo.gl/t5yQ2WQuSXwbEUbA6" target="_blank" class="text-center bg-white hover:bg-pink-50 text-pink-600 border border-pink-200 font-bold text-xs py-2.5 px-3 rounded-xl transition flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Lokasi Toko di Maps</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- 6. KELUAR DARI AKUN --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('keluar')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-red-50/50 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-red-600 text-sm sm:text-base block">Keluar dari Akun</span>
                            <span class="text-[11px] text-gray-400 block">Akhiri sesi akun Anda di perangkat ini</span>
                        </div>
                    </div>
                    <svg id="chevron-keluar" class="w-4 h-4 text-red-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-keluar" class="menu-drawer hidden px-5 pb-5 pt-3 bg-red-50/20 border-t border-red-100">
                    <p class="text-xs text-gray-600 mb-3">Apakah Anda yakin ingin keluar dari akun By.Reesha?</p>
                    <div class="flex items-center gap-2">
                        <form action="/logout" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition">
                                Ya, Keluar Sekarang
                            </button>
                        </form>
                        <button type="button" onclick="toggleMenu('keluar')" class="px-4 py-2.5 bg-white hover:bg-gray-100 border border-gray-200 text-gray-600 font-semibold text-xs rounded-xl transition">
                            Batal
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- TAUTAN KEMBALI KE BERANDA -->
        <div class="text-center text-xs text-gray-400">
            <a href="/" class="hover:text-pink-600 transition font-medium inline-flex items-center gap-1">
                <span>← Kembali ke Beranda</span>
            </a>
        </div>

    </main>

    <!-- SCRIPT ACCORDION INTERAKTIF (KLIK UNTUK MUNCULKAN OPSI) -->
    <script>
        function toggleMenu(menuKey) {
            const targetDrawer = document.getElementById('drawer-' + menuKey);
            const targetChevron = document.getElementById('chevron-' + menuKey);
            if (!targetDrawer) return;
            const isCurrentlyHidden = targetDrawer.classList.contains('hidden');

            // Tutup semua drawer terlebih dahulu agar tetap rapi dan tidak semak
            document.querySelectorAll('.menu-drawer').forEach(drawer => {
                drawer.classList.add('hidden');
            });
            document.querySelectorAll('.chevron-icon').forEach(chevron => {
                chevron.classList.remove('rotate-90');
            });

            // Jika sebelumnya tertutup, maka buka drawer yang diklik
            if (isCurrentlyHidden) {
                targetDrawer.classList.remove('hidden');
                if (targetChevron) targetChevron.classList.add('rotate-90');
            }
        }

        // Buka langsung menu Informasi Akun (Data Diri & Foto)
        function openProfileEdit() {
            const targetDrawer = document.getElementById('drawer-profil');
            const targetChevron = document.getElementById('chevron-profil');
            if (targetDrawer && targetDrawer.classList.contains('hidden')) {
                toggleMenu('profil');
            }
            setTimeout(() => {
                if (targetDrawer) {
                    targetDrawer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }, 100);
        }

        // Preview langsung foto profil saat dipilih
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (file) {
                // Validasi ukuran maks 2MB (2 * 1024 * 1024 byte)
                if (file.size > 2097152) {
                    alert('Ukuran foto terlalu besar! Maksimal 2MB.');
                    event.target.value = '';
                    return;
                }

                // Update text label nama file
                const label = document.getElementById('avatar-filename-label');
                if (label) {
                    label.textContent = 'Dipilih: ' + file.name;
                    label.classList.add('text-pink-600', 'font-medium');
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update preview thumbnail di drawer
                    const drawerImg = document.getElementById('avatar-preview-img');
                    const drawerFallback = document.getElementById('avatar-preview-fallback');
                    if (drawerImg) {
                        drawerImg.src = e.target.result;
                        drawerImg.classList.remove('hidden');
                    }
                    if (drawerFallback) {
                        drawerFallback.classList.add('hidden');
                    }

                    // Update preview di kartu profil atas
                    const headerContainer = document.getElementById('header-avatar-container');
                    if (headerContainer) {
                        headerContainer.innerHTML = `<img src="${e.target.result}" class="h-full w-full object-cover">`;
                    }

                    // Uncheck checkbox hapus foto jika sebelumnya dicentang
                    const hapusCb = document.getElementById('hapus-avatar-cb');
                    if (hapusCb) hapusCb.checked = false;
                };
                reader.readAsDataURL(file);
            }
        }

        // Toggle opsi hapus foto profil
        function toggleHapusAvatar(checkbox) {
            const drawerImg = document.getElementById('avatar-preview-img');
            const drawerFallback = document.getElementById('avatar-preview-fallback');
            const headerContainer = document.getElementById('header-avatar-container');
            const avatarInput = document.getElementById('avatar-input');
            const label = document.getElementById('avatar-filename-label');

            if (checkbox.checked) {
                if (avatarInput) avatarInput.value = '';
                if (label) {
                    label.textContent = 'Foto akan dihapus saat Anda menekan tombol simpan';
                    label.classList.remove('text-pink-600');
                    label.classList.add('text-red-500');
                }
                if (drawerImg) drawerImg.classList.add('hidden');
                if (drawerFallback) drawerFallback.classList.remove('hidden');
                if (headerContainer) {
                    headerContainer.innerHTML = `<span class="text-2xl font-bold uppercase tracking-wider">{{ substr(Auth::user()->name, 0, 1) }}</span>`;
                }
            } else {
                if (label) {
                    label.textContent = 'Format: JPG, PNG, WEBP (Maks. 2MB)';
                    label.classList.remove('text-red-500', 'text-pink-600');
                }
                @if(Auth::user()->avatar)
                    if (drawerImg) {
                        drawerImg.src = "{{ asset(Auth::user()->avatar) }}";
                        drawerImg.classList.remove('hidden');
                    }
                    if (drawerFallback) drawerFallback.classList.add('hidden');
                    if (headerContainer) {
                        headerContainer.innerHTML = `<img src="{{ asset(Auth::user()->avatar) }}" class="h-full w-full object-cover">`;
                    }
                @endif
            }
        }

        // Buka otomatis jika baru selesai submit form atau terjadi error validasi
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('active_tab') === 'data-diri')
                toggleMenu('profil');
            @elseif(session('active_tab') === 'alamat' || $errors->has('address'))
                toggleMenu('alamat');
            @elseif(session('active_tab') === 'keamanan' || $errors->has('current_password') || $errors->has('new_password'))
                toggleMenu('keamanan');
            @endif
        });
    </script>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>