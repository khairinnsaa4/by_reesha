<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relasi Eloquent: 1 Kategori memiliki banyak Produk (One to Many)
     * Sesuai spesifikasi slide 10 PPT: Category hasMany Products
     */
    public function produks()
    {
        return $this->hasMany(Produk::class, 'category_id');
    }

    public function products()
    {
        return $this->produks();
    }
}
