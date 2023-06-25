@extends('layouts.backend.app',[
'title' => 'Dashboard',
'contentTitle' => 'Dashboard',
])

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/dist/css/adminlte.min.css?v=3.2.0">
<!-- Small boxes (Stat box) -->
@can('role',['admin'])
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>@count('users')</h3>

        <p>Admin</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-tie"></i>
      </div>
      <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan
  <!-- ./col -->
  @can('role',['admin'])
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>@count('data_sampah')</h3>

        <p>Data Sampah</p>
      </div>
      <div class="icon">
        <i class="fas fa-image"></i>
      </div>
      <a href="{{ route('admin.data_sampah.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan
  <!-- ./col -->
  @can('role',['admin'])
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>@count('pengumuman')</h3>

        <p>Pengumuman</p>
      </div>
      <div class="icon">
        <i class="fas fa-info"></i>
      </div>
      <a href="{{ route('admin.pengumuman.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan
  <!-- ./col -->
  @can('role',['admin'])
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>@count('data_transaksi')</h3>

        <p>Data Transaksi</p>
      </div>
      <div class="icon">
        <i class="fas fa-list"></i>
      </div>
      <a href="{{ route('admin.data_transaksi.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan
  <!-- ./col -->
  @can('role',['admin'])
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>@count('galeri')</h3>

        <p>galeri</p>
      </div>
      <div class="icon">
        <i class="fas fa-image"></i>
      </div>
      <a href="{{ route('admin.galeri.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan
</div>

@can('role', ['admin', 'guest'])
<div class="card">
  <div class="card-header bg-primary">
    <b>Data Penjualan Sampah Tahun {{\Carbon\Carbon::now()->format('Y')}}</b>
  </div>
  <div class="card-body">
    <div class="table-responsive-lg">
      <table class="table table-bordered table-hover text-center" id="dataTable1">
        <thead class="bg-info">
          <tr>
            <th>No</th>
            <th>Judul Penjualan</th>
            <th>Berat</th>
            <th>Total Berat</th>
            <th>Harga</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $item)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->judul}}</td>
            <td>{{$item->berat}}</td>
            <td>{{$item->totalberat}}</td>
            <td>Rp.{{number_format($item->harga, 0,'','.')}}</td>
            <td>Rp.{{number_format($item->totalharga, 0,'','.')}}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot class="bg-secondary">
          <tr>
            <th colspan="2">Total Penjualan Tahun {{\Carbon\Carbon::now()->format('Y')}}</th>
            <th colspan="2">{{$data->sum('totalberat')}}</th>
            <th colspan="2">Rp.{{number_format($data->sum('totalharga', 0,'','.'))}}</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@endcan
<!-- /.row -->
@endsection

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