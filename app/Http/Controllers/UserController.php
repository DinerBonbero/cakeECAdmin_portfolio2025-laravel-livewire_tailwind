<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoRequest;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {

        $userInfo = UserInfo::where('user_id', Auth::id())->first();

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

        $userInfo = UserInfo::where('user_id', Auth::id())->first();

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

        $userInfo = UserInfo::where('user_id', Auth::id())->first();

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

        return redirect()->back();
        //ユーザー情報編集画面へリダイレクト
    }
}
