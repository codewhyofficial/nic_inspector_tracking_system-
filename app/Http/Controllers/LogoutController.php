<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function handle(Request $request){
        Session::flush();
        $cookie = Cookie::forget('jwt');

        return redirect()->route('login')->withCookie($cookie);
    }
}
