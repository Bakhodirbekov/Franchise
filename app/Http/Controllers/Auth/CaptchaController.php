<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generate()
    {
        // Generate two random numbers for a simple math CAPTCHA
        $num1 = rand(1, 20);
        $num2 = rand(1, 20);
        $operator = rand(0, 1) ? '+' : '-'; // Randomly choose addition or subtraction
        
        // Calculate the correct answer
        $answer = ($operator === '+') ? ($num1 + $num2) : ($num1 - $num2);
        
        // Store the answer in session
        Session::put('captcha_answer', $answer);
        
        // Return the CAPTCHA question
        return response()->json([
            'question' => "$num1 $operator $num2 = ?",
            'hash' => md5($answer . env('APP_KEY'))
        ]);
    }
}