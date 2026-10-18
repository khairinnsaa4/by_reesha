<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Logistik & Stok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-gray-800 bg-[#f9fafb]">

    <!-- Mobile Topbar for Logistik -->
    <header class="md:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between sticky top-0 z-30 shadow-sm">
        <a href="/profil" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 text-xs leading-tight">{{ Auth::user()->name }}</h4>
                <p class="text-[10px] text-gray-400 capitalize">{{ Auth::user()->role }}</p>
            </div>
        </a>
        <button id="mobile-dash-btn" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none" aria-label="Buka Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </header>

    <!-- Mobile Dropdown Navigation -->
    <div id="mobile-dash-menu" class="hidden md:hidden bg-white border-b border-gray-200 px-4 py-3 shadow-md space-y-1">
        <nav class="space-y-1">
            <a href="/dashboard-owner" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Dashboard
            </a>
            @if(Auth::check() && Auth::user()->role === 'owner')
            <a href="/karyawan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Karyawan
            </a>
            <a href="/pelanggan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Pelanggan
            </a>
            @endif
            <a href="/pemesanan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Pemesanan
            </a>
            @if(Auth::check() && Auth::user()->role === 'owner')
            <a href="/transaksi" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Transaksi
            </a>
            @endif
            <a href="/logistik" class="block w-full text-left px-3 py-2 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
                Logistik
            </a>
            <a href="/supplier" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Supplier
            </a>
            @if(Auth::check() && Auth::user()->isPembuatKue())
            <a href="/resep" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm flex items-center justify-between">
                <span>Resep Produk</span>
                <span class="text-[10px] bg-pink-100 text-pink-700 px-1.5 py-0.5 rounded font-semibold">Baker</span>
            </a>
            @endif
            @if(Auth::check() && Auth::user()->role === 'owner')
            <a href="/laporan" class="block w-full text-left px-3 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                Laporan
            </a>
            @endif
        </nav>
        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between">
            <a href="/" class="text-xs text-gray-500 font-medium hover:text-gray-800">Lihat Website</a>
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-xs text-red-500 font-medium hover:underline">Keluar</button>
            </form>
        </div>
    </div>

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-screen sticky top-0 p-5 hidden md:flex shrink-0">
        <div>
            <a href="/profil" class="flex items-center gap-3 mb-8 p-2 -ml-2 rounded-xl hover:bg-gray-50 transition cursor-pointer group">
                <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h4 class="font-medium text-gray-800 text-sm group-hover:text-pink-600 transition">{{ Auth::user()->name }}</h4>
                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                </div>
            </a>

            <nav class="space-y-1">
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/dashboard-owner" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Dashboard
                </a>
                @endif
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/karyawan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Karyawan
                </a>
                @endif
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/pelanggan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Pelanggan
                </a>
                @endif
                <a href="/pemesanan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Pemesanan
                </a>
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/transaksi" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Transaksi
                </a>
                @endif
                <a href="/logistik" class="block w-full text-left px-4 py-2.5 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
                    Logistik
                </a>
                <a href="/supplier" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Supplier
                </a>
                @if(Auth::check() && Auth::user()->isPembuatKue())
                <a href="/resep" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm flex items-center justify-between">
                    <span>Resep Produk</span>
                    <span class="text-[10px] bg-pink-100 text-pink-700 px-1.5 py-0.5 rounded font-semibold">Baker</span>
                </a>
                @endif
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/laporan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm mb-4">
                    Laporan
                </a>
                @endif
            </nav>
        </div>

        <div class="mt-8 border-t border-gray-100 pt-4">
            <a href="/" class="block w-full text-left px-4 py-2 text-gray-500 font-medium hover:text-gray-800 transition text-sm mb-2">
                Lihat Website
            </a>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-500 font-medium hover:bg-red-50 rounded-lg transition text-sm">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="flex-1 p-4 sm:p-6 md:p-8 min-w-0">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-semibold">Logistik & Stok Bahan</h1>
                <p class="text-xs text-gray-500 mt-0.5">Kelola stok ketersediaan bahan baku dan packaging</p>
            </div>
            <button onclick="toggleModal('modal-tambah')" class="bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-medium px-4 py-2.5 rounded-lg transition shadow flex items-center gap-2">
                <span>+</span> Tambah Barang
            </button>
        </div>

        @if(session('sukses'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
            ✓ {{ session('sukses') }}
        </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="p-4 border-b border-gray-200 flex items-center gap-2">
                <div class="relative flex-1 max-w-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-logistik" placeholder="Cari nama barang atau kategori..." oninput="cariLogistik()"
                        class="text-sm border border-gray-300 rounded-lg pl-9 pr-3 py-2 focus:outline-none focus:border-pink-500 w-full transition">
                </div>
                <button onclick="cariLogistik()" class="bg-pink-600 hover:bg-pink-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
                <span id="result-count-log" class="text-xs text-gray-400 ml-1"></span>
                <span class="ml-auto text-sm font-medium text-gray-500">Total <span id="log-count">{{ $logistiks->count() }}</span> Jenis Barang</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                            <th class="px-6 py-3 font-medium">Nama Barang</th>
                            <th class="px-6 py-3 font-medium">Kategori</th>
                            <th class="px-6 py-3 font-medium text-center">Stok</th>
                            <th class="px-6 py-3 font-medium text-center">Satuan</th>
                            <th class="px-6 py-3 font-medium text-center">Status</th>
                            <th class="px-6 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="tabel-logistik">
                        @forelse($logistiks as $item)
                        @php
                            // Status ditentukan otomatis dari jumlah stok
                            $autoStatus = $item->stok <= 5 ? 'Kritis' : ($item->stok <= 15 ? 'Menipis' : 'Aman');
                        @endphp
                        <tr class="hover:bg-gray-50 log-row">
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $item->kategori }}</td>
                            <td class="px-6 py-4 text-center font-bold {{ $autoStatus === 'Kritis' ? 'text-red-600' : ($autoStatus === 'Menipis' ? 'text-yellow-600' : 'text-gray-800') }}">
                                {{ $item->stok }}
                            </td>
                            <td class="px-6 py-4 text-center text-gray-500">{{ $item->satuan }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($autoStatus === 'Aman')
                                    <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">✓ Aman</span>
                                @elseif($autoStatus === 'Menipis')
                                    <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">⚡ Menipis</span>
                                @else
                                    <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">🔴 Kritis</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-1">
                                    <button onclick="openEditModal({{ $item }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit Barang">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="/logistik/{{ $item->id }}/hapus" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang {{ $item->nama }}?')" class="inline">
                                        @csrf
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus Barang">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-log">
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada barang di logistik. Klik "+ Tambah Barang" untuk menambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- ===== MODAL TAMBAH BARANG ===== --}}
    <div id="modal-tambah" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Barang Logistik</h3>
            <form action="/logistik/tambah" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Barang</label>
                    <input type="text" name="nama" required placeholder="Contoh: Tepung Terigu" class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:border-pink-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kategori</label>
                    <select name="kategori" required class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:border-pink-500 focus:outline-none">
                        <option value="Bahan Utama">Bahan Utama</option>
                        <option value="Bahan Penunjang">Bahan Penunjang</option>
                        <option value="Packaging">Packaging</option>
                        <option value="Peralatan">Peralatan</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Stok Jumlah</label>
                        <input type="number" name="stok" min="0" required placeholder="10" class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:border-pink-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Satuan</label>
                        <input type="text" name="satuan" required placeholder="Kg / Tray / Pcs" class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:border-pink-500 focus:outline-none">
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="toggleModal('modal-tambah')" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-lg text-sm font-medium hover:bg-pink-700">Simpan Barang</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL EDIT BARANG ===== --}}
    <div id="modal-edit" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Edit Barang Logistik</h3>
            <form id="form-edit" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Barang</label>
                    <input type="text" id="edit-nama" name="nama" required class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:border-pink-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Kategori</label>
                    <select id="edit-kategori" name="kategori" required class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:border-pink-500 focus:outline-none">
                        <option value="Bahan Utama">Bahan Utama</option>
                        <option value="Bahan Penunjang">Bahan Penunjang</option>
                        <option value="Packaging">Packaging</option>
                        <option value="Peralatan">Peralatan</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Stok Jumlah</label>
                        <input type="number" id="edit-stok" name="stok" min="0" required class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:border-pink-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Satuan</label>
                        <input type="text" id="edit-satuan" name="satuan" required class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:border-pink-500 focus:outline-none">
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="toggleModal('modal-edit')" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-lg text-sm font-medium hover:bg-pink-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function openEditModal(item) {
            document.getElementById('form-edit').action = '/logistik/' + item.id + '/update';
            document.getElementById('edit-nama').value = item.nama;
            document.getElementById('edit-kategori').value = item.kategori;
            document.getElementById('edit-stok').value = item.stok;
            document.getElementById('edit-satuan').value = item.satuan;
            toggleModal('modal-edit');
        }

        // ── Live Search Logistik ──────────────────────────────
        function cariLogistik() {
            const keyword = document.getElementById('search-logistik').value.toLowerCase();
            const rows    = document.querySelectorAll('#tabel-logistik .log-row');
            let visible   = 0;

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(keyword)) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('result-count-log').innerText =
                keyword ? `${visible} hasil ditemukan` : '';
            document.getElementById('log-count').innerText =
                keyword ? visible : {{ $logistiks->count() }};
        }

        document.getElementById('search-logistik').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') cariLogistik();
        });

        const dashBtn = document.getElementById('mobile-dash-btn');
        const dashMenu = document.getElementById('mobile-dash-menu');
        if (dashBtn && dashMenu) {
            dashBtn.addEventListener('click', () => {
                dashMenu.classList.toggle('hidden');
            });
        }
    </script>

</body>
</html>
