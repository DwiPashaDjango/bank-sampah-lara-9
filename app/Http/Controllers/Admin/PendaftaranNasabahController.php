<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PendaftaranNasabahController extends Controller
{
    public function index()
    {
        $user = User::where('status', 'lock')->get();
        return view('admin.pendaftaran.index', compact('user'));
    }

    public function validateUser(Request $request, $id)
    {
        $data = User::find($id);
        $data->update([
            'status' => 'unlock'
        ]);
        return response()->json($data);
    }
}
