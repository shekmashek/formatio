<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('isAdmin',function($user){
            return $user->role_id == 1;
        });

        Gate::define('isReferent',function($user){
            return $user->role_id == 2;
        });

        Gate::define('isStagiaire',function($user){
            return $user->role_id == 3;
        });

        Gate::define('isFormateur',function($user){
            return $user->role_id == 4;
        });

        Gate::define('isManager',function($user){
            return $user->role_id == 5;
        });

        Gate::define('isSuperAdmin',function($user){
            return $user->role_id == 6;
        });

        Gate::define('isCFP',function($user){
            return $user->role_id == 7;
        });
    }
}
