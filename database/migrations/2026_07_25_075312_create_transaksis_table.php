<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('gambar_produk')->nullable();
            $table->string('varian')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('qty')->default(1);
            $table->integer('harga_satuan')->default(0);
            $table->integer('total_harga')->default(0);
            $table->string('metode_pengiriman')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('status')->default('Dikemas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
