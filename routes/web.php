<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(CatalogController::class)->group(function() {
    Route::match(['get', 'post'], '/', 'list')->name('catalog');
    Route::get('/detail/{id}', 'detail')->name('catalog-detail');
    Route::get('/catalog', 'ProductController')->name('catalog');
});

Route::controller(UserController::class)->group(function() {
    Route::match(['get', 'post'], '/signup', 'signup')->name('signup');
    Route::match(['get', 'post'], '/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(ProductController::class)->group(function() {
    Route::middleware('auth')->group(function() {
        Route::match(['get', 'post'], '/product/create', 'create')->name('product-create');
        Route::match(['get', 'post'], '/product/{id}/edit', 'edit')->name('product-edit');
    });
});

Route::controller(CartController::class)->group(function() {
    Route::middleware('auth')->group(function() {
        Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::get('/cart', [CartController::class, 'cart'])->name('cart');
        Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    });
});
