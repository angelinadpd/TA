<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';

    public $fillable = [
    'jenis_promo',
    'barang_id',
    'discount_uang',
    'discount_barang'
    ];
    
    public $timestamps =  false;
}

