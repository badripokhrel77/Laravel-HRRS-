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

    // Redirect after login
    protected $redirectTo = '/home';

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle a login request to the application.
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Attempt to log the user in
        if (Auth::attempt($this->credentials($request))) {
            // Authentication passed
            return $this->sendLoginResponse($request);
        }

        // Authentication failed
        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
        ];
    }

    protected function validateLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
}

protected function sendFailedLoginResponse(Request $request)
{
    return redirect()->back()
        ->withInput($request->only('email', 'remember'))
        ->withErrors([
            'login_failed' => 'Either Email Or password is Incorrect !!.',
        ]);
}
protected function redirectTo()
{
    if (Auth::user()->role === 'admin') {
        return '/admin/dashboard';
    } else {
        return '/home';
    }
}

}