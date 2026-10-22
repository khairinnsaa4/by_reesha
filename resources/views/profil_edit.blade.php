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

                <!-- SEKSI FOTO PROFIL -->
                <div class="bg-pink-50/30 p-4 rounded-2xl border border-pink-100/70">
                    <label class="block text-xs font-bold text-gray-700 mb-3">Foto Profil Akun</label>
                    <div class="flex items-center gap-4">
                        <!-- Lingkaran Avatar Preview -->
                        <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden bg-gradient-to-tr from-pink-500 to-rose-400 text-white flex-shrink-0 border-2 border-white shadow-md flex items-center justify-center">
                            <img id="avatar-preview-img" 
                                 src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : '' }}" 
                                 class="w-full h-full object-cover {{ Auth::user()->avatar ? '' : 'hidden' }}"
                                 alt="Avatar Preview">
                            <span id="avatar-preview-fallback" class="text-xl sm:text-2xl font-bold uppercase {{ Auth::user()->avatar ? 'hidden' : '' }}">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </div>

                        <div class="flex-1 min-w-0">
                            <input type="file" id="avatar-input" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" onchange="previewAvatar(event)">
                            <div class="flex items-center gap-2 flex-wrap">
                                <button type="button" onclick="document.getElementById('avatar-input').click()" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white hover:bg-pink-50 text-pink-600 border border-pink-200 text-xs font-semibold rounded-xl transition shadow-2xs cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Pilih Foto Baru</span>
                                </button>

                                @if(Auth::user()->avatar)
                                    <label class="inline-flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer select-none">
                                        <input type="checkbox" name="hapus_avatar" value="1" id="hapus-avatar-cb" onchange="toggleHapusAvatar(this)" class="rounded text-red-600 focus:ring-red-400">
                                        <span>Hapus Foto</span>
                                    </label>
                                @endif
                            </div>
                            <p id="avatar-filename-label" class="text-[10px] text-gray-400 mt-1.5">Format JPG, PNG, atau WEBP (Maksimal 2MB)</p>
                        </div>
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

    <!-- SCRIPT PREVIEW AVATAR -->
    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2097152) {
                    alert('Ukuran foto terlalu besar! Maksimal 2MB.');
                    event.target.value = '';
                    return;
                }

                const label = document.getElementById('avatar-filename-label');
                if (label) {
                    label.textContent = 'Dipilih: ' + file.name;
                    label.classList.add('text-pink-600', 'font-medium');
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('avatar-preview-img');
                    const fallback = document.getElementById('avatar-preview-fallback');
                    if (previewImg) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('hidden');
                    }
                    if (fallback) fallback.classList.add('hidden');

                    const hapusCb = document.getElementById('hapus-avatar-cb');
                    if (hapusCb) hapusCb.checked = false;
                };
                reader.readAsDataURL(file);
            }
        }

        function toggleHapusAvatar(checkbox) {
            const previewImg = document.getElementById('avatar-preview-img');
            const fallback = document.getElementById('avatar-preview-fallback');
            const avatarInput = document.getElementById('avatar-input');
            const label = document.getElementById('avatar-filename-label');

            if (checkbox.checked) {
                if (avatarInput) avatarInput.value = '';
                if (label) {
                    label.textContent = 'Foto akan dihapus setelah Anda menekan tombol simpan.';
                    label.classList.remove('text-pink-600');
                    label.classList.add('text-red-500');
                }
                if (previewImg) previewImg.classList.add('hidden');
                if (fallback) fallback.classList.remove('hidden');
            } else {
                if (label) {
                    label.textContent = 'Format JPG, PNG, atau WEBP (Maksimal 2MB)';
                    label.classList.remove('text-red-500', 'text-pink-600');
                }
                @if(Auth::user()->avatar)
                    if (previewImg) {
                        previewImg.src = "{{ asset(Auth::user()->avatar) }}";
                        previewImg.classList.remove('hidden');
                    }
                    if (fallback) fallback.classList.add('hidden');
                @endif
            }
        }
    </script>

    @include('partials.bottom_nav', ['active' => 'profil'])
</body>
</html>
