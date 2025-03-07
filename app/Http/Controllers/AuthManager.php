<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login()
    {
        return view(view:'auth.login');
    }
    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route(name:"home"));
        }
        return redirect(route("login"))->with("error", "Invalid Email or Password");
    }
    function register()
    {
        return view(view: 'auth.register');
    }
    function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if($user->save()){
            return redirect(route(name: "login"))->with("success", "Registration Successfull");
        }
        return redirect(route(name:"register"))->with("error", "Registration Failed! Try Again");
    }
    function logout()
    {
        Auth::logout();
        return redirect(route("login"));
    }
    
}
