<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opname extends Model
{
    protected $table = "opname";

    protected $casts = [
        'harga_beli' => 'float',
        'stok' => 'float',
        'real' => 'float',
        'selisih' => 'float',
        'nominal_hilang' => 'float',
        'lebih' => 'float',
        'nominal_lebih' => 'float'
    ];

    protected $fillable = [
        'id_barang',
		'harga_beli',
		'tanggal',
		'stok',
		'real',
		'selisih',
		'nominal_hilang',
		'lebih',
		'nominal_lebih',
		'keterangan'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
