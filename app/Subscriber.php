<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email',
        'watched_codes'
    ];

    public function getWatchedCodesAttribute($val)
    {
    	$codes = json_decode($val, true);

    	return $codes;
    }
}
