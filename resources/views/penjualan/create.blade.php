@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create Penjualan Barang</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('penjualan.index') }}"> Back</a>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Crete Data Penjualan
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('penjualan.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="tgl" id="tgl" placeholder="Tanggal Penjualan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nama_pembeli" id="nama_pembeli" placeholder="Nama Pembeli">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <table class="table table-bordered table-responsive" id="tbdetail">
                            <thead>
                            <tr>
                                <th class="col-md-3">Tipe Barang dan Nama Barang</th>
                                <th class="col-md-3">Price</th>
                                <th class="col-md-3">Quantity</th>
                                <th>Amount</th>
                                <th>
                                    <a href="#" class="btn btn-flat tambah"><i class="fa fa-plus"></i></a>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="tbody">
                            <tr>
                                <td>
                                    <select name="barang[]" required="" class="form-control" >
                                        <option>--Pilih Barang--</option>
                                        @foreach($barangs as $barang)
                                        <option value="{{$barang->id}}"> {{ $barang->tipe_barang }} | {{ $barang->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td id="price">
                                    <input type="text" class="form-control price" id="price" name="price[]" readonly="">
                                </td>
                                <td>
                                    <input type="text" class="form-control qty" name="qty[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control amount" name="amount[]" style="text-align: right">
                                </td>
                                <td>
                                    <a class="btn btn-danger hapus" href="#">X</a>
                                </td>
                            </tr>
                            <tr id="row1" style="border:none">
                                <td colspan="3" style="text-align: right;border:none"><b>Total:</b></td>
                                <td style="border:none;text-align: right"><b class="total"></b></td>
                                <td style="border:none"></td>                                
                            </tr>
                            </tbody>
                        </table>
                        <br><br><br><br><br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button class="btn btn-success" type="submit" name="submit">Post</button>
    <button class="btn btn-warning" type="reset" name="reset">Reset</button>

@endsection
<script src="/vendors/js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click','.tambah',function () {
            var table = document.getElementById('tbdetail');
            var row1 = document.getElementById('row1');
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            cell1.innerHTML ='<select name="barang[]" required="" class="form-control" >'+
                                '<option>--Pilih Barang--</option>'+
                                '@foreach($barangs as $barang)'+
                                '<option value="{{$barang->id}}">'+
                                '{{ $barang->tipe_barang }}'+
                                '|'+
                                '{{ $barang->nama_barang }}</option>'+
                                '@endforeach'+
                            '</select>'; 
            cell2.innerHTML = '<input type="text" class="form-control price" id="price" name="price[]" readonly="">';
            cell3.innerHTML = '<input type="text" class="form-control qty" name="qty[]">';
            cell4.innerHTML = '<input type="text" class="form-control amount" name="amount[]" style="text-align: right">';
            cell5.innerHTML = '<a class="btn btn-danger" href="#">X</a>';
            row1.before(row);
        });
        $('.tbody').delegate('.barang','change',function () {
            var tr = $(this).parent().parent();
            var idbarang = tr.find('.barang').val();
            $.ajax({
                type:'get',
                url:'{!! URL::to('/data-price') !!}',
                data:{'id':idbarang},
                success:function (data) {
                    for(i=0;i<data.length;i++)
                    {
                        if(data[i].id==idbarang)
                        {
                            tr.find('.price').val(data[i].price);
                            tr.find('.barang_id').val(data[i].barang_id);
                            console.log(data[i].barang_id);
                        }
                    }
                }
            });
            tr.find('.price').val('');
            tr.find('.amount').val('');
            $('.total').html('');
        });
    //     $('.tbody').delegate('.jumlah','keyup', function () {
    //         var tr = $(this).parent().parent();
    //         var harga = tr.find('.harga').val();
    //         var jumlah = tr.find('.jumlah').val();
    //         var hasil = jumlah*harga;
    //         tr.find('.subtotal').val(hasil);
    //         console.log(jumlah);
    //         total();
    //     });
    //     function total() {
    //         var total = 0;
    //         $('.subtotal').each(function () {
    //             var stotal = $(this).val()-0;
    //             total +=stotal;
    //         });
    //         $('.total').html('Rp '+total);
    //     }
    // });
</script>