<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Setpersentasejual extends Model
{
    protected $table = 'set_persentase_jual';

    protected $fillable = [
        'persentase',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
