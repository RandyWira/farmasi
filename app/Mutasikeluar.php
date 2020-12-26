<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mutasikeluar extends Model
{
    protected $table = 'mutasi_keluar';
    protected $primaryKey = 'no_mutasi';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'no_mutasi',
        'ke',
        'letak_id',
        'tanggal'
    ];
}
