@extends('layouts.app')

@section('content')

<div class="row">
 <div class="col-lg-12">
  <h1 class="page-header" align="center">
    Data Penjualan
  </h1>

  <div class="col-md-9">
    <div class="form-group">
      <div class="col-md-12">
        <a href="{{route('penjualan.create')}}" class="pull-left btn btn-primary" id="create-barang" style="margin-right: 5px; margin-bottom: 20px">
          <i class="icon-plush icon-white"></i>Tambah Data</a>
      </div>
    </div>
  </div><br><br><br>

<div class="table-responsive">
  <table class="table table-bordered table-hover tble-striped" id="tabelpenjualan">
    <thead>
    	<tr>
        <th>No.</th>
    		<th>Nota</th>
    		<th>Tanggal</th>
    		<th>Nama Pembeli</th>
    		<th>Nama Barang</th>
    		<th>Quantity</th>
        <th>Price</th>
        <th>Amount</th>
        <th>DPP</th>
        <th>PPN</th>
        <th>Action</th>
    	</tr>
      {{ csrf_field() }}
    </thead>

<?php
  $i=0
?>
      @foreach($penjualans as $penjualan)
      <tr class="item{{$penjualan->id}}">
         <td> {{$i=$i+1}} </td>
         <td> PJL{{$datenow}}{{ $penjualan->nota}} </td>
         <td> {{ $penjualan->tgl}} </td>
         <td> {{ $penjualan->nama_pembeli}} </td>
         <td> {{ $penjualan->nama_barang}} </td>
         <td align="center"> {{ $penjualan->qty}} </td>
         <td align="right"> Rp.{{ $penjualan->price}} </td>
         <td align="right"> Rp.{{ $penjualan->amount}} </td>
         <td align="right"> Rp.{{ $penjualan->dpp}} </td>
         <td align="right"> Rp.{{ $penjualan->ppn}} </td>
         <td>
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
                            <a href="{{route('penjualan.destroy',[$penjualan->nota])}}" class="btn btn-danger" id="alertHapus"><i class="glyphicon glyphicon-trash"></i>&nbsp;Hapus</a>
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
  {!! $penjualans->links() !!} 
  </div>
</div> 
</div>
@endsection
