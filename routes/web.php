<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProdukController;
use App\Models\Produk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $produkBestSeller = Produk::take(4)->get();
    return view('welcome', compact('produkBestSeller'));
});

Route::get('/produk', [ProdukController::class, 'index']);

use App\Http\Controllers\AuthController;

Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); });

Route::post('/register', [AuthController::class, 'registerProses']);
Route::post('/login', [AuthController::class, 'loginProses']);
Route::post('/logout', [AuthController::class, 'logout']);

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Logistik;
use App\Models\Supplier;

Route::get('/dashboard-owner', function () {
    if (!Auth::check() || Auth::user()->role !== 'owner') {
        return redirect(Auth::check() && Auth::user()->role === 'karyawan' ? '/pemesanan' : '/riwayat-transaksi');
    }
    $total_pendapatan = Transaksi::sum('total_harga');
    $pesanan_aktif = Transaksi::count();
    $total_pelanggan = User::where('role', 'pelanggan')->count();
    $produk_terjual = Transaksi::sum('qty');
    $transaksis = Transaksi::with('user')->latest()->take(5)->get();

    // Data grafik tren penjualan 7 hari terakhir
    $chartDays = collect(range(6, 0))->map(function ($daysAgo) {
        $date = now()->subDays($daysAgo);
        $omzet = Transaksi::whereDate('created_at', $date->toDateString())->sum('total_harga');
        return [
            'label' => $date->locale('id')->isoFormat('D MMM'),
            'omzet' => (int) $omzet,
        ];
    });
    $chartLabels = $chartDays->pluck('label')->toArray();
    $chartOmzet = $chartDays->pluck('omzet')->toArray();

    // Data grafik 5 produk terlaris
    $produkStats = Transaksi::all()->groupBy('nama_produk')->map(function ($items, $nama) {
        return [
            'nama' => $nama,
            'total_qty' => $items->sum('qty'),
            'total_omzet' => (int) $items->sum('total_harga'),
        ];
    })->sortByDesc('total_omzet')->take(5);

    $chartProdukLabels = $produkStats->pluck('nama')->values()->toArray();
    $chartProdukOmzet  = $produkStats->pluck('total_omzet')->values()->toArray();
    $chartProdukQty    = $produkStats->pluck('total_qty')->values()->toArray();

    return view('dashboard_owner', compact(
        'total_pendapatan', 'pesanan_aktif', 'total_pelanggan', 'produk_terjual', 'transaksis',
        'chartLabels', 'chartOmzet', 'chartProdukLabels', 'chartProdukOmzet', 'chartProdukQty'
    ));
})->middleware('auth');

Route::get('/dashboard-karyawan', function () {
    return redirect('/pemesanan');
})->middleware('auth');

Route::get('/profil', function () {
    return view('profil');
})->middleware('auth');

Route::get('/profil/alamat', function () {
    return view('profil_alamat');
})->middleware('auth');

Route::get('/profil/edit', function () {
    return view('profil_edit');
})->middleware('auth');

Route::get('/profil/informasi', function () {
    return redirect('/profil/edit');
})->middleware('auth');

Route::get('/profil/keamanan', function () {
    return view('profil_keamanan');
})->middleware('auth');

Route::get('/profil/bantuan', function () {
    return view('profil_bantuan');
})->middleware('auth');

Route::get('/bantuan', function () {
    return redirect('/profil/bantuan');
});

Route::post('/profil/update', [AuthController::class, 'updateProfil'])->middleware('auth');
Route::post('/profil/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');

// Simpan alamat & telepon pelanggan ke database (AJAX)
Route::post('/profil/update-alamat', function (Request $request) {
    $request->validate([
        'phone'   => 'nullable|string|max:20',
        'address' => 'required|string|max:500',
    ]);

    $user = Auth::user();
    $user->phone   = $request->input('phone');
    $user->address = $request->input('address');
    $user->save();

    return response()->json(['status' => 'ok']);
})->middleware('auth');

