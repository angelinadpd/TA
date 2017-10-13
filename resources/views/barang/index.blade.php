@extends('layouts.app')

@section('content')

<div class="row">
 <div class="col-lg-12">
  <h1 class="page-header" align="center">
    Data Barang
  </h1>
    <div class="form-group">
      <div class="col-md-3">
        <a href="{{route('barang.create')}}" class="pull-left btn btn-primary" id="create-barang" style="margin-right: 5px; margin-bottom: 20px">
          <i class="icon-plush icon-white"></i>Tambah Data</a><br><br><br>
      </div>
  </div><br><br><br>
   
  <table class="table table-bordered table-hover tble-striped" id="tabelbarang">
    <thead>
    	<tr>
    		<th>No.</th>
    		<th>Tipe Barang</th>
    		<th>Nama Barang</th>
    		<th>Price</th>
    		<th>DPP</th>
    		<th>PPN</th>
    		<th>Stok Barang</th>
        <th>Action</th>
    	</tr>
      {{ csrf_field() }}
    </thead>
<?php
  $i=0
?>
      @foreach($barangs as $barang)
      <tr class="item{{$barang->id}}">
         <td> {{$i=$i+1}} </td>
         <td> {{ $barang->tipe_barang}} </td>
         <td> {{ $barang->nama_barang}} </td>
         <td> Rp.{{ $barang->price}} </td>
         <td> Rp.{{ $barang->dpp}} </td>
         <td> Rp.{{ $barang->ppn}} </td>
         <td> {{ $barang->stok}} </td>
         <td>
           		<a href="/barang/{{$barang->id}}/edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>
              <a href="{{route('pemesanan.create',[$barang->id])}}" class="btn btn-success" id="alertPesan"><i class="glyphicon glyphicon-troli"></i>&nbsp;Pesan</a>

<!--  Modals-->
            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Hapus
            </button>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Warning !</h4>
                        </div>
                        <div class="modal-body">Yakin ingin menghapus data ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <a href="{{route('barang.destroy',[$barang->id])}}" class="btn btn-danger" id="alertHapus"><i class="glyphicon glyphicon-trash"></i>&nbsp;Hapus</a>
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
  {!! $barangs->links() !!} 
  </div>
</div> 
</div>
@endsection
