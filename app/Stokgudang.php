<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stokgudang extends Model
{
    protected $table = "stok_gudang";

    protected $fillable = [
        'id_barang',
        'id_letak',
        'stok'
    ];
}
