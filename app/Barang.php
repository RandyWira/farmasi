<?php

namespace App;

use App\Jenis;
use App\Kategori;
use App\Riwayat;
use App\Golonganbarang;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'nama',
        'harga_beli',
        'harga_grosir',
        'harga_langganan',
        'harga_umum',
        'stok_minimal',
        'stok_akhir',
        'expire', 
        'id_jenis',
        'id_golongan',
        'id_kategori',
        'id_satuan'
    ];

    protected $dates = ['expire', 'created_at', 'updated_at'];

    // public function jenis()
    // {
    //     return $this->belongsTo(Jenis::class, 'id_jenis');
    // }

    public function jenis()
    {
    
        return $this->hasOne('App\Jenis', 'id_jenis', 'id_jenis');
    }

    public function golongan()
    {
        return $this->hasOne(Golongan::class, 'id', 'id_golongan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }
    public function riwayat(){
        return $this->hasMany(Riwayat::class);
    }
}
