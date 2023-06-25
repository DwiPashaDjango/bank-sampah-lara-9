@extends('layouts.backend.app',[
'title' => 'Tabungan Nasabah',
'contentTitle' => 'Tabungan Nasabah',
])

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@section('content')
@if (session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
<div class="card">
    <div class="card-header">
        @can('role', ['guest'])
        <a href="{{route('tabungan.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
        @endcan
        @can('role', ['admin'])
        <a href="{{route('tabungan.cetakAll')}}" class="btn btn-sm btn-danger mr-2"><i class="fas fa-print"></i> Cetak</a>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-hover table-bordered text-center" id="dataTable1">
                <thead class="bg-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jumlah Sampah Keseluruhan (Kg)</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @can('role', ['guest'])
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{\Carbon\Carbon::parse($item->tgl_nabung)->format('d-m-Y')}}</td>
                        <td>{{$item->jml_sampah}} Kg</td>
                        <td>Rp.{{number_format($item->debit, 0,'','.')}}</td>
                        <td>Rp.{{number_format($item->kredit, 0,'','.')}}</td>
                        <td>Rp.{{number_format($item->saldo, 0,'','.')}}</td>
                        <td>
                            <a href="javascript:void(0)" data-id="{{$item->id}}" class="btn btn-sm btn-success detail"><i class="fas fa-eye"></i></a>
                            <a href="javascript:void(0)" data-id="{{$item->id}}" class="btn btn-sm btn-danger mr-2 cetakById"><i class="fas fa-print"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endcan
                    @can('role', ['admin'])
                    @foreach ($dataAdmin as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{\Carbon\Carbon::parse($item->tgl_nabung)->format('d-m-Y')}}</td>
                        <td>{{$item->jml_sampah}} Kg</td>
                        <td>Rp.{{number_format($item->debit, 0,'','.')}}</td>
                        <td>Rp.{{number_format($item->kredit, 0,'','.')}}</td>
                        <td>Rp.{{number_format($item->saldo, 0,'','.')}}</td>
                        <td>
                            <a href="javascript:void(0)" data-id="{{$item->id}}" class="btn btn-sm btn-success detail"><i class="fas fa-eye"></i></a>
                            <a href="javascript:void(0)" data-id="{{$item->id}}" class="btn btn-sm btn-danger mr-2 cetakById"><i class="fas fa-print"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endcan
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@push('modal')
<div class="modal fade" id="modalTabungan" tabindex="-1" role="dialog" aria-labelledby="modalTabunganLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTabunganLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="" id="name" disabled class="form-control" value="{{Auth::user()->name}}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="text" name="" id="tgl_nabung" disabled class="form-control" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jumlah Sampah (Kg)</label>
                            <input type="text" name="jml_sampah" disabled id="jml_sampah" class="form-control @error('jml_sampah') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Debit</label>
                            <input type="number" name="debit" disabled id="debit" class="form-control @error('debit') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Kredit</label>
                            <input type="number" name="kredit" disabled id="kredit" class="form-control @error('kredit') is-invalid @enderror">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Saldo</label>
                    <input type="number" name="saldo" id="saldo" disabled class="form-control @error('saldo') is-invalid @enderror">
                    @error('saldo')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
@endpush

@push('js')
<!-- DataTables -->
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $("#dataTable1").DataTable();
        });

        $('.detail').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: '/tabungan/' + id,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#modalTabungan').modal('show');
                    $('#modalTabunganLabel').html(response.user.name);
                    $('#name').val(response.user.name);
                    $('#tgl_nabung').val(response.tgl_nabung);
                    $('#jml_sampah').val(response.jml_sampah);
                    $('#debit').val(response.debit);
                    $('#kredit').val(response.kredit);
                    $('#saldo').val(response.saldo);
                },
                error: function(err) {
                    console.log(err);
                }
            })
        });

        $('.cetakById').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            window.location.href = '/tabungan/' + id + '/cetak'
        });
    });
</script>
@endpush