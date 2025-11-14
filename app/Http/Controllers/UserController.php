<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoRequest;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {

        $userInfo = Auth::user()->userInfo()->first();
        // モデルのリレーションメソッド（userInfo()）
        //$userInfo = Auth::user()->userInfo()->get();
        //userInfosレコードのみ取得,ユーザー情報は含まれない

        if (!isset($userInfo)) {
            //ログインユーザーのユーザー情報がなければ

            return view('user_info.create');
            //ユーザー情報登録画面を表示
        } else {

            return redirect()->route('items.index');
            //ユーザー情報が既に登録されている場合、商品一覧画面へリダイレクト
        }
    }

    public function store(UserInfoRequest $request)
    {

        $validated = $request->validated();
        //フォームリクエストバリデーション、$validatedは連想配列

        UserInfo::create([
            'user_id' => Auth::id(),
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'phone_number' => $validated['phone_number'],
            'postal_code' => $validated['postal_code'],
            'prefecture' => $validated['prefecture'],
            'street_address' => $validated['street_address'],
            'address_detail' => $validated['address_detail'],
        ]);
        //ユーザー情報登録

        return redirect()->route('items.index');
        //商品一覧画面へリダイレクト
    }

    public function edit()
    {

        $userInfo = Auth::user()->userInfo()->first();
        // モデルのリレーションメソッド（userInfo()）

        if (isset($userInfo)) {
            //ログインユーザーのユーザー情報があれば

            return view('user_info.edit', compact('userInfo'));
            //ユーザー情報編集画面を表示かつユーザー情報を渡す
        } else {

            return redirect()->route('items.index');
            //ユーザー情報が登録されていない場合、商品一覧画面へリダイレクト
        }
    }

    public function update(UserInfoRequest $request)
    {

        $validated = $request->validated();
        //フォームリクエストバリデーション、$validatedは連想配列

        $userInfo = Auth::user()->userInfo()->first();

        $userInfo->update([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'phone_number' => $validated['phone_number'],
            'postal_code' => $validated['postal_code'],
            'prefecture' => $validated['prefecture'],
            'street_address' => $validated['street_address'],
            'address_detail' => $validated['address_detail'],
        ]);
        //ユーザー情報更新

        return redirect()->route('user_info.edit');
        //ユーザー情報編集画面へリダイレクト
    }
}

// モデルのリレーションメソッド（userInfo()）
//$userInfo = Auth::user()->userInfo()->get();
//userInfosレコードのみ取得,ユーザー情報は含まれない

//リレーションプロパティ（userInfo）
//$userInfo = Auth::user()->userInfo;
//userInfoレコードのみ取得 ユーザー情報は含まれない

//モデルから取得（UserInfo）
//$userInfo = UserInfo::where('user_id', Auth::id())->get();
//userInfosレコードのみ取得（リレーションに依存しない）
//ユーザー情報は含まれない

//モデルにwithを使って親と子を取得
//$user = UserInfo::with('user')->find(Auth::id());
//userInfosレコード＋usersレコードを同時取得
