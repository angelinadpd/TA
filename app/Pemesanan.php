<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    public $fillable = [
    'no_so',
    'tgl_pesan',
    'barang_id',
    'status'
    ];

    public $timestamps =  true;

    public function barang()
    {
        return $this->belongsTo('App\Barang','barang_id','id');
    }
    
    public function realisasi()
    {
        return $this->hasMany('App\Realisasi');
    }
}
