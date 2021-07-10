<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAdif extends Model
{
	protected $fillable = [
		'user_id', 'data_adif', 'total_records',
	];

    public $timestamps = false;
}
