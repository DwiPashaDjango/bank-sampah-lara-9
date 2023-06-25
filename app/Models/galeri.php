<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
    	'judul','slug','tgl','deskripsi','image','user_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function kategoriArtikel()
    {
    	return $this->belongsTo(KategoriArtikel::class);
    }

    public function getImage()
    {
    	return 'uploads/img/galeri/'.$this->image;
    }
    
}
