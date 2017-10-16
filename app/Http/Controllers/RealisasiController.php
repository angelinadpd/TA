<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Realisasi;
use App\Barang;
use App\Pemesanan;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $realisasis = DB::table('realisasi')
            ->leftjoin('pemesanan', 'realisasi.pemesanan_id','=','pemesanan.id')
            ->leftjoin('barang', 'realisasi.barang_id','=','barang.id')
            ->select('realisasi.*','pemesanan.no_so as noso','pemesanan.tgl_pesan as tglpesan','barang.tipe_barang as tipe_barang','barang.nama_barang as nama_barang')
            ->orderBy('id', 'desc')
            ->paginate(10); 

        $datenow = date('Ymd'); 
        return view('realisasi.index',compact('realisasis','datenow'))
        			->with('i', ($request->input('page', 1) - 1) * 5);  
    }
    
    public function show($id)
    {   
        $realisasi=Realisasi::find($id);
		if (!$realisasi) {
        	abort(403);
        }
        $datenow = date('Ymd');
		return view('realisasi.show',compact('realisasi','datenow')); 
    }

    public function edit($realisasi)
    {
        $pemesanan= DB::table('pemesanan')->get();
        $barang= DB::table('barang')->get();
        $realisasi=realisasi::where('id',$realisasi)->first();
        if(!$realisasi){
            abort(404);
        }
        return view('realisasi.edit',[
            'pemesanan' => $pemesanan,
            'barang' => $barang,
            'realisasi' => $realisasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $price = $request->price;
        $qty = $request->qty;
        $total = $price*$qty;

        $pemesanan_id=Realisasi::where('id','=',$id)->value('pemesanan_id');

        $pemesanan =Pemesanan::find($pemesanan_id);
        $pemesanan->status = $request->input('status');
        $pemesanan->save();

        $this->validate($request, [
        'no_do' => 'required|numeric',
        'tgl_realisasi' => 'required',
        'price' => 'required|numeric',
        'qty' => 'required|numeric',
        'status' => 'required',
        ]);

        $datenow = date('Ymd');
        $no_do = $datenow.$request->no_do;
        
        $realisasi = Realisasi::find($id);

        $realisasi->no_do= $no_do;
        $realisasi->tgl_realisasi = $request->tgl_realisasi;
        $realisasi->price = $request->price;
        $realisasi->qty = $request->qty;
        $realisasi->total = $total;
        $realisasi->status = $request->status;
        
        // echo $realisasi->barang_id;
        // // dd();
        //    $barang_id = $realisasi->barang_id; 
        //    $barang = Barang::where('id',$barang_id)->first();
            
        //     echo $barang->stok;
        //     dd();        

        
        // Penambahan Stok Barang
        if($realisasi->save()){
            $barang_id = $realisasi->barang_id;
            $barang = Barang::where('id',$barang_id)->first();
            $barang->stok = $barang->stok + $realisasi->qty;

            $barang->save();
        }

        return redirect()->route('realisasi.index')
                        ->with('message','Edit realisasi pemesanan sukses');
                 
    }

    public function destroy($id)
    {
        $realisasi = Realisasi::find($id)->delete();
        return redirect()->route('realisasi.index',compact('datenow'))
                        ->with('message','Hapus data realisasi sukses');
    }

// Laporan Pemesanan dan Realisasi
    public function getpdftanggal(Request $request){
        $realisasi= Realisasi::All();
        $month = $request -> input('bulan');
        $year = $request -> input('tahun');

        $realisasi = Realisasi::where(DB::raw('month(tgl_realisasi)'),$month)->where(DB::raw('year(tgl_realisasi)'),$year)->get();
        $realisasi = Realisasi::where(DB::raw('year(tgl_realisasi)'),$year)->get();

        $pdf = PDF::loadView('realisasi.pdf',compact('realisasi','month','year'))
        ->setPaper('a4', 'potrait');
        return $pdf->stream('realisasipemesanan.pdf');
    }

    public function selecttanggal(Request $request){
        return view('realisasi.realisasipemesanan'); 
    }
}
