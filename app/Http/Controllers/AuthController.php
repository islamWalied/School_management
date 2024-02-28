<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (!empty(Auth::check()))
        {
            $type = Auth::user()->user_type;
            return redirect($type . '/dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $remember = !empty($request->remember);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember))
        {
            $type = Auth::user()->user_type;
            return redirect($type . '/dashboard');
        }
        else
            return redirect()->back()->message('error','Please Enter Correct Email and Password');
    }
    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }
}
