<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sethargajual extends Model
{
    protected $table = 'set_harga_jual';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'h_grosir',
        'h_langganan',
        'h_umum'
    ];

    public function jenis()
    {
        return $this->hasOne(jenis::class, 'id_jenis');
    }
}
