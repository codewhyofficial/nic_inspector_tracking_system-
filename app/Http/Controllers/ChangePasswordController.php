<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user_id = Session::get('user_id');

        // Update the user's password and set is_first_login to false
        DB::update('UPDATE user_login SET password = ?, is_first_login = ? WHERE email = ?', [
            $request->password, false, $user_id
        ]);

        return redirect()->route('login')->with('status', 'Password changed successfully.');
    }

    public function skipChangePassword(Request $request)
    {
        DB::update('UPDATE user_login SET is_first_login = false WHERE email = ?', [Session::get('user_id')]);

        return redirect()->route('login')->with('status', 'Password change skipped.');
    }
}
