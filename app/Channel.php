<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
	protected $fillable = ['name', 'description', 'slug'];

    public function threads()
    {
    	return $this->hasMany(Thread::class)->orderBy('created_at', 'DESC');
    }
}
