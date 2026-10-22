<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Keamanan & Kata Sandi</title>
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
                <h1 class="text-base sm:text-lg font-bold text-gray-800">Keamanan & Sandi</h1>
                <p class="text-xs text-gray-400">Ubah kata sandi akun secara berkala</p>
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

        <!-- FORMULIR GANTI PASSWORD -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border border-pink-100">
            <form action="/profil/update-password" method="POST" class="space-y-4">
                @csrf

                <!-- Kata Sandi Saat Ini -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Kata Sandi Saat Ini <span class="text-pink-600">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="current_password" name="current_password" required placeholder="Masukkan kata sandi lama Anda" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl pl-3.5 pr-10 py-2.5 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 focus:outline-none transition">
                        <button type="button" onclick="togglePasswordVisibility('current_password', 'eye-icon-1')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="eye-icon-1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Kata Sandi Baru -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Kata Sandi Baru <span class="text-pink-600">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="new_password" name="new_password" required placeholder="Minimal 6 karakter" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl pl-3.5 pr-10 py-2.5 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 focus:outline-none transition">
                        <button type="button" onclick="togglePasswordVisibility('new_password', 'eye-icon-2')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="eye-icon-2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Konfirmasi Kata Sandi Baru -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Konfirmasi Kata Sandi Baru <span class="text-pink-600">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required placeholder="Ulangi kata sandi baru" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl pl-3.5 pr-10 py-2.5 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 focus:outline-none transition">
                        <button type="button" onclick="togglePasswordVisibility('new_password_confirmation', 'eye-icon-3')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg id="eye-icon-3" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tips Keamanan Singkat & Rapi -->
                <div class="bg-pink-50/30 p-3.5 rounded-2xl border border-pink-100/60 text-[11px] text-gray-500 space-y-1">
                    <div class="font-semibold text-gray-700 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Saran Keamanan Kata Sandi</span>
                    </div>
                    <p class="leading-relaxed pl-5">Gunakan kombinasi minimal 6 karakter dengan huruf dan angka untuk mencegah akses yang tidak sah.</p>
                </div>

                <!-- Tombol Simpan -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 active:scale-[0.99] text-white font-bold text-xs sm:text-sm py-3 rounded-xl shadow-xs transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Perbarui Kata Sandi</span>
                    </button>
                </div>
            </form>
        </div>

    </main>

    <!-- SCRIPT LIHAT/SEMBUNYIKAN PASSWORD -->
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>
