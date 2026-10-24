<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Logistik;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Sesuai kriteria UTS slide 12, 20 & 21 (Reproducibility & Demo Account)
     *
     * @return void
     */
    public function run()
    {
        // 1. Seed Categories (Kategori Master)
        $catBento = Category::updateOrCreate(['slug' => 'bento-korean'], [
            'nama' => 'Bento & Korean Style',
            'deskripsi' => 'Koleksi kue bento mini bergaya Korea dengan custom desain estetik.'
        ]);

        $catLayer = Category::updateOrCreate(['slug' => 'signature-cake'], [
            'nama' => 'Signature Artisan Cake',
            'deskripsi' => 'Kue tart lembut berlapis dengan krim segar dan hiasan premium.'
        ]);

        $catTier = Category::updateOrCreate(['slug' => 'tier-celebration'], [
            'nama' => 'Tier Celebration Cake',
            'deskripsi' => 'Kue bertingkat megah untuk pesta ulang tahun, anniversary, dan resepsi.'
        ]);

        $catBox = Category::updateOrCreate(['slug' => 'box-hampers'], [
            'nama' => 'Box Cake & Hampers',
            'deskripsi' => 'Pilihan kue boks praktis cocok untuk hadiah dan hampers perayaan.'
        ]);

        // 2. Seed Master Produk dengan SKU, Stok (Slot PO), Minimum Stock, dan HPP
        $daftarProduk = [
            [
                'id' => 2,
                'nama_kue' => 'Mini Cake',
                'sku' => 'BR-MINI-01',
                'category_id' => $catBento->id,
                'harga' => 35000,
                'harga_modal' => 18000,
                'stok' => 20,
                'stok_minimum' => 5,
                'gambar' => 'mini_cake.jpg',
                'deskripsi' => 'Mini cake lezat ukuran personal dengan krim vanilla lembut.'
            ],
            [
                'id' => 3,
                'nama_kue' => 'Bento Cake',
                'sku' => 'BR-BNT-02',
                'category_id' => $catBento->id,
                'harga' => 45000,
                'harga_modal' => 22000,
                'stok' => 15,
                'stok_minimum' => 4,
                'gambar' => 'bento_cake.jpg',
                'deskripsi' => 'Kue bento khas By.Reesha dalam wadah ramah lingkungan dengan pesan kustom.'
            ],
            [
                'id' => 4,
                'nama_kue' => 'Box Cake',
                'sku' => 'BR-BOX-03',
                'category_id' => $catBox->id,
                'harga' => 85000,
                'harga_modal' => 42000,
                'stok' => 12,
                'stok_minimum' => 3,
                'gambar' => 'box_cake.jpg',
                'deskripsi' => 'Kue boks persegi dengan topping lumer premium dan sponge cake super moist.'
            ],
            [
                'id' => 5,
                'nama_kue' => 'Duo Cake',
                'sku' => 'BR-DUO-04',
                'category_id' => $catBento->id,
                'harga' => 95000,
                'harga_modal' => 48000,
                'stok' => 10,
                'stok_minimum' => 3,
                'gambar' => 'duo_cake.jpg',
                'deskripsi' => 'Dua varian rasa kue bento dalam satu kemasan spesial berpasangan.'
            ],
            [
                'id' => 6,
                'nama_kue' => 'Love Cake',
                'sku' => 'BR-LOVE-05',
                'category_id' => $catLayer->id,
                'harga' => 100000,
                'harga_modal' => 50000,
                'stok' => 8,
                'stok_minimum' => 2,
                'gambar' => 'love_cake.jpg',
                'deskripsi' => 'Kue berbentuk hati elegan bernuansa romantis dengan krim strawberry/red velvet.'
            ],
            [
                'id' => 7,
                'nama_kue' => 'Midi Cake',
                'sku' => 'BR-MIDI-06',
                'category_id' => $catLayer->id,
                'harga' => 120000,
                'harga_modal' => 60000,
                'stok' => 8,
                'stok_minimum' => 2,
                'gambar' => 'midi_cake.jpg',
                'deskripsi' => 'Kue tart ukuran sedang diameter 16cm, cocok untuk perayaan 4-6 orang.'
            ],
            [
                'id' => 8,
                'nama_kue' => 'Flower Cake',
                'sku' => 'BR-FLW-07',
                'category_id' => $catLayer->id,
                'harga' => 135000,
                'harga_modal' => 70000,
                'stok' => 6,
                'stok_minimum' => 2,
                'gambar' => 'flower_cake.jpg',
                'deskripsi' => 'Dekorasi bunga piping buttercream mewah karya chef patisserie By.Reesha.'
            ],
            [
                'id' => 9,
                'nama_kue' => 'Dua Tier Cake',
                'sku' => 'BR-TIER-08',
                'category_id' => $catTier->id,
                'harga' => 150000,
                'harga_modal' => 80000,
                'stok' => 5,
                'stok_minimum' => 2,
                'gambar' => 'dua_tier_cake.jpg',
                'deskripsi' => 'Kue dua tingkat megah bertingkat kokoh untuk acara penting dan momen berharga.'
            ]
        ];

        foreach ($daftarProduk as $prod) {
            Produk::updateOrCreate(['id' => $prod['id']], $prod);
        }

        // 3. Seed Demo Accounts (Akun Pengujian Demo Sesuai Slide 20 PPT)
        User::updateOrCreate(
            ['email' => 'byreeshaowner@gmail.com'],
            [
                'name' => 'Owner By.Reesha',
                'password' => Hash::make('password123'),
                'role' => 'owner',
                'divisi' => 'Owner & Eksekutif',
                'phone' => '081234567890'
            ]
        );

        User::updateOrCreate(
            ['email' => 'baker@byreesha.com'],
            [
                'name' => 'Song Kang (Baker)',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'divisi' => 'Baker (Pembuat Kue)',
                'phone' => '082199887766'
            ]
        );

        User::updateOrCreate(
            ['email' => 'pelanggan@byreesha.com'],
            [
                'name' => 'Khai Pelanggan',
                'password' => Hash::make('password123'),
                'role' => 'pelanggan',
                'phone' => '085711223344'
            ]
        );

        // 4. Seed Supplier Mitra
        Supplier::updateOrCreate(
            ['nama_supplier' => 'PT Sinar Pangan Abadi'],
            [
                'kontak' => '081234567890',
                'alamat' => 'Kawasan Industri Pulo Gadung, Jakarta Timur',
                'kategori' => 'Bahan Baku & Dairy'
            ]
        );

        Supplier::updateOrCreate(
            ['nama_supplier' => 'CV Kemasan Nusantara'],
            [
                'kontak' => '082198765432',
                'alamat' => 'Jl. Daan Mogot KM 12, Tangerang',
                'kategori' => 'Box & Packaging'
            ]
        );

        // 5. Seed Logistik Stok Bahan
        Logistik::updateOrCreate(
            ['nama' => 'Tepung Terigu Segitiga Biru'],
            [
                'kategori' => 'Bahan Baku',
                'stok' => 50,
                'satuan' => 'kg',
                'status' => 'Aman'
            ]
        );

        Logistik::updateOrCreate(
            ['nama' => 'Butter Anchor Salted'],
            [
                'kategori' => 'Bahan Baku',
                'stok' => 20,
                'satuan' => 'kg',
                'status' => 'Aman'
            ]
        );

        Logistik::updateOrCreate(
            ['nama' => 'Box Bento Kraft Eco 10x10'],
            [
                'kategori' => 'Kemasan',
                'stok' => 100,
                'satuan' => 'pcs',
                'status' => 'Aman'
            ]
        );
    }
}
