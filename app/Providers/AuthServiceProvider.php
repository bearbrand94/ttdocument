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

        Gate::define('review-document-send', function ($user) {
            return $user->hasAccess(['review-document-send']);
        });
        Gate::define('review-document-receive', function ($user) {
            return $user->hasAccess(['review-document-receive']);
        });
        Gate::define('manage-document-send', function ($user) {
            return $user->hasAccess(['manage-document-send']);
        });
        Gate::define('manage-document-receive', function ($user) {
            return $user->hasAccess(['manage-document-receive']);
        });
        Gate::define('create-document-send', function ($user) {
            return $user->hasAccess(['create-document-send']);
        });
        Gate::define('create-document-receive', function ($user) {
            return $user->hasAccess(['create-document-receive']);
        });
        Gate::define('manage-user', function ($user) {
            return $user->hasAccess(['manage-user']);
        });
        Gate::define('manage-client', function ($user) {
            return $user->hasAccess(['manage-client']);
        });
        Gate::define('create-client', function ($user) {
            return $user->hasAccess(['create-client']);
        });
        Gate::define('update-client', function ($user) {
            return $user->hasAccess(['update-client']);
        });

        Gate::define('manage-my-account', function ($user) {
            return $user->hasAccess(['manage-my-account']);
        });
        Gate::define('manage-supervisor-staff-relation', function ($user) {
            return $user->hasAccess(['manage-supervisor-staff-relation']);
        });
        Gate::define('manage-staff-client-relation', function ($user) {
            return $user->hasAccess(['manage-staff-client-relation']);
        });

    }
}
