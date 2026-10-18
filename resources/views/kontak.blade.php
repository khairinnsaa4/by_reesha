<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami — By.Reesha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #FFF8F9; color: #1a1a1a; }

        /* ── HERO STRIP ── */
        .page-hero {
            background: linear-gradient(135deg, #c2185b 0%, #e91e63 60%, #f06292 100%);
            padding: 3.5rem 2rem 3rem;
            text-align: center;
            color: #fff;
        }
        .page-hero p.eyebrow { font-size: .78rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; opacity: .85; margin-bottom: .6rem; }
        .page-hero h1 { font-size: 2.4rem; font-weight: 700; margin-bottom: .6rem; }
        .page-hero p.sub { font-size: .92rem; opacity: .9; max-width: 480px; margin: auto; line-height: 1.7; }

        /* ── MAIN LAYOUT ── */
        .contact-container { max-width: 1160px; margin: auto; padding: 0 1.5rem; }

        /* ── CONTACT INFO BAR ── */
        .info-bar {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            border: 1px solid #f0e6ea;
            border-radius: 12px;
            overflow: hidden;
            margin: 3rem auto;
            background: #fff;
            box-shadow: 0 2px 16px rgba(194,24,91,.07);
        }
        .info-item {
            padding: 1.6rem 1.4rem;
            border-right: 1px solid #f0e6ea;
            display: flex; align-items: flex-start; gap: 14px;
        }
        .info-item:last-child { border-right: none; }
        .info-icon {
            width: 42px; height: 42px; border-radius: 10px;
            background: #fce4ec; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .info-icon svg { width: 20px; height: 20px; stroke: #c2185b; fill: none; stroke-width: 1.8; }
        .info-label { font-size: .72rem; font-weight: 600; color: #aaa; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 4px; }
        .info-value { font-size: .87rem; font-weight: 500; color: #222; line-height: 1.5; }
        .info-value a { color: #c2185b; text-decoration: none; }

        /* ── CONTENT GRID ── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2.5rem;
            margin-bottom: 4rem;
            align-items: start;
        }

        /* ── FORM SECTION ── */
        .form-section { background: #fff; border: 1px solid #f0e6ea; border-radius: 12px; padding: 2.2rem; }
        .section-title { font-size: 1.1rem; font-weight: 700; color: #1a1a1a; margin-bottom: .3rem; }
        .section-sub { font-size: .82rem; color: #888; margin-bottom: 1.8rem; line-height: 1.6; }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-size: .78rem; font-weight: 600; color: #555; margin-bottom: 6px; }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%; font-family: 'Poppins', sans-serif;
            border: 1.5px solid #e8d5da; border-radius: 8px;
            padding: 10px 14px; font-size: .85rem; color: #222;
            background: #fff; outline: none; transition: border .2s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus { border-color: #c2185b; }
        .form-group textarea { resize: vertical; min-height: 110px; }

        .btn-submit {
            width: 100%; background: #c2185b; color: #fff;
            border: none; padding: 12px; border-radius: 8px;
            font-size: .9rem; font-weight: 600; cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: background .2s;
            letter-spacing: .3px;
        }
        .btn-submit:hover { background: #ad1457; }

        .alert-sukses {
            display: none; background: #e8f5e9; border: 1px solid #c8e6c9;
            color: #2e7d32; border-radius: 8px; padding: 12px 16px;
            font-size: .85rem; margin-bottom: 1.2rem;
        }

        /* ── RIGHT COLUMN ── */
        .right-col { display: flex; flex-direction: column; gap: 1.2rem; }

        /* Map */
        .map-card { border: 1px solid #f0e6ea; border-radius: 12px; overflow: hidden; background: #fff; }
        .map-header { padding: 1.2rem 1.4rem .8rem; }
        .map-header h3 { font-size: .95rem; font-weight: 700; color: #1a1a1a; margin-bottom: 3px; }
        .map-header p { font-size: .78rem; color: #888; }
        .map-embed iframe { width: 100%; height: 220px; display: block; border: 0; }
        .map-footer { padding: .8rem 1.4rem; border-top: 1px solid #f0e6ea; display: flex; justify-content: space-between; }
        .map-footer span { font-size: .75rem; color: #888; }
        .map-footer a { font-size: .75rem; color: #c2185b; text-decoration: none; font-weight: 600; }

        /* WA Card */
        .wa-card {
            background: #25d366; color: #fff;
            border-radius: 12px; padding: 1.4rem;
            display: flex; align-items: center; gap: 14px;
            text-decoration: none; transition: background .2s;
        }
        .wa-card:hover { background: #1ebe5d; }
        .wa-icon { width: 44px; height: 44px; background: rgba(255,255,255,.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .wa-icon svg { width: 24px; height: 24px; fill: #fff; }
        .wa-text strong { display: block; font-size: .92rem; font-weight: 700; margin-bottom: 2px; }
        .wa-text span { font-size: .78rem; opacity: .9; }

        /* Jam ops card */
        .hours-card { background: #fff; border: 1px solid #f0e6ea; border-radius: 12px; padding: 1.4rem; }
        .hours-card h4 { font-size: .9rem; font-weight: 700; margin-bottom: 1rem; color: #1a1a1a; }
        .hours-row { display: flex; justify-content: space-between; padding: 7px 0; border-bottom: 1px solid #f5f5f5; font-size: .82rem; }
        .hours-row:last-child { border-bottom: none; }
        .hours-row .day { color: #555; }
        .hours-row .time { font-weight: 600; color: #c2185b; }
        .hours-row .closed { font-weight: 600; color: #bbb; }

        /* ── FAQ ── */
        .faq-section { margin-bottom: 4rem; }
        .faq-section > .section-title { margin-bottom: 1.6rem; }
        .faq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .faq-item { border: 1px solid #f0e6ea; border-radius: 10px; padding: 1.4rem; }
        .faq-item h5 { font-size: .87rem; font-weight: 600; color: #1a1a1a; margin-bottom: .5rem; }
        .faq-item p { font-size: .82rem; color: #666; line-height: 1.6; }

        /* ── FOOTER ── */
        footer { background: #fff; border-top: 1px solid #f0e6ea; padding: 1.5rem 2rem; text-align: center; font-size: .78rem; color: #aaa; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .info-bar { grid-template-columns: 1fr 1fr; }
            .info-item { border-right: 1px solid #f0e6ea; border-bottom: 1px solid #f0e6ea; }
            .content-grid { grid-template-columns: 1fr; }
            .faq-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 540px) {
            .info-bar { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
            .page-hero h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body class="font-[Poppins] min-h-screen flex flex-col justify-between">

    <!-- NAVIGATION BAR -->
    <nav class="bg-white shadow-sm border-b border-pink-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3.5 flex justify-between items-center">
            
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="Logo By.Reesha" class="h-9 w-9 sm:h-10 sm:w-10 object-contain rounded-full bg-pink-100" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
                <a href="/" class="text-xl sm:text-2xl font-bold text-pink-600 tracking-wider">BY.REESHA</a>
            </div>

            <div class="hidden md:flex items-center gap-6 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-pink-600 transition">HOME</a>
                <a href="/produk" class="hover:text-pink-600 transition">SEMUA PRODUK</a>
                <a href="/keranjang" class="hover:text-pink-600 transition">KERANJANG</a>
                <a href="/kontak" class="text-pink-600 border-b-2 border-pink-600 pb-1">KONTAK KAMI</a>
                <a href="/tentang-kami" class="hover:text-pink-600 transition">TENTANG KAMI</a>
            </div>

            <div class="hidden md:flex items-center gap-4">
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

            <!-- Mobile Actions -->
            <div class="flex items-center gap-2 md:hidden">
                <a href="/keranjang" class="p-2 text-gray-600 hover:text-pink-600 transition rounded-lg hover:bg-pink-50" aria-label="Keranjang">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </a>
                <button type="button" id="mobile-menu-btn" class="p-2 text-gray-700 hover:text-pink-600 rounded-lg hover:bg-pink-50 transition focus:outline-none" aria-label="Buka Menu">
                    <svg id="hamburger-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-pink-100 bg-white px-4 pt-3 pb-5 space-y-2.5 shadow-lg">
            <a href="/" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">HOME</a>
            <a href="/produk" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">SEMUA PRODUK</a>
            <a href="/keranjang" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">KERANJANG</a>
            <a href="/kontak" class="block px-3 py-2 rounded-lg font-semibold text-sm text-pink-600 bg-pink-50">KONTAK KAMI</a>
            <a href="/tentang-kami" class="block px-3 py-2 rounded-lg font-semibold text-sm text-gray-700 hover:text-pink-600 hover:bg-pink-50 transition">TENTANG KAMI</a>

            <div class="border-t border-gray-100 pt-3 mt-3">
                @auth
                    <div class="flex items-center justify-between mb-2">
                        <a href="/profil" class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                            <span>👤</span>
                            <span>Halo, <strong class="text-pink-600">{{ Auth::user()->name }}</strong></span>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <a href="/profil" class="text-center text-xs font-bold text-gray-700 bg-pink-50 py-2.5 rounded-xl border border-pink-100 hover:bg-pink-100 transition">
                            Akun Saya
                        </a>
                        <form action="/logout" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-center text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 py-2.5 rounded-xl transition">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <a href="/login" class="text-center text-sm font-bold text-pink-600 py-2.5 border border-pink-200 rounded-xl hover:bg-pink-50 transition">
                            Masuk
                        </a>
                        <a href="/register" class="text-center text-sm font-bold bg-pink-600 text-white py-2.5 rounded-xl shadow-md shadow-pink-100 hover:bg-pink-700 transition">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTACT INFO BAR -->
    <div class="contact-container" style="padding-top: 3rem;">
        <!-- MAIN CONTENT GRID -->
        <div class="content-grid">

            <!-- FORM -->
            <div class="form-section">
                <h2 class="section-title">Kirim Pesan</h2>
                <p class="section-sub">Isi formulir di bawah ini dan tim kami akan membalas dalam 1×24 jam kerja.</p>

                <div id="alert-sukses" class="alert-sukses">
                    Pesan Anda berhasil terkirim. Kami akan segera menghubungi Anda.
                </div>

                <form id="contact-form" onsubmit="kirimPesan(event)">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <span style="color:#c2185b">*</span></label>
                            <input type="text" id="nama" required placeholder="Nama Anda">
                        </div>
                        <div class="form-group">
                            <label for="kontak">WhatsApp / Email <span style="color:#c2185b">*</span></label>
                            <input type="text" id="kontak" required placeholder="0821xxxx atau email@...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="topik">Topik Pertanyaan <span style="color:#c2185b">*</span></label>
                        <select id="topik" required>
                            <option value="">Pilih topik...</option>
                            <option>Pemesanan Custom Cake</option>
                            <option>Cek Ketersediaan Tanggal</option>
                            <option>Konsultasi Desain Kue</option>
                            <option>Kerjasama & Event</option>
                            <option>Keluhan & Pertanyaan Lain</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pesan">Pesan <span style="color:#c2185b">*</span></label>
                        <textarea id="pesan" required placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Kirim Pesan</button>
                </form>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="right-col">

                <!-- MAP -->
                <div class="map-card">
                    <div class="map-header">
                        <h3>Lokasi Toko</h3>
                        <p>Muara Satu, Kota Lhokseumawe, Aceh 24353</p>
                    </div>
                    <div class="map-embed">
                        <iframe
                            src="https://maps.google.com/maps?q=5.2109939,97.0683937&z=16&output=embed"
                            allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                    <div class="map-footer">
                        <span>📍 Parkir tersedia</span>
                        <a href="https://maps.app.goo.gl/t5yQ2WQuSXwbEUbA6" target="_blank">Buka di Maps →</a>
                    </div>
                </div>



            </div>
        </div>

        <!-- FAQ -->
        <div class="faq-section">
            <h2 class="section-title">Pertanyaan Umum</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <h5>Berapa lama waktu pengerjaan kue custom?</h5>
                    <p>Untuk Bento Cake dan kue reguler minimal pemesanan H-2. Kue custom dengan desain kompleks disarankan pesan minimal H-5 agar hasilnya optimal.</p>
                </div>
                <div class="faq-item">
                    <h5>Apakah tersedia layanan pengiriman?</h5>
                    <p>Ya, kami bekerja sama dengan kurir yang terlatih membawa kue. Tersedia pengiriman ke seluruh wilayah Banda Aceh dan sekitarnya.</p>
                </div>
                <div class="faq-item">
                    <h5>Metode pembayaran apa saja yang diterima?</h5>
                    <p>Kami menerima QRIS (semua e-wallet dan mobile banking), transfer bank, serta bayar di tempat (COD) khusus pengambilan langsung ke toko.</p>
                </div>
                <div class="faq-item">
                    <h5>Bisakah request desain dan rasa sesuai keinginan?</h5>
                    <p>Tentu bisa. Anda cukup mengirimkan referensi desain atau mendeskripsikan keinginan via WhatsApp saat melakukan pemesanan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER INFO -->
    <footer style="background: #FFF8F9; border-top: 1px solid #fce7f3; padding: 3rem 2rem 1.5rem; margin-top: 4rem;">
        <div style="max-width: 1160px; margin: auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-bottom: 2rem; text-align: left;">
            <div>
                <h4 style="font-size: .85rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Alamat Toko</h4>
                <p style="font-size: .8rem; color: #666; line-height: 1.6;">
                    <a href="https://maps.app.goo.gl/t5yQ2WQuSXwbEUbA6" target="_blank" style="color: #c2185b; text-decoration: none; font-weight: 600;">Muara Satu, Kota Lhokseumawe,<br>Aceh 24353, Indonesia</a>
                </p>
            </div>
            <div>
                <h4 style="font-size: .85rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Hubungi Kami</h4>
                <p style="font-size: .8rem; color: #666; line-height: 1.6;">
                    <a href="https://wa.me/6282141519323" target="_blank" style="color: #c2185b; text-decoration: none; font-weight: 600;">WA: +62 821-4151-9323</a><br>
                    <a href="mailto:byreesha.cake@gmail.com" target="_blank" style="color: #c2185b; text-decoration: none; font-weight: 600;">Email: byreesha.cake@gmail.com</a>
                </p>
            </div>
            <div>
                <h4 style="font-size: .85rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Jam Operasional</h4>
                <p style="font-size: .8rem; color: #666; line-height: 1.6;">Senin - Sabtu: 08.00 - 20.00 WIB<br>Minggu: 09.00 - 17.00 WIB</p>
            </div>
            <div>
                <h4 style="font-size: .85rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">Sosial Media</h4>
                <p style="font-size: .8rem; color: #666; line-height: 1.6;">
                    <a href="https://instagram.com/by.reesha" target="_blank" style="color: #c2185b; text-decoration: none; font-weight: 600;">Instagram: @by.reesha</a>
                </p>
            </div>
        </div>
        <div style="text-align: center; font-size: .75rem; color: #aaa; border-top: 1px solid #eee; padding-top: 1.5rem;">
            &copy; {{ date('Y') }} By.Reesha. Hak Cipta Dilindungi.
        </div>
    </footer>

    <script>
        function kirimPesan(e) {
            e.preventDefault();
            document.getElementById('alert-sukses').style.display = 'block';
            document.getElementById('contact-form').reset();
            window.scrollTo({ top: 400, behavior: 'smooth' });
        }

        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }
    </script>

</body>
</html>
