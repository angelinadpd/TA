@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create Pemesanan Barang</h2>
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
 
{{ Form::open(array('route' => 'pemesanan.store','method'=>'POST')) }}
	<input type="hidden" name="barang_id" value="{{$barang->id}}">
	<p>Tanggal Pemesanan</p>
	<input type="date" name="tgl_pesan" value="" required="" class="form-control">
	{{ ($errors->has('tgl_pesan')) ? $errors->first('tgl_pesan') : '' }}<br>

    <p>Tipe Barang</p>
    <input type="text" name="tipe_barang" value="{{ $barang->tipe_barang }}" required="" class="form-control" readonly="">
    {{ ($errors->has('tipe_barang')) ? $errors->first('tipe_barang') : '' }}<br>

    <p>Nama Barang</p>
    <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" required="" class="form-control" readonly="">
    {{ ($errors->has('nama_barang')) ? $errors->first('nama_barang') : '' }}<br>

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<button class="btn btn-success" type="submit" name="submit">Post</button>
    <button class="btn btn-warning" type="reset" name="reset">Reset</button>
{{ Form::close() }}
@endsection