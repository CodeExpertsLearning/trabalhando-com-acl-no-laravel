<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Thread' => 'App\Policies\ThreadPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if(!Schema::hasTable('resources')) return null;

        $resources = \App\Resource::all();

        Gate::before(function($user){
        	if($user->isAdmin()) {
        		return true;
	        }
        });

        foreach($resources as $resource) {

        	Gate::define($resource->resource, function($user) use ($resource){
		        return $resource->roles->contains($user->role);
	        });

        }
    }
}
