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

        /* ── MAIN LAYOUT ── */
        .contact-container { max-width: 1160px; margin: auto; padding: 1.5rem 1rem 2rem; }
        @media (min-width: 640px) {
            .contact-container { padding: 2.25rem 1.5rem 2.5rem; }
        }

        /* ── CONTENT GRID ── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 1.5rem;
            margin-bottom: 1.75rem;
            align-items: start;
        }

        /* ── FORM SECTION ── */
        .form-section { background: #fff; border: 1px solid #f0e6ea; border-radius: 16px; padding: 1.25rem; box-shadow: 0 2px 10px rgba(194,24,91,.03); }
        @media (min-width: 640px) {
            .form-section { padding: 1.6rem 1.85rem; }
        }
        .section-title { font-size: 1.05rem; font-weight: 700; color: #1a1a1a; margin-bottom: .25rem; }
        .section-sub { font-size: .8rem; color: #777; margin-bottom: 1.25rem; line-height: 1.5; }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; margin-bottom: .75rem; }
        .form-group { margin-bottom: .85rem; }
        .form-group label { display: block; font-size: .75rem; font-weight: 600; color: #555; margin-bottom: 5px; }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%; font-family: 'Poppins', sans-serif;
            border: 1.5px solid #e8d5da; border-radius: 10px;
            padding: 9px 12px; font-size: .82rem; color: #222;
            background: #fff; outline: none; transition: border .2s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus { border-color: #c2185b; }
        .form-group textarea { resize: vertical; min-height: 95px; }

        .btn-submit {
            width: 100%; background: #c2185b; color: #fff;
            border: none; padding: 11px; border-radius: 10px;
            font-size: .85rem; font-weight: 600; cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: background .2s;
            letter-spacing: .3px;
        }
        .btn-submit:hover { background: #ad1457; }

        .alert-sukses {
            display: none; background: #e8f5e9; border: 1px solid #c8e6c9;
            color: #2e7d32; border-radius: 8px; padding: 10px 14px;
            font-size: .82rem; margin-bottom: 1rem;
        }

        /* ── RIGHT COLUMN ── */
        .right-col { display: flex; flex-direction: column; gap: 1rem; }

        /* Map Card */
        .map-card { border: 1px solid #f0e6ea; border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 2px 10px rgba(194,24,91,.04); }
        .map-header { padding: 0.9rem 1.1rem 0.6rem; }
        .map-header h3 { font-size: .88rem; font-weight: 700; color: #1a1a1a; margin-bottom: 2px; }
        .map-header p { font-size: .75rem; color: #777; line-height: 1.4; }
        .map-embed iframe { width: 100%; height: 165px; display: block; border: 0; }
        .map-footer { padding: .65rem 1.1rem; border-top: 1px solid #f0e6ea; display: flex; justify-content: space-between; align-items: center; }
        .map-footer span { font-size: .72rem; color: #666; font-weight: 500; }
        .map-footer a { font-size: .75rem; color: #c2185b; text-decoration: none; font-weight: 700; }

        /* Quick Info Card under Map */
        .info-card { background: #fff; border: 1px solid #f0e6ea; border-radius: 16px; padding: 0.95rem 1.1rem; box-shadow: 0 2px 10px rgba(194,24,91,.04); }
        .info-card h4 { font-size: .82rem; font-weight: 700; margin-bottom: .55rem; color: #1a1a1a; }
        .info-row { display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #fbf4f6; font-size: .76rem; }
        .info-row:last-child { border-bottom: none; }
        .info-row .label { color: #666; }
        .info-row .val { font-weight: 600; color: #c2185b; }

        /* ── FAQ ── */
        .faq-section { margin-top: 1rem; margin-bottom: 1.75rem; }
        .faq-section > .section-title { margin-bottom: .85rem; font-size: .95rem; }
        .faq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }
        .faq-item { border: 1px solid #f0e6ea; border-radius: 12px; padding: .9rem 1.1rem; background: #fff; box-shadow: 0 1px 6px rgba(194,24,91,.02); }
        .faq-item h5 { font-size: .82rem; font-weight: 600; color: #1a1a1a; margin-bottom: .3rem; }
        .faq-item p { font-size: .75rem; color: #666; line-height: 1.5; }

        /* ── RESPONSIVE ── */
        @media (max-width: 860px) {
            .content-grid { grid-template-columns: 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }
            .faq-grid { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
</head>
<body class="font-[Poppins] min-h-screen flex flex-col justify-between pb-16 md:pb-0">

    <!-- NAVIGATION BAR -->
    @include('partials.navbar', ['active' => 'kontak'])

    <!-- MAIN CONTACT CONTENT -->
    <div class="contact-container">
        
        <!-- TOP CONTENT GRID (Form & Maps) -->
        <div class="content-grid">

            <!-- FORM -->
            <div class="form-section">
                <h2 class="section-title">Kirim Pesan</h2>
                <p class="section-sub">Isi formulir di bawah ini dan tim By.Reesha akan membalas pertanyaan Anda secepatnya.</p>

                <div id="alert-sukses" class="alert-sukses">
                    Pesan Anda berhasil terkirim. Tim kami akan segera menghubungi Anda.
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

            <!-- RIGHT COLUMN (Map & Quick Info) -->
            <div class="right-col">

                <!-- MAP CARD -->
                <div class="map-card">
                    <div class="map-header">
                        <div class="flex items-center justify-between gap-2">
                            <h3 class="flex items-center gap-1.5 font-bold text-gray-800">
                                <svg class="w-4 h-4 text-pink-600 inline flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Lokasi Toko
                            </h3>
                            <span class="text-[10px] bg-pink-50 text-pink-700 font-bold px-2 py-0.5 rounded-full border border-pink-100">Lhokseumawe</span>
                        </div>
                        <p class="mt-1">Muara Satu, Kota Lhokseumawe, Aceh 24353</p>
                    </div>
                    <div class="map-embed">
                        <iframe
                            src="https://maps.google.com/maps?q=5.2109939,97.0683937&z=16&output=embed"
                            allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                    <div class="map-footer">
                        <span class="flex items-center gap-1.5 text-emerald-700 text-[11px] font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                            Area Parkir Tersedia
                        </span>
                        <a href="https://maps.app.goo.gl/t5yQ2WQuSXwbEUbA6" target="_blank" class="hover:underline flex items-center gap-1">
                            Buka di Maps →
                        </a>
                    </div>
                </div>

                <!-- QUICK INFO CARD UNDER MAP -->
                <div class="info-card">
                    <h4 class="flex items-center gap-1.5 font-bold text-gray-800">
                        <svg class="w-3.5 h-3.5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Layanan
                    </h4>
                    <div class="info-row">
                        <span class="label">Jam Operasional</span>
                        <span class="val">08.00 - 20.00 WIB</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Hari Buka</span>
                        <span class="val">Setiap Hari</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Pemesanan Custom</span>
                        <span class="val">H-2 s/d H-5</span>
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-pink-50 flex items-center justify-between">
                        <span class="text-[11px] text-gray-500 font-medium">Respon Cepat:</span>
                        <a href="https://wa.me/6282141519323" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 px-3 py-1.5 rounded-xl shadow-xs transition">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            Chat WhatsApp
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- FAQ SECTION -->
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

    <!-- COMPACT FOOTER INFO -->
    <footer class="bg-white/80 border-t border-pink-100 py-6 px-4 mt-6">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-left mb-6">
            <div>
                <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-2">Alamat Toko</h4>
                <p class="text-xs text-gray-600 leading-relaxed">
                    <a href="https://maps.app.goo.gl/t5yQ2WQuSXwbEUbA6" target="_blank" class="text-pink-600 hover:underline font-medium">
                        Muara Satu, Kota Lhokseumawe,<br>Aceh 24353
                    </a>
                </p>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-2">Hubungi Kami</h4>
                <p class="text-xs text-gray-600 leading-relaxed">
                    <a href="https://wa.me/6282141519323" target="_blank" class="text-pink-600 hover:underline font-medium block">WA: +62 821-4151-9323</a>
                    <a href="mailto:byreesha.cake@gmail.com" target="_blank" class="text-pink-600 hover:underline font-medium block">byreesha.cake@gmail.com</a>
                </p>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-2">Jam Buka</h4>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Senin - Sabtu: 08.00 - 20.00<br>
                    Minggu: 09.00 - 17.00 WIB
                </p>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-2">Sosial Media</h4>
                <p class="text-xs text-gray-600 leading-relaxed">
                    <a href="https://instagram.com/by.reesha" target="_blank" class="text-pink-600 hover:underline font-medium">
                        Instagram: @by.reesha
                    </a>
                </p>
            </div>
        </div>
        <div class="text-center text-[11px] text-gray-400 border-t border-pink-50 pt-4 max-w-6xl mx-auto">
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
    </script>

    @include('partials.bottom_nav', ['active' => 'kontak'])
</body>
</html>
