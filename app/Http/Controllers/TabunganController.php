<?php

namespace App\Http\Controllers;

use App\Models\BalanceWithdrawal;
use App\Models\SaldoNasabah;
use App\Models\Tabungan;
use App\Models\User;
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
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');

        if ($tanggal && $bulan) {
            $data = Tabungan::with('user')->where('users_id', '=', Auth::user()->id)->whereMonth('tgl_nabung', $bulan)->whereDay('tgl_nabung', $tanggal)->get();
            $dataAdmin = Tabungan::with('user')->whereMonth('tgl_nabung', $bulan)->whereDay('tgl_nabung', $tanggal)->get();
            $saldoUser = User::with('total_saldo')->where('id', '=', Auth::user()->id)->get();
            $user = User::orderBy('id', 'desc')->where('role', '=', 'guest')->get(['id', 'name']);
            $riwayat_penarikan = BalanceWithdrawal::with('user', 'saldo')->orderBy('id', 'desc')->get();
        } else {
            $data = Tabungan::with('user')->where('users_id', '=', Auth::user()->id)->get();
            $dataAdmin = Tabungan::with('user')->get();
            $saldoUser = User::with('total_saldo')->where('id', '=', Auth::user()->id)->get();
            $user = User::orderBy('id', 'desc')->where('role', '=', 'guest')->get(['id', 'name']);
            $riwayat_penarikan = BalanceWithdrawal::with('user', 'saldo')->orderBy('id', 'desc')->get();
            $tanggal = $request->input('tanggal');
            $bulan = $request->input('bulan');
        }

        return view('tabungan.index', compact('data', 'dataAdmin', 'saldoUser', 'user', 'riwayat_penarikan'));
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

        $usersId = Auth::user()->id;

        $grand = SaldoNasabah::where('users_id', '=', Auth::user()->id)->first();

        Tabungan::create([
            'users_id' => $usersId,
            'tgl_nabung' => Carbon::now(),
            'jml_sampah' => $request->jml_sampah,
            'debit' => $request->debit,
            'kredit' => $request->kredit,
            'saldo' => $request->saldo
        ]);

        if ($grand) {
            $grand->total_saldo = $grand->total_saldo + $request->saldo;
            $grand->save();
        } else {
            SaldoNasabah::create([
                'users_id' => $usersId,
                'total_saldo' => $request->saldo,
            ]);
        }
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

    public function getSaldoUser($id)
    {
        $data = SaldoNasabah::with('user')->where('users_id', '=', $id)->get();
        foreach ($data as $value) {
            $value->total_saldo = number_format($value->total_saldo, 0, '', '.');
        }
        return response()->json($data);
    }

    public function tarikSaldo(Request $request)
    {
        $request->validate([
            'users_id' => 'required',
            'amount_withdrawn' => 'required',
        ]);

        $tarikSaldo = str_replace('.', '', $request->amount_withdrawn);

        $saldo = SaldoNasabah::with('user')->where('users_id', '=', $request->users_id)->first();

        if (!$saldo) {
            return redirect('/tabungan')->with(['failed' => 'Saldo Tabungan Kurang.']);
        }

        if ($tarikSaldo > $saldo->total_saldo) {
            return redirect('/tabungan')->with(['failed' => 'Saldo Tabungan ' . $saldo->user->name . ' Kurang.']);
        }

        $saldo->total_saldo -= $tarikSaldo;
        $saldo->save();

        $balance_withdrawn = BalanceWithdrawal::create([
            'users_id' => $request->users_id,
            'saldo_id' => $saldo->id,
            'amount_withdrawn' => str_replace('.', '', $request->amount_withdrawn)
        ]);

        return redirect('/admin/saldouser/' . $balance_withdrawn->id . '/cetak-resi');
    }

    public function cetak_withdrawn($id)
    {
        $data = BalanceWithdrawal::with('user', 'saldo')->find($id);
        return view('tabungan.cetak_resi', compact('data'));
    }
}