// Simpan alamat dari form halaman profil (redirect biasa)
Route::post('/profil/update-alamat-form', function (Request $request) {
    $request->validate([
        'phone'   => 'nullable|string|max:20',
        'address' => 'required|string|max:500',
    ], [
        'address.required' => 'Alamat pengiriman wajib diisi.',
    ]);

    $user = Auth::user();
    if ($request->filled('phone')) {
        $user->phone = $request->input('phone');
    }
    $user->address = $request->input('address');
    $user->save();

    return back()->with('sukses', 'Alamat pengiriman berhasil disimpan!')->with('active_tab', 'alamat');
})->middleware('auth');
Route::get('/produk/{id}', [ProdukController::class, 'detailProduk']);
Route::get('/lihat-produk-bestseller', function() {
    return redirect('/produk');
})->middleware('auth')->name('produk.lihat');

Route::get('/karyawan', function () {
    if (Auth::check() && Auth::user()->role !== 'owner') {
        return Auth::user()->role === 'karyawan' ? redirect('/pemesanan') : redirect('/riwayat-transaksi');
    }
    $karyawan = User::where('role', 'karyawan')->latest()->get();
    return view('karyawan', compact('karyawan'));
})->middleware('auth');

// Tambah karyawan — hanya owner
Route::post('/karyawan/tambah', function (Request $request) {
    if (!Auth::check() || Auth::user()->role !== 'owner') abort(403);

    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'divisi'   => 'required|string|max:100',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'role'     => 'karyawan',
        'divisi'   => $request->divisi,
    ]);

    return back()->with('sukses', 'Akun karyawan ' . $request->name . ' berhasil ditambahkan!');
})->middleware('auth');

// Hapus karyawan — hanya owner
Route::delete('/karyawan/{id}/hapus', function ($id) {
    if (!Auth::check() || Auth::user()->role !== 'owner') abort(403);

    $karyawan = User::where('id', $id)->where('role', 'karyawan')->firstOrFail();
    $nama = $karyawan->name;
    $karyawan->delete();

    return back()->with('sukses', 'Akun karyawan ' . $nama . ' berhasil dihapus!');
})->middleware('auth');

// Edit karyawan — hanya owner
Route::put('/karyawan/{id}/edit', function (Illuminate\Http\Request $request, $id) {
    if (!Auth::check() || Auth::user()->role !== 'owner') abort(403);

    $karyawan = App\Models\User::where('id', $id)->where('role', 'karyawan')->firstOrFail();

    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email,'.$id,
        'divisi'   => 'required|string|max:100',
        'password' => 'nullable|string|min:6',
    ]);

    $karyawan->name = $request->name;
    $karyawan->email = $request->email;
    $karyawan->divisi = $request->divisi;
    if ($request->filled('password')) {
        $karyawan->password = \Illuminate\Support\Facades\Hash::make($request->password);
    }
    $karyawan->save();

    return back()->with('sukses', 'Data karyawan ' . $request->name . ' berhasil diperbarui!');
})->middleware('auth');



Route::get('/pelanggan', function () {
    if (!Auth::check() || Auth::user()->role !== 'owner') {
        return redirect(Auth::check() && Auth::user()->role === 'karyawan' ? '/dashboard-owner' : '/riwayat-transaksi');
    }
    $pelanggan = User::where('role', 'pelanggan')->withCount('transaksis')->withSum('transaksis', 'total_harga')->latest()->get();
    return view('pelanggan', compact('pelanggan'));
})->middleware('auth');

Route::get('/pemesanan', function () {
    if (Auth::check() && !in_array(Auth::user()->role, ['owner', 'karyawan'])) {
        return redirect('/riwayat-transaksi');
    }
    $transaksis = Transaksi::with('user')->latest()->get();
    return view('pemesanan', compact('transaksis'));
})->middleware('auth');

Route::post('/pemesanan/{id}/update-status', function (Request $request, $id) {
    $trx = Transaksi::findOrFail($id);
    $trx->status = $request->input('status');
    $trx->save();
    return back()->with('sukses', 'Status pesanan #TRX-' . str_pad($id, 3, '0', STR_PAD_LEFT) . ' berhasil diperbarui ke "' . $trx->status . '"!');
})->middleware('auth');

