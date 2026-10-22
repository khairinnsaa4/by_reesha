<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Bantuan & Layanan</title>
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
                <h1 class="text-base sm:text-lg font-bold text-gray-800">Bantuan & Customer Service</h1>
                <p class="text-xs text-gray-400">Hubungi kami untuk konsultasi pesanan atau kendala</p>
            </div>
        </div>

        <!-- KARTU HUBUNGI KAMI LANGSUNG -->
        <div class="space-y-3.5 mb-6">
            
            <!-- WhatsApp CS -->
            <div class="bg-white rounded-3xl p-5 shadow-sm border border-pink-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-gray-800">Customer Service WhatsApp</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Respon cepat untuk tanya jawab produk & custom cake</p>
                        <p class="text-[11px] text-gray-400 mt-1">Setiap hari: 08.00 - 20.00 WIB</p>
                    </div>
                </div>
                <a href="https://wa.me/6282141519323" target="_blank" class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-2.5 px-4 rounded-xl shadow-xs transition flex-shrink-0">
                    <span>Chat Sekarang</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <!-- Lokasi Toko di Google Maps -->
            <div class="bg-white rounded-3xl p-5 shadow-sm border border-pink-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-gray-800">Lokasi Fisik Toko</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Kunjungi outlet By.Reesha atau ambil pesanan langsung</p>
                        <p class="text-[11px] text-gray-400 mt-1">Cek rute tercepat via Google Maps</p>
                    </div>
                </div>
                <a href="https://maps.app.goo.gl/t5yQ2WQuSXwbEUbA6" target="_blank" class="inline-flex items-center justify-center gap-2 bg-white hover:bg-pink-50 text-pink-600 border border-pink-200 font-bold text-xs py-2.5 px-4 rounded-xl shadow-2xs transition flex-shrink-0">
                    <span>Lihat di Maps</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
            </div>

        </div>

        <!-- PANDUAN & FAQ TERTATA RAPI -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border border-pink-100">
            <h2 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Pertanyaan yang Sering Diajukan</span>
            </h2>

            <div class="space-y-3">
                <div class="p-3.5 rounded-2xl bg-pink-50/20 border border-pink-100/60">
                    <h3 class="text-xs font-bold text-gray-800 mb-1">Bagaimana cara memesan kue?</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Pilih produk yang Anda sukai di menu Semua Produk, tentukan varian rasa dan ukuran, lalu klik tombol Checkout atau masukkan ke Keranjang belanja terlebih dahulu.
                    </p>
                </div>

                <div class="p-3.5 rounded-2xl bg-pink-50/20 border border-pink-100/60">
                    <h3 class="text-xs font-bold text-gray-800 mb-1">Berapa lama estimasi pesanan diproses?</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Kue reguler yang tersedia siap dikirim pada hari yang sama. Untuk desain custom cake bertema, pemesanan sebaiknya dilakukan minimal 1 hari sebelumnya.
                    </p>
                </div>

                <div class="p-3.5 rounded-2xl bg-pink-50/20 border border-pink-100/60">
                    <h3 class="text-xs font-bold text-gray-800 mb-1">Metode pembayaran apa saja yang didukung?</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Kami menerima pembayaran melalui QRIS (dapat dipindai dari semua aplikasi e-wallet dan perbankan digital) serta Transfer Bank.
                    </p>
                </div>

                <div class="p-3.5 rounded-2xl bg-pink-50/20 border border-pink-100/60">
                    <h3 class="text-xs font-bold text-gray-800 mb-1">Bagaimana jika ingin konsultasi request tulisan/desain khusus?</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Anda dapat langsung menghubungi admin kami via WhatsApp melalui tombol kontak di atas. Sertakan referensi foto kue yang Anda inginkan.
                    </p>
                </div>
            </div>
        </div>

    </main>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>
