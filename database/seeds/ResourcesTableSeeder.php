<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    foreach(Route::getRoutes()->getRoutes() as $route) {
			$nameRoute = $route->getName();

			if($nameRoute) {

				\App\Resource::create([
					'name' => ucwords(str_replace('.', ' ', $route->getName())),
					'resource' => $nameRoute,
					'is_menu' => false
				]);

			}
	    }
    }
}
