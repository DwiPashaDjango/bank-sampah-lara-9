@extends('layouts.backend.app',[
'title' => 'Pendaftaran Nasabah',
'contentTitle' => 'Pendaftaran Nasabah',
])

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <b>Daftar Pendaftaran Nasabah</b>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-bordered table-hover text-center" id="dataTable1">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nik</th>
                        <th>TTL</th>
                        <th>No Telephone</th>
                        <th>No Rekening</th>
                        <th>Pekerjaan</th>
                        <th>Umur</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->nik}}</td>
                        <td>{{$item->tmp_lahir}}, {{\Carbon\Carbon::parse($item->tgl_lahir)->format('d-m-Y')}}</td>
                        <td>0{{$item->telp}}</td>
                        <td>{{$item->no_rek}}</td>
                        <td>{{$item->pekerjaan}}</td>
                        <td>{{$item->umur}}</td>
                        <td>
                            @if ($item->status == 'lock')
                            <span class="badge bg-warning p-2">Not Validate</span>
                            @else
                            <span class="badge bg-success p-2">Validate</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm validate" data-id="{{$item->id}}"><i class="fas fa-check"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@push('js')
<!-- DataTables -->
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $("#dataTable1").DataTable();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.validate').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: '/admin/pendaftaran/' + id,
                method: 'PUT',
                success: function(response) {
                    console.log(response);
                    let timerInterval
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        html: 'I will close in <b></b> milliseconds.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                            window.location.reload();
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer');
                            window.location.reload();
                        }
                    })
                },
                error: function(err) {
                    console.log(err);
                }
            })
        });
    });
</script>
@endpush