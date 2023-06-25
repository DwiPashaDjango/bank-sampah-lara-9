@extends('layouts.backend.app',[
'title' => 'Manage Data Transaksi',
'contentTitle' => 'Manage Data Transaksi',
])
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush
@section('content')
<x-alert></x-alert>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('admin.data_transaksi.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
      </div>
      <div class="card-body table-responsive">
        <table id="dataTable1" class="table table-bordered table-hover text-center">
          <thead class="bg-info">
            <tr>
              <th>No</th>
              <th>petugas</th>
              <th>Judul</th>
              <th>Tgl Upload</th>
              <th>jam</th>
              <th>berat</th>
              <th>total berat</th>
              <th>harga</th>
              <th>total harga</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
            $no=1;
            @endphp

            @foreach($data_transaksi as $agd)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $agd->petugas }}</td>
              <td>{{ $agd->judul }}</td>
              <td>{{ \Carbon\Carbon::parse($agd->tgl)->format('d-m-Y') }}</td>
              <td>{{ $agd->jam }}</td>
              <td>{{ $agd->berat }}</td>
              <td>{{ $agd->totalberat }}</td>
              <td>Rp.{{number_format( $agd->harga, 0,'','.') }}</td>
              <td>Rp.{{ number_format($agd->totalharga, 0,'','.') }}</td>

              <td>
                <div class="row ml-2">
                  <a href="{{ route('admin.data_transaksi.edit',$agd->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i></a>

                  <form method="POST" action="{{ route('admin.data_transaksi.destroy',$agd->id) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus ?')" type="submit" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash fa-fw"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
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