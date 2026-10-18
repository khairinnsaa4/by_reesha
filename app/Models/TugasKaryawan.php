<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasKaryawan extends Model
{
    use HasFactory;

    protected $table = 'tugas_karyawan';

    protected $fillable = [
        'karyawan_id',
        'judul',
        'deskripsi',
        'prioritas',
        'status',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'karyawan_id');
    }
}
