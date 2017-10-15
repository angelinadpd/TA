<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Promo;
use App\Barang;
use App\Http\Controller\Controllers;
use Validator;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $promos = DB::table('promo')
        	->join('barang','barang.id','=','promo.barang_id')
            ->select('promo.*','barang.tipe_barang as tipe_barang','barang.nama_barang as nama_barang')
            ->orderBy('id', 'desc')
            ->paginate(10);  
        return view('promo.index', ['promos' => $promos])
                    ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create()
    {
    	$barangs = Barang::All();
        return view('promo.create',compact('barangs'));

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis_promo' => 'required',
            'barang_id'	=> 'required',
            'discount_uang'	=> 'required',
            'discount_barang'	=> 'required',
        ]);

        $promo = new Promo;
        $promo->jenis_promo = $request->jenis_promo;
        $promo->barang_id = $request->barang_id;
        $promo->discount_uang = $request->discount_uang;
        $promo->discount_barang = $request->discount_barang;
        $promo->save();

            return redirect()->route('promo.index')
                        ->with('message','Create promo sukses');
    }

    public function edit($promo)
    {
    	$barangs= DB::table('barang')->get();
        $promo=promo::where('id',$promo)->first();
        if(!$promo){
            abort(404);
        }
        return view('promo.edit',compact('promo','barangs'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_promo' => 'required',
            'barang_id'	=> 'required',
            'discount_uang'	=> 'required',
            'discount_barang'	=> 'required',
        ]);

        $promo = promo::where('id', '=',$id);

	    $paramsUpdate = [
		'jenis_promo'   => $request->jenis_promo,
		'barang_id'   => $request->barang_id,
		'discount_uang'  => $request->discount_uang,
		'discount_barang'    => $request->discount_barang,
	]; 
        $promo->update($paramsUpdate);

        return redirect()->route('promo.index')
        				->with('message','Edit data promo sukses');  
    }

    public function destroy($id)
    {
        $promo = Promo::find($id)->delete();
        return redirect()->route('promo.index')
                        ->with('message','Hapus data promo sukses');   
    }
}
