<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// Add auth middleware to the home route
// route to the product controller
Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])
    ->middleware('auth') // Add this line to protect the route
    ->name('home'); // don't erase or don't move