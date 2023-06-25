<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\data_transaksi;

class CountController extends Controller
{
    public function countMonth(Request $request)
    {
        $data = \DB::table('data_transaksi')
        ->select([
            \DB::raw('MONTH(tgl) as bulan, judul, SUM(totalberat) as berat, SUM(totalharga) as harga')
        ])
        ->groupBy('bulan', 'judul')
        ->get()
        ->toArray();
        dd($data);
    }

}