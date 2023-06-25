<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index()
    {
        return view('jadwal.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tgl_jemput' => 'required',
            'jam' => 'required',
            'jenis' => 'required',
            'berat' => 'required',
            'alamat' => 'required'
        ], [
            'tgl_jemput.required' => 'Tanggal penjemputan sampah tidak boleh kosong.',
            'jam.required' => 'Jam penjemputan sampah tidak boleh kosong.',
            'jenis.required' => 'Jenis sampah tidak boleh kosong.',
            'berat.required' => 'Berat sampah tidak boleh kosong.',
            'alamat.required' => 'Alamat penjemputan tidak boleh kosong.'
        ]);

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }

        $data = Jadwal::create([
            'users_id' => Auth::user()->id,
            'tgl_jemput' => $request->tgl_jemput,
            'jam' => $request->jam,
            'jenis' => $request->jenis,
            'berat' => $request->berat,
            'alamat' => $request->alamat
        ]);
        return response()->json($data);
    }
}
