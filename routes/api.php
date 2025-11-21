<?php

use App\Http\Controllers\Api\FranchiseController;
use App\Http\Controllers\Api\InquiryController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/franchises', [FranchiseController::class, 'index']);
Route::get('/franchises/{id}', [FranchiseController::class, 'show']);

Route::post('/inquiries', [InquiryController::class, 'store']);

// Payment webhook
Route::post('/payment/webhook', [PaymentController::class, 'webhook']);

// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});