<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserInfoRequest;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {

        return view('user_info.create');
    }

    public function store(UserInfoRequest $request)
    {

        $validated = $request->validated();//連想配列
        // var_dump($validated);
        // $validated['first_name'];
        // exit();

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
        
        return redirect()->route('items.index');
    }

    public function edit(){

        return view('user_info.edit');
    }

    public function update(){

        return redirect()->intended(route('items.index'));
    }

}
