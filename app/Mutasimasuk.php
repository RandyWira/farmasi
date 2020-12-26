<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mutasimasuk extends Model
{
    protected $table = 'mutasi_masuk';
    protected $primaryKey = 'no_mutasi';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'no_mutasi',
        'dari',
        'letak_id',
        'tanggal'
    ];
}
