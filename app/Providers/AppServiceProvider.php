<?php

namespace App\Providers;

use App\Domain\User\Repositories\UserInterface;
use App\Domain\User\Repositories\UserRepository;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
        $this->registerPolicies();
        Passport::ignoreRoutes();
        Schema::defaultStringLength(191);
    }
}
