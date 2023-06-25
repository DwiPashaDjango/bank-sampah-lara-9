@extends('layouts.backend.app',[
    'title' => 'Tambah gallery',
    'contentTitle' => 'Tambah gallery'
])

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/summernote') }}/summernote-bs4.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropify') }}/dist/css/dropify.min.css">
@endpush


@section('content')
<div class="">    
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.gallery.store') }}">
            @csrf
    <div class="col-md-5">
        <h3>Add a image</h3>
        <form action="/add-image" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="mt-4" >Photo Title:</label>
                <input 
                    type="text" 
                    class="form-control @error('title') is-invalid @enderror " 
                    name="title" 
                    placeholder="Enter image title"
                >
                <span class="text-danger">
                    @error('title')
                        {{$message}}
                    @enderror
                </span>

            </div>
            <div class="form-group">
                <label for="price" class="mt-4">Photo Price:</label>
                <input 
                    type="number"
                    step="any"
                    min="1" 
                    class="form-control @error('price') is-invalid @enderror " 
                    name="price" 
                    placeholder="Enter photo price"
                >
                <span class="text-danger">
                    @error('price')
                        {{$message}}
                    @enderror
                </span>

            </div>
            <div class="form-group">
                <label for="files" class="form-label mt-4">Upload Photo Images:</label>
                <input 
                    type="file" 
                    name="image[]"
                    class="form-control" 
                    accept="image/*"
                    multiple
                >
            </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Save Product</button>
        </div>
    </form>
</div>
@stop
            

@push('js')
<script type="text/javascript" src="{{ asset('plugins/summernote') }}/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(".summernote").summernote({
        height:500,
        callbacks: {
        // callback for pasting text only (no formatting)
            onPaste: function (e) {
              var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
              e.preventDefault();
              bufferText = bufferText.replace(/\r?\n/g, '<br>');
              document.execCommand('insertHtml', false, bufferText);
            }
        }
    })

    $(".summernote").on("summernote.enter", function(we, e) {
        $(this).summernote("pasteHTML", "<br><br>");
        e.preventDefault();
    });

    $(".summernote").on("summernote.enter", function(we, e) {
        $(this).summernote("pasteHTML", "<br><br>");
        e.preventDefault();
    });

    $('.dropify').dropify({
        messages: {
            default: 'Drag atau Drop untuk memilih gambar',
            replace: 'Ganti',
            remove:  'Hapus',
            error:   'error'
        }
    });

    $('.title').keyup(function(){
        var title = $(this).val().toLowerCase().replace(/[&\/\\#^, +()$~%.'":*?<>{}]/g,'-');
        $('.slug').val(title);
    });
</script>
@endpush