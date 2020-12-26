<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailmutasimasuk extends Model
{
    protected $table = 'detail_mutasi_masuk';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'no_mutasi',
        'barang_id',
        'jml',
        'harga_beli',
        'sub_total'
    ];
}
