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
        // awalnya seperti ini return $this->belongsToMany('App\User');
        
    	return $this->belongsTo('App\User', 'users', 'id', 'user_id');
    }

    public function userAwards()
    {
        return $this->hasMany('App\UserAward');
    }
}

