<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\data_transaksi;
use Str;

class DataTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_transaksi = data_transaksi::all();
        return view('admin.data_transaksi.index',compact('data_transaksi'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data_transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add([
            'tgl' => date('Y-m-d'),
            'slug' => Str::slug($request->deskripsi),
            'user_id' => auth()->user()->id,
        ]);
        data_transaksi::create($request->all());

        return redirect()->route('admin.data_transaksi.index')->with('success','Data berhasil ditambah');
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
    public function edit(data_transaksi $data_transaksi)
    {
        return view('admin.data_transaksi.edit',compact('data_transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, data_transaksi $data_transaksi)
    {
        $request->request->add([
            'tgl' => date('Y-m-d'),
            'slug' => Str::slug($request->deskripsi),
            'user_id' => auth()->user()->id,
        ]);
        $data_transaksi->update($request->all());
           
        return redirect()->route('admin.data_transaksi.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(data_transaksi $data_transaksi)
    {   
        $data_transaksi->delete();
        return redirect()->route('admin.data_transaksi.index')->with('success','Data berhasil dihapus');
    }
}
