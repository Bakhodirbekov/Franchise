<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OperatorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access operator panel.');
        }

        // Get fresh user data from database to ensure we have the latest role
        $user = User::find(Auth::id());
        
        // Check if user is operator or admin (admins can also access operator features)
        if ($user->role !== 'operator' && $user->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have permission to access operator panel.');
        }

        // Update the session with fresh user data
        Auth::setUser($user);

        return $next($request);
    }
}