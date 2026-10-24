<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relasi: Produk milik suatu Kategori (Belongs To)
     * Sesuai spesifikasi slide 10 PPT: Product belongsTo Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relasi: 1 Produk memiliki resep takaran dapur
     */
    public function resep()
    {
        return $this->hasOne(Resep::class, 'produk_id');
    }

    /**
     * Relasi: 1 Produk memiliki riwayat transaksi penjualan (hasMany)
     * Sesuai spesifikasi slide 10 PPT: Product hasMany SaleItems / Transaksi
     */
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'produk_id');
    }

    /**
     * Scope Eloquent: Filter produk yang kuota stoknya menipis (Low Stock Alert)
     * Sesuai kriteria slide 6, 13, 18
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stok', '<=', 'stok_minimum');
    }

    /**
     * Helper status kuota slot PO
     */
    public function isLowStock(): bool
    {
        return $this->stok <= $this->stok_minimum;
    }

    public function isHabis(): bool
    {
        return $this->stok <= 0;
    }
}
