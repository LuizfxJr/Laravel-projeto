<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('all', function ($user) {
            return true;
        });

        Gate::define('view_collaborator', function ($user) {
            return $user->user_level == 'administrator' || $user->user_level == 'supervisor' ? true : false;
        });

        Gate::define('view_customer', function ($user) {
            return $user->user_level == 'administrator' || $user->user_level == 'supervisor' || $user->occupation_id === 3 ? true : false;
        });

        Gate::define('view_financing', function ($user) {
            return $user->user_level == 'administrator' || $user->user_level == 'supervisor' || $user->occupation_id === 3 ? true : false;
        });

        Gate::define('view_loan', function ($user) {
            return $user->user_level == 'administrator' || $user->user_level == 'supervisor' || $user->occupation_id === 3 ? true : false;
        });

        Gate::define('view_imoveis', function ($user) {
            return $user->user_level == 'administrator' || $user->user_level == 'supervisor' || $user->occupation_id === 4 ? true : false;
        });

        Gate::define('only_adm', function ($user) {
            return $user->user_level == 'administrator' || $user->user_level == 'supervisor' ? true : false;
        });

        Gate::define('adm_supervisor', function ($user) {
            return $user->user_level == 'administrator' || $user->user_level == 'supervisor' ? true : false;
        });

        Gate::define('delete_register', function ($user) {
            return $user->user_level == 'administrator' ? true : false;
        });

        Gate::define('edit_register', function ($user) {
            return $user->user_level == 'administrator' || $user->user_level == 'supervisor' ? true : false;
        });

        //
    }
}
