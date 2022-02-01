<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'callsign', 
        'password', 
        'foto', 
        'role', 
        'category', 
        'class_premium',
        'life_time',
        'member_id', 
        'register', 
        'active',
        'manager',
        'certificate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function awards()
    {
        return $this->belongsToMany('App\Award', 'user_awards', 'award_id', 'user_id');
    }

    public function userAwards()
    {
        return $this->belongsToMany('App\Award', 'user_awards');
    }
    
    
    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hak_akses(): BelongsTo
    {
        return $this->belongsTo(HakAkses::class, 'id', 'user_id');
    }
}
