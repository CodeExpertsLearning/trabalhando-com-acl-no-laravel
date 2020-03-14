<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 5)->create()->each(function($user){
			$thread = factory(\App\Thread::class, 3)->make();

        	$user->threads()->saveMany($thread);
        });
    }
}
