<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Barang;
use App\Pemesanan;
use App\Http\Controller\Controllers;
use Validator;
use Barryvdh\DomPDF\Facade as PDF;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barangs = DB::table('barang')
            ->leftjoin('pemesanan','pemesanan.barang_id','=','barang.id')
            ->select('barang.*','barang.tipe_barang','barang.nama_barang')
            ->orderBy('id', 'desc')
            ->paginate(10);  
        return view('barang.index', ['barangs' => $barangs])
                    ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create()
    {
        return view('barang.create');

    }
    public function store(Request $request)
    {
	    $price = $request->price;
        $ppn = $price*0.1;
        $dpp = $price+$ppn;

        // agar tipe dan nama tidak sama
        $data=Barang::select('*')
                        ->where('tipe_barang',$request->input('tipe_barang'))
                        ->where('nama_barang',$request->input('nama_barang'))
                        ->get();

        $id=$request->input('tipe_barang');
        $count = count($data);
        if ($count==0) {
            $barang = new barang;
            $barang->tipe_barang = $request->input('tipe_barang');
            $barang->nama_barang = $request->input ('nama_barang');
            $barang->price = $request->input ('price');
            $barang->dpp    = $dpp;
            $barang->ppn    = $ppn;
            $barang->stok = $request->input ('stok');
            $barang->save();	        

            return redirect()->route('barang.index')
                        ->with('message','Create barang sukses');
        } elseif ($count==1) {
            $data=DB::table('barang')
                        ->select('*')
                        ->where('tipe_barang',$request->input('tipe_barang'))
                        ->where('nama_barang', $request->input('nama_barang'))
                        ->update([
                            'price' => $request->input('price'),
                            'stok' => $request->input('stok')]);
            return redirect()->route('barang.index')
                        ->with('message','Create barang sukses');
        }
    }

    public function show($id)
    {

    }

    public function edit($barang)
    {
        $barang=barang::where('id',$barang)->first();
        if(!$barang){
            abort(404);
        }
        return view('barang.edit',compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $price = $request->price;
        $ppn = $price*0.1;
        $dpp = $price+$ppn;

        $this->validate($request, [
         'tipe_barang' => 'required',
         'nama_barang' => 'required',
         'price'=> 'required|numeric',
         //'dpp'  => 'required',
         //'ppn'  => 'required',
         'stok' => 'required|numeric',
    ]);
        $barang = barang::where('id', '=',$id);

	    $paramsUpdate = [
		'tipe_barang'   => $request->tipe_barang,
		'nama_barang'   => $request->nama_barang,
		'price'  => $request->price,
		'dpp'    => $dpp,
		'ppn'    => $ppn,
		'stok'   => $request->stok,
	]; 
        $barang->update($paramsUpdate);

        return redirect()->route('barang.index')
        				->with('message','Edit data barang sukses');  
    }

    public function destroy($id)
    {
        $barang = Barang::find($id)->delete();
        //$barang->delete();
        return redirect()->route('barang.index')
                        ->with('message','Hapus data barang sukses');   
    }

// Laporan Stok Barang
    public function getpdftanggal(Request $request){
        $barang= Barang::All();
        $month = $request -> input('bulan');
        $year = $request -> input('tahun');
        // select * from barang where month(created_at) = 10 and year(created_at)=2017 
        // $barang = Barang::whereMonth('created_at',$month)
        //                 ->whereYear('created_at',$years)->get();
        $barang = Barang::where(DB::raw('month(created_at)'),$month)->where(DB::raw('year(created_at)'),$year)->get();
        $barang = Barang::where(DB::raw('year(created_at)'),$year)->get();
        // foreach ($barang as $key => $value) {
        //     echo $value->nama_barang;
        // }
        // dd();
        //return view('barang.pdf',compact('barang','month','year'));
        $pdf = PDF::loadView('barang.pdf',compact('barang','month','year'))
        ->setPaper('a4', 'potrait');
        return $pdf->stream('stokbarang.pdf');
    }

    public function selecttanggal(Request $request){
        return view('barang.laporanstokbarang'); 
    }
}