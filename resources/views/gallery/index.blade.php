@extends('layouts.frontend.app',[
    'title' => '    Gallery',
])
@section('content')
<!-- ##### Blog Area Start ##### -->
<section class="blog-area section-padding-100-0 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>GALLERY</h3>
                </div>
            </div>
        </div>

        <div class="row">
            
            @forelse ($gallery as $gallery)
            <tr>
                
                <td>{{$gallery->title}}</td>
                <td>${{$gallery->price}}</td>
                <td>{{$gallery->image->count()}}</td>
                <td>
                    <a href="{{ route('gallery.show',$art->slug) }}" class="btn btn-outline-dark">View</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No image yet!</td>
            </tr>
        @endforelse
            <div class="col-lg pagination pagination-center justify-content-center">
                {{ $gallery->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</section>
@stop