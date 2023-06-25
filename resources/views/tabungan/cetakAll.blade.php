<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cetak Tabungan</title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed" onload="window.print()">
    <div class="container-fluid mt-5">
        <div class="text-center">
            <h3>Cetak Tabungan</h3>
        </div>
        <table class="table table-bordered table-hover text-center">
            <thead class="bg-info">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jumlah Sampah Keseluruhan (Kg)</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_nabung)->format('d-m-Y')}}</td>
                    <td>{{$item->jml_sampah}} Kg</td>
                    <td>Rp.{{number_format($item->debit, 0,'','.')}}</td>
                    <td>Rp.{{number_format($item->kredit, 0,'','.')}}</td>
                    <td>Rp.{{number_format($item->saldo, 0,'','.')}}</td>
                </tr>
                @empty
                <tr>
                    <th colspan="7">Tidak Ada Data Di Dalam Tabungan</th>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Saldo Tabungan</th>
                    <th colspan="3">Rp.{{number_format($data->sum('saldo', 0,'','.'))}}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- chart -->
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/dist/js/adminlte.js"></script>
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/dist/js/demo.js"></script>
    @stack('js')
</body>

</html>