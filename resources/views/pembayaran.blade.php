<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Pembayaran QRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { background-color: #fce7f3; font-family: 'Poppins', sans-serif; }
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 0.4; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .pulse-effect {
            animation: pulse-ring 2s infinite ease-in-out;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4 py-8">

    <div class="bg-white max-w-lg w-full rounded-3xl shadow-2xl overflow-hidden border border-pink-100 relative">
        {{-- Header Strip --}}
        <div class="bg-gradient-to-r from-pink-600 via-pink-500 to-rose-500 text-white p-6 text-center relative">
            <div class="flex items-center justify-center gap-2 mb-2">
                <img src="{{ asset('images/logo.png') }}" alt="By.Reesha" class="h-9 w-9 rounded-full bg-white p-0.5 shadow" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\'><circle cx=\'12\' cy=\'12\' r=\'12\' fill=\'%23fce7f3\'/><text x=\'12\' y=\'16\' font-size=\'14\' text-anchor=\'middle\' fill=\'%23db2777\' font-weight=\'bold\'>BR</text></svg>'">
                <span class="font-extrabold tracking-wider text-lg">BY.REESHA</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold">Pembayaran QRIS</h1>
            <p class="text-pink-100 text-xs sm:text-sm mt-1">Scan QR Code dengan aplikasi e-Wallet atau m-Banking Anda</p>
        </div>

        <div class="p-6 sm:p-8">

            {{-- Status Banner & Timer --}}
            <div class="flex items-center justify-between bg-pink-50 rounded-2xl p-4 mb-6 border border-pink-200">
                <div class="flex items-center gap-2.5">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-600"></span>
                    </span>
                    <div>
                        <p class="text-[11px] uppercase tracking-wider text-pink-600 font-bold" id="label-status">Status Tagihan</p>
                        <p class="text-xs font-semibold text-gray-800" id="text-status">{{ $trx->status === 'Menunggu Pembayaran' ? 'Menunggu Pembayaran' : $trx->status }}</p>
                    </div>
                </div>

                <div class="text-right">
                    <p class="text-[11px] text-gray-500 uppercase tracking-wider font-semibold">Sisa Waktu</p>
                    <p class="text-base font-extrabold text-pink-600 tracking-wider font-mono" id="countdown-timer">15:00</p>
                </div>
            </div>

            {{-- Ringkasan Tagihan --}}
            <div class="text-center mb-6">
                <p class="text-xs text-gray-400 uppercase tracking-wider font-medium">Total yang harus dibayar</p>
                <div class="text-3xl sm:text-4xl font-extrabold text-gray-900 mt-1 flex items-center justify-center gap-1.5">
                    <span>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</span>
                    <button type="button" onclick="salinNominal('{{ $trx->total_harga }}')" title="Salin Nominal" class="text-gray-400 hover:text-pink-600 transition text-sm p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </button>
                </div>
                <div class="inline-flex items-center gap-1 mt-2 text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                    <span>No. Pesanan:</span>
                    <span class="font-bold text-gray-700 font-mono">{{ $trx->kode_transaksi }}</span>
                </div>
            </div>

            {{-- Kotak Gambar QRIS --}}
            <div class="bg-gray-50 border-2 border-dashed border-pink-200 rounded-3xl p-6 flex flex-col items-center justify-center text-center shadow-inner relative group mb-6">
                
                {{-- Logo QRIS & GPN --}}
                <div class="flex items-center justify-between w-full max-w-[260px] mb-3 px-2">
                    <span class="text-xs font-extrabold tracking-widest text-gray-800 flex items-center gap-1">
                        <span class="bg-red-600 text-white px-1.5 py-0.5 rounded text-[10px] font-black">QRIS</span>
                        <span class="text-[10px] text-gray-500 font-bold">STANDAR PEMBAYARAN NASIONAL</span>
                    </span>
                </div>

                @if(!empty($trx->qris_url))
                    <div class="bg-white p-3 rounded-2xl shadow-md border border-gray-200 relative">
                        <img src="{{ $trx->qris_url }}" alt="QRIS By.Reesha" class="w-56 h-56 sm:w-64 sm:h-64 object-contain mx-auto rounded-lg">
                    </div>
                @else
                    <div class="p-8 text-center bg-white rounded-2xl border border-gray-200 w-full">
                        <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-gray-800">QR Code Belum Tersedia</p>
                        <p class="text-xs text-gray-500 mt-1">Pastikan Merchant ID, Client Key, dan Server Key Midtrans sudah terpasang di file <code class="text-pink-600 font-mono">.env</code>.</p>
                    </div>
                @endif

                <p class="text-[11px] text-gray-400 mt-3 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Terverifikasi Midtrans Core API • By.Reesha Cake & Bakery
                </p>
            </div>

            {{-- Supported e-Wallets and Banks --}}
            <div class="mb-6">
                <p class="text-center text-[11px] uppercase tracking-wider text-gray-400 font-semibold mb-2.5">Mendukung Semua Pembayaran QRIS</p>
                <div class="flex flex-wrap items-center justify-center gap-2 text-[11px] font-semibold text-gray-600">
                    <span class="bg-gray-100 px-2.5 py-1 rounded-md">BCA Mobile</span>
                    <span class="bg-gray-100 px-2.5 py-1 rounded-md">Livin' Mandiri</span>
                    <span class="bg-gray-100 px-2.5 py-1 rounded-md">BRImo</span>
                    <span class="bg-gray-100 px-2.5 py-1 rounded-md">BNI Mobile</span>
                    <span class="bg-gray-100 px-2.5 py-1 rounded-md">BSI</span>
                    <span class="bg-pink-100 text-pink-700 px-2.5 py-1 rounded-md">GoPay</span>
                    <span class="bg-indigo-100 text-indigo-700 px-2.5 py-1 rounded-md">OVO</span>
                    <span class="bg-sky-100 text-sky-700 px-2.5 py-1 rounded-md">DANA</span>
                    <span class="bg-orange-100 text-orange-700 px-2.5 py-1 rounded-md">ShopeePay</span>
                </div>
            </div>

            {{-- Cara Pembayaran (Accordion/List) --}}
            <div class="border border-gray-200 rounded-2xl p-4 mb-6 bg-gray-50/50">
                <p class="font-semibold text-gray-800 text-xs sm:text-sm flex items-center gap-1.5 mb-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Cara Melakukan Pembayaran:
                </p>
                <ol class="text-xs text-gray-600 space-y-1.5 list-decimal list-inside pl-1 leading-relaxed">
                    <li>Buka aplikasi <b>m-Banking</b> atau <b>e-Wallet</b> pilihan Anda.</li>
                    <li>Pilih menu <b>Bayar</b> atau <b>Scan QRIS</b>.</li>
                    <li>Arahkan kamera ke QR Code di atas.</li>
                    <li>Periksa nama penerima (<b>By.Reesha</b>) dan total nominal pembayaran.</li>
                    <li>Konfirmasi & masukkan PIN Anda untuk menyelesaikan pembayaran.</li>
                </ol>
            </div>

            {{-- Action Buttons --}}
            <div class="space-y-3">
                <button type="button" id="btn-cek-status" onclick="cekStatusManual()" class="w-full flex items-center justify-center gap-2 py-3.5 px-4 bg-pink-600 hover:bg-pink-700 text-white font-bold rounded-xl shadow-md transition text-sm">
                    <svg id="icon-refresh" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span id="text-cek-status">Cek Status Pembayaran</span>
                </button>

                <div class="flex gap-2">
                    <a href="/riwayat-transaksi" class="flex-1 text-center py-2.5 px-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition text-xs">
                        Riwayat Transaksi
                    </a>
                    <a href="/" class="flex-1 text-center py-2.5 px-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition text-xs">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Toast Notifikasi --}}
    <div id="toast" class="fixed bottom-5 right-5 z-50 bg-gray-900 text-white text-xs px-4 py-2.5 rounded-xl shadow-lg transform translate-y-10 opacity-0 transition-all duration-300 pointer-events-none">
        Teks disalin
    </div>

    <script>
        const trxId = "{{ $trx->id }}";
        const expiredAtStr = "{{ $trx->expired_at ? $trx->expired_at->toIso8601String() : '' }}";
        let expireDate = expiredAtStr ? new Date(expiredAtStr) : new Date(Date.now() + 15 * 60 * 1000);

        // ── 1. Countdown Timer ───────────────────────────────
        function updateTimer() {
            const now = new Date().getTime();
            const distance = expireDate.getTime() - now;

            if (distance <= 0) {
                document.getElementById('countdown-timer').textContent = "00:00";
                document.getElementById('countdown-timer').classList.add('text-rose-600');
                document.getElementById('text-status').textContent = "Kedaluwarsa";
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const minStr = String(minutes).padStart(2, '0');
            const secStr = String(seconds).padStart(2, '0');
            document.getElementById('countdown-timer').textContent = `${minStr}:${secStr}`;
        }
        setInterval(updateTimer, 1000);
        updateTimer();

        // ── 2. Toast Notifikasi ─────────────────────────────
        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.classList.remove('translate-y-10', 'opacity-0');
            setTimeout(() => {
                t.classList.add('translate-y-10', 'opacity-0');
            }, 2500);
        }

        function salinNominal(nom) {
            navigator.clipboard.writeText(nom).then(() => {
                showToast("Nominal Rp " + parseInt(nom).toLocaleString('id-ID') + " berhasil disalin!");
            });
        }

        // ── 3. Auto Polling & Manual Cek Status ──────────────
        let isPolling = true;

        async function periksaStatus(isManual = false) {
            try {
                const response = await fetch(`/transaksi/${trxId}/cek-status`);
                const data = await response.json();

                if (data.paid) {
                    isPolling = false;
                    document.getElementById('text-status').textContent = "Berhasil Dibayar";
                    document.getElementById('label-status').textContent = "Status: Lunas";
                    showToast("Pembayaran berhasil diverifikasi!");

                    setTimeout(() => {
                        window.location.href = `/sukses?id=${trxId}`;
                    }, 1200);
                    return true;
                } else if (data.expired) {
                    isPolling = false;
                    document.getElementById('text-status').textContent = "Kedaluwarsa";
                    if (isManual) showToast("Batas waktu pembayaran telah habis.");
                    return false;
                } else {
                    if (isManual) {
                        showToast("Belum ada pembayaran yang masuk. Silakan selesaikan di aplikasi Anda.");
                    }
                    return false;
                }
            } catch (err) {
                console.error("Gagal memeriksa status: ", err);
                if (isManual) showToast("Gagal menghubungi server. Periksa koneksi internet Anda.");
                return false;
            }
        }

        async function cekStatusManual() {
            const btn = document.getElementById('btn-cek-status');
            const icon = document.getElementById('icon-refresh');
            const text = document.getElementById('text-cek-status');

            icon.classList.add('animate-spin');
            text.textContent = 'Memeriksa ke Midtrans...';
            btn.disabled = true;

            await periksaStatus(true);

            setTimeout(() => {
                icon.classList.remove('animate-spin');
                text.textContent = 'Cek Status Pembayaran';
                btn.disabled = false;
            }, 800);
        }

        // Auto check every 4 seconds
        const pollInterval = setInterval(() => {
            if (!isPolling) {
                clearInterval(pollInterval);
                return;
            }
            periksaStatus(false);
        }, 4000);
    </script>
</body>
</html>
