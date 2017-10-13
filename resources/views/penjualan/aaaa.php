@extends('layouts.layouts')

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
                                        @foreach($barang as $barang)
                                        <option value="{{$barang->id}}"> {{ $barang->tipe_barang }} | {{ $barang->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td id="price">
                                    <input type="text" class="form-control price" id="price" name="price[]" readonly="">
                                </td>
                                <td>
                                    <input type="text" class="form-control qty" name="jumlah[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control amount" name="amount[]" style="text-align: right">
                                    <input type="hidden" name="amount[]" readonly="">
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
    <!-- discount -->
 <div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Discount Uang
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <div class="form-group">
                            <p>Persenan</p>
                            <div class="form-group input-group">
                                <input type="text" name="persenan" value="" class="form-control">
                                <span class="input-group-addon">%</span>
                            </div>
                            {{ ($errors->has('persenan'))? $errors->first('persenan') : '' }}
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>

  <div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Discount Barang
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <div class="form-group">
                            <p>Tipe Barang</p>
                            <select name="barang_id"  class="form-control">
                                <option>--Pilih Barang--</option>
                                @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}"> {{ $barang->tipe_barang }} |  {{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                            {{ ($errors->has('barang_id')) ? $errors->first('barang_id') : '' }}<br>

                            <p>Jumlah Barang</p>
                            <input type="text" name="discount_qty" value="" class="form-control">
                            {{ ($errors->has('discount_qty')) ? $errors->first('discount_qty') : '' }}<br>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button class="btn btn-success" type="submit" name="submit">Post</button>
    <button class="btn btn-warning" type="reset" name="reset">Reset</button>
                    </form>

@endsection
<script src="{{ asset('assets/plugins/jquery-1.10.2.js')}}"></script>
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
            cell1.innerHTML = '<select class="form-control barang" name="barang[]">'+
                '<option value="0" selected disabled>- Pilihan -</option>'+
                '@forelse($harga as $itemHarga)'+
                '<option value="{{ $itemHarga->id }}">'+
                    '{{ $itemHarga->nama_barang }} '+
                        '-'+
                    ' {{ $itemHarga->nama_satuan }}'+
                '</option>'+
                '@empty'+

                '@endforelse';
            cell2.innerHTML = '<input type="text" class="form-control harga" id="harga" name="harga[]">';
            cell3.innerHTML = '<input type="text" class="form-control jumlah" name="jumlah[]">';
            cell4.innerHTML = '<input type="text" class="form-control subtotal" name="subtotal[]" style="text-align:right">'+
                '<input type="hidden" name="industri_id[]" class="industri_id">';
            cell5.innerHTML = '<a class="btn btn-danger" href="#">X</a>';
            row1.before(row);
        });
        $('.tbody').delegate('.barang','change',function () {
            var tr = $(this).parent().parent();
            var idbarang = tr.find('.barang').val();
            $.ajax({
                type:'get',
                url:'{!! URL::to('/data-harga') !!}',
                data:{'id':idbarang},
                success:function (data) {
                    for(i=0;i<data.length;i++)
                    {
                        if(data[i].id==idbarang)
                        {
                            tr.find('.harga').val(data[i].harga_toko);
                            tr.find('.industri_id').val(data[i].industri_id);
                            console.log(data[i].industri_id);
                        }
                    }
                }
            });
            tr.find('.jumlah').val('');
            tr.find('.subtotal').val('');
            $('.total').html('');
        });
        $('.tbody').delegate('.jumlah','keyup', function () {
            var tr = $(this).parent().parent();
            var harga = tr.find('.harga').val();
            var jumlah = tr.find('.jumlah').val();
            var hasil = jumlah*harga;
            tr.find('.subtotal').val(hasil);
            console.log(jumlah);
            total();
        });
        function total() {
            var total = 0;
            $('.subtotal').each(function () {
                var stotal = $(this).val()-0;
                total +=stotal;
            });
            $('.total').html('Rp '+total);
        }
    });
</script>



==================================================================
 public function add(Request $request){     
        $hitung = count($request->get('price'));
        // echo $hitung;
        // dd();

        $data = array();
        $i=0;
              
        while($i<$hitung){
            $id[$i] = $request->get('barang')[$i];
            $price = Barang::where('id',$request->input('id'))->value('price');
            $jual = new Penjualan();

            $jual->nota = $request->get('nota');
            $jual->tgl = $request->get('tgl');
            $jual->nama_pembeli = $request->get('nama_pembeli');
            $jual->barang_id = $id[$i];
            $jual->qty = $request->get('jumlah')[$i];
            $jual->price = $price[$i];
            $jual->amount = (int)$jual->qty * (double)$jual->price; //hasil qty*harga

            $data[$i]=$jual->amount;
            $jual->dpp = $jual->amount*0.1;
            $jual->ppn = $jual->amount+$jual->ppn;
            

            $jual->save();

            // Update stok
            $stokawal = Barang::where('id',$id[$i])->value('stok');
            $barangs = Barang::find($id[$i]);
            $barangs->stok = $stokawal - $request->get('jumlah')[$i];
            $barangs->save();
            $i=$i+1;
        }
            //Masukkan nilai total
            $total1=array_sum($data);
            $diskon = $total1 * $request->get('discount_uang');

                $total = new Total;
                $total->nota = $jual->nota;
                $total->total = $total1 - $diskon;
                $total->barang_id = $request->get('barang_id');
                $total->discount_qty = $request->get('discount_qty');
                $total->discount_uang =  $diskon;  
                $total->save();

            if($request->get('barang_id')!=null and $request->get('discount_qty')){
                $stokawal = Barang::where('id',$request->get('barang_id'))->value('stok');
                $barang = Barang::find($request->get('barang_id'));
                $barang->stok = $stokawal - $request->get('discount_qty'); 
                $barang->save();
            }
    }


==============================================================================================
$barang=DB::table('barang')->get();
        $barangs=DB::table('barang')->get();
        return view('penjualan.create',compact('barang','barangs'));


=========================================================================
$penjualan = new Penjualan();
        $penjualan->add($request);

        return redirect()->route('penjualan.index')
                        ->with('message','Create penjualan sukses');