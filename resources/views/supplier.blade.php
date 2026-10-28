<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Data Mitra Supplier</title>
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

    @include('partials.owner_sidebar', ['active' => 'supplier'])

    
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar pb-24 md:pb-8">

        @if(session('sukses'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-xl flex items-center gap-2.5 shadow-2xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-medium">{{ session('sukses') }}</span>
        </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 pb-6 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
                    <span>Portal Manajemen</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-pink-600 font-semibold">Data Supplier</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Mitra & Pemasok</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Daftar kontak vendor, pasokan bahan baku utama, kemasan, dan rekanan logistik.</p>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="toggleModal('modal-tambah')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Supplier</span>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            
            <div class="p-4 sm:p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="relative flex-1 max-w-md">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-supplier" placeholder="Cari nama supplier, kategori, kontak, atau alamat..." oninput="cariSupplier()"
                        class="w-full text-xs sm:text-sm border border-slate-200 rounded-xl pl-9 pr-3 py-2 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition">
                </div>

                <div class="text-xs text-slate-500">
                    <span id="result-count-sup" class="text-slate-400 font-medium"></span>
                    <span class="ml-2 font-medium text-slate-600">Total: <strong id="sup-count" class="text-slate-900">{{ $suppliers->count() }}</strong> Vendor</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-200 text-[11px] font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5">Nama Perusahaan / Supplier</th>
                            <th class="px-5 py-3.5">Kategori Pasokan</th>
                            <th class="px-5 py-3.5">Kontak / WhatsApp</th>
                            <th class="px-5 py-3.5">Alamat Operasional</th>
                            <th class="px-5 py-3.5 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="tabel-supplier">
                        @forelse($suppliers as $sup)
                        <tr class="hover:bg-slate-50/60 transition-colors sup-row">
                            
                            <td class="px-5 py-4 font-semibold text-slate-800 text-xs sm:text-sm">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center shrink-0 border border-pink-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <span>{{ $sup->nama_supplier }}</span>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded-md border border-slate-200">
                                    {{ $sup->kategori }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-slate-700 font-mono text-xs">
                                {{ $sup->kontak }}
                            </td>

                            <td class="px-5 py-4 text-slate-500 text-xs max-w-xs truncate">
                                {{ $sup->alamat }}
                            </td>

                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <button onclick="openEditModal({{ $sup }})" class="p-1.5 text-slate-500 hover:text-blue-600 hover:bg-slate-100 rounded-lg transition" title="Ubah Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="/supplier/{{ $sup->id }}/hapus" method="POST" onsubmit="return confirm('Konfirmasi: Hapus data supplier {{ $sup->nama_supplier }}?')" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-100 rounded-lg transition" title="Hapus Supplier">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-sup">
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                Belum ada data supplier yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <div id="modal-tambah" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-200">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <h3 class="text-base font-bold text-slate-900">Tambah Mitra Supplier Baru</h3>
                <button type="button" onclick="toggleModal('modal-tambah')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="/supplier/tambah" method="POST" class="space-y-4 text-xs sm:text-sm">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Perusahaan / Supplier</label>
                    <input type="text" name="nama_supplier" required placeholder="Contoh: PT Boga Flour Indonesia" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kategori Pasokan</label>
                    <select name="kategori" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 bg-white">
                        <option value="Bahan Baku">Bahan Baku</option>
                        <option value="Bahan Utama">Bahan Utama</option>
                        <option value="Packaging">Packaging</option>
                        <option value="Peralatan">Peralatan</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Kontak / WhatsApp</label>
                    <input type="text" name="kontak" required placeholder="0812-xxxx-xxxx" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Kantor / Gudang</label>
                    <textarea name="alamat" required rows="2" placeholder="Jl. Industri No. 12, Jakarta" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500"></textarea>
                </div>
                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="toggleModal('modal-tambah')" class="px-4 py-2 border border-slate-200 rounded-xl font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-xl font-semibold transition shadow-xs">Simpan Supplier</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-edit" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-200">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <h3 class="text-base font-bold text-slate-900">Perbarui Data Supplier</h3>
                <button type="button" onclick="toggleModal('modal-edit')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="form-edit" method="POST" class="space-y-4 text-xs sm:text-sm">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Perusahaan / Supplier</label>
                    <input type="text" id="edit-nama" name="nama_supplier" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kategori Pasokan</label>
                    <select id="edit-kategori" name="kategori" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 bg-white">
                        <option value="Bahan Baku">Bahan Baku</option>
                        <option value="Bahan Utama">Bahan Utama</option>
                        <option value="Packaging">Packaging</option>
                        <option value="Peralatan">Peralatan</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Kontak / WhatsApp</label>
                    <input type="text" id="edit-kontak" name="kontak" required class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Kantor / Gudang</label>
                    <textarea id="edit-alamat" name="alamat" required rows="2" class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500"></textarea>
                </div>
                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="toggleModal('modal-edit')" class="px-4 py-2 border border-slate-200 rounded-xl font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-xl font-semibold transition shadow-xs">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function openEditModal(sup) {
            document.getElementById('form-edit').action = '/supplier/' + sup.id + '/update';
            document.getElementById('edit-nama').value = sup.nama_supplier;
            document.getElementById('edit-kategori').value = sup.kategori;
            document.getElementById('edit-kontak').value = sup.kontak;
            document.getElementById('edit-alamat').value = sup.alamat;
            toggleModal('modal-edit');
        }

        function cariSupplier() {
            const keyword = document.getElementById('search-supplier').value.toLowerCase();
            const rows    = document.querySelectorAll('#tabel-supplier .sup-row');
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

            document.getElementById('result-count-sup').innerText =
                keyword ? `${visible} supplier ditemukan` : '';
            document.getElementById('sup-count').innerText =
                keyword ? visible : {{ $suppliers->count() }};
        }

        document.getElementById('search-supplier').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') cariSupplier();
        });
    </script>
</body>
</html>
