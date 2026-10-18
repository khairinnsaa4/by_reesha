<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $semua_cake = Produk::all();
        
        if ($semua_cake->isEmpty()) {
            Produk::create([
                'nama_kue' => 'Mini Cake',
                'harga' => 35000,
                'gambar' => 'mini_cake.jpg',
                'deskripsi' => 'Mini cake super gemas dengan porsi yang sesuai, tampilan estetik, dan rasa manis yang pas untuk memanjakan dirimu atau orang tersayang.'
            ]);

            Produk::create([
                'nama_kue' => 'Bento Cake',
                'harga' => 45000,
                'gambar' => 'bento_cake.jpg',
                'deskripsi' => 'Bikin momen spesial makin berkesan dengan bento cake estetik yang bisa custom desain sesukamu'
            ]);

            Produk::create([
                'nama_kue' => 'Box Cake',
                'harga' => 85000,
                'gambar' => 'box_cake.jpg',
                'deskripsi' => 'Cake dengan dekorasi yang elegan dan menawan, dikemas dalam kotak eksklusif untuk memberikan kesan hadiah mewah, berkelas, dan istimewa di setiap perayaanmu.' 
            ]);

            Produk::create([
                'nama_kue' => 'Duo Cake',
                'harga' => 95000,
                'gambar' => 'duo_cake.jpg',
                'deskripsi' => 'Cake dengan dekorasi yang elegan dan menawan, dikemas dalam kotak eksklusif untuk memberikan kesan hadiah mewah, berkelas, dan istimewa di setiap perayaanmu.' 
            ]);

            Produk ::create([
                'nama_kue' => 'Love Cake',
                'harga' => 100000,
                'gambar' => 'love_cake.jpg',
                'deskripsi' => 'Cake berbentuk love yang minimalis dan clean, memancarkan kesan romantis yang anggun.'
            ]);

             Produk::create([
                'nama_kue' => 'Midi Cake',
                'harga' => 120000,
                'gambar' => 'midi_cake.jpg',
                'deskripsi' => 'Cake midi dengan ukuran yang lebih pas, tekstur selembut awan, dan tampilan estetik yang siap menyempurnakan setiap sudut foto perayaanmu.'
            ]);

            Produk::create([
                'nama_kue' => 'Flower Cake',
                'harga' => 135000,
                'gambar' => 'flower_cake.jpg',
                'deskripsi' => 'Cake dengan desain flower yang cantik dan aesthetic dengan pilihan warna bunga yang bisa di custom.'
            ]);

            Produk::create([
                'nama_kue' => 'Dua Tier Cake',
                'harga' => 150000,
                'gambar' => 'dua_tier_cake.jpg',
                'deskripsi' => 'Cake 2 tingkat yang elegan untuk berbagai momen spesial. Tersedia custom desain sesuai keinginan.'
            ]);

           
            $semua_cake = Produk::all();
        }

        return view('katalog', compact('semua_cake'));
    }

    public function detailProduk($id)
    {
        $cake = Produk::findOrFail($id);
        return view('detail', compact('cake'));
    }
}