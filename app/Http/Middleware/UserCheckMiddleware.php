<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // dd(Auth::user()->is_admin);
        //     exit();
        if (Auth::check() && Auth::user()->is_admin === 0) {

            //ログインユーザーのis_adminカラムが0、つまり一般ユーザーなら次に進める
            return $next($request);
        } else {

            //ログインユーザーのis_adminカラムが1、つまり管理者や未ログインであれば前のページに戻す
            return redirect()->route('items.index');
        }
    }
}
