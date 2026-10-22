<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Alamat Pengiriman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #FFF8F9; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between pb-20 md:pb-8">

    <!-- NAVIGATION BAR -->
    @include('partials.navbar', ['active' => 'profil'])

    <!-- MAIN CONTAINER -->
    <main class="max-w-xl mx-auto px-4 py-6 sm:py-8 w-full flex-grow">
        
        <!-- HEADER NAVIGASI KEMBALI KE PROFIL -->
        <div class="flex items-center gap-3.5 mb-6">
            <a href="/profil" class="w-10 h-10 rounded-2xl bg-white border border-pink-100 flex items-center justify-center text-gray-600 hover:text-pink-600 hover:border-pink-300 transition shadow-xs flex-shrink-0" title="Kembali ke Profil">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-base sm:text-lg font-bold text-gray-800">Alamat Pengiriman</h1>
                <p class="text-xs text-gray-400">Atur tujuan pengantaran kue & patokan rumah</p>
            </div>
        </div>

        <!-- NOTIFIKASI SUKSES / ERROR -->
        @if(session('sukses'))
        <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-2xl flex items-center gap-2.5 shadow-xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('sukses') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-800 text-xs rounded-2xl shadow-xs">
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

        <!-- PREVIEW ALAMAT AKTIF SAAT INI (JIKA SUDAH ADA) -->
        @if(Auth::user()->address)
        <div class="bg-white rounded-3xl p-5 shadow-sm border border-pink-100 mb-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold text-gray-700 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Alamat Aktif Saat Ini
                </span>
                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100">Utama</span>
            </div>
            <p class="text-xs sm:text-sm text-gray-700 font-medium leading-relaxed bg-pink-50/20 p-3.5 rounded-2xl border border-pink-50 mb-2">
                {{ Auth::user()->address }}
            </p>
            <p class="text-[11px] text-gray-400">
                Nomor Kontak: <span class="text-gray-700 font-medium">{{ Auth::user()->phone ?? 'Belum diisi' }}</span>
            </p>
        </div>
        @endif

        <!-- FORMULIR PERBARUI ALAMAT PENGIRIMAN -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border border-pink-100">
            <h2 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center gap-2">
                <span>{{ Auth::user()->address ? 'Perbarui Alamat Pengiriman' : 'Tambah Alamat Pengiriman' }}</span>
            </h2>

            <form action="/profil/update-alamat-form" method="POST" class="space-y-4">
                @csrf

                <!-- Nama Penerima -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Penerima</label>
                    <input type="text" value="{{ Auth::user()->name }}" disabled class="w-full text-xs sm:text-sm bg-gray-50 text-gray-500 border border-gray-200 rounded-xl px-3.5 py-2.5 cursor-not-allowed">
                    <span class="text-[10px] text-gray-400 mt-1 block">Sesuai nama profil akun Anda. Ubah nama di menu Informasi Akun jika diperlukan.</span>
                </div>

                <!-- Nomor HP / WhatsApp -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                        No. WhatsApp / HP Penerima <span class="text-pink-600">*</span>
                    </label>
                    <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required placeholder="Contoh: 0821xxxxxxxx" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 focus:outline-none transition">
                    <span class="text-[10px] text-gray-400 mt-1 block">Nomor aktif untuk konfirmasi pengantaran oleh kurir.</span>
                </div>

                <!-- Alamat Lengkap -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Alamat Lengkap & Patokan <span class="text-pink-600">*</span>
                    </label>
                    <textarea name="address" rows="4" required placeholder="Contoh: Jl. Merdeka No. 12, Gampong Kuta Blang, Lhokseumawe (Depan Masjid Al-Ikhlas, Pagar Putih)" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 focus:outline-none transition">{{ old('address', Auth::user()->address) }}</textarea>
                    <span class="text-[10px] text-gray-400 mt-1 block">Sertakan detail nama jalan, RT/RW, kelurahan, dan patokan rumah agar kurir mudah menemukan alamat Anda.</span>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 active:scale-[0.99] text-white font-bold text-xs sm:text-sm py-3 rounded-xl shadow-xs transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Simpan Alamat Pengiriman</span>
                    </button>
                </div>
            </form>
        </div>

    </main>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>
