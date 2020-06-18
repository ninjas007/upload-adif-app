<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'awards';
    
    protected $fillable = [
    	'uuid', 'nama', 'url_gambar', 'url_award'
    ];

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

}
