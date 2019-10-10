<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = true;
    
    protected $fillable = [
        'name', 'email', 'password', 'address_id'
    ];

    public function addresses()
    {
        return $this->belongsTo('App\Models\Address', 'address_id');
    }

    public function likes(){
        return $this->belongsToMany('App\Models\Post', 'likes');
    }

    public function follows(){
        return $this->belongsToMany('App\Models\User', 'follows', 'user_id', 'user_following');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
