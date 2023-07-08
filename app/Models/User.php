<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\data_sampah;
use App\Models\galeri;
use App\Models\gallery;
use App\Models\Pengumuman;
use App\Models\data_transaksi;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function data_sampah()
    {
        return $this->hasMany(data_sampah::class);
    }

    public function galeri()
    {
        return $this->hasMany(galeri::class);
    }

    public function gallery()
    {
        return $this->hasMany(gallery::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }

    public function data_transaksi()
    {
        return $this->hasMany(data_transaksi::class);
    }

    public function total_saldo()
    {
        return $this->hasMany(SaldoNasabah::class, 'users_id', 'id');
    }
}
