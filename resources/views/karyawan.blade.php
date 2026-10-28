<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Manajemen Karyawan</title>
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

    @include('partials.owner_sidebar', ['active' => 'karyawan'])

    
    <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl mx-auto w-full custom-scrollbar pb-24 md:pb-8">

        @if(session('sukses'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-xl flex items-center gap-2.5 shadow-2xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-medium">{{ session('sukses') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm rounded-xl flex items-center gap-2.5 shadow-2xs">
            <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 pb-6 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
                    <span>Portal Manajemen</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-pink-600 font-semibold">Data Karyawan</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Karyawan</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Daftar akun staf, penugasan divisi operasional, dan hak akses sistem.</p>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition hover:shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Karyawan</span>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
            
            <div class="p-4 sm:p-5 border-b border-slate-200/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="relative flex-1 max-w-md">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search-karyawan" placeholder="Cari berdasarkan nama, email, atau divisi..." oninput="cariKaryawan()"
                        class="w-full text-xs sm:text-sm border border-slate-200 rounded-xl pl-9 pr-3 py-2 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition">
                </div>

                <div class="flex items-center justify-between sm:justify-end gap-3 text-xs text-slate-500">
                    <span id="result-count-kar" class="text-slate-400"></span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 font-medium text-slate-700">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Total: <strong id="kar-count" class="text-slate-900">{{ $karyawan->count() }}</strong> Karyawan</span>
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 border-b border-slate-200 text-[11px] font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5">Nama & Profil</th>
                            <th class="px-5 py-3.5">Email</th>
                            <th class="px-5 py-3.5 text-center">Divisi / Penugasan</th>
                            <th class="px-5 py-3.5">Tanggal Terdaftar</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="tabel-karyawan">
                        @forelse($karyawan as $i => $k)
                        <tr class="hover:bg-slate-50/60 transition-colors kar-row">
                            
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-tr from-pink-500 to-rose-400 text-white font-bold text-xs shrink-0 ring-1 ring-slate-200">
                                        @if($k->avatar)
                                            <img src="{{ $k->avatar_url }}" class="w-full h-full object-cover" alt="{{ $k->name }}">
                                        @else
                                            <span>{{ strtoupper(substr($k->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-slate-800 text-xs sm:text-sm truncate">{{ $k->name }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-xs text-slate-600 font-mono">
                                {{ $k->email }}
                            </td>

                            <td class="px-5 py-4 text-center">
                                @if($k->divisi)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-semibold bg-violet-50 text-violet-700 border border-violet-200">
                                        {{ $k->divisi }}
                                    </span>
                                @else
                                    <span class="text-slate-400 text-xs italic">-</span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-xs text-slate-500">
                                {{ $k->created_at ? $k->created_at->locale('id')->isoFormat('D MMMM Y') : '-' }}
                            </td>

                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="openModalEdit({{ $k->id }}, '{{ addslashes($k->name) }}', '{{ addslashes($k->email) }}', '{{ $k->divisi }}')"
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-slate-200 text-slate-700 hover:text-blue-600 hover:border-blue-300 text-xs font-semibold transition" title="Ubah Data">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span>Edit</span>
                                    </button>

                                    <form action="/karyawan/{{ $k->id }}/hapus" method="POST"
                                        onsubmit="return confirm('Konfirmasi: Hapus akun karyawan {{ $k->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-slate-200 text-slate-700 hover:text-red-600 hover:border-red-300 text-xs font-semibold transition" title="Hapus Akun">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="row-empty-kar">
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="max-w-xs mx-auto text-slate-400">
                                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p class="text-sm font-semibold text-slate-600">Belum ada karyawan terdaftar</p>
                                    <p class="text-xs text-slate-400 mt-1">Gunakan tombol di kanan atas untuk mendaftarkan akun staf baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    
    <div id="modal-tambah" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-5 pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h2 class="text-base font-bold text-slate-900">Tambah Akun Karyawan</h2>
                </div>
                <button onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="/karyawan/tambah" method="POST" class="space-y-4 text-xs sm:text-sm">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Nama lengkap karyawan"
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" required placeholder="staf@gmail.com"
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Divisi / Penugasan</label>
                    <select name="divisi" required
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 bg-white">
                        <option value="">-- Pilih Penugasan Divisi --</option>
                        <optgroup label="Produksi & Dapur">
                            <option value="Baker (Pembuat Kue)">Baker (Pembuat Kue)</option>
                            <option value="Dekorasi Kue">Dekorasi Kue</option>
                            <option value="Pembuat Adonan">Pembuat Adonan</option>
                            <option value="Pastry Chef">Pastry Chef</option>
                        </optgroup>
                        <optgroup label="Operasional & Gudang">
                            <option value="Packaging">Packaging</option>
                            <option value="Quality Control">Quality Control</option>
                            <option value="Gudang & Logistik">Gudang & Logistik</option>
                        </optgroup>
                        <optgroup label="Pelayanan Pelanggan">
                            <option value="Kasir">Kasir</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="Kurir / Pengiriman">Kurir / Pengiriman</option>
                        </optgroup>
                        <optgroup label="Administrasi">
                            <option value="Admin">Admin</option>
                        </optgroup>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Password Sementara</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter"
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                    <p class="text-[11px] text-slate-400 mt-1">Karyawan dapat memperbarui password secara mandiri melalui menu profil.</p>
                </div>
                <div class="pt-3 flex gap-3">
                    <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                        class="flex-1 border border-slate-200 text-slate-600 font-semibold py-2.5 rounded-xl hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2.5 rounded-xl transition shadow-xs">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="modal-edit" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-5 pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h2 class="text-base font-bold text-slate-900">Perbarui Data Karyawan</h2>
                </div>
                <button onclick="document.getElementById('modal-edit').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="form-edit" method="POST" class="space-y-4 text-xs sm:text-sm">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="edit-name" name="name" required
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Email</label>
                    <input type="email" id="edit-email" name="email" required
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Divisi / Penugasan</label>
                    <select id="edit-divisi" name="divisi" required
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 bg-white">
                        <option value="">-- Pilih Penugasan Divisi --</option>
                        <optgroup label="Produksi & Dapur">
                            <option value="Baker (Pembuat Kue)">Baker (Pembuat Kue)</option>
                            <option value="Dekorasi Kue">Dekorasi Kue</option>
                            <option value="Pembuat Adonan">Pembuat Adonan</option>
                            <option value="Pastry Chef">Pastry Chef</option>
                        </optgroup>
                        <optgroup label="Operasional & Gudang">
                            <option value="Packaging">Packaging</option>
                            <option value="Quality Control">Quality Control</option>
                            <option value="Gudang & Logistik">Gudang & Logistik</option>
                        </optgroup>
                        <optgroup label="Pelayanan Pelanggan">
                            <option value="Kasir">Kasir</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="Kurir / Pengiriman">Kurir / Pengiriman</option>
                        </optgroup>
                        <optgroup label="Administrasi">
                            <option value="Admin">Admin</option>
                        </optgroup>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Password Baru <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="password" name="password" placeholder="Kosongkan bila tidak diubah"
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500">
                </div>
                <div class="pt-3 flex gap-3">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="flex-1 border border-slate-200 text-slate-600 font-semibold py-2.5 rounded-xl hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                        class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2.5 rounded-xl transition shadow-xs">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModalEdit(id, name, email, divisi) {
            document.getElementById('modal-edit').classList.remove('hidden');
            document.getElementById('form-edit').action = '/karyawan/' + id + '/edit';
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-divisi').value = divisi;
        }

        function cariKaryawan() {
            const keyword = document.getElementById('search-karyawan').value.toLowerCase();
            const rows    = document.querySelectorAll('#tabel-karyawan .kar-row');
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

            document.getElementById('result-count-kar').innerText =
                keyword ? `${visible} hasil` : '';
            document.getElementById('kar-count').innerText =
                keyword ? visible : {{ $karyawan->count() }};
        }

        document.getElementById('search-karyawan').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') cariKaryawan();
        });
    </script>
</body>
</html>
