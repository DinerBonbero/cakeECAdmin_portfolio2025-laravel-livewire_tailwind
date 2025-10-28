<?php

namespace App\Http\Middleware;

use App\Models\UserInfo;
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
            //もし不正アクセスユーザーの機密情報をログに出力する際は書き手側：サーバーアプリケーション(Apache)でノート側のシスログなどに出力する。
            //必ず機密情報はLaravel側ではなくサーバー側で記録する！
            //Laravel側では情報漏洩やgitignoreの設定が誤っていた時リモートに上げてしまう可能性がある

            return redirect()->route('errors.error');
            //エラーページへリダイレクト
        } else {
            //未ログインユーザーの場合
            //まずこの状況は通常ありえないが、念のため対応

            return redirect()->route('items.index');  //未ログインユーザーはログイン画面へ
        }
    }
}
