{{-- ========================================================================= --}}
{{-- BY.REESHA MOBILE BOTTOM NAVIGATION BAR (Aplikasi HP Modern)               --}}
{{-- ========================================================================= --}}
<nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-pink-100 shadow-[0_-4px_25px_rgba(0,0,0,0.08)] px-2 py-2 transition-all">
    <div class="grid grid-cols-4 items-center max-w-md mx-auto">
        
        {{-- 1. Home --}}
        @php $isHome = ($active ?? '') === 'home'; @endphp
        <a href="/" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isHome ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-600 font-medium' }}">
            <div class="relative {{ $isHome ? 'scale-110' : '' }} transition-transform">
                <svg class="w-6 h-6" fill="{{ $isHome ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isHome ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <span class="text-[10px] mt-1 tracking-tight">Home</span>
        </a>

        {{-- 2. Produk --}}
        @php $isProduk = ($active ?? '') === 'produk'; @endphp
        <a href="/produk" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isProduk ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-600 font-medium' }}">
            <div class="relative {{ $isProduk ? 'scale-110' : '' }} transition-transform">
                <svg class="w-6 h-6" fill="{{ $isProduk ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isProduk ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <span class="text-[10px] mt-1 tracking-tight">Produk</span>
        </a>

        {{-- 3. Keranjang --}}
        @php $isKeranjang = ($active ?? '') === 'keranjang'; @endphp
        <a href="/keranjang" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isKeranjang ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-600 font-medium' }}">
            <div class="relative {{ $isKeranjang ? 'scale-110' : '' }} transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="{{ $isKeranjang ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span id="mobile-bottom-cart-badge" class="hidden absolute -top-1.5 -right-2.5 bg-pink-600 text-white text-[9px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center border-2 border-white shadow-xs">0</span>
            </div>
            <span class="text-[10px] mt-1 tracking-tight">Keranjang</span>
        </a>

        {{-- 4. Akun / Profil --}}
        @php $isAkun = in_array(($active ?? ''), ['profil', 'akun', 'login', 'register']); @endphp
        <a href="{{ Auth::check() ? '/profil' : '/login' }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isAkun ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-600 font-medium' }}">
            <div class="relative {{ $isAkun ? 'scale-110' : '' }} transition-transform">
                @if(Auth::check() && Auth::user()->avatar)
                    <div class="w-6 h-6 rounded-full overflow-hidden border {{ $isAkun ? 'border-pink-600 ring-2 ring-pink-300' : 'border-gray-300' }} shadow-xs">
                        <img src="{{ asset(Auth::user()->avatar) }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <svg class="w-6 h-6" fill="{{ $isAkun ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isAkun ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                @endif
            </div>
            <span class="text-[10px] mt-1 tracking-tight">{{ Auth::check() ? 'Akun' : 'Masuk' }}</span>
        </a>

    </div>
</nav>

<script>
    (function() {
        function refreshMobileBottomCartBadge() {
            try {
                const cart = JSON.parse(localStorage.getItem('my_cart') || '[]');
                const badge = document.getElementById('mobile-bottom-cart-badge');
                if (badge) {
                    if (cart.length > 0) {
                        badge.innerText = cart.length;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            } catch (e) {}
        }
        document.addEventListener('DOMContentLoaded', refreshMobileBottomCartBadge);
        window.addEventListener('storage', refreshMobileBottomCartBadge);
    })();
</script>
