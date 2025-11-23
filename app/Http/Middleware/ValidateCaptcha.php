<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ValidateCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip CAPTCHA validation in testing environment
        if (app()->environment('testing')) {
            return $next($request);
        }

        // Get the user's answer and the stored answer
        $userAnswer = $request->input('captcha');
        $storedAnswer = Session::get('captcha_answer');
        $captchaHash = $request->input('captcha_hash');
        
        // Validate the CAPTCHA
        if (!$userAnswer || !$storedAnswer || !$captchaHash) {
            return back()->withErrors(['captcha' => 'Please complete the security check.'])->withInput();
        }
        
        // Verify the hash
        $expectedHash = md5($storedAnswer . env('APP_KEY'));
        if ($captchaHash !== $expectedHash) {
            return back()->withErrors(['captcha' => 'Security check failed. Please try again.'])->withInput();
        }
        
        // Check if the answer is correct
        if ((string)$userAnswer !== (string)$storedAnswer) {
            return back()->withErrors(['captcha' => 'Incorrect answer. Please try again.'])->withInput();
        }
        
        // CAPTCHA is valid, remove it from session
        Session::forget('captcha_answer');
        
        return $next($request);
    }
}