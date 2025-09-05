<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserInfoRequest;

class UserController extends Controller
{
    public function create(){

        return view('user_info.create');
    }

    public function store(UserInfoRequest $request){

        $validated = $request->validated();
        dd($validated);
        exit();
        return redirect()->route('items.index');
    }
}
