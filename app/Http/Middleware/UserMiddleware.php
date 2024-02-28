<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$user_type): Response
    {
        if (!empty(Auth::check()))
        {
            if (Auth::user()->user_type == $user_type)
            {
//                return redirect()->route($user_type . 'dashboard/');
                return $next($request);
            }
            else {
//                Auth::logout();
//                return redirect()->route('login');
                abort(403);
            }
        }
        else {
//            Auth::logout();
//            return redirect()->route('login');
            abort(403);
        }

    }
}
