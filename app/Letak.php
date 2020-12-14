<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letak extends Model
{
    protected $table = 'letak_barang';
    protected $primaryKey = 'id_letak';

    protected $fillable = [
        'letak'
    ];
}
