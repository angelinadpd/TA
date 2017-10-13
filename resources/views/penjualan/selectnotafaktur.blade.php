@extends('layouts.app')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<h3 class="box-title" style="margin-left: 10px;">Data Faktur</h3>
				<div class="box-body">
					<form role="form" method="POST" action="{{route('penjualan.pdffaktur')}}">
						<input type="hidden" name="_token" value="{{csrf_token()}}">

						<div class="form-group" style="margin-left: 10px; width: 500px;">
							<select name="note" class="form-control">
								<option>--Pilih Nota--</option>
								@foreach ($penjualan as $penjualan)
							    <option value="{{$penjualan->note}}">{{$penjualan->note}}</option>
							    @endforeach
							</select>
						</div>
						<div style="margin-left: 10px; width: 500px;">
							<input type="text" name="no_faktur" value="" required="" placeholder="No. Faktur">
						</div><br><br>
						<div class="box-footer">
							<button type="submit" class="btn btn-success">Cetak Faktur</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection