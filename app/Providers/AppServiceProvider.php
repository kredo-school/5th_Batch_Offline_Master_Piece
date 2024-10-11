<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use app\Models\User;
use Illuminate\Support\Facades\Blade;

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
            return $user->role_id === User::STORE_ROLE_ID ||$user->role_id === User::ADMIN_ROLE_ID;
        });

        Blade::directive('highlightKeyword', function ($expression) {
            return "<?php echo highlightKeyword($expression); ?>";
        });
    }
}
