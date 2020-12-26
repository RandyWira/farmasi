<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = "pembelian";
    protected $primaryKey = "no_faktur";

    public $incrementing = false;

    protected $casts = [
        'total_beli'    => 'float',
        'potongan_beli' => 'float',
        'ppn_beli'      => 'float',
        'tagihan_beli'  => 'float'
    ];

    protected $dates = ['created_at'];

    protected $fillable = [
        'suplier_id',
        'letak_id',
        'total_beli',
        'potongan_beli',
        'ppn_beli',
        'tagihan_beli'
    ];
}
