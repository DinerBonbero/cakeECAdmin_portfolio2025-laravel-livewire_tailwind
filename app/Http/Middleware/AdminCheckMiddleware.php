<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin === 1) {

            //ログインユーザーのis_adminカラムが1、つまり管理者なら次に進める
            return $next($request);
        } elseif (Auth::check() && Auth::user()->is_admin === 0) {

            //ログインユーザーのis_adminカラムが0、つまり一般ユーザーであれば前のページに戻す
            Log::error('管理者権限のないユーザーが管理者ページにアクセスしようとしました。', ['ユーザーID' => Auth::id(), 'アクセスURL' => $request->fullUrl(), 'IPアドレス' => $request->ip(), '姓' => Auth::user()->last_name, '名' => Auth::user()->first_name]);
            return redirect()->route('errors.error');
        }else{

            //未ログインユーザーであればログイン画面へ
            return redirect()->route('items.index');  //未ログインユーザーはログイン画面へ
        }
    }
}
