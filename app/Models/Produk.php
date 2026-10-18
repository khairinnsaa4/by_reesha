<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $guarded = [];

    public function resep()
    {
        return $this->hasOne(Resep::class, 'produk_id');
    }
}