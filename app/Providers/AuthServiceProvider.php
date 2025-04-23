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
    public function boot()
{

    Gate::define('is-admin', function ($user) {
        return $user->role === 'admin';
    });

    Gate::define('is-client', function ($user) {
        return $user->role === 'client';
    });
}
}
