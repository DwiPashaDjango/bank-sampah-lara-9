<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\data_transaksi;

class DataTransaksiController extends Controller
{
  public function index()
    {
    	$data_transaksi = data_transaksi::with(['user'])->latest()->paginate(4);
    	return view('data_transaksi.index',compact('data_transaksi'));
    }

    public function show(data_transaksi $data_transaksi)
    {
    	return view('data_transaksi.show',compact('data_transaksi'));
    }

}
