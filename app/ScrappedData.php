<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScrappedData extends Model
{
    protected $table = 'scrapped';
    protected $fillable = [
        'postcode', 
        'url'
        // add the ones you need
    ];
}
