<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAward extends Model
{
    protected $table = 'user_awards';

    protected $fillable = [
    	'user_id', 'award_id', 'link_googledrive'
    ];
}
