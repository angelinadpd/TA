<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $table = 'realisasi';

    public $fillable = [
    'no_do',
    'pemesanan_id',
    'no_so',
    'tgl_pesan',
    'barang_id',
    'tgl_realisasi',
    'price',
    'qty',
    'total',
    'status'
    ];

    public $timestamps =  true;

    public function pemesanan()
    {
        return $this->belongsTo('App\Pemesanan','pemesanan_id','id');
    }
}
