<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email', // Ensure this matches the email format
        ]);

        // Retrieve the user based on user_id
        $user = DB::select('SELECT * FROM user_login WHERE email = ?', [$request->email]);

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Use the user's email for sending the reset link
        $status = Password::sendResetLink(['email' => $request->email]);

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Password reset link sent successfully!');
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
