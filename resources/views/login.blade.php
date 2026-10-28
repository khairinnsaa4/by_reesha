<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Masuk Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-[#FFF8F9] font-[Poppins] min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-5 sm:p-8 rounded-2xl sm:rounded-3xl shadow-xl shadow-pink-100 border border-pink-100 w-full max-w-md space-y-6">
        <div class="text-center space-y-2">
            <div class="flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-14 rounded-full bg-pink-100" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'56\' height=\'56\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang</h2>
            <p class="text-xs text-gray-400">Silakan masuk ke akun BY.REESHA kamu</p>
        </div>

        @if(session('sukses'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs p-3 rounded-xl text-center font-semibold">
                {{ session('sukses') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-xs p-3 rounded-xl text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-xs p-3 rounded-xl text-center font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase tracking-wider">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="w-full px-4 py-3 rounded-xl border border-pink-100 focus:outline-none focus:border-pink-400 text-sm transition bg-pink-50/30" placeholder="nama@email.com">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase tracking-wider">Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required autocomplete="current-password" class="w-full px-4 py-3 rounded-xl border border-pink-100 focus:outline-none focus:border-pink-400 text-sm transition bg-pink-50/30 pr-12" placeholder="••••••••">
                    <button type="button" onclick="togglePassword('password', 'eye-icon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-pink-600 transition" aria-label="Lihat Kata Sandi">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-pink-100 transition transform hover:-translate-y-0.5 text-sm">
                    Masuk Sekarang 
                </button>
            </div>
        </form>

        <div class="text-center text-xs text-gray-500 pt-2">
            Belum punya akun? <a href="/register" class="text-pink-600 font-bold hover:underline">Daftar di sini</a>
            <br><br>
            <a href="/" class="text-gray-400 hover:text-pink-600 transition">← Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.695 9.695A3 3 0 0014 14m4.244-1.244A10.581 10.581 0 0121.542 12c-1.274 4.057-5.064 7-9.542 7-1.155 0-2.278-.184-3.332-.524M3 3l18 18" />
                `;
            } else {
                passwordInput.type = "password";
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</body>
</html>
