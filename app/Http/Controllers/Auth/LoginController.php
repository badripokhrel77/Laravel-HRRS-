<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle a login request to the application
    public function login(Request $request)
    {
        // Validate the login request
        $this->validateLogin($request);

        // Get the 'remember me' value from the request
        $remember = $request->has('remember');

        // Attempt to log the user in with 'remember me' functionality
        if (Auth::attempt($this->credentials($request), $remember)) {
            // Authentication passed
            return $this->sendLoginResponse($request);
        }

        // Authentication failed
        return $this->sendFailedLoginResponse($request);
    }

    // Validate the login form inputs
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    // Get the credentials from the login form
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
        ];
    }

    // Handle failed login response
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'login_failed' => 'Either Email Or password is Incorrect !!',
            ]);
    }

    // Redirect based on user role after successful login
    protected function redirectTo()
    {
        if (Auth::user()->role === 'admin') {
            return '/admin/dashboard';
        } else {
            return '/home';
        }
    }
}
