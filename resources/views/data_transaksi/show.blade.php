<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *Must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title>BankSampah | {{ $title ?? '' }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('templates/frontend/clever') }}/img/core-img/favicon.ico">
    
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ asset('templates/frontend/clever') }}/style.css">
        @stack('css')
    </head>
    
    <body>
@section('content')
<div class="blog-details bg-img d-flex align-items-center justify-content-center">
        <div class="text-center">

    </div>
</div>
<!-- ##### Catagory Area End ##### -->

<!-- ##### Blog Details Content ##### -->
<div class="blog-details-content section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <!-- Blog Details Text -->
                <div class="blog-details-text">
                    <div class="text-center">
                        <h3>Data Transaksi</h3>
                        <h3>Bank Sampah Dream</h3>
                    </div>
                    <br/>
                    <div class="text-right">
                        <p>petugas : {!! $data_transaksi->petugas !!}</p>
                    </div>
                    <br/>
                    <p>judul : {!! $data_transaksi->judul !!}</p>
                    <p>tanggal : {!! $data_transaksi->tgl !!}</p>
                    <p>jam : {!! $data_transaksi->jam !!}</p>
                    <p>berat : {!! $data_transaksi->berat !!}kg</p>
                    <p>total berat : {!! $data_transaksi->totalberat !!}kg</p>
                    <p>harga : Rp.{!! $data_transaksi->harga !!}/kg</p>
                    <p>total harga : Rp.{!! $data_transaksi->totalharga !!}</p>
                    <p>deskripsi : <strong>{!! $data_transaksi->deskripsi !!}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@yield('content')


<!-- ##### All Javascript Script ##### -->
<!-- jQuery-2.2.4 js -->
<script src="{{ asset('templates/frontend/clever') }}/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="{{ asset('templates/frontend/clever') }}/js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="{{ asset('templates/frontend/clever') }}/js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="{{ asset('templates/frontend/clever') }}/js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="{{ asset('templates/frontend/clever') }}/js/active.js"></script>
@stack('js')
</body>
</html>