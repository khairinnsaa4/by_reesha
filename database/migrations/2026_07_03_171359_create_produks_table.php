<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
  Schema::create('produks', function (Blueprint $table) {
        $table->id(); // Ini untuk nomor otomatis (Primary Key)
        $table->string('nama_kue'); // Kolom untuk nama kue
        $table->integer('harga'); // Kolom untuk harga berupa angka
        $table->string('gambar'); // Kolom untuk nama file foto kue
        $table->text('deskripsi'); // Kolom untuk deskripsi teks panjang
        $table->timestamps(); // Kolom otomatis pembuat waktu cetak data
    });
}
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
