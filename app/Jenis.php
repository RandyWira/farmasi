<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';
    protected $primaryKey = 'id_jenis';
    
    protected $fillable = [
        'nama',
        'ket'
    ];

    public function set_harga_jual()
    {
        return $this->hasOne(Sethargajual::class, 'id_jenis');
    }


}
