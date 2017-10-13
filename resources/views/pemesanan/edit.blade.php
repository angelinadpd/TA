@extends('layouts.app')
@section('content')

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Edit Pesan Barang</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('pemesanan.index') }}"> Back</a>
	        </div>
	    </div>
	</div>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

{{ Form::model($pemesanan, ['method' => 'PATCH','route' => ['pemesanan.update', $pemesanan->id]]) }}

	<p>Tanggal Pemesanan</p>
	<input type="date" name="tgl_pesan" value="{{ $pemesanan->tgl_pesan }}" required="" class="form-control"><br>


	<input type="hidden" name="_method" value="PATCH">	
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<button class="btn btn-success" type="submit" name="submit">Save</button>
{{ Form::close() }}
@endsection