<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9fafb; }
    </style>
</head>
<body class="flex min-h-screen text-gray-800">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between h-screen sticky top-0 p-5 hidden md:flex">
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
                <a href="/dashboard-owner" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Dashboard
                </a>
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/karyawan" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
                    Karyawan
                </a>
                @endif
                @if(Auth::check() && Auth::user()->role === 'owner')
                <a href="/pelanggan" class="block w-full text-left px-4 py-2.5 rounded-lg bg-pink-50 text-pink-700 font-medium text-sm">
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
                <a href="/logistik" class="block w-full text-left px-4 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition text-sm">
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
    <main class="flex-1 p-8">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-semibold">Pelanggan</h1>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-200 flex items-center gap-2">
                <div class="relative flex-1 max-w-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-pelanggan" placeholder="Cari nama atau email pelanggan..." oninput="cariPelanggan()"
                        class="text-sm border border-gray-300 rounded-lg pl-9 pr-3 py-2 focus:outline-none focus:border-pink-500 w-full transition">
                </div>
                <button onclick="cariPelanggan()" class="bg-pink-600 hover:bg-pink-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
                <span id="result-count-plg" class="text-xs text-gray-400 ml-2"></span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 border-b border-gray-200">
                            <th class="px-6 py-3 font-medium">Nama</th>
                            <th class="px-6 py-3 font-medium">Email</th>
                            <th class="px-6 py-3 font-medium">Total Pesanan</th>
                            <th class="px-6 py-3 font-medium">Total Belanja</th>
                            <th class="px-6 py-3 font-medium">Tipe</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="tabel-pelanggan">
                        @forelse($pelanggan as $p)
                        <tr class="hover:bg-gray-50 plg-row">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $p->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $p->email }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $p->transaksis_count ?? 0 }} Pesanan</td>
                            <td class="px-6 py-4 font-semibold text-pink-600">Rp {{ number_format($p->transaksis_sum_total_harga ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if(($p->transaksis_count ?? 0) > 3)
                                    <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-md">Loyal</span>
                                @elseif(($p->transaksis_count ?? 0) > 0)
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-md">Reguler</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-md">Baru</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-plg">
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada pelanggan terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100 flex items-center justify-between">
                <p class="text-xs text-gray-500">Menampilkan <span id="plg-count">{{ count($pelanggan) }}</span> pelanggan terdaftar</p>
                <p id="no-result-plg" class="hidden text-xs text-red-400">Tidak ada pelanggan yang cocok dengan pencarian.</p>
            </div>
        </div>
    </main>

    <script>
        function cariPelanggan() {
            const keyword = document.getElementById('search-pelanggan').value.toLowerCase();
            const rows    = document.querySelectorAll('#tabel-pelanggan .plg-row');
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

            document.getElementById('result-count-plg').innerText =
                keyword ? `${visible} hasil ditemukan` : '';
            document.getElementById('plg-count').innerText = visible || {{ count($pelanggan) }};

            const noResult = document.getElementById('no-result-plg');
            noResult.classList.toggle('hidden', visible > 0 || !keyword);
        }

        document.getElementById('search-pelanggan').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') cariPelanggan();
        });
    </script>

</body>
</html>
