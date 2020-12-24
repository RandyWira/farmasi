<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Setpersentasejual extends Model
{
    protected $table = 'set_persentase_jual';
    protected $primaryKey = 'id_persen';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'persen_grosir',
        'persen_langganan',
        'persen_umum',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
