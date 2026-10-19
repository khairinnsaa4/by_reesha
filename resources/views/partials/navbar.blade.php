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
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="{{ $currentActive === 'keranjang' ? '2.4' : '2' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span id="desktop-nav-cart-badge" class="hidden absolute -top-2 -right-2 bg-pink-600 text-white text-[9px] font-bold rounded-full h-3.5 min-w-[14px] px-1 flex items-center justify-center">0</span>
                </div>
                <span>KERANJANG</span>
            </a>
        </div>

        <!-- Desktop Auth Section -->
        <div class="hidden md:flex items-center gap-3">
           @auth
                <a href="/profil" class="text-sm font-semibold text-gray-700 bg-pink-50 px-3 py-1.5 rounded-xl border border-pink-100 hover:bg-pink-100 transition flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-tr from-pink-500 to-rose-400 text-white text-[11px] font-bold flex-shrink-0 shadow-xs">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset(Auth::user()->avatar) }}" class="w-full h-full object-cover">
                        @else
                            <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        @endif
                    </div>
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

        <!-- Mobile Action Buttons (Quick Cart Shortcut) -->
        <div class="flex items-center gap-2 md:hidden">
            <a href="/keranjang" class="p-2 text-gray-600 hover:text-pink-600 transition rounded-xl hover:bg-pink-50 relative" aria-label="Keranjang">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span id="mobile-top-cart-badge" class="hidden absolute top-1 right-1 bg-pink-600 text-white text-[9px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center border border-white">0</span>
            </a>
        </div>
    </div>
</nav>

<script>
    (function() {
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
