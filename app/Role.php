<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = ['name', 'role'];

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function resources()
    {
    	return $this->belongsToMany(Resource::class);
    }

    public function modules()
    {
    	return $this->belongsToMany(Module::class);
    }
}
