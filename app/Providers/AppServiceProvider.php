<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Views\Composers\UserComposer;
use Illuminate\View\View;

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
        Gate::define('is_admin', function (User $user) {
            return $user->is_admin == 1;
        });

        Gate::define('user', function (User $user) {
            return $user->is_admin == 0;
        });

        View::composer(
            ['items.index', 'items.show'],
            UserComposer::class
        );
    }
}
