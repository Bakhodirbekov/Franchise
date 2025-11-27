<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Get fresh user data from database to ensure we have the latest role
        $user = User::find(Auth::id());

        // Check if user has one of the required roles
        if (!in_array($user->role, $roles)) {
            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }

        // Update the session with fresh user data
        Auth::setUser($user);

        return $next($request);
    }
}