Route::get('/transaksi', function (Request $request) {
    if (!Auth::check() || Auth::user()->role !== 'owner') {
        return redirect(Auth::check() && Auth::user()->role === 'karyawan' ? '/dashboard-owner' : '/riwayat-transaksi');
    }

    $filter = $request->query('filter', 'semua');
    $tahun  = (int) $request->query('tahun', now()->year);
    $tanggal = $request->query('tanggal', now()->toDateString());
    $minggu = $request->query('minggu', now()->format('Y-\WW'));
    $bulan_input = $request->query('bulan', now()->format('Y-m'));

    $query = Transaksi::with('user');

    $tanggal_awal = null;
    $tanggal_akhir = null;
    $nama_bulan = null;
    $tahun_bulan = null;

    if ($filter === 'harian') {
        $query->whereDate('created_at', $tanggal);
    } elseif ($filter === 'mingguan') {
        if (preg_match('/^(\d+)-W(\d+)$/', $minggu, $matches)) {
            $year = (int)$matches[1];
            $week = (int)$matches[2];
            $date = new \Carbon\Carbon();
            $date->setISODate($year, $week);
            $awal = $date->copy()->startOfWeek()->startOfDay();
            $akhir = $date->copy()->endOfWeek()->endOfDay();
        } else {
            $awal = now()->startOfWeek()->startOfDay();
            $akhir = now()->endOfWeek()->endOfDay();
        }
        $query->whereBetween('created_at', [$awal, $akhir]);
        $tanggal_awal = $awal->format('d M Y');
        $tanggal_akhir = $akhir->format('d M Y');
    } elseif ($filter === 'bulanan') {
        $parts = explode('-', $bulan_input);
        if (count($parts) === 2) {
            $year = (int)$parts[0];
            $month = (int)$parts[1];
        } else {
            $year = now()->year;
            $month = now()->month;
        }
        $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
        $nama_bulan = \Carbon\Carbon::create()->month($month)->locale('id')->isoFormat('MMMM');
        $tahun_bulan = $year;
    } elseif ($filter === 'tahunan') {
        $query->whereYear('created_at', $tahun);
    }

    $transaksis = $query->latest()->get();
    $total_pendapatan = $transaksis->sum('total_harga');
    $total_transaksi = $transaksis->count();
    $total_produk = $transaksis->sum('qty');

    $allYears = Transaksi::all()->pluck('created_at')
        ->map(fn($d) => $d ? (int)$d->format('Y') : null)
        ->filter()->unique()->sortDesc()->values()->toArray();
    if (!in_array(now()->year, $allYears)) {
        array_unshift($allYears, now()->year);
    }
    $allYears = array_values(array_unique($allYears));

    $label_periode = 'Semua Waktu';
    if ($filter === 'harian') {
        $label_periode = 'Harian (' . \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('dddd, D MMMM Y') . ')';
    } elseif ($filter === 'mingguan') {
        $label_periode = 'Mingguan (' . $tanggal_awal . ' s/d ' . $tanggal_akhir . ')';
    } elseif ($filter === 'bulanan') {
        $label_periode = 'Bulanan (' . $nama_bulan . ' ' . $tahun_bulan . ')';
    } elseif ($filter === 'tahunan') {
        $label_periode = 'Tahunan (Tahun ' . $tahun . ')';
    }

    return view('transaksi', compact(
        'transaksis', 'total_pendapatan', 'total_transaksi', 'total_produk',
        'filter', 'tahun', 'tanggal', 'minggu', 'bulan_input', 'allYears',
        'tanggal_awal', 'tanggal_akhir', 'nama_bulan', 'tahun_bulan', 'label_periode'
    ));
})->middleware('auth');

