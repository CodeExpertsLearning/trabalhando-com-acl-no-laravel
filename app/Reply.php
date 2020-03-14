<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	protected $fillable = ['reply', 'user_id'];

	public function thread()
	{
		return $this->belongsTo(Thread::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
