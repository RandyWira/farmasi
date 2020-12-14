<?php

namespace App;

use App\Jenis;
use App\Kategori;
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
        'expire'
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }

    public function golongan()
    {
        return $this->belongsTo(Golonganbarang::class, 'id_golongan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }
}
