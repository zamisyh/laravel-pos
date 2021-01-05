<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\SignupRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function logView()
    {

        if(session('error_login')){
            toast(session('error_login'),'error');

        }else{
            toast(session('success_login'), 'success');


        }
        return view('auth.login');

    }

    public function regView()
    {
       return response()->json([
            'error' => 'true',
            'message' => 'Disabled route!'
       ]);
    }

    public function actionLogin(LoginRequest $req)
    {
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
           return redirect()->route('admin.auth.logView')->with('success_login', 'Successfully login, redirecting...');

        }else{
            return redirect()->route('admin.auth.logView')->with('error_login', 'Opppss, your credentials is invalid');
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
