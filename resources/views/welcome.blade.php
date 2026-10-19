<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #FFF8F9;
        }
        #hero-slider {
            transition: background-image 0.8s ease-in-out;
        }
    </style>
</head>
<body class="font-[Poppins] min-h-screen flex flex-col justify-between pb-16 md:pb-0">

    @include('partials.navbar', ['active' => 'home'])

    <main id="hero-slider" class="w-full min-h-[70vh] md:min-h-[85vh] bg-cover bg-center flex items-center justify-center relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 py-12 md:py-20 text-center space-y-4 md:space-y-6 w-full">
            <div class="inline-block bg-pink-600 px-3.5 py-1 md:px-4 md:py-1.5 rounded-full shadow-md">
                <span class="text-[11px] sm:text-xs font-bold uppercase tracking-widest text-white">Welcome To By.Reesha</span>
            </div>
            <h2 class="text-2xl sm:text-4xl md:text-6xl font-extrabold text-white leading-tight tracking-tight drop-shadow-[0_5px_8px_rgba(0,0,0,0.9)]">
                Wujudkan Cake Impianmu<br> 
                <span class="text-pink-300 drop-shadow-[0_5px_8px_rgba(0,0,0,0.9)]">Bersama By.reesha</span>
            </h2>
            <p class="max-w-2xl mx-auto text-white font-medium leading-relaxed text-xs sm:text-base md:text-lg drop-shadow-[0_3px_6px_rgba(0,0,0,0.9)]">
                Kami menyajikan koleksi kue terbaik premium yang dihadirkan secara artistik untuk menyenangkan pelanggan dan berbagai jenis rasa dan tekstur dengan harga yang terjangkau.
            </p>
        </div>

    </main>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20 w-full">
        <div class="text-center mb-8 md:mb-12">
            <span class="text-pink-600 font-bold text-xs sm:text-sm uppercase tracking-wider">Koleksi Terpopuler</span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-2">Produk Best Seller</h3>
            <div class="w-20 sm:w-24 h-1 bg-pink-600 mx-auto mt-3 rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
            @foreach($produkBestSeller as $produk)
            <div class="bg-white rounded-2xl shadow-lg border border-pink-100 overflow-hidden flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                <div class="relative overflow-hidden h-48 sm:h-56 md:h-64">
                    <img src="{{ asset('images/' . $produk->gambar) }}"
                         alt="{{ $produk->nama_kue }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                         onerror="this.src='{{ asset('images/logo.png') }}'">
                    <div class="absolute top-3 left-3">
                        <span class="bg-pink-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Best Seller</span>
                    </div>
                </div>
                <div class="p-4 sm:p-6 space-y-3 flex-grow flex flex-col justify-between">
                    <div>
                        <h4 class="text-lg sm:text-xl font-bold text-gray-800">{{ $produk->nama_kue }}</h4>
                        <p class="text-gray-500 text-xs sm:text-sm mt-1 line-clamp-2">{{ $produk->deskripsi }}</p>
                    </div>
                    <div class="pt-3 sm:pt-4 flex items-center justify-between">
                        <span class="text-pink-600 font-extrabold text-base sm:text-lg">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <a href="/produk/{{ $produk->id }}" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold px-3.5 py-2 sm:px-4 sm:py-2 rounded-xl transition shadow-md shadow-pink-100">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8 md:mt-10">
            <a href="/produk" class="inline-block border-2 border-pink-600 text-pink-600 hover:bg-pink-600 hover:text-white font-bold px-6 py-2.5 sm:px-8 sm:py-3 rounded-2xl transition text-xs sm:text-sm">
                Lihat Semua Produk →
            </a>
        </div>
    </section>

    <footer class="bg-white border-t border-pink-100 text-center py-6 text-xs text-gray-400">&copy; 2026 By.Reesha. All rights reserved.</footer>

    <script>
        const daftarSampul = [
            "{{ asset('images/sampul1.jpg') }}",
            "{{ asset('images/sampul2.jpg') }}"
        ];

        let indexSekarang = 0;
        const heroElement = document.getElementById('hero-slider');

        function putarSampul() {
            heroElement.style.backgroundImage = `url('${daftarSampul[indexSekarang]}')`;
            indexSekarang = (indexSekarang + 1) % daftarSampul.length;
        }

        putarSampul();
        setInterval(putarSampul, 4000);
    </script>

    @include('partials.bottom_nav', ['active' => 'home'])
</body>
</html>