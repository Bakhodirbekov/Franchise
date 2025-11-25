<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OperatorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access operator panel.');
        }

        // Check if user is operator or admin (admins can also access operator features)
        if (Auth::user()->role !== 'operator' && Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have permission to access operator panel.');
        }

        return $next($request);
    }
}