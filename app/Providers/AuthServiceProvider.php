<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
//use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $gate= Gate::define('isAdmin', function($user){
            return $user->designation =='Admin';
        });

        $gate= Gate::define('isManager', function($user){
            return $user->designation == 'Manager';
        });

        $gate= Gate::define('isSales', function($user){
            return $user->designation == 'Sales';
        });
    
    }
}
