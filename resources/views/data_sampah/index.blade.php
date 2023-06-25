@extends('layouts.frontend.app',[
    'title' => 'List data_sampah',
])
@section('content')
<!-- ##### Blog Area Start ##### -->
<section class="blog-area section-padding-100-0 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>List Data Sampah</h3>
                </div>
            </div>
        </div>

        <div class="row">
            
            @foreach($data_sampah as $art)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            {{ $art->judul }}

                            <span class="badge badge-danger float-right">by : {{ $art->user->name }}</span>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('uploads/img/data_sampah/'.$art->thumbnail) }}" width="100%" style="height: 300px; object-fit: cover; object-position: center;">

                            <div class="card-text mt-3">
                                {!! ($art->deskripsi) !!}
                            </div>

                            <a href="{{ route('data_sampah.show',$art->slug) }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg pagination pagination-center justify-content-center">
                {{ $data_sampah->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</section>
@stop