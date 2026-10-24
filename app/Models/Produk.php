<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'stock' => 'integer',
        'stok' => 'integer',
        'sold_count' => 'integer',
        'harga' => 'integer',
        'harga_modal' => 'integer',
        'stok_minimum' => 'integer',
    ];

    /**
     * Getter & Setter Sinkronisasi Stock & Stok
     */
    public function getStockAttribute($value)
    {
        if ($value !== null) {
            return (int) $value;
        }
        return (int) ($this->attributes['stok'] ?? 0);
    }

    public function setStockAttribute($value)
    {
        $this->attributes['stock'] = (int) $value;
        $this->attributes['stok'] = (int) $value;
    }

    public function getStokAttribute($value)
    {
        if (isset($this->attributes['stock']) && $this->attributes['stock'] !== null) {
            return (int) $this->attributes['stock'];
        }
        return (int) ($value ?? 0);
    }

    public function setStokAttribute($value)
    {
        $this->attributes['stok'] = (int) $value;
        $this->attributes['stock'] = (int) $value;
    }

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
     * Helper status kuota slot PO & Stok
     */
    public function isLowStock(): bool
    {
        return ($this->stock ?? 0) <= ($this->stok_minimum ?? 3);
    }

    public function isHabis(): bool
    {
        return ($this->stock ?? 0) <= 0;
    }
}
