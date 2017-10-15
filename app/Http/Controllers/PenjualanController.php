<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Penjualan;
use App\Barang;
use App\Promo;
use App\Total;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $penjualans = DB::table('penjualan')
            ->leftjoin('barang', 'penjualan.barang_id','=','barang.id')
            ->leftjoin('total', 'penjualan.nota','=','total.nota')
            ->join('promo','penjualan.promo_id','=','promo.id')
            ->select('penjualan.*','barang.tipe_barang','barang.nama_barang')
            ->orderBy('id', 'desc')
            ->paginate(10);  

        $datenow = date('Ymd');
        return view('penjualan.index',compact('penjualans','datenow'))
                    ->with('i', ($request->input('page', 1) - 1) * 5);  
    }

    public function create()
    {    
        $barangs=Barang::All();
        $promos=Promo::All();
        return view('penjualan.create',compact('barangs','promos'));
    }

    public function store(Request $request)
    {  
        $hitung = count($request->get('price'));
        $datenow = date('Ymd');
        $nota = $datenow.$request->get('nota');
        // echo $hitung;
        // dd();

        $data = array();
        $i=0;
              
        while($i<$hitung){
            $id[$i] = $request->get('barang')[$i];
            $price = Barang::where('id',$request->input('id'))->value('price');
            $jual = new Penjualan();

            $jual->nota = $nota;
            $jual->tgl = $request->get('tgl');
            $jual->nama_pembeli = $request->get('nama_pembeli');
            $jual->barang_id = $id[$i];
            $jual->qty = $request->get('qty')[$i];
            $jual->price = $request->get('price')[$i];
            $jual->amount = $request->get('amount')[$i]; //hasil qty*harga
            $jual->dpp = $jual->amount*0.1;
            $jual->ppn = $jual->amount+$jual->ppn;
            $jual->promo_id = $request->get('promo_id');
            
            $data[$i]=$jual->amount;

            $jual->save();

            // Update stok Penjualan
            $stokawal = Barang::where('id',$id[$i])->value('stok');
            $barangs = Barang::find($id[$i]);
            $barangs->stok = $stokawal - $request->get('qty')[$i];
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

        // Update Stok Discount
        if($request->get('barang_id')!=null and $request->get('discount_qty')){
            $stokawal = Barang::where('id',$request->get('barang_id'))->value('stok');
            $barang = Barang::find($request->get('barang_id'));
            $barang->stok = $stokawal - $request->get('discount_qty'); 
            $barang->save();


        }


        return redirect()->route('penjualan.index')
                        ->with('message','Create penjualan sukses');
    }

    public function show($id)
    {
        $penjualan=Penjualan::find($id);
        if (!$penjualan) {
            abort(403);
        }
        return view('penjualan.show',compact('penjualan'    )); 
    }


    public function destroy($nota)
    {
        $penjualan = Penjualan::where('nota',$nota)->delete();
        $total = Total::where('nota',$nota)->delete();

        return redirect()->route('penjualan.index',compact('penjualan','total'))
                        ->with('message','Hapus data penjualan sukses');
    }

    public function dataHarga(){
        return Barang::get();
    }

    // Laporan Penjualan
    public function getpdftanggal(Request $request){
        $penjualan= Penjualan::All();
        $month = $request -> input('bulan');
        $year = $request -> input('tahun');

        // Menampilkan total perbulan
        $tprice= Penjualan::select(DB::raw('sum(price) as tprice'))->where(DB::raw('month(created_at)'),$month)->where(DB::raw('year(created_at)'),$year)->value('tprice');
        $tamount= Penjualan::select(DB::raw('sum(amount) as tamount'))->where(DB::raw('month(created_at)'),$month)->where(DB::raw('year(created_at)'),$year)->value('tamount');
        $tdpp= Penjualan::select(DB::raw('sum(dpp) as tdpp'))->where(DB::raw('month(created_at)'),$month)->where(DB::raw('year(created_at)'),$year)->value('tdpp');
        $tppn= Penjualan::select(DB::raw('sum(ppn) as tppn'))->where(DB::raw('month(created_at)'),$month)->where(DB::raw('year(created_at)'),$year)->value('tppn');

        // Menampilkan total perbulan
        $tprice= Penjualan::select(DB::raw('sum(price) as tprice'))->where(DB::raw('year(created_at)'),$year)->value('tprice');
        $tamount= Penjualan::select(DB::raw('sum(amount) as tamount'))->where(DB::raw('year(created_at)'),$year)->value('tamount');
        $tdpp= Penjualan::select(DB::raw('sum(dpp) as tdpp'))->where(DB::raw('year(created_at)'),$year)->value('tdpp');
        $tppn= Penjualan::select(DB::raw('sum(ppn) as tppn'))->where(DB::raw('year(created_at)'),$year)->value('tppn');

        // Menampilkan Laporan
        $penjualan = Penjualan::where(DB::raw('month(tgl)'),$month)->where(DB::raw('year(tgl)'),$year)->get();
        $penjualan = Penjualan::where(DB::raw('year(tgl)'),$year)->get();

        $pdf = PDF::loadView('penjualan.pdf',compact('penjualan','month','year','tprice','tamount','tdpp','tppn'))
        ->setPaper('a4', 'potrait');
        return $pdf->stream('penjualan.pdf');
    }

    public function selecttanggal(Request $request){
        return view('penjualan.laporanpenjualan',compact('penjualan')); 
    }


// Cetak Faktur
    public function pdffaktur(Request $request){
        $penjualan = Penjualan::where('nota',$request->input('note'))->get();
        $note = $request->input('note');
        $nama = Penjualan::where('nota',$request->input('note'))->value('nama_pembeli');
        $tgl = date('d-M-Y');
        $operator = $request->user()->name ;
        $no_faktur = $request->input('no_faktur');
        $tglnow = date('dmY');
        $terbilang = new Penjualan();


        $total = Total::where('nota',$note)->value('total');
        $discount = Total::where('nota',$note)->first();
        if($discount->discount_uang == Null){
            $diskon = $discount->discount_barang.$discount->discount_qty;
        }else{
            $diskon = $discount->discount_uang;
        }

        $pdf = PDF::loadView('penjualan.pdffaktur',compact('penjualan','note','nama','harga','tgl','operator','no_faktur','tglnow','diskon','total','terbilang'))
        ->setPaper('a4', 'potrait');
        return $pdf->stream('faktur.pdf');
    }   

    public function selectnotafaktur(){
        $datenow = date('Y-m-d');
        $penjualan = Penjualan::select(DB::raw('distinct(nota) as note'))->where('tgl',$datenow)->get();
        return view('penjualan.selectnotafaktur',compact('penjualan','datenow'));         
    }   

// Cetak Surat Jalan
    public function pdfsuratjalan(Request $request){
        $penjualan = Penjualan::where('nota',$request->input('note'))->get();
        $note = $request->input('note');
        $tgl = date('d-M-Y');
        $no_surat = $request->input('no_surat');
        $tglnow = date('dmY');
        
        $pdf = PDF::loadView('penjualan.pdfsuratjalan',compact('penjualan','note','tgl','no_surat','tglnow'))
        ->setPaper('a4', 'potrait');
        return $pdf->stream('surat jalan.pdf'); 
    }

    public function selectnotasj(Request $request){
        $datenow = date('Y-m-d');
        $penjualan = Penjualan::select(DB::raw('distinct(nota) as note'))->where('tgl',$datenow)->get();
        return view('penjualan.selectnotasj',compact('penjualan','datenow')); 
    }  
}
