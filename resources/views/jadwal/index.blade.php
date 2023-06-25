@extends('layouts.backend.app',[
'title' => 'Jadwal Penjemputan Sampah',
'contentTitle' => 'Jadwal Penjemputan Sampah',
])

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
@endpush

@section('content')
<div class="msg">

</div>
<div class="card">
    <div class="card-header">
        <b>Form Jadwal Penjemputan Sampah</b>
    </div>
    <div class="card-body">
        <form action="#" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Penjemputan</label>
                        <input type="date" name="tgl_jemput" id="tgl_jemput" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jam Penjemputan</label>
                        <input type="time" name="jam" id="jam" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jenis Sampah</label>
                        <input type="text" name="jenis" id="jenis" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Berat Sampah</label>
                        <input type="text" name="berat" id="berat" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5"></textarea>
            </div>
            <div class="btn-send">
                <button id="save" class="btn btn-primary float-right">Kirim</button>
            </div>
        </form>
    </div>
</div>
@stop

@push('js')
<!-- DataTables -->
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
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

        $('#save').click(function(e) {
            e.preventDefault();
            let tgl_jemput = $('#tgl_jemput').val();
            let jam = $('#jam').val();
            let jenis = $('#jenis').val();
            let berat = $('#berat').val();
            let alamat = $('#alamat').val();

            $.ajax({
                url: '/jadwal',
                method: 'POST',
                data: {
                    tgl_jemput: tgl_jemput,
                    jam: jam,
                    jenis: jenis,
                    berat: berat,
                    alamat: alamat
                },
                success: function(response) {
                    if (response.errors) {
                        $.each(response.errors, function(key, val) {
                            $('.msg').html(`<div class="alert alert-danger">
                                                <ul>
                                                    <li>${val}</li>
                                                </ul>
                                            </div>`);
                        });
                    } else {
                        let timerInterval
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil.',
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
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        });
    });
</script>
@endpush