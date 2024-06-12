<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProductController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', function () {
    if (Auth::check()) {
        // already logged in
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
});

// Add auth middleware to the home route
Route::get('/home', [App\Http\Controllers\Auth\ProductController::class, 'index'])
    ->middleware('auth') // Add this line to protect the route
    ->name('home'); // don't erase or don't move

Route::group(['middleware' => 'auth'], function () {
    Route::resource('products', ProductController::class);
});