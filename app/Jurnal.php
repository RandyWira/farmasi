<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = "jurnal";
    protected $primaryKey = "no_jurnal";
    public $incrementing = false;

    protected $fillable = [
        'no_jurnal',
        'no_bukti',
        'tgl_transaksi',
        'user_id'
    ];
}
