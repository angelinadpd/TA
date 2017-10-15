@extends('layouts.app')

@section('content')

<div class="row">
 <div class="col-lg-12">
  <h1 class="page-header" align="center">
    Data Promo
  </h1>
    <div class="form-group">
      <div class="col-md-3">
        <a href="{{route('promo.create')}}" class="pull-left btn btn-primary" id="create-promo" style="margin-right: 5px; margin-bottom: 20px">
          <i class="icon-plush icon-white"></i>Tambah Data</a><br><br><br>
      </div>
  </div><br><br><br>
   
  <table class="table table-bordered table-hover tble-striped" id="tabelpromo">
    <thead>
    	<tr>
    		<th>No.</th>
    		<th>Jenis Promo</th>
    		<th>Tipe Barang</th>
    		<th>Nama Barang</th>
    		<th>Persenan Discount</th>
    		<th>Jumlah Barang</th>
        <th>Action</th>
    	</tr>
      {{ csrf_field() }}
    </thead>
<?php
  $i=0
?>
      @foreach($promos as $promo)
      <tr class="item{{$promo->id}}">
         <td> {{$i=$i+1}} </td>
         <td> {{ $promo->jenis_promo}} </td>
         <td> {{ $promo->tipe_barang}} </td>
         <td> {{ $promo->nama_barang}} </td>
         <td align="right"> Rp.{{ $promo->discount_uang}} </td>
         <td align="center"> {{ $promo->discount_barang}} </td>
         <td>
           		<a href="/promo/{{$promo->id}}/edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>

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
                            <a href="{{route('promo.destroy',[$promo->id])}}" class="btn btn-danger" id="alertHapus"><i class="glyphicon glyphicon-trash"></i>&nbsp;Hapus</a>
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
  {!! $promos->links() !!} 
  </div>
</div> 
</div>
@endsection
