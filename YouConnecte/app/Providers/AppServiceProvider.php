<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repository\UserRepository;
use App\Repository\IUserRepository;
use App\Services\UserService;
use App\Services\IUserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(750);
    }
}
