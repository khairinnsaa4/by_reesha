<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Informasi Akun</title>
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
                <h1 class="text-base sm:text-lg font-bold text-gray-800">Informasi Akun</h1>
                <p class="text-xs text-gray-400">Perbarui data diri, kontak & foto profil</p>
            </div>
        </div>

        <!-- NOTIFIKASI SUKSES / ERROR -->
        @if(session('sukses'))
        <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm rounded-2xl flex items-center gap-2.5 shadow-xs">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('sukses') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-800 text-xs rounded-2xl shadow-xs">
            <div class="flex items-center gap-1.5 font-bold mb-1 text-red-700">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Mohon periksa kembali:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- FORMULIR INFORMASI AKUN & FOTO -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border border-pink-100">
            <form action="/profil/update" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- INPUT FILE & DATA HIDDEN -->
                <input type="file" id="avatar-input" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" onchange="previewAvatar(event)">
                <input type="hidden" name="avatar_base64" id="avatar-base64-input">
                <input type="hidden" name="hapus_avatar" id="hapus-avatar-input" value="0">

                <!-- SEKSI FOTO PROFIL DENGAN IKON PENSIL (BERSIH & MINIMALIS) -->
                <div class="bg-pink-50/30 p-4 rounded-2xl border border-pink-100/70 flex items-center gap-4">
                    <!-- Lingkaran Avatar Preview dengan Ikon Pensil Edit -->
                    <div class="relative flex-shrink-0 cursor-pointer group" onclick="openAvatarModal()" title="Klik untuk kelola foto profil">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden bg-gradient-to-tr from-pink-500 to-rose-400 text-white flex-shrink-0 border-2 border-white shadow-md flex items-center justify-center transition group-hover:opacity-95">
                            <img id="avatar-preview-img" 
                                 src="{{ Auth::user()->avatar ? Auth::user()->avatar_url : '' }}" 
                                 class="w-full h-full object-cover {{ Auth::user()->avatar ? '' : 'hidden' }}"
                                 alt="Avatar Preview">
                            <span id="avatar-preview-fallback" class="text-xl sm:text-2xl font-bold uppercase {{ Auth::user()->avatar ? 'hidden' : '' }}">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </div>
                        <!-- Tombol Ikon Pensil Edit -->
                        <button type="button" onclick="openAvatarModal(); event.stopPropagation();" class="absolute -bottom-1 -right-1 w-7 h-7 sm:w-8 sm:h-8 bg-pink-600 hover:bg-pink-700 text-white rounded-full flex items-center justify-center shadow-md border-2 border-white transition transform hover:scale-110 active:scale-95" title="Ubah Foto Profil">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex-grow min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm sm:text-base font-bold text-gray-800 truncate capitalize">{{ Auth::user()->name }}</h3>
                            @if(Auth::user()->role === 'owner')
                                <span class="bg-gray-900 text-white text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Owner</span>
                            @elseif(Auth::user()->role === 'karyawan')
                                <span class="bg-pink-100 text-pink-700 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase">Staf</span>
                            @else
                                <span class="bg-pink-50 text-pink-600 text-[9px] font-bold px-2 py-0.5 rounded-full uppercase border border-pink-100">Member</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Nama Lengkap <span class="text-pink-600">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required placeholder="Nama Anda" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 focus:outline-none transition">
                </div>

                <!-- Alamat Email (Read-only) -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Email Terdaftar</label>
                    <input type="email" value="{{ Auth::user()->email }}" disabled class="w-full text-xs sm:text-sm bg-gray-50 text-gray-500 border border-gray-200 rounded-xl px-3.5 py-2.5 cursor-not-allowed">
                    <span class="text-[10px] text-gray-400 mt-1 block">Email digunakan sebagai identitas akun dan tidak dapat diubah.</span>
                </div>

                <!-- Nomor WhatsApp / HP -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">Nomor WhatsApp / HP</label>
                    <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Contoh: 0821xxxxxxxx" class="w-full text-xs sm:text-sm bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 focus:border-pink-500 focus:ring-1 focus:ring-pink-500 focus:outline-none transition">
                    <span class="text-[10px] text-gray-400 mt-1 block">Digunakan oleh pihak toko untuk konfirmasi pesanan kue Anda.</span>
                </div>

                <!-- Tombol Simpan -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 active:scale-[0.99] text-white font-bold text-xs sm:text-sm py-3 rounded-xl shadow-xs transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Simpan Perubahan Akun</span>
                    </button>
                </div>
            </form>
        </div>

    </main>

    <!-- POP-UP MODAL KELOLA FOTO PROFIL (GANTI & HAPUS FOTO) -->
    <div id="avatar-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl p-6 sm:p-7 max-w-sm w-full shadow-xl border border-pink-100 text-center relative transform transition-all">
            
            <!-- Tombol Tutup X -->
            <button type="button" onclick="closeAvatarModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 flex items-center justify-center transition" title="Tutup">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-1">Foto Profil</h3>
            <p class="text-xs text-gray-400 mb-5">Pilih foto baru atau hapus foto profil akun Anda</p>

            <!-- Preview Lingkaran Besar di Modal -->
            <div class="w-24 h-24 sm:w-28 sm:h-28 mx-auto mb-5 rounded-full overflow-hidden bg-gradient-to-tr from-pink-500 to-rose-400 text-white border-4 border-pink-100 shadow-md flex items-center justify-center">
                <img id="modal-avatar-preview-img" 
                     src="{{ Auth::user()->avatar ? Auth::user()->avatar_url : '' }}" 
                     class="w-full h-full object-cover {{ Auth::user()->avatar ? '' : 'hidden' }}"
                     alt="Preview Foto">
                <span id="modal-avatar-preview-fallback" class="text-3xl sm:text-4xl font-bold uppercase tracking-wider {{ Auth::user()->avatar ? 'hidden' : '' }}">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </span>
            </div>

            <!-- Tombol Aksi di Modal -->
            <div class="space-y-2.5">
                <!-- Tombol Pilih Foto Baru -->
                <button type="button" onclick="triggerPilihFoto()" class="w-full py-2.5 sm:py-3 px-4 bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-xs transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Pilih Foto Baru</span>
                </button>

                <!-- Tombol Hapus Foto Profil -->
                <button type="button" id="modal-btn-hapus" onclick="handleHapusFoto()" class="w-full py-2.5 px-4 bg-white hover:bg-rose-50 text-rose-600 border border-rose-200 font-semibold text-xs sm:text-sm rounded-xl transition flex items-center justify-center gap-2 {{ Auth::user()->avatar ? '' : 'hidden' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    <span>Hapus Foto Profil</span>
                </button>

                <!-- Tombol Batal/Tutup -->
                <button type="button" onclick="closeAvatarModal()" class="w-full py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold text-xs sm:text-sm rounded-xl transition">
                    Tutup
                </button>
            </div>

            <p class="text-[10px] text-gray-400 mt-4">Format: JPG, PNG, atau WEBP (Maksimal 5MB)</p>
        </div>
    </div>

    <!-- SCRIPT POP-UP MODAL & PREVIEW AVATAR DENGAN RESIZE CANVAS -->
    <script>
        function openAvatarModal() {
            const modal = document.getElementById('avatar-modal');
            if (modal) modal.classList.remove('hidden');
        }

        function closeAvatarModal() {
            const modal = document.getElementById('avatar-modal');
            if (modal) modal.classList.add('hidden');
        }

        // Tutup jika klik backdrop
        document.getElementById('avatar-modal')?.addEventListener('click', function(e) {
            if (e.target === this) closeAvatarModal();
        });

        function triggerPilihFoto() {
            const input = document.getElementById('avatar-input');
            if (input) input.click();
        }

        function previewAvatar(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (file.size > 5242880) { // Maks 5MB
                alert('Ukuran foto terlalu besar! Maksimal 5MB.');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    // Kompresi dan resize gambar menjadi resolusi ideal avatar (maks 400x400)
                    const maxDim = 400;
                    let width = img.width;
                    let height = img.height;

                    if (width > height) {
                        if (width > maxDim) {
                            height = Math.round((height * maxDim) / width);
                            width = maxDim;
                        }
                    } else {
                        if (height > maxDim) {
                            width = Math.round((width * maxDim) / height);
                            height = maxDim;
                        }
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    // Konversi ke format JPEG 85% kualitas (hanya ~30-50KB)
                    const optimizedDataUrl = canvas.toDataURL('image/jpeg', 0.85);

                    // Masukkan ke input tersembunyi
                    const base64Input = document.getElementById('avatar-base64-input');
                    if (base64Input) {
                        base64Input.value = optimizedDataUrl;
                    }

                    // Reset penanda hapus foto
                    const hapusInput = document.getElementById('hapus-avatar-input');
                    if (hapusInput) hapusInput.value = '0';

                    // Update preview foto di halaman utama
                    const mainImg = document.getElementById('avatar-preview-img');
                    const mainFallback = document.getElementById('avatar-preview-fallback');
                    if (mainImg) {
                        mainImg.src = optimizedDataUrl;
                        mainImg.classList.remove('hidden');
                    }
                    if (mainFallback) mainFallback.classList.add('hidden');

                    // Update preview foto di dalam modal
                    const modalImg = document.getElementById('modal-avatar-preview-img');
                    const modalFallback = document.getElementById('modal-avatar-preview-fallback');
                    if (modalImg) {
                        modalImg.src = optimizedDataUrl;
                        modalImg.classList.remove('hidden');
                    }
                    if (modalFallback) modalFallback.classList.add('hidden');

                    // Munculkan tombol hapus di modal
                    const btnHapus = document.getElementById('modal-btn-hapus');
                    if (btnHapus) btnHapus.classList.remove('hidden');

                    // Tutup modal secara halus
                    setTimeout(closeAvatarModal, 300);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function handleHapusFoto() {
            // Tandai untuk hapus foto pada submit form
            const hapusInput = document.getElementById('hapus-avatar-input');
            if (hapusInput) hapusInput.value = '1';

            const avatarInput = document.getElementById('avatar-input');
            if (avatarInput) avatarInput.value = '';

            const base64Input = document.getElementById('avatar-base64-input');
            if (base64Input) base64Input.value = '';

            // Sembunyikan gambar dan tampilkan inisial nama di halaman utama
            const mainImg = document.getElementById('avatar-preview-img');
            const mainFallback = document.getElementById('avatar-preview-fallback');
            if (mainImg) mainImg.classList.add('hidden');
            if (mainFallback) mainFallback.classList.remove('hidden');

            // Sembunyikan gambar dan tampilkan inisial nama di dalam modal
            const modalImg = document.getElementById('modal-avatar-preview-img');
            const modalFallback = document.getElementById('modal-avatar-preview-fallback');
            if (modalImg) modalImg.classList.add('hidden');
            if (modalFallback) modalFallback.classList.remove('hidden');

            // Sembunyikan tombol hapus di modal
            const btnHapus = document.getElementById('modal-btn-hapus');
            if (btnHapus) btnHapus.classList.add('hidden');

            // Tutup modal
            closeAvatarModal();
        }
    </script>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>
