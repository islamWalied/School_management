<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function forget_page()
    {
        return view('auth.forget_password');
    }

    public function forget_password(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($request->email)->send(new ForgetPasswordMail($user));
            return redirect()->back()->with('success', 'Check your email and reset your password');
        }
        else
            return redirect()->back()->with('error', 'Email is not found in the system');

    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset',$data);
        }
        else
            abort(404);

    }

    public function reset_password($remember_token,Request $request)
    {

        if($request->password == $request->confirm_password)
        {
            $user = User::getTokenSingle($remember_token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect()->route('index')->with('success', 'Password successfully reset');
        }
        else
            return redirect()->back()->with('error', 'Password and Confirm Password does not match');

    }

}
