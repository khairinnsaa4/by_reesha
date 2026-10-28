<div id="modal-struk-kasir" class="fixed inset-0 z-50 hidden flex items-center justify-center p-3 sm:p-4 bg-slate-950/60 backdrop-blur-xs transition-opacity duration-200">
    <div class="relative w-full max-w-sm sm:max-w-md bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden flex flex-col max-h-[92vh] animate-in fade-in zoom-in-95 duration-150">
        
        <div class="px-5 py-3.5 border-b border-slate-200 bg-slate-50 flex items-center justify-between no-print">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 leading-tight">Struk Kasir Resmi</h3>
                    <p class="text-[11px] text-slate-500">Pratinjau struk transaksi penjualan</p>
                </div>
            </div>
            <button type="button" onclick="tutupModalStruk()" class="w-7 h-7 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 flex items-center justify-center transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-4 sm:p-5 overflow-y-auto custom-scrollbar bg-slate-100/70">
            <div id="area-cetak-struk" class="bg-white p-5 sm:p-6 rounded-xl border border-slate-200/90 shadow-xs font-mono text-xs text-slate-800 leading-relaxed max-w-xs mx-auto">
                
                <div class="text-center pb-3 border-b border-dashed border-slate-300">
                    <h2 class="text-base font-extrabold tracking-wider text-slate-900 uppercase">BY.REESHA CAKE</h2>
                    <p class="text-[10px] text-slate-500 uppercase tracking-tight font-sans">Artisan Cake & Premium Bakery</p>
                    <p class="text-[10px] text-slate-500 mt-1 font-sans">Jl. Cut Nyak Dien, Kutablang, Lhokseumawe</p>
                    <p class="text-[10px] text-slate-500 font-sans">WhatsApp: 0822-7711-2233</p>
                </div>

                <div class="py-3 border-b border-dashed border-slate-300 space-y-1 text-[11px]">
                    <div class="flex justify-between">
                        <span class="text-slate-500">No. Struk</span>
                        <span id="struk-kode" class="font-bold text-slate-900">#TRX-0000</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Tanggal</span>
                        <span id="struk-tanggal" class="text-slate-800">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Kasir</span>
                        <span id="struk-kasir" class="text-slate-800 font-semibold">{{ Auth::user()->name ?? 'Kasir By.Reesha' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Pelanggan</span>
                        <span id="struk-pelanggan" class="font-semibold text-slate-900 truncate max-w-[130px]">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Pengiriman</span>
                        <span id="struk-pengiriman" class="text-slate-800">Ambil di Toko</span>
                    </div>
                </div>

                <div class="py-3 border-b border-dashed border-slate-300">
                    <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider mb-2 flex justify-between">
                        <span>Item</span>
                        <span>Total</span>
                    </div>
                    <div id="struk-items-container" class="space-y-2">
                        <div>
                            <p id="struk-nama-produk" class="font-bold text-slate-900 text-xs leading-snug">Nama Kue</p>
                            <div class="flex justify-between text-[11px] text-slate-600 mt-0.5">
                                <span id="struk-qty-harga">1 x Rp 0</span>
                                <span id="struk-item-total" class="font-bold text-slate-900">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-3 border-b border-dashed border-slate-300 space-y-1.5 text-xs">
                    <div class="flex justify-between text-slate-600">
                        <span>Subtotal</span>
                        <span id="struk-subtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>Diskon</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-black text-slate-900 pt-1 border-t border-slate-200">
                        <span>TOTAL BAYAR</span>
                        <span id="struk-total" class="text-pink-600 font-extrabold text-base">Rp 0</span>
                    </div>
                </div>

                <div class="py-2.5 border-b border-dashed border-slate-300 space-y-1 text-[11px]">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Metode Bayar</span>
                        <span id="struk-metode" class="font-bold text-slate-800">QRIS</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500">Status Transaksi</span>
                        <span id="struk-status" class="px-2 py-0.2 rounded font-bold text-[10px] bg-emerald-100 text-emerald-800 uppercase">LUNAS</span>
                    </div>
                </div>

                <div class="pt-4 pb-1 text-center text-[10px] text-slate-500 space-y-1 font-sans">
                    <p class="font-semibold text-slate-700">*** TERIMA KASIH ***</p>
                    <p>Kue segar dibuat dengan cinta untuk momen spesial Anda.</p>
                    <p class="text-[9px] text-slate-400">Struk ini adalah bukti pembayaran yang sah.</p>
                </div>

            </div>
        </div>

        <div class="p-3.5 sm:p-4 border-t border-slate-200 bg-white flex items-center justify-end gap-2.5 no-print">
            <button type="button" onclick="tutupModalStruk()"
                class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs sm:text-sm font-semibold transition">
                Tutup
            </button>
            <button type="button" onclick="cetakStrukSekarang()"
                class="px-5 py-2.5 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs sm:text-sm font-semibold shadow-xs transition hover:shadow flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Cetak Struk (Print)</span>
            </button>
        </div>

    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden !important;
    }
    #area-cetak-struk,
    #area-cetak-struk * {
        visibility: visible !important;
    }
    #area-cetak-struk {
        position: fixed !important;
        left: 0 !important;
        top: 0 !important;
        width: 78mm !important;
        max-width: 100% !important;
        margin: 0 auto !important;
        padding: 8px !important;
        background: #ffffff !important;
        color: #000000 !important;
        box-shadow: none !important;
        border: none !important;
        font-family: 'Courier New', Courier, monospace !important;
        font-size: 11px !important;
        line-height: 1.35 !important;
        z-index: 999999 !important;
    }
    .no-print {
        display: none !important;
    }
}
</style>

