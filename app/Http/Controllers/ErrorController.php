<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function error()
    {
        
        return view('errors.error');
    }
}
