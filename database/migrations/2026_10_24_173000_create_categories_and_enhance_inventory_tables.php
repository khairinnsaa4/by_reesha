<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesAndEnhanceInventoryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // 1. Buat tabel master Kategori Produk (sesuai spesifikasi slide 6, 9 & 10)
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('nama')->unique();
                $table->string('slug')->unique();
                $table->text('deskripsi')->nullable();
                $table->timestamps();
            });
        }

        // 2. Tambah kolom spesifikasi inventaris & konsistensi stok pada tabel produks
        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('produks', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            }
            if (!Schema::hasColumn('produks', 'sku')) {
                $table->string('sku', 50)->nullable()->unique();
            }
            if (!Schema::hasColumn('produks', 'stok')) {
                $table->integer('stok')->default(15); // Kuota slot baking PO tersedia per batch
            }
            if (!Schema::hasColumn('produks', 'stok_minimum')) {
                $table->integer('stok_minimum')->default(3); // Batas peringatan low-stock
            }
            if (!Schema::hasColumn('produks', 'harga_modal')) {
                $table->integer('harga_modal')->default(0); // HPP / purchase price
            }
        });

        // 3. Tambah relasi produk dan kode unik transaksi pada tabel transaksis
        Schema::table('transaksis', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksis', 'produk_id')) {
                $table->foreignId('produk_id')->nullable()->constrained('produks')->onDelete('set null');
            }
            if (!Schema::hasColumn('transaksis', 'kode_transaksi')) {
                $table->string('kode_transaksi', 50)->nullable()->unique();
            }
            if (!Schema::hasColumn('transaksis', 'subtotal')) {
                $table->integer('subtotal')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (Schema::hasColumn('transaksis', 'produk_id')) {
                $table->dropForeign(['produk_id']);
                $table->dropColumn(['produk_id', 'kode_transaksi', 'subtotal']);
            }
        });

        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn(['category_id', 'sku', 'stok', 'stok_minimum', 'harga_modal']);
            }
        });

        Schema::dropIfExists('categories');
    }
}
