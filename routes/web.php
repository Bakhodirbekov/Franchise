<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FranchiseController as AdminFranchiseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FranchiseImageController;
use App\Http\Controllers\Admin\CallRequestController;
use App\Http\Controllers\CallRequestController as PublicCallRequestController;
use Illuminate\Support\Facades\Route;

// Public Routes (No authentication required)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/franchises', [FranchiseController::class, 'index'])->name('franchises.index');

// Auth Routes (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // These routes require authentication
    Route::get('/franchises/{slug}', [FranchiseController::class, 'show'])->name('franchises.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Account Routes
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/account/inquiries', [AccountController::class, 'inquiries'])->name('account.inquiries');
    Route::get('/account/orders', [AccountController::class, 'orders'])->name('account.orders');
    
    // Mobile User Interface
    Route::get('/mobile/user-interface', function () {
        return view('mobile.user-interface', [
            'user' => auth()->user(),
        ]);
    })->name('mobile.user-interface');
    
    // Responsive Test Page
    Route::get('/responsive-test', function () {
        return view('responsive-test');
    })->name('responsive.test');
    
    // Inquiry Route (with rate limiting)
    Route::post('/inquiries', [InquiryController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('inquiries.store');
        
    // Call Request Route
    Route::post('/call-requests', [PublicCallRequestController::class, 'store'])
        ->name('call-requests.store');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Franchises Management
    Route::get('/franchises', [AdminFranchiseController::class, 'index'])->name('admin.franchises.index');
    Route::get('/franchises/create', [AdminFranchiseController::class, 'create'])->name('admin.franchises.create');
    Route::post('/franchises', [AdminFranchiseController::class, 'store'])->name('admin.franchises.store');
    Route::get('/franchises/{id}', [AdminFranchiseController::class, 'show'])->name('admin.franchises.show');
    Route::get('/franchises/{id}/edit', [AdminFranchiseController::class, 'edit'])->name('admin.franchises.edit');
    Route::put('/franchises/{id}', [AdminFranchiseController::class, 'update'])->name('admin.franchises.update');
    Route::delete('/franchises/{id}', [AdminFranchiseController::class, 'destroy'])->name('admin.franchises.destroy');

    // Franchise Images Management
    Route::delete('/franchise-images/{id}', [FranchiseImageController::class, 'destroy'])
        ->name('admin.franchise-images.destroy');

    // Categories Management
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Inquiries Management
    Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('admin.inquiries.index');
    Route::get('/inquiries/{id}', [AdminInquiryController::class, 'show'])->name('admin.inquiries.show');
    Route::put('/inquiries/{id}', [AdminInquiryController::class, 'update'])->name('admin.inquiries.update');

    // Call Requests Management
    Route::get('/call-requests', [CallRequestController::class, 'index'])->name('admin.call-requests.index');
    Route::put('/call-requests/{callRequest}/status', [CallRequestController::class, 'updateStatus'])->name('admin.call-requests.update-status');

    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Roles Management
    Route::get('/roles/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.roles.store');
});

// Operator Routes - Operators and admins can access
Route::middleware(['auth', 'role:operator,admin'])->prefix('operator')->name('operator.')->group(function () {
    // Operator routes will be loaded from the separate file
    require __DIR__ . '/operator.php';
});

require __DIR__ . '/auth.php';

// CAPTCHA Routes
Route::get('/captcha/generate', [App\Http\Controllers\Auth\CaptchaController::class, 'generate'])->name('captcha.generate');