<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    protected $table = 'hak_akses';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
