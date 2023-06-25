<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\data_transaksi;
use App\Models\data_sampah;
use App\Models\galeri;
use App\Models\gallery;
use App\Models\Pengumuman;
use App\Models\login;

class HomeController extends Controller
{
    public function index()
    {
    	return view('home.index',[
            'data_transaksi' => data_transaksi::with(['user'])->latest()->take(2)->get(),
            'data_sampah' => data_sampah::with(['user'])->latest()->take(2)->get(),
            'galeri' => galeri::with(['user'])->latest()->take(2)->get(),
            'gallery' => gallery::with(['user'])->latest()->take(2)->get(),
            'pengumuman' => Pengumuman::with(['user'])->latest()->take(2)->get(),
        ]);
    }

    public function about()
    {
    	return view('home.about');
    }

    public function contact()
    {
    	return view('home.contact');
    }

    public function login()
    {
    	return view('auth.login');
    }
}
