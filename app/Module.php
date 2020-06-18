<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name'];

    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }

    public function resources()
    {
    	return $this->hasMany(Resource::class);
    }
}
