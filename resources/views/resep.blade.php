<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Koleksi Resep & Bahan Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif; background-color: #f8fafc; color: #0f172a; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-slate-800 bg-[#f8fafc]">

    @include('partials.owner_sidebar', ['active' => 'resep'])

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA                          -->
    <!-- ========================================== -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar">

        {{-- Flash Alerts --}}
        @if(session('sukses'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-xl flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="font-medium">{{ session('sukses') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 font-bold">&times;</button>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm rounded-xl flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 font-bold">&times;</button>
        </div>
        @endif

        <!-- Executive Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 pb-6 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
                    <span>Portal Manajemen</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-pink-600 font-semibold">Resep & Produksi</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Koleksi Formula & Resep</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Standarisasi takaran bahan, panduan produksi dapur, dan formula resmi By.Reesha.</p>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="openModalTambah()"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Resep Baru</span>
                </button>
            </div>
        </div>

        {{-- ===== SEARCH & FILTER BAR ===== --}}
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-pink-50 mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" id="input-cari" oninput="filterResep()" placeholder="Cari nama kue, bahan, atau resep..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-100 transition">
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-1 md:pb-0">
                <span class="text-xs text-gray-400 font-medium whitespace-nowrap">Tingkat Kesulitan:</span>
                <button onclick="setFilterKesulitan('Semua')" id="btn-filter-Semua"
                    class="filter-btn text-xs px-3 py-1.5 rounded-lg font-medium transition bg-pink-600 text-white">Semua</button>
                <button onclick="setFilterKesulitan('Mudah')" id="btn-filter-Mudah"
                    class="filter-btn text-xs px-3 py-1.5 rounded-lg font-medium transition bg-gray-100 text-gray-600 hover:bg-gray-200">Mudah</button>
                <button onclick="setFilterKesulitan('Sedang')" id="btn-filter-Sedang"
                    class="filter-btn text-xs px-3 py-1.5 rounded-lg font-medium transition bg-gray-100 text-gray-600 hover:bg-gray-200">Sedang</button>
                <button onclick="setFilterKesulitan('Mahir')" id="btn-filter-Mahir"
                    class="filter-btn text-xs px-3 py-1.5 rounded-lg font-medium transition bg-gray-100 text-gray-600 hover:bg-gray-200">Mahir</button>
            </div>
        </div>

        {{-- ===== RECIPE CARDS GRID ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="grid-resep">
            @forelse($reseps as $r)
            @php
                $bgBadge = 'bg-gray-100 text-gray-700';
                if ($r->tingkat_kesulitan === 'Mudah') $bgBadge = 'bg-emerald-100 text-emerald-700';
                elseif ($r->tingkat_kesulitan === 'Sedang') $bgBadge = 'bg-amber-100 text-amber-700';
                elseif ($r->tingkat_kesulitan === 'Mahir') $bgBadge = 'bg-indigo-100 text-indigo-700';
                
                $barisBahan = array_filter(explode("\n", str_replace("\r", "", $r->bahan_bahan)));
                $totalBahan = count($barisBahan);
            @endphp
            <div class="resep-card bg-white rounded-2xl shadow-sm border border-pink-50 overflow-hidden flex flex-col justify-between hover:shadow-md hover:border-pink-200 transition duration-200"
                data-nama="{{ strtolower($r->produk->nama_kue ?? '') }}"
                data-resep="{{ strtolower($r->nama_resep) }}"
                data-bahan="{{ strtolower($r->bahan_bahan) }}"
                data-kesulitan="{{ $r->tingkat_kesulitan }}">
                
                <div>
                    {{-- Image & Badge --}}
                    <a href="/resep/{{ $r->id }}" class="block relative h-44 w-full bg-pink-50 overflow-hidden group">
                        <img src="{{ asset('images/' . ($r->produk->gambar ?? 'logo.png')) }}" 
                             alt="{{ $r->produk->nama_kue ?? 'Kue' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                             onerror="this.src='{{ asset('images/logo.png') }}'">
                        
                        <div class="absolute top-3 left-3 flex gap-1.5">
                            <span class="text-xs px-2.5 py-0.5 rounded-full font-bold shadow-sm {{ $bgBadge }}">
                                {{ $r->tingkat_kesulitan }}
                            </span>
                        </div>

                        <div class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-sm text-white text-[11px] px-2 py-0.5 rounded-md font-medium">
                            {{ $r->porsi ?? '1 Porsi' }}
                        </div>
                    </a>

                    {{-- Content Header --}}
                    <div class="p-4">
                        <div class="text-xs font-semibold text-pink-600 mb-0.5 uppercase tracking-wider">
                            {{ $r->produk->nama_kue ?? 'Kue Custom' }}
                        </div>
                        <a href="/resep/{{ $r->id }}" class="hover:text-pink-600 transition block">
                            <h3 class="text-base font-bold text-gray-800 line-clamp-1 mb-2">
                                {{ $r->nama_resep }}
                            </h3>
                        </a>

                        {{-- Specs Strip --}}
                        <div class="grid grid-cols-3 gap-1 py-2 px-2 bg-gray-50 rounded-xl mb-3 text-center text-xs">
                            <div>
                                <span class="block text-[10px] text-gray-400">Persiapan</span>
                                <span class="font-semibold text-gray-700">{{ $r->waktu_persiapan }}</span>
                            </div>
                            <div class="border-x border-gray-200">
                                <span class="block text-[10px] text-gray-400">Panggang</span>
                                <span class="font-semibold text-gray-700">{{ $r->waktu_panggang }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] text-gray-400">Suhu Oven</span>
                                <span class="font-semibold text-pink-600">{{ $r->suhu_oven }}</span>
                            </div>
                        </div>

                        {{-- Bahan Ringkas --}}
                        <div class="text-xs text-gray-500 mb-3">
                            <span class="font-semibold text-gray-700 block mb-1">Bahan Baku ({{ $totalBahan }} bahan):</span>
                            <ul class="space-y-0.5 text-gray-500 line-clamp-3 pl-1">
                                @foreach(array_slice($barisBahan, 0, 3) as $b)
                                    <li class="truncate">{{ ltrim($b, "•-* \t") }}</li>
                                @endforeach
                            </ul>
                            @if($totalBahan > 3)
                                <span class="text-[11px] text-pink-600 font-medium italic mt-1 block">+ {{ $totalBahan - 3 }} bahan lainnya...</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action Button (Direct Link to Full Page) --}}
                <div class="p-4 pt-0 border-t border-gray-50 flex items-center gap-2">
                    <a href="/resep/{{ $r->id }}"
                        class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-semibold text-xs py-2.5 px-3 rounded-xl transition flex items-center justify-center gap-1.5 shadow-sm shadow-pink-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Lihat Resep Lengkap</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white p-12 text-center rounded-2xl border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">Belum Ada Resep</h3>
                <p class="text-sm text-gray-500 mt-1">Silakan klik tombol "Tambah Resep Baru" untuk menambahkan panduan resep.</p>
            </div>
            @endforelse
        </div>

        {{-- No Result Alert --}}
        <div id="no-result" class="hidden bg-white p-12 text-center rounded-2xl border border-gray-200 mt-4">
            <p class="text-gray-600 font-medium">Tidak ada resep yang sesuai dengan kata kunci pencarian Anda.</p>
        </div>

    </main>

    {{-- ===== MODAL TAMBAH RESEP BARU ===== --}}
    <div id="modal-form" class="hidden fixed inset-0 bg-black/60 z-50 overflow-y-auto p-4 flex items-center justify-center">
        <div class="bg-white rounded-3xl shadow-2xl max-w-xl w-full p-6 md:p-8 my-8 relative">
            <div class="flex items-center justify-between mb-6 pb-3 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Tambah Resep Produk Baru</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Isi detail takaran bahan dan langkah produksi</p>
                </div>
                <button onclick="tutupModalForm()" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form action="/resep/simpan" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Pilih Produk Kue <span class="text-pink-600">*</span></label>
                    <select name="produk_id" required
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
                        <option value="">-- Pilih Produk Kue --</option>
                        @foreach($produks as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_kue }} (Rp {{ number_format($p->harga, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Judul Resep <span class="text-pink-600">*</span></label>
                    <input type="text" name="nama_resep" required placeholder="Contoh: Resep Dasar Bento Cake Vanilla"
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Waktu Persiapan</label>
                        <input type="text" name="waktu_persiapan" value="20 Menit" required
                            class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Waktu Panggang</label>
                        <input type="text" name="waktu_panggang" value="30 Menit" required
                            class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Suhu Oven</label>
                        <input type="text" name="suhu_oven" value="170°C" required
                            class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Kesulitan</label>
                        <select name="tingkat_kesulitan" required
                            class="w-full border border-gray-300 rounded-xl px-2.5 py-2 text-xs focus:outline-none focus:border-pink-500">
                            <option value="Mudah">Mudah</option>
                            <option value="Sedang" selected>Sedang</option>
                            <option value="Mahir">Mahir</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Ukuran Loyang / Porsi</label>
                    <input type="text" name="porsi" placeholder="Contoh: 1 cake D:10 cm, loyang bulat"
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2 text-sm focus:outline-none focus:border-pink-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Daftar Bahan & Takaran <span class="text-pink-600">*</span></label>
                    <textarea name="bahan_bahan" required rows="5" placeholder="Tulis satu bahan per baris, contoh:&#10;• 3 butir telur ayam&#10;• 80 gr gula pasir&#10;• 1 sdt SP&#10;• 85 gr tepung terigu"
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-xs font-mono focus:outline-none focus:border-pink-500"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Langkah-Langkah Pembuatan <span class="text-pink-600">*</span></label>
                    <textarea name="langkah_langkah" required rows="5" placeholder="Tuliskan nomor urut langkah demi langkah:&#10;1. Panaskan oven suhu 165°C...&#10;2. Kocok telur dan gula hingga mengembang...&#10;3. Masukkan tepung terigu perlahan..."
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-xs font-mono focus:outline-none focus:border-pink-500"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tips Chef / Catatan Khusus</label>
                    <textarea name="tips" rows="2" placeholder="Contoh: Jangan buka oven di 20 menit pertama..."
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2 text-xs focus:outline-none focus:border-pink-500"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="tutupModalForm()"
                        class="px-4 py-2 border border-gray-300 text-gray-600 rounded-xl text-xs font-semibold hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-pink-100 transition">
                        Simpan Resep
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SEARCH & FILTER SCRIPT --}}
    <script>
        let filterKesulitanAktif = 'Semua';

        function openModalTambah() {
            document.getElementById('modal-form').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function tutupModalForm() {
            document.getElementById('modal-form').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function filterResep() {
            const query = document.getElementById('input-cari').value.toLowerCase();
            const cards = document.querySelectorAll('.resep-card');
            let matched = 0;

            cards.forEach(card => {
                const nama = card.getAttribute('data-nama');
                const resep = card.getAttribute('data-resep');
                const bahan = card.getAttribute('data-bahan');
                const kesulitan = card.getAttribute('data-kesulitan');

                const matchQuery = !query || nama.includes(query) || resep.includes(query) || bahan.includes(query);
                const matchKesulitan = (filterKesulitanAktif === 'Semua') || (kesulitan === filterKesulitanAktif);

                if (matchQuery && matchKesulitan) {
                    card.style.display = 'flex';
                    matched++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('no-result').classList.toggle('hidden', matched > 0);
        }

        function setFilterKesulitan(val) {
            filterKesulitanAktif = val;
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.className = 'filter-btn text-xs px-3 py-1.5 rounded-lg font-medium transition bg-gray-100 text-gray-600 hover:bg-gray-200';
            });
            document.getElementById('btn-filter-' + val).className = 'filter-btn text-xs px-3 py-1.5 rounded-lg font-medium transition bg-pink-600 text-white';
            filterResep();
        }


    </script>

</body>
</html>
