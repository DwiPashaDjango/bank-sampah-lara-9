<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\data_transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $data = data_transaksi::whereYear('tgl', $now)->get();
        return view('admin.index', compact('data'));
    }
}
