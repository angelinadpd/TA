@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Detail Realisasi</h4></div>
				<div class="panel-body">
					<div class="panel-body">
						<a href="{{route ('realisasi.edit', $realisasi->id)}}" class="btn btn-success">Edit</a>
						<a href="{{route ('realisasi.index')}}" class="btn btn-success">Back</a><br><br>
					</div>
					<table>
						<tr>
							<td>ID Reaslisasi</td>
							<td></td>
							<td></td>
							<td>: {{$realisasi->id}}</td>
						</tr>
						<tr>
							<td>No. DO</td>
							<td></td>
							<td></td>
							<td>: A{{$datenow}}{{$realisasi->no_do}}</td>
						</tr>
						<tr>
							<td>No. SO</td>
							<td></td>
							<td></td>
							<td>: SO{{$realisasi->no_so}}</td>
						</tr>
						<tr>
							<td>Tanggal Pesan</td>
							<td></td>
							<td></td>
							<td>: {{$realisasi->tgl_pesan}}</td>
						</tr>
						<tr>
							<td>Tipe Barang</td>
							<td></td>
							<td></td>
							<td>: {{$realisasi->tipe_barang}}</td>
						</tr>
						<tr>
							<td>Nama Barang</td>
							<td></td>
							<td></td>
							<td>: {{$realisasi->nama_barang}}</td>
						</tr>
						<tr>
							<td>Tanggal Realisasi</td>
							<td></td>
							<td> </td>
							<td>: {{$realisasi->tgl_realisasi}}</td>
						</tr>
						<tr>
							<td>Price</td>
							<td> </td>
							<td> </td>
							<td>: {{$realisasi->price}}</td>
						</tr>
						<tr>
							<td>Quantity</td>
							<td> </td>
							<td> </td>
							<td>: {{$realisasi->qty}}</td>
						</tr>
						<tr>
							<td>Total</td>
							<td> </td>
							<td> </td>
							<td>: {{$realisasi->total}}</td>
						</tr>
						<tr>
							<td width="20%">Status</td>
							<td width="5%"></td>
							<td width="5%"> </td>
							<td width="70%">: {{$realisasi->status}}</td>
						</tr>
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection