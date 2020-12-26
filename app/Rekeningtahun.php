<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekeningtahun extends Model
{
    protected $table = "rekening_tahun";
    protected $primaryKey = "tahun";
    
    public $incrementing = false;
    public $timestamps = false;
}
