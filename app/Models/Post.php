<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'description',
        "user_id", 
        "photo"
    ];

    public function likes(){
        return $this->belongsToMany('App\Models\User', 'likes');
    }

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
