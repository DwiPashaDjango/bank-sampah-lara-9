<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Carbon\Carbon;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tabungan::with('user')->where('users_id', '=', Auth::user()->id)->get();
        $dataAdmin = Tabungan::with('user')->get();
        return view('tabungan.index', compact('data', 'dataAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tabungan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jml_sampah' => 'required',
            'debit' => 'required',
            'kredit' => 'required',
            'saldo' => 'required'
        ], [
            'jml_sampah.required' => 'Jumlah sampah tidak boleh kosong',
            'debit.required' => 'Debit tidak boleh kosong',
            'kredit.required' => 'Kredit tidak boleh kosong',
            'saldo.required' => 'Saldo tidak boleh kosong'
        ]);

        $data = Tabungan::create([
            'users_id' => Auth::user()->id,
            'tgl_nabung' => Carbon::now(),
            'jml_sampah' => $request->jml_sampah,
            'debit' => $request->debit,
            'kredit' => $request->kredit,
            'saldo' => $request->saldo
        ]);
        return redirect()->route('tabungan.index')->with(['message' => 'Berhasil Menambahkan Tabungan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Tabungan::with('user')->find($id);
        $data->debit = number_format($data->debit, 0, '', '.');
        $data->kredit = number_format($data->kredit, 0, '', '.');
        $data->saldo = number_format($data->saldo, 0, '', '.');
        $data->tgl_nabung = Carbon::parse($data->tgl_nabung)->format('d/m/Y');
        return response()->json($data);
    }

    /**
     * CetakById the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cetakById($id)
    {
        $data = Tabungan::with('user')->find($id);
        $data->debit = number_format($data->debit, 0, '', '.');
        $data->kredit = number_format($data->kredit, 0, '', '.');
        $data->saldo = number_format($data->saldo, 0, '', '.');
        $data->tgl_nabung = Carbon::parse($data->tgl_nabung)->format('d/m/Y');
        return view('tabungan.cetakById', compact('data'));
    }

    /**
     * Cetak All the specified resource from storage.
     *
     * @param  int
     * @return \Illuminate\Http\Response
     */
    public function cetakAll()
    {
        $data = Tabungan::with('user')->get();
        return view('tabungan.cetakAll', compact('data'));
    }
}
