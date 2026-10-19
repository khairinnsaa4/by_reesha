<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Akun Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-[#FFF8F9] font-[Poppins] min-h-screen flex flex-col items-center p-4">

    <!-- Header -->
    <div class="mt-4 sm:mt-8 mb-4 sm:mb-8 text-center">
        <h1 class="text-pink-600 text-xl sm:text-2xl font-bold tracking-wide">Akun Saya</h1>
    </div>

    <!-- Avatar & Info -->
    <div class="text-center w-full max-w-md flex flex-col items-center">
        <div class="h-24 w-24 sm:h-32 sm:w-32 rounded-full bg-white shadow-xl flex items-center justify-center mb-4 sm:mb-6 border-4 border-pink-100 overflow-hidden">
            @if(Auth::user()->avatar)
                <img src="{{ url('/') . '/' . Auth::user()->avatar }}" class="h-full w-full object-cover">
            @else
                <span class="text-3xl sm:text-5xl font-bold text-pink-600 uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </span>
            @endif
        </div>

        <h2 class="text-xl sm:text-3xl font-bold text-gray-800 mb-1 capitalize">{{ Auth::user()->name }}</h2>
        <p class="text-gray-500 text-sm sm:text-base mb-5 sm:mb-6">{{ Auth::user()->email }}</p>

        @if(session('sukses'))
        <div class="w-full mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl flex items-center justify-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('sukses') }}</span>
        </div>
        @endif


        <!-- Buttons Container -->
        <div class="w-full space-y-3 mt-2">
            @if(Auth::user()->role === 'owner')
                <a href="/dashboard-owner" class="block w-full text-center bg-gray-900 hover:bg-black text-white font-bold py-3.5 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 text-sm">
                    Masuk ke Dashboard Owner
                </a>
            @elseif(Auth::user()->role === 'karyawan')
                <a href="/dashboard-karyawan" class="block w-full text-center bg-gray-900 hover:bg-black text-white font-bold py-3.5 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 text-sm">
                    Masuk ke Dashboard Karyawan
                </a>
                @if(Auth::user()->isPembuatKue())
                <a href="/resep" class="block w-full text-center bg-pink-600 hover:bg-pink-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-pink-100 transition transform hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Buku Resep & Bahan Kue</span>
                </a>
                @endif
            @endif

            <!-- Riwayat Transaksi (Khusus Pelanggan) -->
            @if(Auth::user()->role === 'pelanggan')
            <a href="/riwayat-transaksi" class="block w-full text-center bg-pink-600 hover:bg-pink-700 text-white font-bold py-3.5 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 text-sm flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                </svg>
                Riwayat Transaksi
            </a>
            @endif

            <!-- Kembali ke Beranda -->
            <a href="/" class="block w-full text-center border-2 border-pink-200 text-pink-600 hover:bg-pink-50 font-bold py-3.5 rounded-xl transition transform hover:-translate-y-0.5 text-sm">
                Kembali ke Beranda 
            </a>
        </div>
    </div>

</body>
</html>
