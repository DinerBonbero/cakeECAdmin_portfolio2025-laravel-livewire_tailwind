<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Views\Composers\UserComposer;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('is_admin', function (User $user) {
            //管理者かどうか

            return $user->is_admin == 1;
        });

        Gate::define('user', function (User $user) {
            //一般ユーザーかどうか

            return $user->is_admin == 0;
        });


        View::composer(
            //ヘッダーコンポーネントにUserComposerを紐づける

            ['components.layouts.app.header'],
            UserComposer::class
        );
    }
}
