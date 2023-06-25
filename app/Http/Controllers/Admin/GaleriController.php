<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\ArtikelRequest;
use Illuminate\Http\Request;
use App\Events\ArtikelDeleteEvent;
use App\Services\SummernoteService;
use App\Services\UploadService;
use App\Models\galeri;
use App\Models\KategoriArtikel;
use Str;
use File;

class GaleriController extends Controller
{
    private $summernoteService;
    private $uploadService;

    public function __construct(SummernoteService $summernoteService, UploadService $uploadService)
    {
        $this->summernoteService = $summernoteService;
        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeri = galeri::with(['user','kategoriArtikel'])->get();
        return view('admin.galeri.index',compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriArtikel = KategoriArtikel::all();
        return view('admin.galeri.create',compact('kategoriArtikel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        galeri::create([
            'judul' => $request->judul,
            'image' => $this->uploadService->imageUpload('galeri'),
            'tgl' => date('Y-m-d'),
            'slug' => Str::slug($request->judul),
            'user_id' => auth()->user()->id,
            'kategori_artikel_id' => $request->kategori_artikel_id,
        ]);

        return redirect()->route('admin.galeri.index')->with('success','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(galeri $galeri)
    {   
        $kategoriArtikel = KategoriArtikel::get();
        return view('admin.galeri.edit',compact('galeri','kategoriArtikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, galeri $galeri)
    {
        $request->request->add([
                        'judul' => $request->judul,
            'image' => $this->uploadService->imageUpload('galeri'),
            'tgl' => date('Y-m-d'),
            'slug' => Str::slug($request->judul),
            'user_id' => auth()->user()->id,
        ]);
        $galeri->update($request->all());
           
        return redirect()->route('admin.galeri.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(galeri $galeri)
    {   
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success','Data berhasil dihapus');
    }
}
