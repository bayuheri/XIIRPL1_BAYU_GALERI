<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function postregister(Request $request)
    {
        $data = [
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->username),
        ];
        User::create($data);
        Auth::user($data);

        return redirect('/');
    }
    public function proseslogin(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            return redirect('/');
        }else{
            return redirect('/welcome');
        }
    }
    public function logout()
    {
        User::logout();
        return redirect('/');
    }
}
