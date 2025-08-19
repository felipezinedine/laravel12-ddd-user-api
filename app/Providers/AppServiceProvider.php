<?php

namespace App\Providers;

use App\Domain\User\Repositories\UserInterface;
use App\Domain\User\Repositories\UserRepository;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::ignoreRoutes();
        Schema::defaultStringLength(191);
    }
}
