<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtikelRequest as Request;

use App\Models\data_sampah;

class DataSampahController extends Controller
{
    public function index()
    {
    	$data_sampah = data_sampah::with(['user','kategoriArtikel'])->latest()->paginate(4);
    	return view('data_sampah.index',compact('data_sampah'));
    }

    public function show(data_sampah $data_sampah)
    {
    	return view('data_sampah.show',compact('data_sampah'));
    }

    public function search(Request $request)
    {	
    	$data_sampah = data_sampah::with(['user','kategoriArtikel'])->where(function($query) use ($request){
    		$query->where('judul','like','%'.$request->keyword.'%')
            ->orWhere('deskripsi','like','%'.$request->keyword.'%');
    	})->paginate(4);

    	return view('data_sampah.index',compact('data_sampah'));
    }
}