Route::get('/logistik', function () {
    if (Auth::check() && !in_array(Auth::user()->role, ['owner', 'karyawan'])) {
        return redirect('/riwayat-transaksi');
    }

    // Helper: hitung status otomatis dari stok
    $autoStatus = function ($stok) {
        if ($stok <= 5)  return 'Kritis';
        if ($stok <= 15) return 'Menipis';
        return 'Aman';
    };

    if (Logistik::count() === 0) {
        $seed = [
            ['nama' => 'Tepung Terigu',  'kategori' => 'Bahan Utama',     'stok' => 25,  'satuan' => 'Kg'],
            ['nama' => 'Telur',          'kategori' => 'Bahan Utama',     'stok' => 2,   'satuan' => 'Tray'],
            ['nama' => 'Mentega',        'kategori' => 'Bahan Utama',     'stok' => 8,   'satuan' => 'Kg'],
            ['nama' => 'Gula Pasir',     'kategori' => 'Bahan Utama',     'stok' => 18,  'satuan' => 'Kg'],
            ['nama' => 'Cokelat Blok',   'kategori' => 'Bahan Penunjang', 'stok' => 12,  'satuan' => 'Kg'],
            ['nama' => 'Box Cake 20x20', 'kategori' => 'Packaging',       'stok' => 150, 'satuan' => 'Pcs'],
            ['nama' => 'Pita Dekorasi',  'kategori' => 'Packaging',       'stok' => 4,   'satuan' => 'Roll'],
        ];
        foreach ($seed as $s) {
            Logistik::create(array_merge($s, ['status' => $autoStatus($s['stok'])]));
        }
    } else {
        // Sinkronisasi status semua barang yang sudah ada berdasarkan stok terkini
        Logistik::all()->each(function ($item) use ($autoStatus) {
            $newStatus = $autoStatus($item->stok);
            if ($item->status !== $newStatus) {
                $item->update(['status' => $newStatus]);
            }
        });
    }

    $logistiks = Logistik::latest()->get();
    return view('logistik', compact('logistiks'));
})->middleware('auth');

Route::post('/logistik/tambah', function (Request $request) {
    $stok = (int) $request->input('stok', 0);
    // Status otomatis berdasarkan jumlah stok
    $status = $stok <= 5 ? 'Kritis' : ($stok <= 15 ? 'Menipis' : 'Aman');

    Logistik::create([
        'nama'     => $request->input('nama'),
        'kategori' => $request->input('kategori'),
        'stok'     => $stok,
        'satuan'   => $request->input('satuan'),
        'status'   => $status,
    ]);
    return back()->with('sukses', 'Barang logistik berhasil ditambahkan!');
})->middleware('auth');

Route::post('/logistik/{id}/update', function (Request $request, $id) {
    $item = Logistik::findOrFail($id);
    $stok = (int) $request->input('stok', 0);
    // Status otomatis berdasarkan jumlah stok
    $status = $stok <= 5 ? 'Kritis' : ($stok <= 15 ? 'Menipis' : 'Aman');

    $item->update([
        'nama'     => $request->input('nama'),
        'kategori' => $request->input('kategori'),
        'stok'     => $stok,
        'satuan'   => $request->input('satuan'),
        'status'   => $status,
    ]);
    return back()->with('sukses', 'Data logistik berhasil diperbarui!');
})->middleware('auth');

// Catat barang masuk (Restock) manual oleh staf gudang
Route::post('/logistik/{id}/restock', function (Request $request, $id) {
    $item = Logistik::findOrFail($id);
    $tambah = (int) $request->input('jumlah_masuk', 0);
    if ($tambah > 0) {
        $item->stok += $tambah;
        $item->status = $item->stok <= 5 ? 'Kritis' : ($item->stok <= 15 ? 'Menipis' : 'Aman');
        $item->save();
        return back()->with('sukses', "Stok masuk +{$tambah} {$item->satuan} berhasil ditambahkan untuk {$item->nama}! Total stok sekarang: {$item->stok} {$item->satuan}.");
    }
    return back()->with('error', 'Jumlah barang masuk harus lebih dari 0.');
})->middleware('auth');

Route::post('/logistik/{id}/hapus', function ($id) {
    $item = Logistik::findOrFail($id);
    $item->delete();
    return back()->with('sukses', 'Barang logistik berhasil dihapus!');
})->middleware('auth');

