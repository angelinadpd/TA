@extends('layouts.app')
@section('content')

<div class="row">
 <div class="col-lg-12">
  <h1 class="page-header" align="center">
    Data Pemesanan Barang
  </h1>
<div class="table-responsive">
  <table class="table table-bordered table-hover tble-striped">
    <thead>
      <tr>
    		<th>No.</th>
    		<th>No. SO</th>
    		<th>Tanggal Pesan</th>
        <th>Tipe Barang</th>
        <th>Nama Barang</th>
        <th>Status</th>
        <th>Action</th>
    	</tr>
    </thead>
<?php
  $i=0
?>
    @foreach($pemesanans as $pemesanan)
    <tr>
       <td> {{$i=$i+1}} </td>
       <td> SO{{ $pemesanan->no_so}} </td>
       <td> {{ $pemesanan->tgl_pesan}} </td>
       <td> {{ $pemesanan->tipe_barang}} </td>
       <td> {{ $pemesanan->nama_barang}} </td>
       <td> {{ $pemesanan->status}} </td>
       <td>
         		<a href="/pemesanan/{{$pemesanan->id}}/edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>
            <!--  Modals-->
            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Hapus
            </button>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Warning</h4>
                        </div>
                        <div class="modal-body">Yakin ingin menghapus data ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <a href="{{route('pemesanan.destroy',[$pemesanan->id])}}" class="btn btn-danger" id="alertHapus"><i class="glyphicon glyphicon-trash"></i>&nbsp;Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
<!-- End Modals--> 
        </td>
      </tr>

@endforeach
</tbody>
</table>
          {!! $pemesanans->links() !!} 
  </div>
  </div>  
@endsection