<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('superadmin', function ($user) {
            return $user->role == 'superadmin';
        });

        Gate::define('admin', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('client', function ($user) {
            return $user->role == 'client';
        });

        Gate::define('mitra', function ($user) {
            return $user->role == 'mitra';
        });
    }
}
