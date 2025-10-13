<?php

namespace App\Views\Composers;

use Illuminate\View\View;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        if (Auth::check() && Auth::user()->is_admin === 0) {
            
            $userInfo = UserInfo::where('user_id', Auth::id())->first();

            // dd($userInfo);
            // exit();

            $view->with('isAdmin', $userInfo);
        }
    }
}
