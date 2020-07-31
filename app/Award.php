<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'awards';
    
    protected $fillable = [
    	'uuid', 'nama', 'url_gambar', 'url_award', 'category'
    ];

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

}
