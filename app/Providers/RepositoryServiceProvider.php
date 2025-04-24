<?php

namespace App\Providers;
use App\Interfaces\RegimeRepositoryInterface;
use App\Repositories\RegimeRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RegimeRepositoryInterface::class,RegimeRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
