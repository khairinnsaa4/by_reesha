<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->string('nama_resep');
            $table->string('porsi')->nullable();
            $table->string('waktu_persiapan')->default('20 Menit');
            $table->string('waktu_panggang')->default('30 Menit');
            $table->string('suhu_oven')->default('170°C');
            $table->string('tingkat_kesulitan')->default('Sedang');
            $table->text('bahan_bahan');
            $table->text('langkah_langkah');
            $table->text('tips')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
}
