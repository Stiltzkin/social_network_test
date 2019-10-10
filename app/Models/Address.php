<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'zip_code'
    ];

    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
