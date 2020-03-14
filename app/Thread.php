<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	protected $fillable = ['title', 'body', 'slug'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function replies()
	{
		return $this->hasMany(Reply::class)->orderBy('created_at', 'DESC');
	}
}
