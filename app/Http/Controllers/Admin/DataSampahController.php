<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\ArtikelRequest;
use Illuminate\Http\Request;
use App\Events\ArtikelDeleteEvent;
use App\Services\SummernoteService;
use App\Services\UploadService;
use App\Models\data_sampah;
use App\Models\KategoriArtikel;
use File;
use Illuminate\Support\Str;

class DataSampahController extends Controller
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
        $data_sampah = data_sampah::with(['user', 'kategoriArtikel'])->get();
        return view('admin.data_sampah.index', compact('data_sampah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriArtikel = KategoriArtikel::all();
        return view('admin.data_sampah.create', compact('kategoriArtikel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        data_sampah::create([
            'judul' => $request->judul,
            'thumbnail' => $this->uploadService->imageUpload('data_sampah'),
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'slug' => Str::slug($request->judul),
            'user_id' => auth()->user()->id,
            'kategori_artikel_id' => $request->kategori_artikel_id,
        ]);

        return redirect()->route('admin.data_sampah.index')->with('success', 'Data berhasil ditambah');
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
    public function edit(data_sampah $data_sampah)
    {
        $kategoriArtikel = KategoriArtikel::get();
        return view('admin.data_sampah.edit', compact('data_sampah', 'kategoriArtikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, data_sampah $data_sampah)
    {
        $request->request->add([
            'tgl' => date('Y-m-d'),
            'slug' => Str::slug($request->judul),
            'user_id' => auth()->user()->id,
        ]);
        $data_sampah->update($request->all());

        return redirect()->route('admin.data_sampah.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(data_sampah $data_sampah)
    {
        $data_sampah->delete();
        return redirect()->route('admin.data_sampah.index')->with('success', 'Data berhasil dihapus');
    }
}
