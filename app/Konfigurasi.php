<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    protected $table = 'konfigurasi';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'alamat',
        'nohp',
        'apoteker',
        'no_sipa'
    ];
}
