<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Akun Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { background-color: #FFF8F9; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between pb-20 md:pb-8">

    @include('partials.navbar', ['active' => 'profil'])

    <main class="max-w-xl mx-auto px-4 py-6 sm:py-8 w-full flex-grow">

        <div class="bg-white rounded-3xl p-5 shadow-sm border border-pink-100 flex items-center gap-4 mb-4">
            <div class="relative flex-shrink-0">
                <div class="h-16 w-16 sm:h-20 sm:w-20 rounded-full bg-gradient-to-tr from-pink-500 to-rose-400 text-white shadow-md flex items-center justify-center border-2 border-pink-100 overflow-hidden">
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar_url }}" class="h-full w-full object-cover" alt="Foto Profil">
                    @else
                        <span class="text-2xl font-bold uppercase tracking-wider">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    @endif
                </div>
                
                <a href="/profil/edit" class="absolute -bottom-1 -right-1 w-7 h-7 sm:w-8 sm:h-8 bg-pink-600 hover:bg-pink-700 text-white rounded-full flex items-center justify-center shadow-md border-2 border-white transition transform hover:scale-110 active:scale-95" title="Ubah Profil">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </a>
            </div>

            <div class="flex-grow min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-gray-800 truncate capitalize">{{ Auth::user()->name }}</h2>
                    @if(Auth::user()->role === 'owner')
                        <span class="bg-gray-900 text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Owner</span>
                    @elseif(Auth::user()->role === 'karyawan')
                        <span class="bg-pink-100 text-pink-700 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Staf</span>
                    @else
                        <span class="bg-pink-50 text-pink-600 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase border border-pink-100">Member</span>
                    @endif
                </div>
                <p class="text-gray-400 text-xs truncate mt-0.5">{{ Auth::user()->email }}</p>
                @if(Auth::user()->phone)
                    <p class="text-gray-500 text-xs truncate mt-0.5">{{ Auth::user()->phone }}</p>
                @endif
            </div>
        </div>

        @if(session('sukses'))
        <div class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-2xl flex items-center gap-2.5 shadow-xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('sukses') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-4 p-3.5 bg-red-50 border border-red-200 text-red-800 text-xs rounded-2xl shadow-xs">
            <div class="flex items-center gap-1.5 font-bold mb-1 text-red-700">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Mohon periksa kembali:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(Auth::user()->role === 'owner')
            <div class="mb-4">
                <a href="/dashboard-owner" class="flex items-center justify-between p-4 bg-gray-900 hover:bg-black text-white rounded-2xl shadow-sm transition">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gray-800 flex items-center justify-center text-pink-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm">Panel Manajemen Owner</h3>
                            <p class="text-[11px] text-gray-300">Laporan penjualan, keuangan & staf</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        @elseif(Auth::user()->role === 'karyawan')
            <div class="mb-4">
                <a href="/dashboard-karyawan" class="flex items-center justify-between p-4 bg-gray-900 hover:bg-black text-white rounded-2xl shadow-sm transition">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gray-800 flex items-center justify-center text-pink-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm">Panel Operasional Karyawan</h3>
                            <p class="text-[11px] text-gray-300">Kelola antrean kue & pesanan harian</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-pink-100 overflow-hidden divide-y divide-gray-100 mb-6">

            <a href="/riwayat-transaksi" class="flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 group">
                <div class="flex items-center gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0 group-hover:bg-pink-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-800 text-sm sm:text-base block">Pesanan Saya</span>
                        <span class="text-[11px] text-gray-400 block">Riwayat transaksi & status kue yang dipesan</span>
                    </div>
                </div>
                <svg class="w-4 h-4 text-gray-400 group-hover:text-pink-600 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="/profil/alamat" class="flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 group">
                <div class="flex items-center gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0 group-hover:bg-pink-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-800 text-sm sm:text-base block">Alamat Pengiriman</span>
                        <span class="text-[11px] text-gray-400 block">Tujuan pengantaran kue & patokan rumah</span>
                    </div>
                </div>
                <svg class="w-4 h-4 text-gray-400 group-hover:text-pink-600 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="/profil/edit" class="flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 group">
                <div class="flex items-center gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0 group-hover:bg-pink-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-800 text-sm sm:text-base block">Informasi Akun</span>
                        <span class="text-[11px] text-gray-400 block">Nama lengkap & kontak pelanggan</span>
                    </div>
                </div>
                <svg class="w-4 h-4 text-gray-400 group-hover:text-pink-600 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="/profil/keamanan" class="flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 group">
                <div class="flex items-center gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0 group-hover:bg-pink-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-800 text-sm sm:text-base block">Keamanan & Sandi</span>
                        <span class="text-[11px] text-gray-400 block">Ubah kata sandi akun secara berkala</span>
                    </div>
                </div>
                <svg class="w-4 h-4 text-gray-400 group-hover:text-pink-600 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="/profil/bantuan" class="flex items-center justify-between px-5 py-4 text-left transition hover:bg-pink-50/30 group">
                <div class="flex items-center gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0 group-hover:bg-pink-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-800 text-sm sm:text-base block">Bantuan & Customer Service</span>
                        <span class="text-[11px] text-gray-400 block">Konsultasi custom cake & kendala pesanan</span>
                    </div>
                </div>
                <svg class="w-4 h-4 text-gray-400 group-hover:text-pink-600 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <button type="button" onclick="openLogoutModal()" class="w-full flex items-center justify-between px-5 py-4 text-left transition hover:bg-red-50/50 group focus:outline-none">
                <div class="flex items-center gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0 group-hover:bg-red-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-red-600 text-sm sm:text-base block">Keluar dari Akun</span>
                        <span class="text-[11px] text-gray-400 block">Akhiri sesi akun Anda di perangkat ini</span>
                    </div>
                </div>
                <svg class="w-4 h-4 text-red-400 group-hover:text-red-600 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

        </div>

        <div class="text-center text-xs text-gray-400">
            <a href="/" class="hover:text-pink-600 transition font-medium inline-flex items-center gap-1">
                <span>&larr; Kembali ke Beranda</span>
            </a>
        </div>

    </main>

    <div id="logout-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl p-6 sm:p-7 max-w-sm w-full shadow-xl border border-pink-100 transform transition-all text-center">
            <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 mx-auto flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>
            <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-1">Keluar dari Akun?</h3>
            <p class="text-xs text-gray-500 mb-6 leading-relaxed">
                Apakah Anda yakin ingin keluar dari akun By.Reesha? Anda dapat masuk kembali kapan saja.
            </p>
            <div class="flex items-center gap-2.5">
                <button type="button" onclick="closeLogoutModal()" class="flex-1 py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs sm:text-sm rounded-xl transition">
                    Batal
                </button>
                <a href="/logout" class="flex-1 py-2.5 px-4 bg-red-600 hover:bg-red-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-sm transition inline-flex items-center justify-center">
                    Ya, Keluar
                </a>
            </div>
        </div>
    </div>

    <script>
        function openLogoutModal() {
            const modal = document.getElementById('logout-modal');
            if (modal) modal.classList.remove('hidden');
        }
        function closeLogoutModal() {
            const modal = document.getElementById('logout-modal');
            if (modal) modal.classList.add('hidden');
        }

        document.getElementById('logout-modal')?.addEventListener('click', function(e) {
            if (e.target === this) closeLogoutModal();
        });
    </script>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>
