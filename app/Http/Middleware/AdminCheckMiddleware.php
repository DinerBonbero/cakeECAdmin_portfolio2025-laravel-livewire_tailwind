<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminCheckMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin === 1) {
            //ログインユーザーでかつis_adminカラムが1(管理者)の場合

            return $next($request);
            //次に進める
        } elseif (Auth::check() && Auth::user()->is_admin === 0) {
            //ログインユーザーのis_adminカラムが0、つまり一般ユーザーの場合

            Log::error('管理者権限のないユーザーによる管理者ページへのアクセス', ['ユーザーID' => Auth::id(), 'アクセスURL' => $request->fullUrl(), 'IPアドレス' => $request->ip(), '姓' => Auth::user()->last_name, '名' => Auth::user()->first_name]);
            return redirect()->route('errors.error');
            //エラーログを記録し、エラーページへリダイレクト
        } else {
            //未ログインユーザーの場合
            //まずこの状況は通常ありえないが、念のため対応

            return redirect()->route('items.index');  //未ログインユーザーはログイン画面へ
        }
    }
}
