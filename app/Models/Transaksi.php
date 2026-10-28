<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    /**
     * Relasi: Transaksi dilakukan oleh User pelanggan
     * Sesuai spesifikasi slide 10 PPT: Sale belongsTo User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Transaksi mengikat Produk kue
     * Sesuai spesifikasi slide 10 PPT: SaleItem belongsTo Product
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    /**
     * Nomor faktur resmi transaksi
     */
    public function getNomorTransaksiAttribute(): string
    {
        return $this->kode_transaksi ?? ('#TRX-' . str_pad($this->id, 4, '0', STR_PAD_LEFT));
    }
}
