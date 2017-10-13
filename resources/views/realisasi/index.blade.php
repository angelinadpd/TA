@extends('layouts.app')
@section('content')


<div class="row">
 <div class="col-lg-12">
  <h1 class="page-header" align="center">
    Data Realisasi Pemesanan
  </h1>

<div class="table-responsive">
  <table class="table table-bordered table-hover tble-striped">
    <thead>
      <tr>
    		<th>No.</th>
        <th>No.DO</th>
        <th>No.SO</th>
    		<th>Nama Barang</th>
        <th>Tanggal Realisasi</th>
    		<th>Price(Rp)</th>
        <th>Qty</th>
        <th>Status</th>
        <th>Action</th>
    	</tr>
    </thead>
<?php
  $i=0
?>

    @foreach($realisasis as $realisasi)
    <tr>
       <td> {{$i=$i+1}} </td>
       <td> A{{$datenow}}{{ $realisasi->no_do}} </td>
       <td> SO{{ $realisasi->no_so}} </td>
       <td> {{ $realisasi->nama_barang}} </td>
       <td> {{ $realisasi->tgl_realisasi}} </td>
       <td> {{ $realisasi->price}} </td>
       <td> {{ $realisasi->qty}} </td>
       <td> {{ $realisasi->status}} </td>
       <td>
         		<a href="/realisasi/{{$realisasi->id}}/edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>
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
                            <a href="{{route('realisasi.destroy',[$realisasi->id])}}" class="btn btn-danger" id="alertHapus"><i class="glyphicon glyphicon-trash"></i>&nbsp;Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
<!-- End Modals-->
            <a href="/realisasi/{{$realisasi->id}}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i>&nbsp;Detail</a>
        </td>
      </tr>
@endforeach
</tbody>
</table>
          {!! $realisasis->links() !!} 
  </div>  
  </div>
@endsection