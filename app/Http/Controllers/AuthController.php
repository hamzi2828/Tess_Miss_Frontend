<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\SendResetLink;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.login');
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the intended page
        return redirect()->route('dashboard');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
  
        // Validate the form data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        // Attempt to log the user in
        if (Auth::attempt($credentials)) {

            $user = Auth::user();
         

            if($user->role !== 'frontendUser'){
                Auth::logout();
    
                return back()->with('error_login', 'You are not allowed to login.');
                      
            }
            if($user->status === 'inactive'){
                Auth::logout();
                // return redirect()->route('login');
                return back()->with('error_login', 'Your account is inactive.');
                      
            }
            // If successful, redirect to the intended page
            return redirect()->intended('/');
        }

        // If unsuccessful, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function sendResetLink(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();
    
        // Check if the user is not a frontend user
        if ($user->role !== 'frontendUser') {
            return redirect()->route('login')->with('error_login', 'You are not authorized to request a password reset link.');
        }
        
        // Check if the user exists
        if (!$user) {
            return response()->json([
                'error_login' => 'We could not find a user with that email address.',
            ], 404);
        }

        // Delete any existing password reset tokens for the user
        $user->remember_token = Str::random(60);
        $user->resetlink_created_at = now();
        $user->save();

       // Send the reset link via email
       Mail::to($user->email)->send(new SendResetLink($user->remember_token));
    

        return back()->with('success', 'We have e-mailed your password reset link!');
    }
    public function updatePassword(Request $request){
      

        $user = User::where('remember_token', $request->token)->first();
        if(!$user){
            return redirect()->back()->withErrors(['error_foget_password' => 'Invalid or expired token.']);
        }
        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->withErrors(['error_foget_password' => 'Passwords do not match']);
        }
    
        $user->password = Hash::make($request->password);
        $user->remember_token = null;
        $user->resetlink_created_at = null;
        $user->save();
        return redirect()->route('login')->with('success', 'Your password has been updated successfully. You can now log in with your new password.');
    

    }
}
