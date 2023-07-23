<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login', [
            'title' => 'Login',
        ]);

    }
    public function proses_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|'
        ]);

        if(Auth::attempt($credentials)){
            return redirect('/dashboard');
        }
        return redirect('/login')->with('status','Login Gagal!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
