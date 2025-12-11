<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\AdminController;

// Public routes - accessible to everyone (guests and authenticated users)
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/plans', [PublicController::class, 'plans'])->name('plans');
Route::get('/help', [PublicController::class, 'help'])->name('help');
Route::get('/privacy', [PublicController::class, 'privacy'])->name('privacy');

// Guest only routes - only for non-authenticated users
Route::middleware('guest')->group(function () {
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
        Route::post('/compound', [InvestmentController::class, 'compound'])->name('compound');

        // Withdrawal routes
        Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::get('/withdrawals/create', [WithdrawalController::class, 'create'])->name('withdrawals.create');
        Route::post('/withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');
        Route::get('/withdrawals/{withdrawal}', [WithdrawalController::class, 'show'])->name('withdrawals.show');

        // Buy USDT route
        Route::get('/buy-usdt', [PublicController::class, 'buyUsdt'])->name('buy-usdt');
        //analytic route
        Route::get('/analytic', [PublicController::class, 'analytic'])->name('analytic');
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

            // Withdrawal approval routes
            Route::post('/withdrawals/{withdrawal}/approve', [WithdrawalController::class, 'approve'])->name('approve-withdrawal');
            Route::post('/withdrawals/{withdrawal}/reject', [WithdrawalController::class, 'reject'])->name('reject-withdrawal');
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