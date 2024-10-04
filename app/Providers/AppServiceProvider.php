<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use app\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Paginator::useBootstrap();

        Gate::define('admin', function ($user) {
            # Checks if user has admin role ID.
            return $user->role_id === User::ADMIN_ROLE_ID;
        });

        Gate::define('store', function ($user) {
            # Checks if user has store role ID.
            return $user->role_id === User::STORE_ROLE_ID;
        });
    }
}
