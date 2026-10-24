<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddStockAndSoldCountToProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('produks', 'stock')) {
                $table->integer('stock')->default(0);
            }
            if (!Schema::hasColumn('produks', 'sold_count')) {
                $table->integer('sold_count')->default(0);
            }
        });

        // Salin nilai stok yang sudah ada ke kolom stock baru
        if (Schema::hasColumn('produks', 'stok') && Schema::hasColumn('produks', 'stock')) {
            DB::statement("UPDATE produks SET stock = COALESCE(stok, 0)");
        }

        // Kalkulasi awal sold_count dari data tabel transaksis yang sudah tercatat
        if (Schema::hasTable('transaksis')) {
            $sales = DB::table('transaksis')
                ->select('nama_produk', DB::raw('SUM(qty) as total_sold'))
                ->whereNotIn('status', ['Dibatalkan', 'Batal'])
                ->groupBy('nama_produk')
                ->get();

            foreach ($sales as $sale) {
                DB::table('produks')
                    ->where('nama_kue', $sale->nama_produk)
                    ->update(['sold_count' => (int) $sale->total_sold]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'sold_count')) {
                $table->dropColumn('sold_count');
            }
            if (Schema::hasColumn('produks', 'stock')) {
                $table->dropColumn('stock');
            }
        });
    }
}
