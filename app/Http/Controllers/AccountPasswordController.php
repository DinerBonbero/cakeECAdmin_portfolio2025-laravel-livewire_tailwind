<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class AccountPasswordController extends Controller
{
    public function edit()
    {
        return view('user_password.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ],[
            'password.required' => '新しいパスワードを入力してください。',
            'password.string' => '新しいパスワードは文字列で入力してください',
            'password.confirmed' => '新しいパスワードと確認用パスワードが一致しません',
            'password.min' => '新しいパスワードは8文字以上で入力してください',
            'password.mixedCase' => '新しいパスワードは大文字と小文字をそれぞれ1文字以上含めてください',
            'password.uncompromised' => '新しいパスワードは過去に流出したことのあるパスワードです。別のパスワードを設定してください',
        ]);

        //     $user = $request->user();

        //     if (!\Hash::check($request->current_password, $user->password)) {
        //         return back()->withErrors(['current_password' => 'Current password is incorrect']);
        //     }

        //     $user->password = \Hash::make($request->new_password);
        //     $user->save();

        //     return redirect()->route('dashboard')->with('status', 'Password updated successfully');
    }

    public function done()
    {
        return view('user_password.done');
    }
}
