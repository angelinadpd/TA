@extends('layouts.app')
 
@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Edit Promo</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('promo.index') }}"> Back</a>
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

{{ Form::model($promo, ['method' => 'PATCH','route' => ['promo.update', $promo->id]]) }}
    <p>Jenis Promo</p>
    <input type="text" name="jenis_promo" value="{{$promo->jenis_promo}}" required="" class="form-control">
    {{ ($errors->has('jenis_promo'))? $errors->first('jenis_promo') : '' }}<br>
    
    <p>Tipe Barang</p>
    <select name="barang_id"  class="form-control">
        <option>--Pilih Barang--</option>
        @foreach($barangs as $barang)
        <option value="{{ $barang->id }}"> {{ $barang->tipe_barang }} |  {{ $barang->nama_barang }}</option>
        @endforeach
    </select>
    {{ ($errors->has('barang_id'))? $errors->first('barang_id') : '' }}<br>

    <p>Persenan Discount</p>
    <div class="form-group input-group">
        <input type="text" name="discount_uang" value="{{$promo->discount_uang}}" required="" class="form-control">
        <span class="input-group-addon">%</span>
    </div>
    {{ ($errors->has('discount_uang'))? $errors->first('discount_uang') : '' }}

    <p>Jumlah Barang</p>
    <input type="text" name="discount_barang" value="{{$promo->discount_barang}}" required="" class="form-control">
    {{ ($errors->has('discount_barang'))? $errors->first('discount_barang') : '' }}<br><br><br><br>

	<input type="hidden" name="_method" value="PATCH">	
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<button class="btn btn-success" type="submit" name="submit">Save</button>
{{ Form::close() }}
@endsection