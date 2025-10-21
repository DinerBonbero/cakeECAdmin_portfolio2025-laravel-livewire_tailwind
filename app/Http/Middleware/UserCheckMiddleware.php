<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserCheckMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && Auth::user()->is_admin === 0) {
            //ログインユーザーのis_adminカラムが0、つまり一般ユーザーの場合
            
            return $next($request);
            //次に進める
        } else {
            //ログインユーザーのis_adminカラムが1、つまり管理者の場合
            //まずこの状況で未ログイン者は通常ありえないが念のためこちらで対応
            
            return redirect()->route('items.index');
            //商品一覧画面へリダイレクト
        }
    }
}