Route::get('/supplier', function () {
    if (Auth::check() && !in_array(Auth::user()->role, ['owner', 'karyawan'])) {
        return redirect('/riwayat-transaksi');
    }
    
    // Paksa update supplier lama ke data Lhokseumawe (jika masih ada data lama)
    $supplierData = [
        [
            'nama_supplier' => 'UD Sumber Terigu Lhokseumawe',
            'kontak'        => '0812-6001-2345',
            'alamat'        => 'Jl. Merdeka No. 17, Lhokseumawe, Aceh',
            'kategori'      => 'Bahan Baku',
        ],
        [
            'nama_supplier' => 'Toko Plastik & Packaging Aceh',
            'kontak'        => '0853-7712-9988',
            'alamat'        => 'Jl. Iskandar Muda No. 54, Lhokseumawe, Aceh',
            'kategori'      => 'Packaging',
        ],
        [
            'nama_supplier' => 'Peternakan Telur Ayam Mulia',
            'kontak'        => '0821-5533-7766',
            'alamat'        => 'Desa Blang Mangat, Kec. Blang Mangat, Lhokseumawe, Aceh',
            'kategori'      => 'Bahan Utama',
        ],
    ];

    // Hapus supplier lama dari luar Lhokseumawe (jika masih ada)
    $namaLama = ['PT Boga Flour Indonesia', 'Toko Plastik Jaya Packaging', 'Distributor Telur Fresh'];
    Supplier::whereIn('nama_supplier', $namaLama)->delete();

    // Tambahkan supplier Lhokseumawe jika belum ada
    foreach ($supplierData as $s) {
        Supplier::updateOrCreate(['nama_supplier' => $s['nama_supplier']], $s);
    }

    $suppliers = Supplier::latest()->get();
    return view('supplier', compact('suppliers'));
})->middleware('auth');

Route::post('/supplier/tambah', function (Request $request) {
    Supplier::create([
        'nama_supplier' => $request->input('nama_supplier'),
        'kontak' => $request->input('kontak'),
        'alamat' => $request->input('alamat'),
        'kategori' => $request->input('kategori'),
    ]);
    return back()->with('sukses', 'Supplier baru berhasil ditambahkan!');
})->middleware('auth');

Route::post('/supplier/{id}/update', function (Request $request, $id) {
    $sup = Supplier::findOrFail($id);
    $sup->update([
        'nama_supplier' => $request->input('nama_supplier'),
        'kontak' => $request->input('kontak'),
        'alamat' => $request->input('alamat'),
        'kategori' => $request->input('kategori'),
    ]);
    return back()->with('sukses', 'Data supplier berhasil diperbarui!');
})->middleware('auth');

Route::post('/supplier/{id}/hapus', function ($id) {
    $sup = Supplier::findOrFail($id);
    $sup->delete();
    return back()->with('sukses', 'Supplier berhasil dihapus!');
})->middleware('auth');

