<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API routes are disabled for now
// Uncomment when API controllers are implemented

// Route::get('/franchises', [FranchiseController::class, 'index']);
// Route::get('/franchises/{id}', [FranchiseController::class, 'show']);
// Route::post('/inquiries', [InquiryController::class, 'store']);

// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});