<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtikelRequest as Request;

use App\Models\galeri;

class GaleriController extends Controller
{
    public function index()
    {
    	$galeri = galeri::with(['user','kategoriArtikel'])->latest()->paginate(4);
    	return view('galeri.index',compact('galeri'));
    }

    public function show(galeri $galeri)
    {
    	return view('galeri.show',compact('galeri'));
    }

    public function search(Request $request)
    {	
    	$galeri = galeri::with(['user','kategoriArtikel'])->where(function($query) use ($request){
    		$query->where('judul','like','%'.$request->keyword.'%')
            ->orWhere('deskripsi','like','%'.$request->keyword.'%');
    	})->paginate(4);

    	return view('galeri.index',compact('galeri'));
    }
}