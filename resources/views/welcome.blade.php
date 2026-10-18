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
<body class="font-[Poppins] min-h-screen flex flex-col justify-between">

    <nav class="bg-white shadow-sm border-b border-pink-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-10 w-10 object-contain rounded-full bg-pink-100">
                <a href="/" class="text-2xl font-bold text-pink-600 tracking-wider">BY.REESHA</a>
            </div>

            <div class="flex flex-wrap justify-center gap-6 text-sm font-semibold text-gray-600">
                <a href="/" class="text-pink-600 border-b-2 border-pink-600 pb-1">HOME</a>
                <a href="/produk" class="hover:text-pink-600 transition">SEMUA PRODUK</a>
                <a href="/keranjang" class="hover:text-pink-600 transition">KERANJANG</a>
                <a href="/kontak" class="hover:text-pink-600 transition">KONTAK KAMI</a>
                <a href="/tentang-kami" class="hover:text-pink-600 transition">TENTANG KAMI</a>
            </div>

            <div class="flex items-center gap-4">
               @auth
                    <a href="/profil" class="text-sm font-semibold text-gray-700 bg-pink-50 px-3 py-1.5 rounded-xl border border-pink-100 hover:bg-pink-100 transition block">
                         Halo, <strong class="text-pink-600">{{ Auth::user()->name }}</strong>
                    </a>
                    
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-gray-400 hover:text-red-500 transition">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="/login" class="text-sm font-bold text-pink-600 hover:text-pink-700 px-4 py-2 border border-pink-200 rounded-xl hover:bg-pink-50 transition">
                        Masuk
                    </a>
                    <a href="/register" class="text-sm font-bold bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-xl shadow-md shadow-pink-100 transition">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main id="hero-slider" class="w-full min-h-[85vh] bg-cover bg-center flex items-center justify-center relative">
        <div class="max-w-4xl mx-auto px-6 py-20 text-center space-y-6 w-full">
            <div class="inline-block bg-pink-600 px-4 py-1.5 rounded-full shadow-md">
                <span class="text-xs font-bold uppercase tracking-widest text-white">Welcome To By.Reesha</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-extrabold text-white leading-tight tracking-tight drop-shadow-[0_5px_8px_rgba(0,0,0,0.9)]">
                Wujudkan Cake Impianmu<br> 
                <span class="text-pink-300 drop-shadow-[0_5px_8px_rgba(0,0,0,0.9)]">Bersama By.reesha</span>
            </h2>
            <p class="max-w-2xl mx-auto text-white font-medium leading-relaxed text-sm md:text-lg drop-shadow-[0_3px_6px_rgba(0,0,0,0.9)]">
                Kami menyajikan koleksi kue terbaik premium yang dihadirkan secara artistik untuk menyenangkan pelanggan dan berbagai jenis rasa dan tekstur dengan harga yang terjangkau.
            </p>
        </div>

    </main>
    <section class="max-w-7xl mx-auto px-6 py-20 w-full">
        <div class="text-center mb-12">
            <span class="text-pink-600 font-bold text-sm uppercase tracking-wider">Koleksi Terpopuler</span>
            <h3 class="text-3xl font-extrabold text-gray-800 mt-2">Produk Best Seller</h3>
            <div class="w-24 h-1 bg-pink-600 mx-auto mt-4 rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($produkBestSeller as $produk)
            <div class="bg-white rounded-2xl shadow-lg border border-pink-100 overflow-hidden flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                <div class="relative overflow-hidden h-64">
                    <img src="{{ asset('images/' . $produk->gambar) }}"
                         alt="{{ $produk->nama_kue }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-pink-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Best Seller</span>
                    </div>
                </div>
                <div class="p-6 space-y-3 flex-grow flex flex-col justify-between">
                    <div>
                        <h4 class="text-xl font-bold text-gray-800">{{ $produk->nama_kue }}</h4>
                        <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $produk->deskripsi }}</p>
                    </div>
                    <div class="pt-4 flex items-center justify-between">
                        <span class="text-pink-600 font-extrabold text-lg">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <a href="/produk/{{ $produk->id }}" class="bg-pink-600 hover:bg-pink-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-md shadow-pink-100">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="/produk" class="inline-block border-2 border-pink-600 text-pink-600 hover:bg-pink-600 hover:text-white font-bold px-8 py-3 rounded-2xl transition text-sm">
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
</body>
</html>