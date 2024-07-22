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
            'userid' => 'required|email',
        ]);

        // Custom logic to use `user_id` instead of `email`
        $user = DB::table('user_login')->where('user_id', $request->userid)->first();

        if (!$user) {
            return back()->withErrors(['userid' => 'User with this email does not exist.']);
        }

        // Send password reset link
        $response = Password::sendResetLink([
            'user_id' => $request->userid // Custom field for email
        ]);

        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Password reset link sent successfully!');
        } else {
            return back()->withErrors(['userid' => __($response)]);
        }
    }
}
