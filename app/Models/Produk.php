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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function resep()
    {
        return $this->hasOne(Resep::class, 'produk_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'produk_id');
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stok', '<=', 'stok_minimum');
    }

    public function isLowStock(): bool
    {
        return ($this->stock ?? 0) <= ($this->stok_minimum ?? 3);
    }

    public function isHabis(): bool
    {
        return ($this->stock ?? 0) <= 0;
    }
}
