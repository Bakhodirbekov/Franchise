<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access admin panel.');
        }

        // Get fresh user data from database to ensure we have the latest role
        $user = User::find(Auth::id());
        
        // Check if user is admin
        if ($user->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have permission to access admin panel.');
        }

        // Update the session with fresh user data
        Auth::setUser($user);

        return $next($request);
    }
}