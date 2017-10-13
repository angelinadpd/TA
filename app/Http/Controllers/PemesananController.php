<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Realisasi;
use App\Pemesanan;
use App\Barang;
use App\Http\Controllers\Controller;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $pemesanans = DB::table('pemesanan')
            ->leftjoin('barang', 'pemesanan.barang_id','=','barang.id')
            ->leftjoin('realisasi','realisasi.pemesanan_id','=','pemesanan.id')
            ->select('pemesanan.*','barang.tipe_barang','barang.nama_barang')
            ->orderBy('id', 'desc')
        	->paginate(10);  
        return view('pemesanan.index',compact('pemesanans'))
                    ->with('i', ($request->input('page', 1) - 1) * 5);                                          
    }

    public function create($id)
    {
        // $barang= DB::table('barang')->first();
        $barang = Barang::find($id);
        return view('pemesanan.create',compact('barang'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'tgl_pesan' => 'required',
            'barang_id'	=> 'required',
        ]);

        $pemesanan = new pemesanan;
        $pemesanan->no_so = str_random(8);
        $pemesanan->tgl_pesan = $request->tgl_pesan;
        $pemesanan->barang_id = $request->barang_id;
        $pemesanan->status = "Pesan";
        //$pemesanan->save();

        if ($pemesanan->save()) {
        $realisasi = new realisasi;
        $pemesanan_id = DB::table('pemesanan')->max('id');
        $realisasi->pemesanan_id = $pemesanan_id;
        $realisasi->no_so = str_random(8);
        $realisasi->tgl_pesan = $request->tgl_pesan;
        $realisasi->barang_id = $request->barang_id;
        $realisasi->status = "Pesan";
        $realisasi->save();
    }

        return redirect()->route('pemesanan.index')
                        ->with('message','Create pemesanan barang sukses');
    }


    public function edit($pemesanan)
    {
        $barang= DB::table('barang')->get();
        $pemesanan=Pemesanan::where('id',$pemesanan)->first();
        if(!$pemesanan){
            abort(404);
        }
        return view('pemesanan.edit',[
            'pemesanan' => $pemesanan,
            'barang' => $barang
        ]);
    }

    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'tgl_pesan' => 'required',
        ]);

       $pemesanan = Pemesanan::where('id', '=',$id);

        $paramsUpdate = [
            'tgl_pesan' => $request->tgl_pesan,
        ];
        
        $pemesanan->update($paramsUpdate);

       return redirect()->route('pemesanan.index')
        				->with('message','Edit pemesanan barang sukses');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::find($id)->delete();
        return redirect()->route('pemesanan.index')
                        ->with('message','Hapus data pemesanan sukses');
    }

}
