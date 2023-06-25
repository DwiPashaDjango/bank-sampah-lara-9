<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtikelRequest as Request;

use App\Models\gallery;

class GalleryController extends Controller
{
    public function index()
    {
    	$gallery = gallery::with(['user','kategoriArtikel'])->latest()->paginate(4);
    	return view('gallery.index',compact('gallery'));
    }

    public function show(gallery $gallery)
    {
    	return view('gallery.show',compact('gallery'));
    }

    public function search(Request $request)
    {	
    	$gallery = gallery::with(['user','kategoriArtikel'])->where(function($query) use ($request){
    		$query->where('title','like','%'.$request->keyword.'%')
            ->orWhere('deskripsi','like','%'.$request->keyword.'%');
    	})->paginate(4);

    	return view('gallery.index',compact('gallery'));
    }

}