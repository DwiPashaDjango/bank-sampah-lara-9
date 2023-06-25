@extends('layouts.backend.app',[
'title' => 'Edit Data Sampah',
'contentTitle' => 'Edit data_sampah'
])

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/summernote') }}/summernote-bs4.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropify') }}/dist/css/dropify.min.css">
@endpush

@section('content')
<div class="">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.data_sampah.index') }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.data_sampah.update',$data_sampah->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="judul">nama sampah</label>
                    <input required="" value="{{ $data_sampah->judul }}" required="" type="" name="judul" id="judul" placeholder="" class="form-control title">
                </div>
                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="file" name="file" class="dropify form-control" data-height="190" data-allowed-file-extensions="png jpg gif jpeg svg webp jfif" required>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="jenis">jenis sampah</label>
                            <input required="" value="{{ $data_sampah->jenis }}" required="" type="" name="jenis" id="jenis" placeholder="" class="form-control title">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="harga">harga/kg</label>
                            <input required="" value="{{ $data_sampah->harga }}" type="price" name="harga" id="harga" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">deskripsi</label>
                    <textarea required="" name="deskripsi" id="deskripsi" class="text-dark form-control summernote">{!! $data_sampah->deskripsi !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
    @stop

    @push('js')
    <script type="text/javascript" src="{{ asset('plugins/summernote') }}/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $(".summernote").summernote({
            height: 500,
            callbacks: {
                // callback for pasting text only (no formatting)
                onPaste: function(e) {
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

        $('.dropify').dropify({
            messages: {
                default: 'Drag atau Drop untuk memilih gambar',
                replace: 'Ganti',
                remove: 'Hapus',
                error: 'error'
            }
        });

        $('.title').keyup(function() {
            var title = $(this).val().toLowerCase().replace(/[&\/\\#^, +()$~%.'":*?<>{}]/g, '-');
            $('.slug').val(title);
        });
    </script>
    @endpush