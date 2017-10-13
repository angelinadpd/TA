<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    protected $table = 'total';

    public $fillable = [
	    'nota',
	    'total',
	    'barang_id',
	    'discount_qty',
	    'discount_uang'
    ];

    public $timestamps =  false;
    
}
