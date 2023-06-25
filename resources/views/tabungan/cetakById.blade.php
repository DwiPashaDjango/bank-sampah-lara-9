<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cetak Tabungan {{$data->user->name}}</title>
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
            <h3>Cetak Tabungan {{$data->user->name}}</h3>
        </div>
        <table class="table table-bordered table-hover text-center">
            <thead class="bg-info">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jumlah Sampah Keseluruhan (Kg)</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$data->user->name}}</td>
                    <td>{{$data->tgl_nabung}}</td>
                    <td>{{$data->jml_sampah}} Kg</td>
                    <td>Rp.{{$data->debit}}</td>
                    <td>Rp.{{$data->kredit}}</td>
                    <td>Rp.{{$data->saldo}}</td>
                </tr>
            </tbody>
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