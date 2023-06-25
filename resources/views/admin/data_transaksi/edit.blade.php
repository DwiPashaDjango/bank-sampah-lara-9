@extends('layouts.backend.app',[
    'title' => 'Edit Data Transaksi',
    'contentTitle' => 'Edit data_transaksi'
])

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/summernote') }}/summernote-bs4.min.css">
@endpush

@section('content')
<div class="">    
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.data_transaksi.index') }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.data_transaksi.update',$data_transaksi->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="petugas">petugas</label>
                <input required="" value="{{ $data_transaksi->petugas }}" required="" type="" name="petugas" id="petugas" placeholder="" class="form-control title"> 
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input required="" value="{{ $data_transaksi->judul }}" required="" type="" name="judul" id="judul" placeholder="" class="form-control title"> 
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tgl">Tanggal</label>
                        <input required="" value="{{ $data_transaksi->tgl }}" type="date" name="tgl" id="tgl" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="jam">jam</label>
                        <input required="" value="{{ $data_transaksi->jam }}" type="time" name="jam" id="jam" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="berat">berat</label>
                        <input required="" value="{{ $data_transaksi->berat }}" type="weight" name="berat" id="berat" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="totalberat">total berat</label>
                            <input required="" value="{{ $data_transaksi->totalberat }}" type="weight" name="totalberat" id="totalberat" class="form-control">
                        </div>
                    </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="harga">harga</label>
                        <input required="" value="{{ $data_transaksi->harga }}" type="price" name="harga" id="harga" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="totalharga">total harga</label>
                    <input required="" value="{{ $data_transaksi->totalharga }}" type="price" name="totalharga" id="totalharga" class="form-control">
                </div>
            </div>
        </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea required="" name="deskripsi" id="deskripsi" class="text-dark form-control summernote">{!! $data_transaksi->deskripsi !!}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>    
            </div> 
        </div>
        </form>
    </div>
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
</script>
@endpush