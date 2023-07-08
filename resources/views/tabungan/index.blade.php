@extends('layouts.backend.app',[
'title' => 'Tabungan Nasabah',
'contentTitle' => 'Tabungan Nasabah',
])

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
@endpush

@section('content')
@if (session()->has('message'))
    <div class="alert alert-success">
        {{session()->get('message')}}
    </div>
@endif
@if (session()->has('failed'))
    <div class="alert alert-danger">
        {{session()->get('failed')}}
    </div>
@endif

@can('role', ['guest'])
<div class="row">
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        @if ($saldoUser[0]->total_saldo->count() > 0)
            <h3>Rp {{number_format($saldoUser[0]->total_saldo[0]->total_saldo, 0,'','.')}}</h3>
        @else
             <h3>Rp 0</h3>
        @endif
        <p>Saldo {{Auth::user()->name}}</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill"></i>
      </div>
      {{-- <a href="javascript:void(0)" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
    </div>
  </div>
</div>
@endcan

<div class="card">
    <div class="card-header">
        @can('role', ['guest'])
            <a href="{{route('tabungan.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
        @endcan
        @can('role', ['admin'])
            <a href="{{route('tabungan.cetakAll')}}" class="btn btn-sm btn-danger mr-2"><i class="fas fa-print"></i> Cetak</a>
        @endcan
        <button class="btn btn-primary btn-sm tarik-saldo"><i class="fas fa-money-bill"></i> Tarik Saldo</button>
        <button class="btn btn-warning btn-sm filter-modal"><i class="fas fa-filter"></i> Filter</button>
        <a href="{{url('/tabungan')}}" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i> Refresh</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-hover table-bordered text-center" id="dataTable1">
                <thead class="bg-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Masuk</th>
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
                                <td>{{\Carbon\Carbon::parse($item->tgl_nabung)->format('d-F-Y')}}</td>
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

@can('role', ['admin'])
<div class="card mb-3">
    <div class="card-header">
        <b>Riwayat Penarikan Tunai Nasabah</b>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-bordered table-striped text-center" id="table-riwayat">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>No Resi</th>
                        <th>No Rekening</th>
                        <th>Nama Nasabah</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat_penarikan as $item)
                        <tr>
                            <td>{{$item->kode_withdrawn}}</td>
                            <td>{{$item->user->no_rek}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{\Carbon\Carbon::parse($item->created_at)->translatedFormat('d-F-Y H:i:s')}}</td>
                            <td>{{number_format($item->amount_withdrawn,0,'','.')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcan
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
                    <input type="text" name="saldo" id="saldo" disabled class="form-control @error('saldo') is-invalid @enderror">
                    @error('saldo')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTarikSaldo" tabindex="-1" role="dialog" aria-labelledby="modalTarikSaldoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{url('/admin/saldoUser/tarik')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTarikSaldoLabel">Tarik Saldo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @can('role', ['admin'])
                        <div class="form-group">
                            <label for="">User</label>
                            <select name="users_id" id="users_id" class="form-control @error('users_id') is-inalid @enderror">
                                <option value="">Pilih</option>
                                @foreach ($user as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                                @error('users_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </select>
                        </div>
                        <div id="hidden">
                            <div class="form-group">
                                <label for="" id="label_jumlah_saldo"></label>
                                <input type="text" readonly class="form-control" id="jumlah_saldo">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Saldo Yang Akan di Tarik</label>
                                <input type="text" name="amount_withdrawn" id="amount_withdrawn" class="form-control @error('amount_withdrawn') is-inalid @enderror">
                                @error('amount_withdrawn')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    @endcan
                    @can('role', ['guest'])
                        <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
                        <div class="form-group">
                            <label for="" id="label_jumlah_saldo">Sisa Saldo Anda</label>
                            @if ($saldoUser[0]->total_saldo->count() > 0)
                                <input type="text" readonly class="form-control" value="{{number_format($saldoUser[0]->total_saldo[0]->total_saldo, 0,'','.')}}">
                            @else
                                <input type="text" readonly class="form-control" value="0">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Saldo Yang Akan di Tarik</label>
                            <input type="text" name="amount_withdrawn" id="amount_withdrawn" class="form-control @error('amount_withdrawn') is-inalid @enderror">
                            @error('amount_withdrawn')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    @endcan
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary tarik">Tarik</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{url('/tabungan')}}" method="POST">
            @csrf
            @method("GET")
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Bulan</label>
                        <select name="bulan" class="form-control" required>
                            <option value="">Pilih</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="text" name="tanggal" pattern="\d{2}" maxlength="2" class="form-control" placeholder="Tanggal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endpush

@push('js')
<!-- DataTables -->
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $("#dataTable1").DataTable();
        $('#table-riwayat').DataTable();

        $('.bulan').datepicker({
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

        $('#hidden').hide();

        $('#users_id').change(function(e) {
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '/admin/saldoUser/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#hidden').show();
                    $('#label_jumlah_saldo').html('Jumlah Saldo Awal ' + response[0].user.name);
                    $('#jumlah_saldo').val(response[0].total_saldo);
                },
                error: function(err) {
                    console.log(err);
                }
            })
        });

        $('.tarik-saldo').click(function(e) {
            e.preventDefault();
            $('#modalTarikSaldo').modal('show');
        });

        $('.filter-modal').click(function(e) {
            e.preventDefault();
            $('#filterModal').modal('show');
        });

        $('#amount_withdrawn').on('keyup', function() {
            var rupiah = $(this).val();
            rupiah = formatRupiah(rupiah, 'Rp. ');
            $(this).val(rupiah);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : rupiah ? rupiah : '';
        }
    });
</script>
@endpush
