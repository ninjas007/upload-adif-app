<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'awards';
    
    protected $fillable = [
    	'uuid', 'nama', 'url_award', 'url_gambar'
    ];
}
