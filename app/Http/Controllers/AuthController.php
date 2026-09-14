<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordResetCode;
use App\Mail\PasswordResetCodeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;



class AuthController extends Controller
{


    public function register(Request $request)
    {
        //collect incoming form data 
        $incomingData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
             // 'confirmed' automatically checks for 'password_confirmation'
        ]);

          //creates a user in the database and saves it
        $user = User::create([
            'username' => $incomingData['username'],
            'email' => $incomingData['email'],
            'password' => $incomingData['password'],
        ]);

        //login the user
        Auth::login($user);

        $pendingPrompt = $request->input('pending_prompt') ?: $request->query('prompt');
        if ($pendingPrompt) {
            return redirect('/home?username=' . urlencode($user->username) . '&prompt=' . urlencode($pendingPrompt));
        }

        // Redirect to the wholesale catalog
        return redirect()->route('catalog');
    }



    // 2. Process Login
    public function login(Request $request)
    {
        //collects incoming form data from login form
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        //attempts to authenticate the user and check if credentials are correct
        if (Auth::attempt($credentials, $request->boolean('remember_me'))) {
            $user = Auth::user();

            // Check if account is suspended or banned
            if ($user->isBanned()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'This account has been banned from EasyBuy for compliance violations.' . ($user->status_reason ? " Reason: {$user->status_reason}" : '')
                ])->onlyInput('email');
            }

            if ($user->isSuspended()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'This account has been temporarily suspended by EasyBuy Administration.' . ($user->status_reason ? " Reason: {$user->status_reason}" : '')
                ])->onlyInput('email');
            }

            if ($request->hasSession()) {
                $request->session()->regenerate();
            }

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->isSupplier()) {
                return redirect()->route('supplier.dashboard');
            }

            $pendingPrompt = $request->input('pending_prompt') ?: $request->query('prompt');
            if ($pendingPrompt) {
                return redirect('/home?username=' . urlencode($user->username) . '&prompt=' . urlencode($pendingPrompt));
            }

            return redirect()->route('catalog');
        }

        //if credentials are not correct 
       return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }



    // 3. Process Logout
    public function logout(Request $request)
    {
        // JS equivalent: req.session.destroy()
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Regenerate CSRF token
        
        return redirect('/');
    
    }
 
    // 4. Send 5-digit code via Mailtrap
public function sendResetCode(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email', // exists checks if email exists in users table
    ]);
    // Generate a random 5-digit number
    $code = rand(10000, 99999);
    // Save or update the code in our database table
    PasswordResetCode::updateOrCreate(
        ['email' => $request->email],
        [
            'code' => $code,
            'expires_at' => now()->addMinutes(15) // Expires in 15 mins
        ]
    );
    
    // Send branded HTML email using Mailtrap / SMTP credentials
    try {
        $user = User::where('email', $request->email)->first();
        Mail::to($request->email)->send(new PasswordResetCodeMail((string) $code, $request->email, $user));
        Log::info("Password reset code successfully dispatched to {$request->email}");
    } catch (\Throwable $e) {
        Log::error("Failed to send password reset email to {$request->email}: " . $e->getMessage());
    }

    // Redirect back to the form, prefilling the email, and flashing a success banner
    return redirect('/forgot-password?email=' . urlencode($request->email))
        ->with('success', 'A 5-digit verification code has been dispatched to your email address.');
}
// 5. Reset Password using the code
public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'code' => 'required|string|size:5',
        'password' => 'required|string|min:8|confirmed',
    ]);
    // Query our table for a matching valid code that hasn't expired yet
    $record = PasswordResetCode::where('email', $request->email)
        ->where('code', $request->code)
        ->where('expires_at', '>', now())
        ->first();
    if (!$record) {
        return back()->withErrors(['code' => 'Invalid or expired verification code.']);
    }
    // Update user's password
    $user = User::where('email', $request->email)->first();
    $user->update([
        'password' => $request->password, // Will hash automatically due to User model casts
    ]);
    // Delete the used code
    $record->delete();
    return redirect('/login')->with('success', 'Password reset successfully! Please sign in.');
}

}
