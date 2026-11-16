<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Since the user table might not have email for all users, or we might want to check if user exists
        // Standard Laravel Password Broker uses 'users' provider.
        // Let's assume standard behavior first.
        
        // However, the user asked for "Input Username and New Password" on the reset page.
        // This implies we might not be using the standard token flow strictly, or we are customizing it.
        // But to send an email, we need an email address.
        
        // Let's use the DB facade to insert token manually if we want full control, or use Password facade.
        // Using Password facade is safer.
        
        // Check if user exists with this email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that e-mail address.']);
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Send Email
        Mail::send('auth.email-forgot', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()->with('status', 'We have e-mailed your password reset link!');
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
            'token' => 'required'
        ]);

        // Verify Token
        $resetRecord = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['token' => 'Invalid token!']);
        }

        // Verify User by Username (as requested)
        // Note: Usually we verify by Email from the token record.
        // But user asked for Username input.
        // We should check if the username matches the email in the reset record?
        // Or just trust the username input if the token is valid?
        // Security risk: If I have a valid token for Email A, can I reset password for Username B?
        // We MUST verify that the username belongs to the email in the token.
        
        $user = User::where('username', $request->username)->first();
        
        if (!$user) {
             return back()->withErrors(['username' => 'Username not found!']);
        }
        
        if ($user->email !== $resetRecord->email) {
            return back()->withErrors(['username' => 'Username does not match the email associated with this reset link.']);
        }

        // Update Password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete Token
        DB::table('password_resets')->where('email', $resetRecord->email)->delete();

        return redirect('/login-kcd')->with('status', 'Your password has been changed!');
    }
}
