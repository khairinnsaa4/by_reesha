@php
    $currentActive = $active ?? '';
    $user = Auth::user();
    $role = $user ? $user->role : 'tamu';
@endphp

<nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-pink-100 shadow-[0_-4px_25px_rgba(0,0,0,0.06)] px-2 py-1.5 transition-all no-print">
    @if($role === 'owner')
        @php
            $isDash = in_array($currentActive, ['dashboard', 'dashboard-owner']);
            $isPemesanan = $currentActive === 'pemesanan';
            $isTransaksi = in_array($currentActive, ['transaksi', 'laporan']);
            $isKatalog = in_array($currentActive, ['produk', 'home']);
            $isAkun = in_array($currentActive, ['profil', 'akun', 'karyawan', 'pelanggan', 'logistik', 'supplier']);
        @endphp
        <div class="grid grid-cols-5 items-center max-w-md mx-auto">
            <a href="/dashboard-owner" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isDash ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isDash ? 'scale-110' : '' }} transition-transform">
                    <svg class="w-5 h-5" fill="{{ $isDash ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isDash ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="text-[9px] mt-0.5 tracking-tight">Dashboard</span>
            </a>

            <a href="/pemesanan" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isPemesanan ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isPemesanan ? 'scale-110' : '' }} transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isPemesanan ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <span class="text-[9px] mt-0.5 tracking-tight">Pesanan</span>
            </a>

            <a href="/transaksi" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isTransaksi ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isTransaksi ? 'scale-110' : '' }} transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isTransaksi ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                    </svg>
                </div>
                <span class="text-[9px] mt-0.5 tracking-tight">Transaksi</span>
            </a>

            <a href="/produk" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isKatalog ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isKatalog ? 'scale-110' : '' }} transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isKatalog ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <span class="text-[9px] mt-0.5 tracking-tight">Katalog</span>
            </a>

            <a href="/profil" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isAkun ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isAkun ? 'scale-110' : '' }} transition-transform">
                    @if($user && $user->avatar)
                        <div class="w-5 h-5 rounded-full overflow-hidden border {{ $isAkun ? 'border-pink-600 ring-2 ring-pink-300' : 'border-slate-300' }}">
                            <img src="{{ $user->avatar_url }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <svg class="w-5 h-5" fill="{{ $isAkun ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isAkun ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </div>
                <span class="text-[9px] mt-0.5 tracking-tight">Akun</span>
            </a>
        </div>

    @elseif($role === 'karyawan')
        @if($user && $user->isKasir())
            @php
                $isPemesanan = $currentActive === 'pemesanan';
                $isTransaksi = $currentActive === 'transaksi';
                $isKatalog = in_array($currentActive, ['produk', 'katalog']);
                $isAkun = in_array($currentActive, ['profil', 'akun']);
            @endphp
            <div class="grid grid-cols-4 items-center max-w-md mx-auto">
                <a href="/pemesanan" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isPemesanan ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                    <div class="relative {{ $isPemesanan ? 'scale-110' : '' }} transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isPemesanan ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-[10px] mt-0.5 tracking-tight">Pesanan</span>
                </a>

                <a href="/transaksi" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isTransaksi ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                    <div class="relative {{ $isTransaksi ? 'scale-110' : '' }} transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isTransaksi ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] mt-0.5 tracking-tight">Transaksi</span>
                </a>

                <a href="/produk" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isKatalog ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                    <div class="relative {{ $isKatalog ? 'scale-110' : '' }} transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isKatalog ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <span class="text-[10px] mt-0.5 tracking-tight">Katalog</span>
                </a>

                <a href="/profil" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isAkun ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                    <div class="relative {{ $isAkun ? 'scale-110' : '' }} transition-transform">
                        @if($user && $user->avatar)
                            <div class="w-5 h-5 rounded-full overflow-hidden border {{ $isAkun ? 'border-pink-600 ring-2 ring-pink-300' : 'border-slate-300' }}">
                                <img src="{{ $user->avatar_url }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <svg class="w-5 h-5" fill="{{ $isAkun ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isAkun ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    </div>
                    <span class="text-[10px] mt-0.5 tracking-tight">Akun</span>
                </a>
            </div>
        @else
            @php
                $isPemesanan = $currentActive === 'pemesanan';
                $isLogistik = $currentActive === 'logistik';
                $isResep = in_array($currentActive, ['resep', 'resep_detail']);
                $isAkun = in_array($currentActive, ['profil', 'akun']);
            @endphp
            <div class="grid grid-cols-4 items-center max-w-md mx-auto">
                <a href="/pemesanan" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isPemesanan ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                    <div class="relative {{ $isPemesanan ? 'scale-110' : '' }} transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isPemesanan ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-[10px] mt-0.5 tracking-tight">Pesanan</span>
                </a>

                <a href="/logistik" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isLogistik ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                    <div class="relative {{ $isLogistik ? 'scale-110' : '' }} transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isLogistik ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-[10px] mt-0.5 tracking-tight">Logistik</span>
                </a>

                <a href="/resep" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isResep ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                    <div class="relative {{ $isResep ? 'scale-110' : '' }} transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isResep ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-[10px] mt-0.5 tracking-tight">Resep</span>
                </a>

                <a href="/profil" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isAkun ? 'text-pink-600 font-bold' : 'text-slate-400 hover:text-pink-600 font-medium' }}">
                    <div class="relative {{ $isAkun ? 'scale-110' : '' }} transition-transform">
                        @if($user && $user->avatar)
                            <div class="w-5 h-5 rounded-full overflow-hidden border {{ $isAkun ? 'border-pink-600 ring-2 ring-pink-300' : 'border-slate-300' }}">
                                <img src="{{ $user->avatar_url }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <svg class="w-5 h-5" fill="{{ $isAkun ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isAkun ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    </div>
                    <span class="text-[10px] mt-0.5 tracking-tight">Akun</span>
                </a>
            </div>
        @endif

    @else
        @php
            $isHome = ($active ?? '') === 'home';
            $isProduk = ($active ?? '') === 'produk';
            $isKeranjang = ($active ?? '') === 'keranjang';
            $isAkun = in_array(($active ?? ''), ['profil', 'akun', 'login', 'register']);
        @endphp
        <div class="grid grid-cols-4 items-center max-w-md mx-auto">
            <a href="/" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isHome ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isHome ? 'scale-110' : '' }} transition-transform">
                    <svg class="w-5 h-5" fill="{{ $isHome ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isHome ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-0.5 tracking-tight">Home</span>
            </a>

            <a href="/produk" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isProduk ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isProduk ? 'scale-110' : '' }} transition-transform">
                    <svg class="w-5 h-5" fill="{{ $isProduk ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isProduk ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <span class="text-[10px] mt-0.5 tracking-tight">Produk</span>
            </a>

            <a href="/keranjang" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isKeranjang ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isKeranjang ? 'scale-110' : '' }} transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="{{ $isKeranjang ? '2.3' : '1.8' }}" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span id="mobile-bottom-cart-badge" class="hidden absolute -top-1.5 -right-2.5 bg-pink-600 text-white text-[9px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center border-2 border-white shadow-xs">0</span>
                </div>
                <span class="text-[10px] mt-0.5 tracking-tight">Keranjang</span>
            </a>

            <a href="{{ Auth::check() ? '/profil' : '/login' }}" class="flex flex-col items-center justify-center py-1 rounded-xl transition {{ $isAkun ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-600 font-medium' }}">
                <div class="relative {{ $isAkun ? 'scale-110' : '' }} transition-transform">
                    @if(Auth::check() && Auth::user()->avatar)
                        <div class="w-5 h-5 rounded-full overflow-hidden border {{ $isAkun ? 'border-pink-600 ring-2 ring-pink-300' : 'border-gray-300' }} shadow-xs">
                            <img src="{{ Auth::user()->avatar_url }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <svg class="w-5 h-5" fill="{{ $isAkun ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $isAkun ? '2.2' : '1.8' }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </div>
                <span class="text-[10px] mt-0.5 tracking-tight">{{ Auth::check() ? 'Akun' : 'Masuk' }}</span>
            </a>
        </div>
    @endif
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