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
        'App\User'            => 'App\Policies\UserPolicy',
        'App\Models\Role'     => 'App\Policies\RolePolicy',
        'App\Models\Province' => 'App\Policies\ProvincePolicy',
        'App\Models\District' => 'App\Policies\DistrictPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('show-system', function ($user) {
            return $user->hasPermission('show-user') && $user->hasPermission('show-role');
        });
        Gate::define('show-category', function ($user) {
            return $user->hasPermission('show-district') && $user->hasPermission('show-province');
        });
    }
}
