<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TransaksiModel;

class CountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->TransaksiModel = new TransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'chart month',
            'TransaksiModel' => $this->TransaksiModel->AllData()
        ];

        return view('admin.index', $data);
    }
}
