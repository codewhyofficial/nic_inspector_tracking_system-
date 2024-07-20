<?php

namespace App\Http\Controllers;

use App\Models\UserLogin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validation of request
        $validator = Validator::make($request->all(), [
            'userid' => 'required|email',
            'password' => 'required|string',
            'captcha_code' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput($request->except('password')); // Retain all inputs except password for security reasons
        }

        // Captcha validation
        $captcha_code = $request->captcha_code;

        if (!Session::has('captcha_code') || empty($captcha_code) || strtolower($captcha_code) !== strtolower(Session::get('captcha_code'))) {
            // Captcha validation failed
            return redirect()->route('login')
                ->withErrors(['captcha_code' => 'The captcha code entered is incorrect.'])
                ->withInput($request->except('password')); // Retain all inputs except password for security reasons
        }

        // Retrieving user
        $user = DB::select('SELECT * FROM user_login WHERE user_id = ?', [$request->userid]);

        // validating user
        if (!$user) {
            return redirect()->route('login')
                ->withErrors(['userid' => 'The provided credentials do not match our records.'])
                ->withInput($request->except('password')); // Retain all inputs except password for security reasons
        }

        if ($request->password !== $user[0]->password) {
            return redirect()->route('login')
                ->withErrors(['password' => 'The provided password is incorrect.'])
                ->withInput($request->except('password')); // Retain all inputs except password for security reasons
        }
        
        // Create an instance of UserLogin and set its attributes
        $loggedInUser = new UserLogin();
        $loggedInUser->user_id = $user[0]->user_id;
        // JWT token
        $token = JWTAuth::fromUser($loggedInUser);

        // Store user information in session
        Session::put('user_id', $user[0]->user_id);
        Session::put('uiid', $user[0]->UIID);
        Session::put('role', $user[0]->role);
        Session::put('name', $user[0]->name);

        // JWT token in a cookie with an expiration time (60 minutes)
        $cookie = cookie('jwt', $token, 60);

        // Redirect based on role
        if ($user[0]->role == 'admin') {
            return redirect()->intended('/admin')->withCookie($cookie);
        } else {
            return redirect()->intended('/user')->withCookie($cookie);
        }
    }
}
