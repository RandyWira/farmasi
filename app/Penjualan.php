<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = "penjualan";
    protected $primaryKey = "nota_jual";

    public $incrementing = false;

    protected $casts = [
        'total_jual'    => 'float',
        'potongan_jual' => 'float',
        'ppn_jual'      => 'float',
        'tagihan_jual'  => 'float'
    ];

    protected $dates = ['created_at'];

    protected $fillable = [
        'nama_pembeli',
        'letak_id',
        'total_jual',
        'potongan_jual',
        'ppn_jual',
        'tagihan_jual'
    ];
}
