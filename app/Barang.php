<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    public $fillable = [
    'tipe_barang',
    'nama_barang',
    'price',
    'dpp',
    'ppn',
    'stok'
    ];
    
    public $timestamps =  true;

    public function pemesanan()
    {
        return $this->hasMany('App\Pemesanan');
    }
}
