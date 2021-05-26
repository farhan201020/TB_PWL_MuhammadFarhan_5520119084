@extends('adminlte::page')

@section('title', 'Laporan Masuk')

@section('content_header')
<h1 class="text-center text-bold">Laporan Masuk</h1>
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          {{ __('Laporan Masuk') }}

          

        </div>
        <div class="card-body">
          <div class="btn-group mb-5" role="group" aria-label="Basis Example">
            
          </div>
          <a href="{{route('admin.print.laporan')}}" target="_blank" class="btn btn-secondary mb-5"><i class="fa fa-print"></i>LAPORAN MASUK PDF</a>
          <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>FOTO</th>
                <th>NAMA</th>
                <th>KATEGORI</th>
                <th>MEREK</th>
                <th>HARGA</th>
                <th>STOK</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach($barang as $key)
              <tr>
                <td>{{$no++}}</td>
                <td>
                  @if($key->photo !== null)
                  <img src="{{ asset('storage/photo_barang/'.$key->photo) }}" width="100px" />
                  @else
                  [Picture Not Found]
                  @endif
                </td>
                <td>{{$key->name}}</td>
                <td>{{$key->view_kategori->name}}</td>
                <td>{{$key->view_merek->name}}</td>
                <td>{{$key->harga}}</td>
                <td>{{$key->stok}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop