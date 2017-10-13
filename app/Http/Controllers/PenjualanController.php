<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Penjualan;
use App\Barang;
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
            ->select('penjualan.*','barang.tipe_barang','barang.nama_barang')
            ->orderBy('id', 'desc')
            ->paginate(10);  

        $datenow = date('Ymd');
        return view('penjualan.index',compact('penjualans','datenow'))
                    ->with('i', ($request->input('page', 1) - 1) * 5);  
    }

    public function create()
    {    
        // $barang=DB::table('barang')->get();
        $barangs=Barang::All();
        return view('penjualan.create',compact('barangs'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nota' => 'required',
            'tgl' => 'required',
            'nama_pembeli' => 'required',
            'barang_id[]' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'dpp' => 'required',
            'ppn' =>'required',
        ]);


            $penjualan = new Penjualan();
            $penjualan ->nota = $request->nota;
            $penjualan ->tgl = $request->tgl;
            $penjualan ->nama_pembeli = $request->nama_pembeli;
            $penjualan ->barang_id = $request->input('barang_id');
            $penjualan ->qty = $request->input('qty');
            $penjualan ->price = $request ->input('price');
            $penjualan ->amount = $request ->input('amount');
            $penjualan ->dpp = $request ->input('dpp');
            $penjualan ->ppn = $request ->input('ppn');
            $penjualan->save();


            return redirect()->route('penjualan.index')
                             ->with('message','Data Berhasil Disimpan');
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
