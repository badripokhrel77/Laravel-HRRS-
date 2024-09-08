<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user is an admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Allow access
        }

        // If not admin, redirect to home or a different route
        return redirect('/login')->with('error', 'You do not have admin access.');
    }
}
