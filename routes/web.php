<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => 'auth'], function () {
    //商品情報一覧
    Route::get('products', [ProductController::class, 'index']) -> name('products.index');
    //商品登録画面
    Route::get('products/create', [ProductController::class, 'create']) -> name('products.create');
    //商品登録
    Route::post('products', [ProductController::class, 'store']) -> name('products.store');
    //商品詳細画面
    Route::get('products/{product}', [ProductController::class, 'show']) -> name('products.show');
    //商品編集画面
    Route::get('products/{product}/edit', [ProductController::class, 'edit']) -> name('products.edit');
    //商品情報上書き登録
    Route::put('products/{product}', [ProductController::class, 'update']) -> name('products.update');
    //商品情報削除
    Route::delete('products/{product}', [ProductController::class, 'destroy']) -> name('products.destroy');
});