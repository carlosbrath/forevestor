<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

// Landing page is now the default home route
Route::get('/', [PublicController::class, 'home'])->name('home');
