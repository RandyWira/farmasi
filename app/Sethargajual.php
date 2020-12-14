<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sethargajual extends Model
{
    protected $table = 'set_harga_jual';

    protected $fillable = [
        'h_grosir',
        'h_langganan',
        'h_umum'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
