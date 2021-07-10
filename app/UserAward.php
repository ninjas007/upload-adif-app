<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAward extends Model
{
    protected $table = 'user_awards';

    public $timestamps = false;

    protected $fillable = [
    	'user_id', 'award_id', 'link_googledrive'
    ];

    public function users()
    {
    	return $this->belongsTo('App\User');
    }

    public function awards()
    {
    	return $this->belongsTo('App\Award');
    }
}
