@extends('layouts.app')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<h3 class="box-title" style="margin-left: 10px;">Data Realisasi Pemesanan</h3>
				<div class="box-body">
					<form role="form" method="POST" action="{{route('realisasi.pdf')}}">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="form-group" style="margin-left: 10px; width: 500px;">
							<select name="bulan" class="form-control">
								<option>--Pilih Bulan--</option>
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">Juli</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
						<div class="form-group" style="margin-left: 10px; width: 500px;">
							<select name="tahun" class="form-control">
								<option>--Pilih Tahun--</option>
								<?php $i=2005?>
							    @while($i<2020)
							    <option value="{{$i=$i+1}}">{{$i}}</option>
							    @endwhile
							</select>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-success">Cetak Laporan Realisasi Pemesanan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection