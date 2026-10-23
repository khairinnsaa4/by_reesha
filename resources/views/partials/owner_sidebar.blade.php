@php
    $currentActive = $active ?? 'dashboard';
    $user = Auth::user();
@endphp

<!-- ========================================== -->
<!-- MOBILE TOPBAR                              -->
<!-- ========================================== -->
<header class="md:hidden bg-white border-b border-slate-200 px-4 py-3 flex items-center justify-between sticky top-0 z-30 shadow-2xs no-print">
    <div class="flex items-center gap-2.5">
        <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="w-8 h-8 object-contain rounded-full bg-pink-50 ring-2 ring-pink-100 p-0.5" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'32\' height=\'32\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'12\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
        <div>
            <h1 class="text-sm font-extrabold text-pink-600 tracking-wider leading-none">BY.REESHA</h1>
            <p class="text-[10px] text-slate-400 font-medium">Portal Manajemen</p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <a href="/profil" class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-tr from-pink-500 to-rose-400 text-white font-bold text-xs ring-2 ring-pink-100">
            @if($user && $user->avatar)
                <img src="{{ $user->avatar_url }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
            @else
                <span>{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</span>
            @endif
        </a>
        <button id="mobile-dash-btn" class="p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none" aria-label="Buka Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
</header>

<!-- ========================================== -->
<!-- MOBILE DROPDOWN NAVIGATION                 -->
<!-- ========================================== -->
<div id="mobile-dash-menu" class="hidden md:hidden bg-white border-b border-slate-200 px-4 py-3 shadow-md space-y-1 no-print">
    <nav class="space-y-1">
        @if($user && $user->role === 'owner')
        <a href="/dashboard-owner" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $currentActive === 'dashboard' ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'dashboard' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="/karyawan" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $currentActive === 'karyawan' ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'karyawan' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span>Karyawan</span>
        </a>

        <a href="/pelanggan" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $currentActive === 'pelanggan' ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'pelanggan' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span>Pelanggan</span>
        </a>
        @endif

        <a href="/pemesanan" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $currentActive === 'pemesanan' ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'pemesanan' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <span>Pemesanan</span>
        </a>

        @if($user && $user->role === 'owner')
        <a href="/transaksi" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $currentActive === 'transaksi' ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'transaksi' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
            </svg>
            <span>Transaksi</span>
        </a>
        @endif

        <a href="/logistik" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $currentActive === 'logistik' ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'logistik' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <span>Logistik</span>
        </a>

        <a href="/supplier" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $currentActive === 'supplier' ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'supplier' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <span>Supplier</span>
        </a>

        @if($user && ($user->isPembuatKue() || $user->role === 'owner'))
        <a href="/resep" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm font-medium transition {{ in_array($currentActive, ['resep', 'resep_detail']) ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0 {{ in_array($currentActive, ['resep', 'resep_detail']) ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span>Resep Produk</span>
            </div>
            <span class="text-[10px] bg-pink-100 text-pink-700 px-1.5 py-0.5 rounded font-semibold">Baker</span>
        </a>
        @endif

        @if($user && $user->role === 'owner')
        <a href="/laporan" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition {{ $currentActive === 'laporan' ? 'bg-pink-50 text-pink-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'laporan' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <span>Laporan</span>
        </a>
        @endif
    </nav>

    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between">
        <a href="/" class="flex items-center gap-1.5 text-xs text-slate-500 font-medium hover:text-slate-800">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            <span>Lihat Website</span>
        </a>
        <form action="/logout" method="POST" class="inline">
            @csrf
            <button type="submit" class="flex items-center gap-1.5 text-xs text-red-600 font-medium hover:text-red-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</div>

<!-- ========================================== -->
<!-- DESKTOP SIDEBAR                            -->
<!-- ========================================== -->
<aside class="w-64 bg-white border-r border-slate-200/90 flex flex-col justify-between h-screen sticky top-0 p-5 hidden md:flex shrink-0 shadow-2xs no-print">
    <div class="overflow-y-auto pr-1">
        <!-- Brand Identity -->
        <div class="flex items-center gap-3 px-2 py-3 mb-4 border-b border-slate-100">
            <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="w-9 h-9 object-contain rounded-full bg-pink-50 ring-2 ring-pink-100 p-0.5 shadow-2xs" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'12\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
            <div class="min-w-0">
                <h2 class="text-sm font-extrabold text-slate-900 tracking-wider leading-none">BY.REESHA</h2>
                <span class="text-[10px] font-semibold text-pink-600 uppercase tracking-wider block mt-1">Portal Manajemen</span>
            </div>
        </div>

        <!-- Navigation Links with Crisp Formal SVG Icons -->
        <nav class="space-y-1">
            @if($user && $user->role === 'owner')
            <!-- Dashboard -->
            <a href="/dashboard-owner" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition {{ $currentActive === 'dashboard' ? 'bg-pink-50 text-pink-700 border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'dashboard' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Karyawan -->
            <a href="/karyawan" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ $currentActive === 'karyawan' ? 'bg-pink-50 text-pink-700 font-semibold border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'karyawan' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Karyawan</span>
            </a>

            <!-- Pelanggan -->
            <a href="/pelanggan" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ $currentActive === 'pelanggan' ? 'bg-pink-50 text-pink-700 font-semibold border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'pelanggan' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Pelanggan</span>
            </a>
            @endif

            <!-- Pemesanan -->
            <a href="/pemesanan" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ $currentActive === 'pemesanan' ? 'bg-pink-50 text-pink-700 font-semibold border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'pemesanan' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span>Pemesanan</span>
            </a>

            @if($user && $user->role === 'owner')
            <!-- Transaksi -->
            <a href="/transaksi" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ $currentActive === 'transaksi' ? 'bg-pink-50 text-pink-700 font-semibold border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'transaksi' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                </svg>
                <span>Transaksi</span>
            </a>
            @endif

            <!-- Logistik -->
            <a href="/logistik" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ $currentActive === 'logistik' ? 'bg-pink-50 text-pink-700 font-semibold border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'logistik' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Logistik</span>
            </a>

            <!-- Supplier -->
            <a href="/supplier" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ $currentActive === 'supplier' ? 'bg-pink-50 text-pink-700 font-semibold border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'supplier' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Supplier</span>
            </a>

            @if($user && ($user->isPembuatKue() || $user->role === 'owner'))
            <!-- Resep Produk -->
            <a href="/resep" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ in_array($currentActive, ['resep', 'resep_detail']) ? 'bg-pink-50 text-pink-700 font-semibold border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 {{ in_array($currentActive, ['resep', 'resep_detail']) ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Resep</span>
                </div>
                <span class="text-[10px] bg-pink-100 text-pink-700 px-1.5 py-0.5 rounded font-semibold">Baker</span>
            </a>
            @endif

            @if($user && $user->role === 'owner')
            <!-- Laporan -->
            <a href="/laporan" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition {{ $currentActive === 'laporan' ? 'bg-pink-50 text-pink-700 font-semibold border border-pink-200/60 shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0 {{ $currentActive === 'laporan' ? 'text-pink-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span>Laporan</span>
            </a>
            @endif
        </nav>
    </div>

    <!-- Sidebar Footer Action -->
    <div class="border-t border-slate-100 pt-3 space-y-1">
        <!-- Compact Account Link -->
        <a href="/profil" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-200 transition group" title="Pengaturan Akun & Profil">
            <div class="w-7 h-7 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-tr from-pink-500 to-rose-500 text-white font-bold text-[11px] shrink-0 ring-1 ring-slate-200">
                @if($user && $user->avatar)
                    <img src="{{ $user->avatar_url }}" class="w-full h-full object-cover" alt="{{ $user->name }}">
                @else
                    <span>{{ strtoupper(substr($user->name ?? 'O', 0, 1)) }}</span>
                @endif
            </div>
            <div class="min-w-0 flex-1 text-left">
                <p class="font-semibold text-xs text-slate-800 truncate group-hover:text-pink-600 transition">{{ $user->name ?? 'Owner By.Reesha' }}</p>
                <p class="text-[10px] text-slate-400 capitalize truncate">{{ ($user && $user->divisi) ? $user->divisi : ($user->role ?? 'Owner') }}</p>
            </div>
            <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-pink-600 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <a href="/" class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl text-slate-500 font-medium hover:text-slate-900 hover:bg-slate-50 transition text-xs">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            <span>Lihat Website</span>
        </a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-1.5 rounded-xl text-rose-600 font-medium hover:bg-rose-50 transition text-xs">
                <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>

<script>
    // Universal mobile drawer handler for admin portal
    (function() {
        const btn = document.getElementById('mobile-dash-btn');
        const menu = document.getElementById('mobile-dash-menu');
        if (btn && menu) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
        }
    })();
</script>
