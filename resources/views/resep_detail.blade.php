<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resep->nama_resep }} — Resep By.Reesha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif; background-color: #f8fafc; color: #0f172a; }
        
        @media print {
            aside, .no-print { display: none !important; }
            body { background: white !important; color: black !important; }
            main { padding: 0 !important; max-width: 100% !important; margin: 0 !important; }
            .print-card { border: 1px solid #e2e8f0 !important; box-shadow: none !important; }
            .sticky { position: static !important; }
        }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen text-slate-800 bg-[#f8fafc]">

    @include('partials.owner_sidebar', ['active' => 'resep'])

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA                          -->
    <!-- ========================================== -->
    <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto w-full min-w-0 overflow-y-auto custom-scrollbar">
        
        {{-- Flash Alerts --}}
        @if(session('sukses'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl flex items-center justify-between no-print">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('sukses') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-800 font-bold">&times;</button>
        </div>
        @endif

        {{-- Top Navigation & Action Toolbar --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-gray-200 no-print">
            <div class="flex items-center gap-3">
                <a href="/resep" 
                   class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-gray-200 text-gray-700 text-xs font-semibold hover:border-pink-300 hover:text-pink-600 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Daftar Resep</span>
                </a>
                
                <span class="text-gray-300">/</span>
                <span class="text-xs font-medium text-gray-500 truncate max-w-xs">{{ $resep->produk->nama_kue ?? 'Produk' }}</span>
            </div>

            <div class="flex items-center gap-2">
                <button onclick="window.print()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-gray-200 text-gray-700 text-xs font-semibold hover:bg-gray-50 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak Lembar Produksi</span>
                </button>

                <button onclick="bukaModalEdit()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-pink-600 hover:bg-pink-700 text-white text-xs font-semibold transition shadow-sm shadow-pink-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Edit Resep</span>
                </button>
            </div>
        </div>

        {{-- ===== HEADER CARD (HERO) ===== --}}
        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-pink-50 mb-8 print-card">
            <div class="flex flex-col md:flex-row gap-6 md:items-center">
                {{-- Product Image --}}
                <div class="w-full md:w-56 h-48 md:h-44 rounded-2xl overflow-hidden bg-pink-50 border border-gray-100 flex-shrink-0">
                    <img src="{{ asset('images/' . ($resep->produk->gambar ?? 'logo.png')) }}" 
                         alt="{{ $resep->produk->nama_kue ?? 'Kue' }}" 
                         class="w-full h-full object-cover"
                         onerror="this.src='{{ asset('images/logo.png') }}'">
                </div>

                {{-- Product & Recipe Title --}}
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-700">
                            Divisi Pembuat Kue
                        </span>
                        @php
                            $badgeKesulitan = 'bg-gray-100 text-gray-700';
                            if ($resep->tingkat_kesulitan === 'Mudah') $badgeKesulitan = 'bg-emerald-100 text-emerald-700';
                            elseif ($resep->tingkat_kesulitan === 'Sedang') $badgeKesulitan = 'bg-amber-100 text-amber-700';
                            elseif ($resep->tingkat_kesulitan === 'Mahir') $badgeKesulitan = 'bg-indigo-100 text-indigo-700';
                        @endphp
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $badgeKesulitan }}">
                            Tingkat: {{ $resep->tingkat_kesulitan }}
                        </span>
                        <span class="text-xs text-gray-400">By.Reesha Standard Quality</span>
                    </div>

                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2 leading-tight">
                        {{ $resep->nama_resep }}
                    </h1>

                    <p class="text-sm text-gray-500 mb-6">
                        Produk Terkait: <strong class="text-gray-800">{{ $resep->produk->nama_kue ?? 'Kue' }}</strong> 
                        &bull; Harga Jual: <span class="text-pink-600 font-semibold">Rp {{ number_format($resep->produk->harga ?? 0, 0, ',', '.') }}</span>
                    </p>

                    {{-- Technical Specifications Grid --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-4 border-t border-gray-100 text-xs">
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-400 font-medium block text-[11px] mb-0.5">Waktu Persiapan</span>
                            <span class="font-bold text-gray-800 text-sm">{{ $resep->waktu_persiapan }}</span>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-400 font-medium block text-[11px] mb-0.5">Waktu Panggang</span>
                            <span class="font-bold text-gray-800 text-sm">{{ $resep->waktu_panggang }}</span>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-400 font-medium block text-[11px] mb-0.5">Suhu Oven Standar</span>
                            <span class="font-bold text-pink-600 text-sm">{{ $resep->suhu_oven }}</span>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-400 font-medium block text-[11px] mb-0.5">Hasil / Ukuran Loyang</span>
                            <span class="font-bold text-gray-800 text-sm truncate block">{{ $resep->porsi ?? '1 Loyang Standar' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== MAIN TWO-COLUMN CONTENT ===== --}}
        @php
            $barisBahan = array_filter(explode("\n", str_replace("\r", "", $resep->bahan_bahan)));
            $barisLangkah = array_filter(explode("\n", str_replace("\r", "", $resep->langkah_langkah)));
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- KOLOM KIRI (5/12): DAFTAR BAHAN BAKU --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl p-6 md:p-7 shadow-sm border border-pink-50 sticky top-6 print-card">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Daftar Bahan Baku</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Centang saat menakar atau menyiapkan bahan</p>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 bg-pink-50 text-pink-700 rounded-lg">
                            {{ count($barisBahan) }} Bahan
                        </span>
                    </div>

                    <div class="space-y-2.5" id="bahan-checklist">
                        @foreach($barisBahan as $index => $item)
                            @php
                                $cleanText = trim(preg_replace('/^[•\-\*\s]+/u', '', $item));
                                if (empty($cleanText)) {
                                    $cleanText = trim(ltrim($item, "•-* \t"));
                                }
                                if (empty($cleanText)) {
                                    $cleanText = trim($item);
                                }
                            @endphp
                            <label class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 hover:border-pink-200 hover:bg-pink-50/30 transition cursor-pointer select-none group">
                                <input type="checkbox" onchange="toggleChecklist(this)"
                                    class="mt-0.5 h-4 w-4 rounded border-gray-300 text-pink-600 focus:ring-pink-400 cursor-pointer flex-shrink-0">
                                <span class="text-sm text-gray-700 leading-snug flex-1 group-hover:text-gray-900 transition font-normal">
                                    {{ $cleanText }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400 no-print">
                        <span id="checklist-counter">0 dari {{ count($barisBahan) }} bahan disiapkan</span>
                        <button onclick="resetChecklist()" class="text-pink-600 hover:underline font-medium">Reset Centang</button>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN (7/12): LANGKAH PEMBUATAN & TIPS --}}
            <div class="lg:col-span-7 space-y-6">
                
                {{-- Langkah Pembuatan Card --}}
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-pink-50 print-card">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Tahapan Pembuatan</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Ikuti langkah berurutan untuk menjaga standar kualitas kue</p>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 text-gray-700 rounded-lg">
                            {{ count($barisLangkah) }} Tahap
                        </span>
                    </div>

                    <div class="space-y-4">
                        @foreach($barisLangkah as $index => $langkah)
                            @php
                                $cleanStep = trim(preg_replace('/^\d+[\.\)]\s*/u', '', $langkah));
                                if (empty($cleanStep)) {
                                    $cleanStep = trim($langkah);
                                }
                            @endphp
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-gray-50/70 border border-gray-100 hover:border-gray-200 transition">
                                <span class="w-8 h-8 rounded-xl bg-pink-600 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 shadow-sm shadow-pink-200">
                                    {{ sprintf('%02d', $index + 1) }}
                                </span>
                                <div class="flex-1 pt-1">
                                    <p class="text-sm text-gray-800 leading-relaxed font-normal">
                                        {{ $cleanStep }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Catatan Teknis & Tips Produksi --}}
                @if(!empty($resep->tips))
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border-l-4 border-pink-500 border-t border-r border-b border-pink-100 print-card">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-pink-100 text-pink-700 flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-gray-900 mb-1">Catatan Teknis & Tips Anti-Gagal</h3>
                            <p class="text-xs text-gray-500 mb-3">Panduan penting dari kepala baker untuk menghindari kegagalan adonan</p>
                            <p class="text-sm text-gray-700 leading-relaxed bg-pink-50/50 p-4 rounded-2xl border border-pink-100">
                                {{ $resep->tips }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

            </div>

        </div>

    </main>

    {{-- ===== MODAL EDIT RESEP ===== --}}
    <div id="modal-edit" class="hidden fixed inset-0 bg-black/60 z-50 overflow-y-auto p-4 flex items-center justify-center no-print">
        <div class="bg-white rounded-3xl shadow-2xl max-w-xl w-full p-6 md:p-8 my-8 relative">
            <div class="flex items-center justify-between mb-6 pb-3 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Edit Resep: {{ $resep->produk->nama_kue ?? '' }}</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Perbarui takaran bahan baku atau langkah produksi</p>
                </div>
                <button onclick="tutupModalEdit()" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            </div>

            <form action="/resep/simpan" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $resep->produk_id }}">

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Judul Resep</label>
                    <input type="text" name="nama_resep" value="{{ $resep->nama_resep }}" required
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-100">
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Waktu Persiapan</label>
                        <input type="text" name="waktu_persiapan" value="{{ $resep->waktu_persiapan }}" required
                            class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Waktu Panggang</label>
                        <input type="text" name="waktu_panggang" value="{{ $resep->waktu_panggang }}" required
                            class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Suhu Oven</label>
                        <input type="text" name="suhu_oven" value="{{ $resep->suhu_oven }}" required
                            class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-pink-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Kesulitan</label>
                        <select name="tingkat_kesulitan" required
                            class="w-full border border-gray-300 rounded-xl px-2.5 py-2 text-xs focus:outline-none focus:border-pink-500">
                            <option value="Mudah" {{ $resep->tingkat_kesulitan === 'Mudah' ? 'selected' : '' }}>Mudah</option>
                            <option value="Sedang" {{ $resep->tingkat_kesulitan === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Mahir" {{ $resep->tingkat_kesulitan === 'Mahir' ? 'selected' : '' }}>Mahir</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Ukuran Loyang / Porsi</label>
                    <input type="text" name="porsi" value="{{ $resep->porsi }}" placeholder="Contoh: 1 cake D:10 cm"
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2 text-sm focus:outline-none focus:border-pink-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Daftar Bahan & Takaran</label>
                    <textarea name="bahan_bahan" required rows="6"
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-xs font-mono focus:outline-none focus:border-pink-500 leading-relaxed">{{ $resep->bahan_bahan }}</textarea>
                    <span class="text-[11px] text-gray-400">Tulis satu bahan per baris.</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Langkah-Langkah Pembuatan</label>
                    <textarea name="langkah_langkah" required rows="6"
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-xs font-mono focus:outline-none focus:border-pink-500 leading-relaxed">{{ $resep->langkah_langkah }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Catatan Teknis & Tips Produksi</label>
                    <textarea name="tips" rows="2"
                        class="w-full border border-gray-300 rounded-xl px-3.5 py-2 text-xs focus:outline-none focus:border-pink-500">{{ $resep->tips }}</textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <button type="button" onclick="tutupModalEdit()"
                        class="px-4 py-2 border border-gray-300 text-gray-600 rounded-xl text-xs font-semibold hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-pink-100 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const totalBahan = {{ count($barisBahan) }};

        function toggleChecklist(cb) {
            const span = cb.nextElementSibling;
            if (cb.checked) {
                span.classList.add('line-through', 'text-gray-400');
            } else {
                span.classList.remove('line-through', 'text-gray-400');
            }
            updateCounter();
        }

        function updateCounter() {
            const checkedCount = document.querySelectorAll('#bahan-checklist input[type="checkbox"]:checked').length;
            document.getElementById('checklist-counter').textContent = checkedCount + ' dari ' + totalBahan + ' bahan disiapkan';
        }

        function resetChecklist() {
            document.querySelectorAll('#bahan-checklist input[type="checkbox"]').forEach(cb => {
                cb.checked = false;
                cb.nextElementSibling.classList.remove('line-through', 'text-gray-400');
            });
            updateCounter();
        }

        function bukaModalEdit() {
            document.getElementById('modal-edit').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function tutupModalEdit() {
            document.getElementById('modal-edit').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }


    </script>

</body>
</html>
