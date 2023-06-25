<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class GetJadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::orderBy('id', 'desc')->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function show($id)
    {
        $jadwal = Jadwal::with('user')->find($id);
        return response()->json($jadwal);
    }
}