<script>
function formatRupiahJs(angka) {
    return 'Rp ' + Number(angka || 0).toLocaleString('id-ID');
}

function bukaModalStrukDariEl(btn) {
    if (!btn) return;
    const data = {
        kode_transaksi: btn.getAttribute('data-kode'),
        created_at_text: btn.getAttribute('data-tanggal'),
        nama_pelanggan: btn.getAttribute('data-pelanggan'),
        nama_produk: btn.getAttribute('data-produk'),
        qty: parseInt(btn.getAttribute('data-qty') || 1),
        harga_satuan: parseInt(btn.getAttribute('data-satuan') || 0),
        total_harga: parseInt(btn.getAttribute('data-total') || 0),
        metode_pembayaran: btn.getAttribute('data-metode'),
        metode_pengiriman: btn.getAttribute('data-pengiriman'),
        status: btn.getAttribute('data-status'),
    };
    bukaModalStruk(data);
}

function bukaModalStruk(trx) {
    if (!trx) return;

    const kode = trx.kode_transaksi || ('#TRX-' + String(trx.id || '').padStart(4, '0'));
    document.getElementById('struk-kode').innerText = kode.startsWith('#') ? kode : '#' + kode;

    let tanggalText = trx.created_at_text || '-';
    if (!trx.created_at_text && trx.created_at) {
        try {
            const d = new Date(trx.created_at);
            if (!isNaN(d.getTime())) {
                tanggalText = d.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                }) + ', ' + d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
            }
        } catch (e) {
            tanggalText = trx.created_at;
        }
    }
    document.getElementById('struk-tanggal').innerText = tanggalText;

    const pelanggan = (trx.user && trx.user.name) ? trx.user.name : (trx.nama_pelanggan || 'Pelanggan Tamu');
    document.getElementById('struk-pelanggan').innerText = pelanggan;

    document.getElementById('struk-pengiriman').innerText = trx.metode_pengiriman || 'Ambil di Toko';

    const namaProduk = trx.nama_produk || 'Produk Bakery By.Reesha';
    document.getElementById('struk-nama-produk').innerText = namaProduk;

    const qty = Number(trx.qty || 1);
    const totalHarga = Number(trx.total_harga || 0);
    const hargaSatuan = Number(trx.harga_satuan || (qty > 0 ? Math.round(totalHarga / qty) : totalHarga));

    document.getElementById('struk-qty-harga').innerText = qty + ' x ' + formatRupiahJs(hargaSatuan);
    document.getElementById('struk-item-total').innerText = formatRupiahJs(totalHarga);
    document.getElementById('struk-subtotal').innerText = formatRupiahJs(totalHarga);
    document.getElementById('struk-total').innerText = formatRupiahJs(totalHarga);

    document.getElementById('struk-metode').innerText = (trx.metode_pembayaran || 'QRIS').toUpperCase();

    const statusEl = document.getElementById('struk-status');
    const rawStatus = (trx.status || 'Selesai').toUpperCase();
    statusEl.innerText = rawStatus;

    if (rawStatus.includes('SELESAI') || rawStatus.includes('LUNAS') || rawStatus.includes('DITERIMA')) {
        statusEl.className = 'px-2 py-0.2 rounded font-bold text-[10px] bg-emerald-100 text-emerald-800 uppercase';
    } else if (rawStatus.includes('BATAL')) {
        statusEl.className = 'px-2 py-0.2 rounded font-bold text-[10px] bg-rose-100 text-rose-800 uppercase';
    } else {
        statusEl.className = 'px-2 py-0.2 rounded font-bold text-[10px] bg-amber-100 text-amber-800 uppercase';
    }

    const modal = document.getElementById('modal-struk-kasir');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function tutupModalStruk() {
    const modal = document.getElementById('modal-struk-kasir');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

function cetakStrukSekarang() {
    window.print();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('modal-struk-kasir');
        if (modal && !modal.classList.contains('hidden')) {
            tutupModalStruk();
        }
    }
});
</script>
