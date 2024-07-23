<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        $token = Cookie::get('jwt');

        // Check if the user is trying to access the login page
        if ($request->is('login')) {
            // If the user is already authenticated, redirect based on role
            if ($token && JWTAuth::setToken($token)->check() && Session::has('user_id') && Session::has('role')) {
                $role = Session::get('role');
                if ($role === 'admin') {
                    return redirect()->route('admin');
                } elseif ($role === 'user') {
                    return redirect()->route('user', ['uiid' => Session::get('uiid')]);
                }
            }

            // Allow access to the login page if not authenticated
            return $next($request);
        }

        // For other routes, check if the token and session data are valid
        if (!$token || !JWTAuth::setToken($token)->check() || !Session::has('user_id') || !Session::has('role')) {
            return redirect()->route('login')->withErrors(['session' => 'Invalid token or session expired. Please log in again.']);
        }

        return $next($request);
    }
}
