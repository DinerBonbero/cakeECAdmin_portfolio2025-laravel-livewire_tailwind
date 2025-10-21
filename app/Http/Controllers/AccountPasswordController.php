<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountPasswordController extends Controller
{
    public function edit()
    {

        return view('user_password.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([

            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            //Rules\Password::defaults()は引数なしの時'password.min'のみ適用される
        ], [

            'password.required' => '新しいパスワードを入力してください。',
            'password.string' => '新しいパスワードは文字列で入力してください',
            'password.confirmed' => '新しいパスワードと確認用パスワードが一致しません',
            'password.min' => '新しいパスワードは8文字以上で入力してください'
        ]);

        $validatedPassword = $validated['password'];

        Auth::user()->update([

            'password' => Hash::make($validatedPassword)
        ]);

        return redirect()->route('user_password.done');
    }

    public function done()
    {

        return view('user_password.done');
    }
}
