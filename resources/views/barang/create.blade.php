@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create Barang</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('barang.index') }}"> Back</a>
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
 
{{ Form::open(array('route' => 'barang.store','method'=>'POST')) }}
    <p>Tipe Barang</p>
    <input type="text" name="tipe_barang" value="" required="" class="form-control">
    {{ ($errors->has('tipe_barang'))? $errors->first('tipe_barang') : '' }}<br>
    
    <p>Nama Barang</p>
    <input type="text" name="nama_barang" value="" required="" class="form-control">
    {{ ($errors->has('nama_barang'))? $errors->first('nama_barang') : '' }}<br>

    <p>Price</p>
    <div class="form-group input-group">
        <span class="input-group-addon">Rp</span>
        <input type="text" name="price" value="" required="" class="form-control">
        <span class="input-group-addon">.00</span>
    </div>
    {{ ($errors->has('price'))? $errors->first('price') : '' }}

    <p>Stok</p>
    <input type="text" name="stok" value="" required="" class="form-control">
    {{ ($errors->has('stok'))? $errors->first('stok') : '' }}<br><br>


    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button class="btn btn-success" type="submit" name="submit">Post</button>
    <button class="btn btn-warning" type="reset" name="reset">Reset</button>
{{ Form::close() }}


@endsection