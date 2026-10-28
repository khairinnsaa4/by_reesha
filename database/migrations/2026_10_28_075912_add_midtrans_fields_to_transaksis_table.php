<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMidtransFieldsToTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksis', 'midtrans_transaction_id')) {
                $table->string('midtrans_transaction_id')->nullable()->after('kode_transaksi');
            }
            if (!Schema::hasColumn('transaksis', 'qris_url')) {
                $table->text('qris_url')->nullable()->after('midtrans_transaction_id');
            }
            if (!Schema::hasColumn('transaksis', 'qris_string')) {
                $table->text('qris_string')->nullable()->after('qris_url');
            }
            if (!Schema::hasColumn('transaksis', 'payment_status')) {
                $table->string('payment_status', 50)->nullable()->default('unpaid')->after('metode_pembayaran');
            }
            if (!Schema::hasColumn('transaksis', 'expired_at')) {
                $table->timestamp('expired_at')->nullable()->after('payment_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['midtrans_transaction_id', 'qris_url', 'qris_string', 'payment_status', 'expired_at']);
        });
    }
}
