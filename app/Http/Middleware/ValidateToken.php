<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the JWT token from the cookies
        $token = $request->cookie('jwt');

        if (!$token) {
            // Token not found in cookies, redirect to login page
            return redirect()->route('login')->withErrors(['token' => 'You must be logged in to access this page.']);
        }

        try {
            // Try to authenticate user with the token
            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                // Token is invalid, redirect to login page
                return redirect()->route('login')->withErrors(['token' => 'Invalid token. Please log in again.']);
            }
        } catch (JWTException $e) {
            // Token is expired or another error occurred
            return redirect()->route('login')->withErrors(['token' => 'Token error: ' . $e->getMessage()]);
        }

        // Token is valid, proceed with the request
        return $next($request);
    }
}
