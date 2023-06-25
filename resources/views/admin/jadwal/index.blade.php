@extends('layouts.backend.app',[
'title' => 'Jadwal Penjemputan Sampah',
'contentTitle' => 'Jadwal Penjemputan Sampah',
])
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <b>List Jadwal Penjemputan Sampah</b>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-bordered table-hover text-center" id="dataTable1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Penjemputan</th>
                        <th>Jam Penjemputan</th>
                        <th>Jenis Sampah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{\Carbon\Carbon::parse($item->tgl_jemput)->format('d-m-Y')}}</td>
                        <td>{{$item->jam}}</td>
                        <td>{{$item->jenis}}</td>
                        <td>
                            <a href="javascript:void(0)" data-id="{{$item->id}}" class="btn btn-info btn-sm show"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@push('modal')
<div class="modal fade" id="jadwalModal" tabindex="-1" role="dialog" aria-labelledby="jadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jadwalModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Penjemputan</label>
                            <input type="date" name="tgl_jemput" disabled id="tgl_jemput" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jam Penjemputan</label>
                            <input type="time" name="jam" id="jam" disabled class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jenis Sampah</label>
                            <input type="text" name="jenis" id="jenis" disabled class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Berat Sampah</label>
                            <input type="text" name="berat" id="berat" disabled class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" disabled cols="30" rows="5"></textarea>
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

        $('.show').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: '/admin/jadwal/' + id,
                method: 'GET',
                success: function(response) {
                    $('#jadwalModal').modal('show');
                    $('#jadwalModalLabel').html(response.user.name);
                    $('#tgl_jemput').val(response.tgl_jemput);
                    $('#jam').val(response.jam);
                    $('#jenis').val(response.jenis);
                    $('#berat').val(response.berat);
                    $('#alamat').val(response.alamat);
                },
                error: function(err) {
                    console.log(err);
                }
            })
        });
    });
</script>
@endpush