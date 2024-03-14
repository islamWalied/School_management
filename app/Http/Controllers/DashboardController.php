<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!empty(Auth::check()))
        {
            $type = Auth::user()->user_type;
            return view('dashboard.' . $type .'.index');
        }
        return redirect()->route('/');
    }
}
