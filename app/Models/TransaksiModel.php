<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class TransaksiModel extends Model
{
    public function AllData()
    {
    	return DB::table('data_transaksi')->get();
    }
    
}
