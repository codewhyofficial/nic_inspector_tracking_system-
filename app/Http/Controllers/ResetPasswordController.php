<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLogin;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'userid' => $request->userid]
        );
    }

    public function reset(Request $request)
    {
        // Validate the request
        $request->validate([
            'token' => 'required',
            'userid' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        // Find the user by user_id (which is actually the email)
        $user = UserLogin::where('user_id', $request->userid)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['userid' => 'User with this email does not exist.']);
        }

        // Check the token
        $passwordReset = DB::table('password_resets')->where('user_id', $request->userid)->first();

        if (!$passwordReset || $passwordReset->token !== $request->token) {
            return redirect()->back()->withErrors(['token' => 'Invalid token']);
        }

        // Reset the password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset token
        DB::table('password_resets')->where('user_id', $request->userid)->delete();

        return redirect('/login')->with('status', 'Password has been reset!');
    }
}
