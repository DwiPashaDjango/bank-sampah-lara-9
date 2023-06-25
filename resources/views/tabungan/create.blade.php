@extends('layouts.backend.app',[
'title' => 'Tabungan Nasabah',
'contentTitle' => 'Tabungan Nasabah',
])

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{route('tabungan.index')}}" class="btn btn-sm btn-success"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{route('tabungan.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="" id="" disabled class="form-control" value="{{Auth::user()->name}}">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="text" name="" id="" disabled class="form-control" value="{{date('d/m/Y')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jumlah Sampah (Kg)</label>
                        <input type="text" name="jml_sampah" id="" class="form-control @error('jml_sampah') is-invalid @enderror">
                        @error('jml_sampah')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Debit</label>
                        <input type="number" name="debit" id="" class="form-control @error('debit') is-invalid @enderror">
                        @error('debit')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kredit</label>
                        <input type="number" name="kredit" id="" class="form-control @error('kredit') is-invalid @enderror">
                        @error('kredit')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Saldo</label>
                <input type="number" name="saldo" id="" class="form-control @error('saldo') is-invalid @enderror">
                @error('saldo')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="btn-send">
                <button class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
@stop

@push('js')
<!-- DataTables -->
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function() {
        $("#dataTable1").DataTable();
    });
</script>
@endpush