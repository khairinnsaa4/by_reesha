{{-- ========================================================================= --}}
{{-- BY.REESHA MAIN NAVIGATION BAR (Desktop & Mobile)                          --}}
{{-- ========================================================================= --}}
@php
    $currentActive = $active ?? '';
@endphp

<nav class="bg-white shadow-sm border-b border-pink-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
        
        <!-- Logo & Brand -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-12 w-12 sm:h-14 sm:w-14 object-contain rounded-full bg-pink-100 shadow-md ring-2 ring-pink-200/80 p-0.5 transition-transform hover:scale-105" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'56\' height=\'56\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
            <a href="/" class="text-xl sm:text-2xl md:text-3xl font-extrabold text-pink-600 tracking-wider hover:text-pink-700 transition">BY.REESHA</a>
        </div>

        <!-- Desktop Navigation Links (With Matching Sleek SVG Icons) -->
        <div class="hidden md:flex items-center gap-7 text-sm font-semibold">
            
            {{-- 1. HOME --}}
            <a href="/" class="flex items-center gap-1.5 transition pb-1 {{ $currentActive === 'home' ? 'text-pink-600 border-b-2 border-pink-600 font-bold' : 'text-gray-600 hover:text-pink-600' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="{{ $currentActive === 'home' ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>HOME</span>
            </a>

            {{-- 2. SEMUA PRODUK --}}
            <a href="/produk" class="flex items-center gap-1.5 transition pb-1 {{ $currentActive === 'produk' ? 'text-pink-600 border-b-2 border-pink-600 font-bold' : 'text-gray-600 hover:text-pink-600' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="{{ $currentActive === 'produk' ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>SEMUA PRODUK</span>
            </a>

            {{-- 3. KERANJANG --}}
            <a href="/keranjang" class="flex items-center gap-1.5 transition pb-1 relative {{ $currentActive === 'keranjang' ? 'text-pink-600 border-b-2 border-pink-600 font-bold' : 'text-gray-600 hover:text-pink-600' }}">
                <div class="relative">
                    <svg class="w-4 h-4 flex-shrink-0" fill="{{ $currentActive === 'keranjang' ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span id="desktop-nav-cart-badge" class="hidden absolute -top-2 -right-2 bg-pink-600 text-white text-[9px] font-bold rounded-full h-3.5 min-w-[14px] px-1 flex items-center justify-center">0</span>
                </div>
                <span>KERANJANG</span>
            </a>

            {{-- 4. KONTAK KAMI --}}
            <a href="/kontak" class="flex items-center gap-1.5 transition pb-1 {{ $currentActive === 'kontak' ? 'text-pink-600 border-b-2 border-pink-600 font-bold' : 'text-gray-600 hover:text-pink-600' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="{{ $currentActive === 'kontak' ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span>KONTAK KAMI</span>
            </a>
        </div>

        <!-- Desktop Auth Section -->
        <div class="hidden md:flex items-center gap-3">
           @auth
                <a href="/profil" class="text-sm font-semibold text-gray-700 bg-pink-50 px-3.5 py-1.5 rounded-xl border border-pink-100 hover:bg-pink-100 transition flex items-center gap-2">
                    <svg class="w-4 h-4 text-pink-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Halo, <strong class="text-pink-600">{{ Auth::user()->name }}</strong></span>
                </a>
                
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-gray-400 hover:text-red-500 transition px-2 py-1">
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

        <!-- Mobile Action Buttons (Cart & Hamburger) -->
        <div class="flex items-center gap-2 md:hidden">
            <a href="/keranjang" class="p-2 text-gray-600 hover:text-pink-600 transition rounded-xl hover:bg-pink-50 relative" aria-label="Keranjang">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span id="mobile-top-cart-badge" class="hidden absolute top-1 right-1 bg-pink-600 text-white text-[9px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center border border-white">0</span>
            </a>
            
            <button type="button" id="mobile-menu-btn" class="p-2 text-gray-700 hover:text-pink-600 rounded-xl hover:bg-pink-50 transition focus:outline-none" aria-label="Buka Menu Akun">
                <svg id="hamburger-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Menu Drawer (Fokus Akun & Tindakan Cepat - Tanpa Duplikasi Menu Bawah) -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-pink-100 bg-white/98 backdrop-blur-md px-4 py-4 space-y-3 shadow-xl">
        @auth
            {{-- User Profile Card --}}
            <div class="bg-gradient-to-r from-pink-50 to-pink-100/60 p-3.5 rounded-2xl border border-pink-200/70 flex items-center gap-3">
                <div class="w-11 h-11 rounded-full bg-pink-600 text-white flex items-center justify-center text-base font-bold shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-gray-800 text-sm truncate">{{ Auth::user()->name }}</h4>
                    <p class="text-xs text-pink-600 font-medium capitalize">{{ Auth::user()->role === 'karyawan' ? (Auth::user()->divisi ? 'Divisi ' . Auth::user()->divisi : 'Karyawan') : Auth::user()->role }}</p>
                    <p class="text-[11px] text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            {{-- Quick Action Links --}}
            <div class="space-y-1.5 pt-1">
                <a href="/profil" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gray-50 hover:bg-pink-50 text-gray-700 hover:text-pink-600 transition text-sm font-semibold">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Akun Saya & Alamat</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                @if(Auth::user()->role === 'pelanggan')
                <a href="/riwayat-transaksi" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gray-50 hover:bg-pink-50 text-gray-700 hover:text-pink-600 transition text-sm font-semibold">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Riwayat Pesanan & Status</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endif

                @if(Auth::user()->role === 'owner')
                <a href="/dashboard-owner" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gray-900 text-white hover:bg-black transition text-sm font-semibold shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        <span>Dashboard Owner</span>
                    </div>
                    <span class="text-xs bg-pink-600 px-2 py-0.5 rounded-full text-white font-bold">Owner</span>
                </a>
                @elseif(Auth::user()->role === 'karyawan')
                <a href="/pemesanan" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gray-900 text-white hover:bg-black transition text-sm font-semibold shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Dashboard Pemesanan</span>
                    </div>
                    <span class="text-xs bg-pink-600 px-2 py-0.5 rounded-full text-white font-bold">Staf</span>
                </a>
                    @if(Auth::user()->isPembuatKue())
                    <a href="/resep" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-pink-50 text-pink-700 hover:bg-pink-100 transition text-sm font-semibold border border-pink-200">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span>Buku Resep Kue</span>
                        </div>
                        <span class="text-[10px] bg-pink-200 text-pink-800 px-2 py-0.5 rounded-full font-bold">Baker</span>
                    </a>
                    @endif
                @endif
            </div>

            <form action="/logout" method="POST" class="w-full pt-1">
                @csrf
                <button type="submit" class="w-full text-center text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 py-2.5 rounded-xl transition flex items-center justify-center gap-2 border border-red-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar dari Akun</span>
                </button>
            </form>
        @else
            {{-- Guest State in Drawer --}}
            <div class="text-center py-2">
                <h4 class="font-bold text-gray-800 text-sm">Selamat Datang di By.Reesha</h4>
                <p class="text-xs text-gray-500 mt-0.5">Silakan masuk atau buat akun baru untuk memesan</p>
            </div>
            <div class="grid grid-cols-2 gap-2 pt-1">
                <a href="/login" class="text-center text-sm font-bold text-pink-600 py-2.5 border border-pink-200 rounded-xl hover:bg-pink-50 transition flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    <span>Masuk</span>
                </a>
                <a href="/register" class="text-center text-sm font-bold bg-pink-600 text-white py-2.5 rounded-xl shadow-md shadow-pink-100 hover:bg-pink-700 transition flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    <span>Daftar</span>
                </a>
            </div>
        @endauth
    </div>
</nav>

<script>
    (function() {
        // Toggle mobile drawer
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                if (hamburgerIcon) hamburgerIcon.classList.toggle('hidden');
                if (closeIcon) closeIcon.classList.toggle('hidden');
            });
        }

        // Live update cart badge in desktop nav and mobile top icon
        function updateNavCartBadges() {
            try {
                const cart = JSON.parse(localStorage.getItem('my_cart') || '[]');
                const desktopBadge = document.getElementById('desktop-nav-cart-badge');
                const mobileTopBadge = document.getElementById('mobile-top-cart-badge');
                const count = cart.length;

                [desktopBadge, mobileTopBadge].forEach(badge => {
                    if (badge) {
                        if (count > 0) {
                            badge.innerText = count;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    }
                });
            } catch (e) {}
        }
        document.addEventListener('DOMContentLoaded', updateNavCartBadges);
        window.addEventListener('storage', updateNavCartBadges);
    })();
</script>
