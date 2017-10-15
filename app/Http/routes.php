<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function() {

	// ==Routes Barang
	Route::resource('barang', 'BarangController');
	Route::get('barang', ['as' => 'barang.index', 'uses' => 'BarangController@index','middleware' => ['role:AdminPembelian']]);
	Route::get('barang/create', ['as' => 'barang.create', 'uses' => 'BarangController@create','middleware' => ['role:AdminPembelian']]);
	Route::post('barang/create', ['as' => 'barang.store', 'uses' => 'BarangController@store','middleware' => ['role:AdminPembelian']]);
	Route::get('barang/{id}/edit', ['as' => 'barang.edit', 'uses' => 'BarangController@edit','middleware' => ['role:AdminPembelian']]);
	Route::patch('barang/{id}', ['as' => 'barang.update', 'uses' => 'BarangController@update','middleware' => ['role:AdminPembelian']]);
	Route::get('barang/delete/{id}', ['as' => 'barang.destroy', 'uses' => 'BarangController@destroy','middleware' => ['role:AdminPembelian']]);
	// Laporan Stok Barang
	Route::post('barang/cetak/pdf', ['as' => 'barang.pdf', 'uses' => 'BarangController@getpdftanggal']);
	Route::get('barang/selecttanggal/select', ['as' => 'barang.laporanstokbarang', 'uses' => 'BarangController@selecttanggal']);

	// ==Routes Pemesanan
	Route::resource('pemesanan', 'PemesananController');
	Route::get('pemesanan', ['as' => 'pemesanan.index', 'uses' => 'PemesananController@index','middleware' => ['role:AdminPembelian']]);
	Route::get('pemesanan/{id}/create', ['as' => 'pemesanan.create', 'uses' => 'PemesananController@create','middleware' => ['role:AdminPembelian']]);
	Route::post('pemesanan/create', ['as' => 'pemesanan.store', 'uses' => 'PemesananController@store','middleware' => ['role:AdminPembelian']]);
	Route::get('pemesanan/{id}', ['as' => 'pemesanan.show', 'uses' => 'PemesananController@show']);
	Route::get('pemesanan/{id}/edit', ['as' => 'pemesanan.edit', 'uses' => 'PemesananController@edit','middleware' => ['role:AdminPembelian']]);
	Route::patch('pemesanan/{id}', ['as' => 'pemesanan.update', 'uses' => 'PemesananController@update','middleware' => ['role:AdminPembelian']]);
	Route::get('pemesanan/delete/{id}', ['as' => 'pemesanan.destroy', 'uses' => 'PemesananController@destroy','middleware' => ['role:AdminPembelian']]);

	// ==Routes Realisasi
	Route::resource('realisasi', 'RealisasiController');
	Route::get('realisasi', ['as' => 'realisasi.index', 'uses' => 'RealisasiController@index','middleware' => ['role:AdminPembelian']]);
	Route::get('realisasi/create', ['as' => 'realisasi.create', 'uses' => 'RealisasiController@create','middleware' => ['role:AdminPembelian']]);
	Route::post('realisasi/create', ['as' => 'realisasi.store', 'uses' => 'RealisasiController@store','middleware' => ['role:AdminPembelian']]);
	Route::get('realisasi/{id}', ['as' => 'realisasi.show', 'uses' => 'RealisasiController@show']);
	Route::get('realisasi/{id}/edit', ['as' => 'realisasi.edit', 'uses' => 'RealisasiController@edit','middleware' => ['role:AdminPembelian']]);
	Route::patch('realisasi/{id}', ['as' => 'realisasi.update', 'uses' => 'RealisasiController@update','middleware' => ['role:AdminPembelian']]);
	Route::get('realisasi/delete/{id}', ['as' => 'realisasi.destroy', 'uses' => 'RealisasiController@destroy','middleware' => ['role:AdminPembelian']]);
	// Laporan Pemesanan dan Realisasi
	Route::post('realisasi/cetak/pdf', ['as' => 'realisasi.pdf', 'uses' => 'RealisasiController@getpdftanggal']);
	Route::get('realisasi/selecttanggal/select', ['as' => 'realisasi.realisasipemesanan', 'uses' => 'RealisasiController@selecttanggal']);

	// ==Routes Promo Penjualan
	Route::resource('promo', 'PromoController');
	Route::get('promo', ['as' => 'promo.index', 'uses' => 'PromoController@index','middleware' => ['role:AdminPenjualan']]);
	Route::get('promo/create', ['as' => 'promo.create', 'uses' => 'PromoController@create','middleware' => ['role:AdminPenjualan']]);
	Route::post('promo/create', ['as' => 'promo.store', 'uses' => 'PromoController@store','middleware' => ['role:AdminPenjualan']]);
	Route::get('promo/{id}/edit', ['as' => 'promo.edit', 'uses' => 'PromoController@edit','middleware' => ['role:AdminPenjualan']]);
	Route::patch('promo/{id}', ['as' => 'promo.update', 'uses' => 'PromoController@update','middleware' => ['role:AdminPenjualan']]);
	Route::get('promo/delete/{id}', ['as' => 'promo.destroy', 'uses' => 'PromoController@destroy','middleware' => ['role:AdminPenjualan']]);
	
	// ==Routes Penjualan
	Route::resource('penjualan', 'PenjualanController');
	Route::get('penjualan', ['as' => 'penjualan.index', 'uses' => 'PenjualanController@index','middleware' => ['role:AdminPenjualan']]);
	Route::get('penjualan/create', ['as' => 'penjualan.create', 'uses' => 'PenjualanController@create','middleware' => ['role:AdminPenjualan']]);
	Route::post('penjualan/create', ['as' => 'penjualan.store', 'uses' => 'PenjualanController@store','middleware' => ['role:AdminPenjualan']]);
	Route::get('penjualan/delete/{nota}', ['as' => 'penjualan.destroy', 'uses' => 'PenjualanController@destroy','middleware' => ['role:AdminPenjualan']]);
	Route::get('/data-price',['as'=>'data-price','uses'=>'PenjualanController@dataHarga']);
	// Laporan Penjualan
	Route::post('penjualan/cetak/pdf', ['as' => 'penjualan.pdf', 'uses' => 'PenjualanController@getpdftanggal']);
	Route::get('penjualan/selecttanggal/select', ['as' => 'penjualan.laporanpenjualan', 'uses' => 'PenjualanController@selecttanggal']);
	// Cetak Faktur
	Route::post('penjualan/cetakfaktur/pdf', ['as' => 'penjualan.pdffaktur', 'uses' => 'PenjualanController@pdffaktur']);
	Route::get('penjualan/selectnotafaktur/select', ['as' => 'penjualan.selectnotafaktur', 'uses' => 'PenjualanController@selectnotafaktur']);
	// Cetak Surat Jalan
	Route::post('penjualan/cetaksurat/pdf', ['as' => 'penjualan.pdfsuratjalan', 'uses' => 'PenjualanController@pdfsuratjalan']);
	Route::get('penjualan/selectnotasj/select', ['as' => 'penjualan.selectnotasj', 'uses' => 'PenjualanController@selectnotasj']);


});
