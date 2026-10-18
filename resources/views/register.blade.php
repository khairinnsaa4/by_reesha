<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>By.Reesha - Daftar Akun Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FFF8F9] font-[Poppins] min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-pink-100 border border-pink-100 w-full max-w-md space-y-6">
        <div class="text-center space-y-2">
            <div class="flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-14 rounded-full bg-pink-100">
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Akun </h2>
            <p class="text-xs text-gray-400">Buat akunmu untuk mulai memesan kue custom</p>
        </div>

        <form action="/register" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-pink-100 focus:outline-none focus:border-pink-400 text-sm transition bg-pink-50/30" placeholder="Nama lengkap kamu">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase tracking-wider">Alamat Email</label>
                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-pink-100 focus:outline-none focus:border-pink-400 text-sm transition bg-pink-50/30" placeholder="nama@email.com">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1 uppercase tracking-wider">Kata Sandi</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-pink-100 focus:outline-none focus:border-pink-400 text-sm transition bg-pink-50/30" placeholder="••••••••">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-pink-100 transition transform hover:-translate-y-0.5 text-sm">
                    Buat Akun Sekarang 
                </button>
            </div>
        </form>

        <div class="text-center text-xs text-gray-500 pt-2">
            Sudah punya akun? <a href="/login" class="text-pink-600 font-bold hover:underline">Masuk di sini</a>
            <br><br>
            <a href="/" class="text-gray-400 hover:text-pink-600 transition">← Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>