<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\SignupRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function logView()
    {
        return view('auth.login');

    }

    public function regView()
    {
        return view('auth.register');
    }

    public function actionLogin(LoginRequest $req)
    {
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            return 'Found';
        }else{
            return 'Not Found';
        }
    }

    public function actionSignup(SignupRequest $req)
    {
        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password)
        ]);

        return 'Success';
    }
}
