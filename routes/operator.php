<?php

use App\Http\Controllers\Operator\DashboardController;
use App\Http\Controllers\Operator\CallRequestController;
use App\Http\Controllers\Operator\InquiryController;
use Illuminate\Support\Facades\Route;

// Operator Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Call Requests Management
Route::get('/call-requests', [CallRequestController::class, 'index'])->name('call-requests.index');
Route::put('/call-requests/{callRequest}/status', [CallRequestController::class, 'updateStatus'])->name('call-requests.update-status');

// Inquiries Management
Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
Route::get('/inquiries/{id}', [InquiryController::class, 'show'])->name('inquiries.show');
Route::put('/inquiries/{id}', [InquiryController::class, 'update'])->name('inquiries.update');