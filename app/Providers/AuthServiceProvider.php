<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerRolPolicies();

        //
    }

    public function registerRolPolicies()
    {
        Gate::define('admin', function ($user) {
            return $user->hasRole() == 'admin' or $user->hasAccess();
        });

        Gate::define('almacenista', function ($user) {
            return $user->hasRole() == 'almacenista';
        });
    }
}
