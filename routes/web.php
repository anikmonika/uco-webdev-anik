<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

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

    route::match(['get', 'post'], '/','list')->name('catalog');
    route::get('/detail/{id}','detail')->name('catalog-detail');
});