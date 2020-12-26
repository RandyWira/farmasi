<?php

namespace App;

use App\Barang;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
	protected $table = "riwayat";

    protected $fillable = [
    	'id',
    	'barang_id',
    	'nama',
    	'stok_akhir',
	];
	
	public function barang(){
		return $this->belongsTo(Barang::class, 'barang_id' , 'id');
	}
}

