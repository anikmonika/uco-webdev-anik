<?php

use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ProductMiddleware;
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
});

Route::controller(UserController::class)->group(function() {
    Route::match(['get', 'post'], '/signup', 'signup')->name('signup');
    Route::match(['get', 'post'], '/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(ProductController::class)->group(function() {
    Route::middleware(['auth', App\Http\Middleware\ProductMiddleware::class])->group(function() {
        Route::match(['get', 'post'], '/product/create', 'create')->can('create_product', App\Models\Product::class)->name('product-create');
        Route::match(['get', 'post'], '/product/{id}/edit', 'edit')->name('product-edit');
    });
});


Route::controller(ShoppingCartController::class)->middleware('auth')->group(function() {
    Route::get('/cart', 'list')->name('cart.list');
    Route::post('/cart/add/{product_id}', 'add')->name('cart.add');
    Route::post('/cart/edit/{cart_id}', 'edit')->name('cart.edit');
    Route::post('/cart/delete/{cart_id}', 'delete')->name('cart.delete');
});

Route::controller(InvoiceController::class)->middleware('auth')->group(function() {
    Route::get('/invoice', 'list')->name('invoice.list');
    Route::get('/invoice/{id}', 'view')->name('invoice.view');
    Route::post('/invoice/create', 'create')->name('invoice.create');
});

Route::controller(NotificationController::class)->middleware('auth')->group(function() {
    Route::get('/notification', 'list')->name('notification.list');
    Route::get('/notification/{notification_id}', 'read')->name('notification.read');
});