<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){

        return view('user_info.create');
    }

    public function store(Request $request){

        $validated = $request->validated();
        return redirect()->route('items.index');
    }
}
