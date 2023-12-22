<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    
    public function registerShow(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        return view('auth.login');
    }

    public function loginShow(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
            return view('admin');
    }
}
