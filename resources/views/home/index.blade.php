@extends('layouts.frontend.app',[
'title' => 'Home',
])
@section('content')
<!-- ##### Hero Area Start ##### -->
<section class="hero-area bg-img bg-overlay-2by5" style="background-image: url({{ asset('img/bg') }}/bg1.jpg)">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <!-- Hero Content -->
                <div class="hero-content text-center">
                    <h2>Selamat Datang di Bank Sampah</h2>
                    @guest
                    <a href="{{ route('login') }}" class="btn clever-btn">login</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Hero Area End ##### -->

<div class="regular-page-area section-padding-100 mt-5 mb-4">
    <div class="col-lg-9 mx-auto">
        <div class="card">
            <div class="card-header">bank sampah dream</div>
            <div class="card-body">
                <p class="lead">
                    Bank sampah adalah sebuah konsep pengumpulan sampah kering rumah tangga,
                    seperti plastik, kertas, kaleng, dan lain-lain yang menerapkan sistem konversi dari sampah menjadi uang,
                    untuk meningkatkan partisipasi warga dalam memilah dan mendaur ulang sampah.
                    ini merupakan program dari Dinas Lingkungan Hidup yang bertujuan untuk mengurangi volume sampah dari kegiatan rumah tangga dan agar sampah yang didaur ulang dapat memiliki nilai ekonomis.
                </p>
            </div>
        </div>
    </div>
</div>

@if($pengumuman->count() > 0)
<section class="upcoming-events section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>Pengumuman Terbaru</h3>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($pengumuman as $pn)
            <div class="col-12 col-md-6 col-lg-6">
                <div class="single-upcoming-events mb-50 wow fadeInUp" data-wow-delay="250ms">
                    <!-- Events Thumb -->
                    <div class="events-thumb">
                        <img src="{{ asset('img/bg') }}/pengumuman.png" alt="">
                        <h6 class="event-date">{{ $pn->tgl }} | BY : {{ $pn->user->name }}</h6>
                        <h4 class="event-title">{{ $pn->judul }}</h4>
                    </div>
                    <div>
                        <a href="{{ route('pengumuman.show',$pn->slug) }}" class="btn btn-primary col-lg">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <a href="{{ route('pengumuman') }}" class="alert alert-success alert-link mx-auto">Lihat Semua Pengumuman</a>
        </div>
    </div>
</section>
@endif

@if($data_sampah->count() > 0)
<!-- ##### data_sampah ##### -->
<section class="blog-area section-padding-100-0 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>Data Sampah Terbaru</h3>
                </div>
            </div>
        </div>

        <div class="row">

            @foreach($data_sampah as $art)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ $art->judul }}

                        <span class="badge badge-danger float-right">Author : {{ $art->user->name }}</span>
                    </div>

                    <div class="card-body">
                        <img src="{{ asset($art->getThumbnail()) }}" width="100%" style="height: 300px; object-fit: cover; object-position: center;">

                        <a href="{{ route('data_sampah.show',$art->slug) }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-3">
            <a href="{{ route('data_sampah') }}" class="alert alert-success alert-link mx-auto mt-3">Lihat Semua Data Sampah</a>
        </div>
    </div>
</section>
@endif

@if($data_transaksi->count() > 0)
<section class="upcoming-events section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>Data Transaksi Terbaru</h3>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($data_transaksi as $pn)
            <div class="col-12 col-md-6 col-lg-6">
                <div class="single-upcoming-events mb-50 wow fadeInUp" data-wow-delay="250ms">
                    <!-- Events Thumb -->
                    <div class="events-thumb">
                        <img src="{{ asset('img/bg') }}/pengumuman.png" alt="">
                        <h6 class="event-date">{{ $pn->tgl }} | BY : {{ $pn->user->name }}</h6>
                        <h4 class="event-title">{{ $pn->judul }}</h4>
                    </div>
                    <div>
                        <a href="{{ route('data_transaksi.show',$pn->slug) }}" class="btn btn-primary col-lg">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <a href="{{ route('data_transaksi') }}" class="alert alert-success alert-link mx-auto">Lihat Semua Data Transaksi</a>
        </div>
    </div>
</section>
@endif

@if($galeri->count() > 0)
<!-- ##### galeri ##### -->
<section class="blog-area section-padding-100-0 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>galeri foto Terbaru</h3>
                </div>
            </div>
        </div>

        <div class="row">

            @foreach($galeri as $art)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ $art->judul }}

                        <span class="badge badge-danger float-right">Author : {{ $art->user->name }}</span>
                    </div>
                    <h6 class="event-date">{{ $art->tgl }} | BY : {{ $art->user->name }}</h6>

                    <div class="card-body">
                        <img src="{{ asset($art->getImage()) }}">

                        <a href="{{ route('galeri.show',$art->slug) }}" class="btn btn-primary btn-sm">Selengkapnya</a>


                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row mt-3">
        <a href="{{ route('galeri') }}" class="alert alert-success alert-link mx-auto mt-3">Lihat Galeri Foto</a>
    </div>
    </div>
</section>
@endif

@if($gallery->count() > 0)
<!-- ##### gallery ##### -->
<section class="blog-area section-padding-100-0 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>gallery foto Terbaru</h3>
                </div>
            </div>
        </div>

        <div class="row">

            @foreach($gallery as $art)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ $art->title }}

                        <span class="badge badge-danger float-right">Author : {{ $art->user->name }}</span>
                    </div>

                    <div class="card-body">
                        <img src="{{ asset($art->getImage()) }}" width="100%" style="height: 300px; object-fit: cover; object-position: center;">

                        <a href="{{ route('gallery.show',$art->slug) }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-3">
            <a href="{{ route('gallery') }}" class="alert alert-success alert-link mx-auto mt-3">Lihat Semua Data Sampah</a>
        </div>
    </div>
</section>
@endif
@stop