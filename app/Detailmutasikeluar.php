<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailmutasikeluar extends Model
{
    protected $table = 'detail_mutasi_keluar';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'no_mutasi',
        'barang_id',
        'jml',
        'harga_jual',
        'subtotal'
    ];
}
