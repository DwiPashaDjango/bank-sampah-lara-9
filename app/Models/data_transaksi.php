<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class data_transaksi extends Model
{
    use HasFactory;

    protected $table = 'data_transaksi';

    protected $fillable = [
    	'petugas','judul','slug','deskripsi','tgl','jam','berat','totalberat','harga','totalharga', 'user_id',
    ]; 

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function AllData()
    {
    	return DB::table('data_transaksi')->get();
    }
    
}
