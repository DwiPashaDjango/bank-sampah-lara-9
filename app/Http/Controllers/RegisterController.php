<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8'
        ]);


        $validatedData['password'] = bcrypt($validatedData['password']);


        User::create($validatedData);

        $request->session()->flash('success', 'registration succesfull ! please login');

        return redirect('/login');
    }

    public function registerNasabah()
    {
        return view('auth.register_nasabah');
    }

    public function storeRegisterNasabah(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'nik' => 'required|unique:users',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'umur' => 'required|integer',
            'telp' => 'required',
            'no_rek' => 'required',
            'image_ktp' => 'required|mimes:png,jpg,jpeg',
            'password' => 'required|min:8',
            'pekerjaan' => 'required'
        ]);

        $file = $request->file('image_ktp');
        $docsName = Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/ktp/', $docsName);

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'umur' => $request->umur,
            'telp' => $request->telp,
            'no_rek' => $request->no_rek,
            'pekerjaan' => $request->pekerjaan,
            'image_ktp' => $docsName,
            'status' => 'lock',
            'role' => 'guest',
            'password' => Hash::make($request->password)
        ]);
        $request->session()->flash('success', 'registration succesfull ! please login');
        return redirect('/login');
    }
}
