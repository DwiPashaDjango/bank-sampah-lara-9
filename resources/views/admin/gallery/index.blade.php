@extends('layouts.backend.app',[
    'title' => 'Manage Data Sampah',
    'contentTitle' => 'Manage Gallery',
])
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush
@section('content')
<x-alert></x-alert>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary">Save Image</button>
              </div>
          </form>
      </div>
      <div class="col-md-6">
          <h3>Photo</h3>
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Photo Title</th>
                      <th>Price</th>
                      <th>Total Images</th>
                      <th>View Image</th>
                  </tr>
              </thead>
              <tbody>
                  @php $i=1; @endphp
                  @forelse ($gallery as $gallery)
                      <tr>
                          <td>{{$gallery->title}}</td>
                          <td>${{$gallery->price}}</td>
                          <td>{{$gallery->image}}</td>
                          <td>
                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="5" class="text-center">No images yet!</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>
@endsection

@push('js')
<!-- DataTables -->
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#dataTable1").DataTable();
  });
</script>
@endpush