<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Katalog Koleksi Kue & Pre-Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #FFF8F9; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between pb-20 md:pb-0">

    <!-- NAVIGATION BAR -->
    @include('partials.navbar', ['active' => 'produk'])

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8 md:py-12 w-full flex-grow pb-24 md:pb-12">
        <!-- Header Banner -->
        <div class="text-center mb-6 md:mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">Koleksi Kue By.Reesha</h1>
            <p class="text-gray-500 text-xs sm:text-sm mt-1.5">Pilihan kue artisanal segar untuk setiap momen spesial Anda.</p>
        </div>

        <!-- Filter & Search Controls -->
        <div class="bg-white rounded-2xl border border-pink-100 p-4 sm:p-5 shadow-xs mb-8">
            <form action="/produk" method="GET" class="flex flex-col md:flex-row gap-3 items-stretch md:items-center justify-between">
                <!-- Search Box -->
                <div class="relative flex-1">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama kue atau SKU (contoh: Bento, BR-MINI-01)..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-pink-200 text-xs sm:text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition">
                    <svg class="w-4 h-4 text-pink-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    @if(request('q'))
                        <a href="/produk{{ request('kategori') ? '?kategori='.request('kategori') : '' }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-xs">✕ Reset</a>
                    @endif
                </div>

                <!-- Hidden Kategori if preserved -->
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif

                <!-- Sorting Dropdown -->
                <div class="flex items-center gap-2">
                    <label for="sort" class="text-xs font-semibold text-gray-500 shrink-0 hidden sm:inline">Urutan:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()"
                        class="w-full sm:w-auto px-3 py-2.5 rounded-xl border border-pink-200 text-xs font-medium text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-pink-400">
                        <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Rekomendasi</option>
                        <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga: Terendah</option>
                        <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Harga: Tertinggi</option>
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Katalog Terbaru</option>
                    </select>
                    <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-xs">
                        Cari
                    </button>
                </div>
            </form>

            <!-- Category Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pt-4 mt-4 border-t border-pink-50 no-scrollbar">
                <a href="/produk{{ request('q') ? '?q='.urlencode(request('q')) : '' }}"
                    class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition {{ !request('kategori') || request('kategori') === 'semua' ? 'bg-pink-600 text-white shadow-xs' : 'bg-pink-50 text-gray-600 hover:bg-pink-100' }}">
                    Semua Kategori
                </a>
                @foreach($categories as $cat)
                <a href="/produk?kategori={{ $cat->slug }}{{ request('q') ? '&q='.urlencode(request('q')) : '' }}{{ request('sort') ? '&sort='.request('sort') : '' }}"
                    class="px-3.5 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition {{ request('kategori') === $cat->slug ? 'bg-pink-600 text-white shadow-xs' : 'bg-pink-50 text-gray-600 hover:bg-pink-100' }}">
                    {{ $cat->nama }} <span class="opacity-70 text-[10px]">({{ $cat->produks_count }})</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Product Cards Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5 sm:gap-5 md:gap-6">
            @forelse($semua_cake as $cake)
            <div class="bg-white rounded-2xl shadow-xs border border-pink-100/80 overflow-hidden flex flex-col justify-between hover:shadow-md hover:-translate-y-0.5 transition duration-200 group">
                <!-- Image -->
                <div class="relative overflow-hidden h-36 sm:h-44 md:h-48 bg-pink-50/30">
                    <img src="{{ asset('images/' . $cake->gambar) }}" alt="{{ $cake->nama_kue }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='{{ asset('images/logo.png') }}'">
                    @if($cake->stock <= 0)
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <span class="bg-black/70 text-white text-[11px] font-semibold px-2.5 py-1 rounded-md">Habis</span>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="p-3.5 flex flex-col justify-between flex-grow gap-2.5">
                    <div>
                        <h3 class="font-semibold text-gray-800 text-xs sm:text-sm line-clamp-1 group-hover:text-pink-600 transition-colors">
                            {{ $cake->nama_kue }}
                        </h3>
                        <div class="flex items-center gap-2 mt-1 text-[11px] text-gray-400">
                            <span>Stok {{ $cake->stock }}</span>
                            <span>•</span>
                            <span>{{ $cake->sold_count ?? 0 }} terjual</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-2 pt-2 border-t border-gray-50">
                        <span class="text-pink-600 font-bold text-xs sm:text-sm">Rp {{ number_format($cake->harga, 0, ',', '.') }}</span>
                        @if($cake->stock > 0)
                            <a href="/produk/{{ $cake->id }}"
                               class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition text-center shadow-2xs">
                                Pesan
                            </a>
                        @else
                            <span class="bg-gray-100 text-gray-400 text-xs font-medium px-2.5 py-1.5 rounded-lg select-none cursor-not-allowed">
                                Habis
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-pink-100 p-8">
                <div class="w-16 h-16 rounded-full bg-pink-50 text-pink-500 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-800 mb-1">Kue tidak ditemukan</h3>
                <p class="text-xs sm:text-sm text-gray-400 max-w-md mx-auto mb-5">Tidak ada kue yang cocok dengan kata kunci pencarian atau kategori yang dipilih.</p>
                <a href="/produk" class="inline-flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition shadow-xs">
                    Reset Filter & Tampilkan Semua
                </a>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white border-t border-pink-100 text-center py-6 text-xs text-gray-400 mt-12">
        &copy; 2026 By.Reesha - Premium Handcrafted Bakery Lhokseumawe. All rights reserved.
    </footer>

    @include('partials.bottom_nav', ['active' => 'produk'])
</body>
</html>
