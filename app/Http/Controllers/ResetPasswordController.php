<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLogin;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        // Validate the request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        // Find the user by email
        $user = DB::select('SELECT * FROM user_login WHERE email = ?', [$request->email]);

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User with this email does not exist.']);
        }

        // Hash the incoming token for comparison
        // $hashedToken = $this->hashToken($request->token);

        // Check the token
        $passwordReset = DB::selectOne('SELECT * FROM password_reset_tokens WHERE email = ?', [$request->email]);

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return redirect()->back()->withErrors(['token' => 'Invalid token']);
        }

        // Update the user's password
        DB::update('UPDATE user_login SET password = ? WHERE email = ?', [$request->password, $request->email]);

        // Delete the password reset token
        DB::delete('DELETE FROM password_reset_tokens WHERE email = ?', [$request->email]);

        return redirect('/login')->with('status', 'Password has been reset!');
    }

    /**
     * Hash the token using bcrypt.
     *
     * @param  string  $token
     * @return string
     */
    private function hashToken($token)
    {
        return Hash::make($token);
    }
}
