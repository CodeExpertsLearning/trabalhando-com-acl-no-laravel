<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Thread::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
    	'channel_id' => function() {
			return factory(\App\Channel::class)->create()->id;
	    },
	    'user_id' => function() {
		    return factory(\App\User::class)->create()->id;
	    },
        'title' => $title,
	    'body'  => $faker->paragraph(2),
	    'slug'  => Str::slug($title)
    ];
});
