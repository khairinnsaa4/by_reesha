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
<body class="min-h-screen flex flex-col">

    <!-- NAVIGATION BAR -->
    <nav class="bg-white shadow-sm border-b border-pink-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-10 w-10 object-contain rounded-full bg-pink-100" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
                <a href="/" class="text-2xl font-bold text-pink-600 tracking-wider">BY.REESHA</a>
            </div>

            <div class="flex flex-wrap justify-center gap-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-pink-600 transition">HOME</a>
                <a href="/produk" class="hover:text-pink-600 transition">SEMUA PRODUK</a>
                <a href="/keranjang" class="hover:text-pink-600 transition">KERANJANG</a>
                <a href="/kontak" class="hover:text-pink-600 transition">KONTAK KAMI</a>
                <a href="/tentang-kami" class="text-pink-600 border-b-2 border-pink-600 pb-1">TENTANG KAMI</a>
            </div>

            <div class="flex items-center gap-4">
               @auth
                    <a href="/profil" class="text-sm font-semibold text-gray-700 bg-pink-50 px-3 py-1.5 rounded-xl border border-pink-100 hover:bg-pink-100 transition block">
                         Halo, <strong class="text-pink-600">{{ Auth::user()->name }}</strong>
                    </a>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-gray-400 hover:text-red-500 transition">Keluar</button>
                    </form>
                @else
                    <a href="/login" class="text-sm font-bold text-pink-600 hover:text-pink-700 px-4 py-2 border border-pink-200 rounded-xl hover:bg-pink-50 transition">Masuk</a>
                    <a href="/register" class="text-sm font-bold bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-xl shadow-md shadow-pink-100 transition">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="flex-grow max-w-5xl mx-auto px-6 py-16 w-full">
        <div class="text-center mb-16">
            <span class="text-pink-600 font-bold text-sm uppercase tracking-wider">Mengenal Lebih Dekat</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mt-2">Tentang By.Reesha</h2>
            <div class="w-24 h-1 bg-pink-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-pink-50 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-8 md:p-12 flex flex-col justify-center space-y-6">
                    <h3 class="text-2xl font-bold text-gray-800">Bermula dari Cinta pada Rasa dan Estetika</h3>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        By.Reesha lahir dari sebuah gairah untuk menghadirkan kebahagiaan melalui sepotong kue. Kami percaya bahwa setiap perayaan—mulai dari ulang tahun, hari jadi, hingga momen kecil dalam hidup—layak mendapatkan kue yang tidak hanya lezat, tetapi juga indah dipandang.
                    </p>
                    <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                        Dengan komitmen untuk menggunakan bahan-bahan premium berkualitas tinggi, By.Reesha hadir dengan spesialisasi custom cake, bento cake, hingga kreasi elegan lainnya yang disesuaikan secara personal untuk memenuhi ekspektasi Anda.
                    </p>
                </div>
                <div class="h-64 md:h-auto bg-pink-100 flex items-center justify-center">
                    <!-- Placeholder untuk foto toko atau owner, atau gambar kue cantik -->
                    <img src="{{ asset('images/bento_cake.jpg') }}" alt="Tentang By.Reesha" class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <div class="bg-white p-8 rounded-3xl text-center shadow-sm border border-pink-50">
                <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">🍰</div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Bahan Premium</h4>
                <p class="text-gray-500 text-sm">Hanya menggunakan bahan baku pilihan terbaik untuk menjamin rasa yang konsisten dan lezat.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl text-center shadow-sm border border-pink-50">
                <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">🎨</div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Desain Kustom</h4>
                <p class="text-gray-500 text-sm">Setiap kue dibuat dengan ketelitian dan nilai estetika tinggi sesuai dengan request desain pelanggan.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl text-center shadow-sm border border-pink-50">
                <div class="w-16 h-16 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">💖</div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Dibuat dengan Cinta</h4>
                <p class="text-gray-500 text-sm">Fresh from the oven. Setiap pesanan dibuat khusus di hari yang sama agar tetap fresh dan higienis.</p>
            </div>
        </div>

    </main>

    <footer class="bg-white border-t border-pink-100 text-center py-6 text-xs text-gray-400 mt-auto">
        &copy; 2026 By.Reesha. All rights reserved.
    </footer>

</body>
</html>
