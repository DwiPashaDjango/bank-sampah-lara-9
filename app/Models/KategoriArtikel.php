<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\data_sampah;

class KategoriArtikel extends Model
{
    use HasFactory;

    protected $table = 'kategori_artikel';

    protected $fillable = [
    	'nama_kategori','slug',
    ];

    public function data_sampah()
    {
    	return $this->hasMany(data_sampah::class,'kategori_artikel_id');
    }

    public function gallery()
    {
    	return $this->hasMany(gallery::class,'kategori_artikel_id');
    }
    
}
