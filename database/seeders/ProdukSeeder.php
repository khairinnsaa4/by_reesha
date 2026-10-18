<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama_kue' => 'Flower Cake',
            'harga' => 135000,
            'gambar' => 'flower_cake.jpg',
        ]);
        Produk::create([
            'nama_kue' => 'Dua Tier Cake',
            'harga' => 150000,
            'gambar' => 'dua_tier_cake.jpg',
        ]);
        Produk::create([
            'nama_kue' => 'Bento Cake',
            'harga' => 55000,
            'gambar' => 'bento_cake.jpg',
        ]);
        Produk::create([
            'nama_kue' => 'Duo Cake',
            'harga' => 95000,
            'gambar' => 'duo_cake.jpg',
        ]);
    }
}