Route::get('/laporan', function (Request $request) {
    if (!Auth::check() || Auth::user()->role !== 'owner') {
        return redirect(Auth::check() && Auth::user()->role === 'karyawan' ? '/pemesanan' : '/riwayat-transaksi');
    }
    
    $filter = $request->query('filter', 'semua');
    $tahun  = (int) $request->query('tahun', now()->year);
    $tanggal = $request->query('tanggal', now()->toDateString());
    $minggu = $request->query('minggu', now()->format('Y-\WW'));
    $bulan_input = $request->query('bulan', now()->format('Y-m'));
    
    $query  = Transaksi::with('user');
    
    $tanggal_awal = null;
    $tanggal_akhir = null;
    $nama_bulan = null;
    $tahun_bulan = null;

    if ($filter === 'harian') {
        $query->whereDate('created_at', $tanggal);
    } elseif ($filter === 'mingguan') {
        if (preg_match('/^(\d+)-W(\d+)$/', $minggu, $matches)) {
            $year = (int)$matches[1];
            $week = (int)$matches[2];
            $date = new \Carbon\Carbon();
            $date->setISODate($year, $week);
            $awal = $date->copy()->startOfWeek()->startOfDay();
            $akhir = $date->copy()->endOfWeek()->endOfDay();
        } else {
            $awal = now()->startOfWeek()->startOfDay();
            $akhir = now()->endOfWeek()->endOfDay();
        }
        $query->whereBetween('created_at', [$awal, $akhir]);
        $tanggal_awal = $awal->format('d M Y');
        $tanggal_akhir = $akhir->format('d M Y');
    } elseif ($filter === 'bulanan') {
        $parts = explode('-', $bulan_input);
        if (count($parts) === 2) {
            $year = (int)$parts[0];
            $month = (int)$parts[1];
        } else {
            $year = now()->year;
            $month = now()->month;
        }
        $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
        $nama_bulan = \Carbon\Carbon::create()->month($month)->locale('id')->isoFormat('MMMM');
        $tahun_bulan = $year;
    } elseif ($filter === 'tahunan') {
        $query->whereYear('created_at', $tahun);
    }
    
    $transaksis        = $query->latest()->get();
    $total_pendapatan  = $transaksis->sum('total_harga');
    $total_pesanan     = $transaksis->count();
    $total_produk      = $transaksis->sum('qty');
    $rata_rata_pesanan = $total_pesanan > 0 ? round($total_pendapatan / $total_pesanan) : 0;
    
    $per_produk        = $transaksis->groupBy('nama_produk')->map(function ($items) {
        return [
            'nama'  => $items->first()->nama_produk,
            'qty'   => $items->sum('qty'),
            'total' => $items->sum('total_harga'),
        ];
    })->values();
    $logistik = Logistik::latest()->get();

    // Data laporan tahunan — daftar tahun database-agnostic (kompatibel PostgreSQL & MySQL)
    $allYears = Transaksi::all()->pluck('created_at')
        ->map(fn($d) => $d ? (int)$d->format('Y') : null)
        ->filter()->unique()->sortDesc()->values()->toArray();
    if (!in_array(now()->year, $allYears)) {
        array_unshift($allYears, now()->year);
    }
    $allYears = array_values(array_unique($allYears));

    $per_bulan = collect(range(1, 12))->map(function ($bulan) use ($tahun) {
        $rows = Transaksi::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        return [
            'bulan'     => $bulan,
            'label'     => \Carbon\Carbon::create()->month($bulan)->locale('id')->isoFormat('MMMM'),
            'pendapatan'=> $rows->sum('total_harga'),
            'transaksi' => $rows->count(),
            'produk'    => $rows->sum('qty'),
        ];
    });

    $label_periode = 'Semua Waktu';
    if ($filter === 'harian') {
        $label_periode = 'Harian (' . \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('dddd, D MMMM Y') . ')';
    } elseif ($filter === 'mingguan') {
        $label_periode = 'Mingguan (' . $tanggal_awal . ' s/d ' . $tanggal_akhir . ')';
    } elseif ($filter === 'bulanan') {
        $label_periode = 'Bulanan (' . $nama_bulan . ' ' . $tahun_bulan . ')';
    } elseif ($filter === 'tahunan') {
        $label_periode = 'Tahunan (Tahun ' . $tahun . ')';
    }

    return view('laporan', compact(
        'transaksis','total_pendapatan','total_pesanan','total_produk','rata_rata_pesanan',
        'per_produk','logistik','filter','tahun','allYears','per_bulan','tanggal',
        'minggu','bulan_input','tanggal_awal','tanggal_akhir','nama_bulan','tahun_bulan','label_periode'
    ));
})->middleware('auth');

Route::get('/keranjang', function () {
    return view('keranjang');
})->middleware('auth');

Route::get('/checkout', function (Request $request) {
    return view('checkout', [
        'id' => $request->query('id'),
        'nama' => $request->query('nama', 'Produk'),
        'gambar' => $request->query('gambar', 'logo.png'),
        'harga' => $request->query('harga', 45000),
        'ukuran' => $request->query('ukuran', 'Standard'),
        'varian' => $request->query('varian', 'Vanilla Milky'),
        'qty' => $request->query('qty', 1),
    ]);
})->middleware('auth');

