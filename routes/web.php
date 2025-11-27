<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\AdminController;

// Public routes - no authentication required
Route::middleware('guest')->group(function () {
    // Landing page
    Route::get('/', [PublicController::class, 'home'])->name('home');

    // About Us page
    Route::get('/about', [PublicController::class, 'about'])->name('about');

    // Investment Plans page
    Route::get('/plans', [PublicController::class, 'plans'])->name('plans');

    // Registration routes
    Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');

    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// Protected routes - authentication required
Route::middleware('auth')->group(function () {
    // Logout route (available to all authenticated users)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard route (role-specific dashboards)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Investor routes
    Route::middleware('role:investor,moderator,admin,super-admin')->group(function () {
        Route::resource('investments', InvestmentController::class);
    });

    // Admin routes (admin, moderator, super-admin)
    Route::middleware('role:admin,moderator,super-admin')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
            Route::post('/settings', [AdminController::class, 'updateSettings'])->name('update-settings');
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            Route::get('/investments', [AdminController::class, 'investments'])->name('investments');
            Route::post('/investments/{investment}/approve', [AdminController::class, 'approveInvestment'])->name('approve-investment');
            Route::post('/investments/{investment}/reject', [AdminController::class, 'rejectInvestment'])->name('reject-investment');
        });
    });

    // Super Admin only routes
    Route::middleware('role:super-admin')->group(function () {
        Route::prefix('super-admin')->name('super-admin.')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'superAdminDashboard'])->name('dashboard');
            Route::get('/roles', [AdminController::class, 'roles'])->name('roles');
            Route::get('/permissions', [AdminController::class, 'permissions'])->name('permissions');
        });
    });
});
