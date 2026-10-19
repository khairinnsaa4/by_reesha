<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Tentang Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #FFF8F9; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col pb-16 md:pb-0">

    <!-- NAVIGATION BAR -->
    @include('partials.navbar', ['active' => 'tentang'])

    <!-- CONTENT -->
    <main class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 py-10 md:py-16 w-full">
        <div class="text-center mb-10 md:mb-16">
            <span class="text-pink-600 font-bold text-xs sm:text-sm uppercase tracking-wider">Mengenal Lebih Dekat</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-800 mt-2">Tentang By.Reesha</h2>
            <div class="w-20 sm:w-24 h-1 bg-pink-600 mx-auto mt-3 rounded-full"></div>
        </div>

        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-pink-50 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6 sm:p-8 md:p-12 flex flex-col justify-center space-y-4 md:space-y-6">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-800">Bermula dari Cinta pada Rasa dan Estetika</h3>
                    <p class="text-gray-600 leading-relaxed text-xs sm:text-sm md:text-base">
                        By.Reesha lahir dari sebuah gairah untuk menghadirkan kebahagiaan melalui sepotong kue. Kami percaya bahwa setiap perayaan—mulai dari ulang tahun, hari jadi, hingga momen kecil dalam hidup—layak mendapatkan kue yang tidak hanya lezat, tetapi juga indah dipandang.
                    </p>
                    <p class="text-gray-600 leading-relaxed text-xs sm:text-sm md:text-base">
                        Dengan komitmen untuk menggunakan bahan-bahan premium berkualitas tinggi, By.Reesha hadir dengan spesialisasi custom cake, bento cake, hingga kreasi elegan lainnya yang disesuaikan secara personal untuk memenuhi ekspektasi Anda.
                    </p>
                </div>
                <div class="h-56 sm:h-64 md:h-auto bg-pink-100 flex items-center justify-center">
                    <img src="{{ asset('images/bento_cake.jpg') }}" alt="Tentang By.Reesha" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/logo.png') }}'">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 mt-8 md:mt-12">
            <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl text-center shadow-sm border border-pink-50">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <h4 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Bahan Premium</h4>
                <p class="text-gray-500 text-xs sm:text-sm">Hanya menggunakan bahan baku pilihan terbaik untuk menjamin rasa yang konsisten dan lezat.</p>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl text-center shadow-sm border border-pink-50">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4 5 5 0 015-5c1.1 0 2.1.4 2.8 1.1L17.4 6.5a2 2 0 012.8 2.8L13.6 15.9c.7.7 1.1 1.7 1.1 2.8a5 5 0 01-5 5 4 4 0 01-2.7-.9z"/></svg>
                </div>
                <h4 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Desain Kustom</h4>
                <p class="text-gray-500 text-xs sm:text-sm">Setiap kue dibuat dengan ketelitian dan nilai estetika tinggi sesuai dengan request desain pelanggan.</p>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl text-center shadow-sm border border-pink-50">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <svg class="w-7 h-7 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
                <h4 class="text-base sm:text-lg font-bold text-gray-800 mb-2">Dibuat dengan Cinta</h4>
                <p class="text-gray-500 text-xs sm:text-sm">Fresh from the oven. Setiap pesanan dibuat khusus di hari yang sama agar tetap fresh dan higienis.</p>
            </div>
        </div>

    </main>

    <footer class="bg-white border-t border-pink-100 text-center py-6 text-xs text-gray-400 mt-auto">
        &copy; 2026 By.Reesha. All rights reserved.
    </footer>

    @include('partials.bottom_nav', ['active' => 'tentang'])
</body>
</html>
