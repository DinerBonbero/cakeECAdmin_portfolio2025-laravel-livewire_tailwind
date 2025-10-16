<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountPasswordController extends Controller
{
    public function edit()
    {
        return view('user_password.edit');
    }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'current_password' => 'required',
    //         'new_password' => 'required|min:8|confirmed',
    //     ]);

    //     $user = $request->user();

    //     if (!\Hash::check($request->current_password, $user->password)) {
    //         return back()->withErrors(['current_password' => 'Current password is incorrect']);
    //     }

    //     $user->password = \Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->route('dashboard')->with('status', 'Password updated successfully');
    // }

    public function done()
    {
        return view('user_password.done');
    }
}