Route::post('/checkout/proses', function (Request $request) {
    $trx = Transaksi::create([
        'user_id' => Auth::id(),
        'nama_produk' => $request->input('nama_produk', 'Produk'),
        'gambar_produk' => $request->input('gambar_produk', 'logo.png'),
        'varian' => $request->input('varian', 'Standard'),
        'ukuran' => $request->input('ukuran', 'Standard'),
        'qty' => $request->input('qty', 1),
        'harga_satuan' => $request->input('harga_satuan', 0),
        'total_harga' => $request->input('total_harga', 0),
        'metode_pengiriman' => $request->input('metode_pengiriman', 'Kurir Instan'),
        'metode_pembayaran' => $request->input('metode_pembayaran', 'QRIS'),
        'status' => 'Diproses',
    ]);

    return redirect('/sukses?id=' . $trx->id);
})->middleware('auth');

Route::get('/sukses', function (Request $request) {
    $trx = Transaksi::find($request->query('id')) ?? Transaksi::where('user_id', Auth::id())->latest()->first();
    return view('sukses', compact('trx'));
});

Route::get('/riwayat-transaksi', function () {
    if (Auth::check() && in_array(Auth::user()->role, ['owner', 'karyawan'])) {
        return redirect(Auth::user()->role === 'owner' ? '/dashboard-owner' : '/pemesanan');
    }
    $transaksis = Transaksi::where('user_id', Auth::id())->latest()->get();
    return view('riwayat-transaksi', compact('transaksis'));
})->middleware('auth');

// Konfirmasi pesanan telah diterima oleh pelanggan
Route::post('/riwayat-transaksi/{id}/terima', function ($id) {
    $trx = Transaksi::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $trx->status = 'Selesai';
    $trx->save();
    return back()->with('sukses', 'Terima kasih telah berbelanja di By.Reesha! Pesanan Anda telah selesai.');
})->middleware('auth');

Route::get('/tentang-kami', function () {
    return redirect('/');
});

Route::get('/kontak', function () {
    return redirect('/');
});

use App\Models\Resep;

Route::get('/resep', function () {
    if (!Auth::check()) return redirect('/login');
    $user = Auth::user();

    if (!$user->isPembuatKue()) {
        return redirect('/pemesanan')->with('error', 'Menu Resep hanya dapat diakses oleh divisi pembuat kue atau Owner.');
    }

    $reseps = Resep::with('produk')->get();
    $produks = Produk::all();
    return view('resep', compact('reseps', 'produks'));
})->middleware('auth');

Route::post('/resep/simpan', function (Request $request) {
    if (!Auth::check()) abort(403);
    $user = Auth::user();
    if (!$user->isPembuatKue()) abort(403);

    $request->validate([
        'produk_id' => 'required|exists:produks,id',
        'nama_resep' => 'required|string|max:255',
        'porsi' => 'nullable|string|max:100',
        'waktu_persiapan' => 'required|string|max:100',
        'waktu_panggang' => 'required|string|max:100',
        'suhu_oven' => 'required|string|max:100',
        'tingkat_kesulitan' => 'required|string|max:50',
        'bahan_bahan' => 'required|string',
        'langkah_langkah' => 'required|string',
        'tips' => 'nullable|string',
    ]);

    Resep::updateOrCreate(
        ['produk_id' => $request->produk_id],
        [
            'nama_resep' => $request->nama_resep,
            'porsi' => $request->porsi,
            'waktu_persiapan' => $request->waktu_persiapan,
            'waktu_panggang' => $request->waktu_panggang,
            'suhu_oven' => $request->suhu_oven,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
            'bahan_bahan' => $request->bahan_bahan,
            'langkah_langkah' => $request->langkah_langkah,
            'tips' => $request->tips,
        ]
    );

    return back()->with('sukses', 'Resep kue berhasil disimpan!');
})->middleware('auth');

Route::get('/resep/{id}', function ($id) {
    if (!Auth::check()) return redirect('/login');
    $user = Auth::user();

    if (!$user->isPembuatKue()) {
        return redirect('/pemesanan')->with('error', 'Menu Resep hanya dapat diakses oleh divisi pembuat kue atau Owner.');
    }

    $resep = Resep::with('produk')->findOrFail($id);
    return view('resep_detail', compact('resep'));
})->middleware('auth');