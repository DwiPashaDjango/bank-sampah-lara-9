@extends('layouts.frontend.app',[
    'title' => 'List Data Transaksi',
])
@section('content')

@if($data_transaksi->count() > 0)
<section class="upcoming-events section-padding-100-0 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>List Data Transaksi</h3>
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
                        <a href="{{ route('data_transaksi.show',$pn->slug) }}" target="_blank" class="btn btn-primary col-lg">Print</a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="pagination justify-content-center">
                {{ $data_transaksi->links() }}
            </div>
        </div>
    </div>
</section>
@endif

@stop