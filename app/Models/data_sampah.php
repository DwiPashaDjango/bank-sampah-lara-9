<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class data_sampah extends Model
{
    use HasFactory;

    protected $table = 'data_sampah';

    protected $fillable = [
    	'judul','slug','deskripsi','thumbnail','harga','jenis','user_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function kategoriArtikel()
    {
    	return $this->belongsTo(KategoriArtikel::class);
    }

    public function getThumbnail()
    {
    	return 'uploads/img/data_sampah/'.$this->thumbnail;
    }
}
