<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function change_password()
    {
        return view('dashboard.profile.change-password');
    }

    public function update_password(Request $request)
    {
        $user = User::getUser(Auth::user()->id);
        if (Hash::check($request->old_password,$user->password))
        {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->back()->with('success','The password is updated successfully');

        }
        else {
            return redirect()->back()->with('danger','The old password is not correct');
        }
    }
}
