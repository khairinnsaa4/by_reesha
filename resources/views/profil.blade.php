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
        
        <!-- HEADER IDENTITAS PENGGUNA (RINGKAS & TIDAK SEMAK) -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-pink-100 flex items-center gap-3.5 mb-4">
            <div class="h-14 w-14 rounded-full bg-gradient-to-tr from-pink-500 to-rose-400 text-white shadow-sm flex items-center justify-center border-2 border-pink-100 overflow-hidden flex-shrink-0">
                @if(Auth::user()->avatar)
                    <img src="{{ url('/') . '/' . Auth::user()->avatar }}" class="h-full w-full object-cover">
                @else
                    <span class="text-xl font-bold uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </span>
                @endif
            </div>

            <div class="flex-grow min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-gray-800 truncate capitalize">{{ Auth::user()->name }}</h2>
                    @if(Auth::user()->role === 'owner')
                        <span class="bg-gray-900 text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Owner</span>
                    @elseif(Auth::user()->role === 'karyawan')
                        <span class="bg-pink-100 text-pink-700 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Staf</span>
                    @endif
                </div>
                <p class="text-gray-400 text-xs truncate mt-0.5">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- NOTIFIKASI SUKSES / ERROR -->
        @if(session('sukses'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center gap-2 shadow-xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('sukses') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 text-xs rounded-xl shadow-xs">
            <div class="flex items-center gap-1.5 font-bold mb-1 text-red-700">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Perhatian:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- PINTASAN DASHBOARD STAFF / OWNER (JIKA STAF / OWNER) -->
        @if(Auth::user()->role === 'owner')
            <div class="mb-4">
                <a href="/dashboard-owner" class="flex items-center justify-between p-3.5 bg-gray-900 hover:bg-black text-white rounded-2xl shadow-sm transition">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">👑</span>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm">Buka Dashboard Owner</h3>
                            <p class="text-[11px] text-gray-300">Laporan penjualan, keuangan & manajemen</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        @elseif(Auth::user()->role === 'karyawan')
            <div class="mb-4 space-y-2">
                <a href="/dashboard-karyawan" class="flex items-center justify-between p-3.5 bg-gray-900 hover:bg-black text-white rounded-2xl shadow-sm transition">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">📋</span>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm">Buka Dashboard Karyawan</h3>
                            <p class="text-[11px] text-gray-300">Manajemen pesanan & status operasional</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @if(Auth::user()->isPembuatKue())
                <a href="/resep" class="flex items-center justify-between p-3.5 bg-pink-600 hover:bg-pink-700 text-white rounded-2xl shadow-sm shadow-pink-100 transition">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">📖</span>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm">Buku Resep & Bahan Kue</h3>
                            <p class="text-[11px] text-pink-100">Panduan takaran resep produksi</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endif
            </div>
        @endif

        <!-- MENU DAFTAR AKUN (DESAIN PERSIS CONTOH: PROFIL, PESANAN, FAVORIT, TITIK LOKASI, PENGATURAN, KELUAR) -->
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-100 overflow-hidden divide-y divide-gray-100 mb-6">
            
            {{-- 1. PROFIL --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('profil')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-gray-50/70 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-sky-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-bold text-sky-700 text-sm sm:text-base">Profil</span>
                    </div>
                    <svg id="chevron-profil" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-profil" class="menu-drawer hidden px-5 pb-5 pt-2 bg-pink-50/20 border-t border-gray-100">
                    <form action="/profil/update" method="POST" class="space-y-3.5 pt-1">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor WhatsApp / HP</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Contoh: 0821xxxx" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Email Akun</label>
                            <input type="email" value="{{ Auth::user()->email }}" disabled class="w-full text-xs sm:text-sm bg-gray-100 text-gray-500 border border-gray-200 rounded-xl px-3 py-2 cursor-not-allowed">
                        </div>
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition">
                            Simpan Perubahan Profil
                        </button>
                    </form>
                </div>
            </div>

            {{-- 2. PESANAN --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('pesanan')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-gray-50/70 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-slate-800 text-sm sm:text-base">Pesanan</span>
                    </div>
                    <svg id="chevron-pesanan" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-pesanan" class="menu-drawer hidden px-5 pb-5 pt-3 bg-pink-50/20 border-t border-gray-100">
                    <div class="bg-white p-3.5 rounded-xl border border-gray-200/80 mb-3 text-xs text-gray-600 flex items-center justify-between">
                        <span>Total Transaksi Anda</span>
                        <strong class="text-pink-600">{{ Auth::user()->transaksis()->count() }} Pesanan</strong>
                    </div>
                    <div class="space-y-2">
                        <a href="/riwayat-transaksi" class="block w-full text-center bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition">
                            Lihat Semua Riwayat Pesanan
                        </a>
                        <a href="/produk" class="block w-full text-center bg-pink-50 hover:bg-pink-100 text-pink-700 font-bold text-xs py-2 rounded-xl transition">
                            Pesan Kue Baru
                        </a>
                    </div>
                </div>
            </div>

            {{-- 3. FAVORIT --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('favorit')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-gray-50/70 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-slate-800 text-sm sm:text-base">Favorit</span>
                    </div>
                    <svg id="chevron-favorit" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-favorit" class="menu-drawer hidden px-5 pb-5 pt-3 bg-pink-50/20 border-t border-gray-100">
                    <p class="text-xs text-gray-500 mb-3">Akses cepat ke keranjang belanja kue pilihan dan produk best seller By.Reesha.</p>
                    <div class="space-y-2">
                        <a href="/keranjang" class="flex items-center justify-between bg-white border border-gray-200 p-3 rounded-xl hover:border-pink-400 text-xs font-semibold text-gray-700 transition">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Keranjang Belanja Anda
                            </span>
                            <span class="text-pink-600 font-bold">Buka →</span>
                        </a>
                        <a href="/produk" class="flex items-center justify-between bg-white border border-gray-200 p-3 rounded-xl hover:border-pink-400 text-xs font-semibold text-gray-700 transition">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                Koleksi Produk Terpopuler
                            </span>
                            <span class="text-pink-600 font-bold">Lihat →</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- 4. TITIK LOKASI --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('titik-lokasi')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-gray-50/70 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-slate-800 text-sm sm:text-base">Titik Lokasi</span>
                    </div>
                    <svg id="chevron-titik-lokasi" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-titik-lokasi" class="menu-drawer hidden px-5 pb-5 pt-2 bg-pink-50/20 border-t border-gray-100">
                    <form action="/profil/update-alamat-form" method="POST" class="space-y-3.5 pt-1">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Pengiriman Utama <span class="text-pink-600">*</span></label>
                            <textarea name="address" rows="3" required placeholder="Tuliskan nama jalan, RT/RW, kelurahan/kecamatan, dan patokan rumah..." class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3 py-2 focus:border-pink-500 focus:outline-none transition">{{ old('address', Auth::user()->address) }}</textarea>
                            <span class="text-[11px] text-gray-400 mt-0.5 block">Alamat ini otomatis digunakan saat checkout kue.</span>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">No. HP Penerima</label>
                            <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="0821xxxx" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition">
                            Simpan Titik Lokasi
                        </button>
                    </form>
                </div>
            </div>

            {{-- 5. PENGATURAN AKUN --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('pengaturan')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-gray-50/70 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-slate-800 text-sm sm:text-base">Pengaturan Akun</span>
                    </div>
                    <svg id="chevron-pengaturan" class="w-4 h-4 text-gray-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-pengaturan" class="menu-drawer hidden px-5 pb-5 pt-2 bg-pink-50/20 border-t border-gray-100">
                    <form action="/profil/update-password" method="POST" class="space-y-3 pt-1">
                        @csrf
                        <p class="text-xs text-gray-500 mb-2">Ganti kata sandi akun untuk menjaga keamanan:</p>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Kata Sandi Saat Ini <span class="text-pink-600">*</span></label>
                            <input type="password" name="current_password" required placeholder="Kata sandi lama" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Kata Sandi Baru <span class="text-pink-600">*</span></label>
                            <input type="password" name="new_password" required placeholder="Minimal 6 karakter" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Konfirmasi Kata Sandi Baru <span class="text-pink-600">*</span></label>
                            <input type="password" name="new_password_confirmation" required placeholder="Ulangi kata sandi baru" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3 py-2 focus:border-pink-500 focus:outline-none transition">
                        </div>
                        <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition">
                            Perbarui Kata Sandi
                        </button>
                    </form>
                </div>
            </div>

            {{-- 6. KELUAR AKUN --}}
            <div class="menu-block">
                <button type="button" onclick="toggleMenu('keluar')" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-red-50/50 focus:outline-none">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9"/>
                        </svg>
                        <span class="font-bold text-rose-600 text-sm sm:text-base">Keluar Akun</span>
                    </div>
                    <svg id="chevron-keluar" class="w-4 h-4 text-rose-400 chevron-icon transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div id="drawer-keluar" class="menu-drawer hidden px-5 pb-5 pt-3 bg-red-50/30 border-t border-red-100">
                    <p class="text-xs text-gray-600 mb-3">Apakah Anda yakin ingin keluar dari akun By.Reesha?</p>
                    <div class="flex items-center gap-2">
                        <form action="/logout" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold text-xs py-2.5 rounded-xl shadow-xs transition">
                                Ya, Keluar Akun
                            </button>
                        </form>
                        <button type="button" onclick="toggleMenu('keluar')" class="px-4 py-2.5 bg-white hover:bg-gray-100 border border-gray-200 text-gray-600 font-semibold text-xs rounded-xl transition">
                            Batal
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- BANTUAN WHATSAPP & KEMBALI KE BERANDA -->
        <div class="flex items-center justify-between text-xs text-gray-500 px-2">
            <a href="/" class="hover:text-pink-600 transition font-medium">
                ← Kembali ke Beranda
            </a>
            <a href="https://wa.me/6282141519323" target="_blank" class="text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1">
                <span>Bantuan Customer Service</span>
                <span class="text-emerald-500">↗</span>
            </a>
        </div>

    </main>

    <!-- SCRIPT ACCORDION TOGGLE (KLIK UNTUK MUNCULKAN OPSI) -->
    <script>
        function toggleMenu(menuKey) {
            const targetDrawer = document.getElementById('drawer-' + menuKey);
            const targetChevron = document.getElementById('chevron-' + menuKey);
            const isCurrentlyHidden = targetDrawer.classList.contains('hidden');

            // Tutup semua drawer agar tetap rapi dan tidak semak
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

        // Otomatis buka drawer jika ada error atau baru selesai update
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('active_tab') === 'data-diri')
                toggleMenu('profil');
            @elseif(session('active_tab') === 'alamat' || $errors->has('address'))
                toggleMenu('titik-lokasi');
            @elseif(session('active_tab') === 'keamanan' || $errors->has('current_password') || $errors->has('new_password'))
                toggleMenu('pengaturan');
            @endif
        });
    </script>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>