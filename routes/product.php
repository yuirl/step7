<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('products', ProductController::class);
});