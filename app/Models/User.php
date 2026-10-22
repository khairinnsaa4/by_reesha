<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'divisi',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        if (str_starts_with($this->avatar, 'data:') || str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
            return $this->avatar;
        }

        return asset($this->avatar);
    }

    public function isPembuatKue(): bool
    {
        if ($this->role === 'owner') {
            return true;
        }

        if ($this->role !== 'karyawan') {
            return false;
        }

        if (empty($this->divisi)) {
            return true;
        }

        $divisiLower = strtolower($this->divisi);
        $keywords = ['kue', 'baker', 'dapur', 'pastry', 'adonan', 'dekorasi', 'produksi', 'chef'];
        foreach ($keywords as $kw) {
            if (str_contains($divisiLower, $kw)) {
                return true;
            }
        }

        return false;
    }
}
