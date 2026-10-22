<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Data Pelanggan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-slate-800 bg-[#f8fafc]">

    @include('partials.owner_sidebar', ['active' => 'pelanggan'])

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA                          -->
    <!-- ========================================== -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar">

        <!-- Executive Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 pb-6 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
                    <span>Portal Manajemen</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-pink-600 font-semibold">Data Pelanggan</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Database Pelanggan</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Daftar akun pembeli terdaftar, frekuensi transaksi, dan akumulasi belanja.</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-xs text-slate-700 shadow-2xs font-semibold">
                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Total: <strong id="header-plg-count" class="text-slate-900">{{ count($pelanggan) }}</strong> Pelanggan</span>
                </span>
            </div>
        </div>

        <!-- Table Card Container -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            <!-- Table Header Toolbar -->
            <div class="p-4 sm:p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="relative flex-1 max-w-md">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-pelanggan" placeholder="Cari berdasarkan nama atau email pelanggan..." oninput="cariPelanggan()"
                        class="w-full text-xs sm:text-sm border border-slate-200 rounded-xl pl-9 pr-3 py-2 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition">
                </div>

                <div class="text-xs text-slate-500">
                    <span id="result-count-plg" class="text-slate-400"></span>
                </div>
            </div>

            <!-- Table Body -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-200 text-[11px] font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5">Pelanggan</th>
                            <th class="px-5 py-3.5">Alamat Email</th>
                            <th class="px-5 py-3.5 text-center">Frekuensi Pesanan</th>
                            <th class="px-5 py-3.5">Total Nilai Belanja</th>
                            <th class="px-5 py-3.5 text-center">Status Loyalitas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="tabel-pelanggan">
                        @forelse($pelanggan as $p)
                        <tr class="hover:bg-slate-50/60 transition-colors plg-row">
                            <!-- Name & Avatar -->
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-tr from-pink-500 to-rose-400 text-white font-bold text-xs shrink-0 ring-1 ring-slate-200">
                                        @if($p->avatar)
                                            <img src="{{ $p->avatar_url }}" class="w-full h-full object-cover" alt="{{ $p->name }}">
                                        @else
                                            <span>{{ strtoupper(substr($p->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <span class="font-semibold text-slate-800 text-xs sm:text-sm truncate">{{ $p->name }}</span>
                                </div>
                            </td>

                            <!-- Email -->
                            <td class="px-5 py-4 text-xs text-slate-600 font-mono">
                                {{ $p->email }}
                            </td>

                            <!-- Order Frequency -->
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-700">
                                    {{ $p->transaksis_count ?? 0 }} pesanan
                                </span>
                            </td>

                            <!-- Total Spend -->
                            <td class="px-5 py-4 font-bold text-slate-900 text-xs">
                                Rp {{ number_format($p->transaksis_sum_total_harga ?? 0, 0, ',', '.') }}
                            </td>

                            <!-- Loyalty Badge -->
                            <td class="px-5 py-4 text-center">
                                @if(($p->transaksis_count ?? 0) > 3)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-violet-50 text-violet-700 border border-violet-200 text-[11px] font-semibold rounded-md">
                                        <svg class="w-3 h-3 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Loyal Customer
                                    </span>
                                @elseif(($p->transaksis_count ?? 0) > 0)
                                    <span class="inline-flex items-center px-2.5 py-1 bg-sky-50 text-sky-700 border border-sky-200 text-[11px] font-semibold rounded-md">
                                        Reguler
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 bg-slate-100 text-slate-600 border border-slate-200 text-[11px] font-semibold rounded-md">
                                        Pelanggan Baru
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-plg">
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="max-w-xs mx-auto text-slate-400">
                                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                                    </svg>
                                    <p class="text-sm font-semibold text-slate-600">Belum ada pelanggan terdaftar</p>
                                    <p class="text-xs text-slate-400 mt-1">Akun pembeli yang mendaftar akan tersimpan secara otomatis di sini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 bg-slate-50/40">
                <span>Menampilkan <strong id="plg-count" class="text-slate-800">{{ count($pelanggan) }}</strong> data pelanggan</span>
                <span id="no-result-plg" class="hidden text-rose-500 font-medium">Tidak ada pelanggan yang cocok dengan kata kunci pencarian.</span>
            </div>
        </div>

    </main>

    <!-- Scripts -->
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
                keyword ? `${visible} hasil` : '';
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
