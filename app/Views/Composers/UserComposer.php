<?php

namespace App\Views\Composers;

use Illuminate\View\View;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserComposer
{

    public function compose(View $view): void
    {
        //ヘッダーコンポーネントに一般ユーザーのユーザー情報を渡す

        if (Auth::check() && Auth::user()->is_admin === 0) {
            //ログインユーザーが一般ユーザーの場合

            $userInfo = UserInfo::where('user_id', Auth::id())->first();
            //ユーザー情報を取得、なければnullが入る

            $view->with('isAdmin', $userInfo);
            //ヘッダーコンポーネントに$userInfoを渡す
        }
    }
}
