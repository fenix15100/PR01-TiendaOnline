<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category',[CategoryController::class, 'getAll']);
    Route::get('/category/{id}',[CategoryController::class, 'get']);
    Route::get('/category/{id}/products',[CategoryController::class, 'getProductsByCategory']);
    Route::post('/category',[CategoryController::class, 'create']);
    Route::put('/category/{id}',[CategoryController::class, 'update']);
    Route::delete('/category/{id}',[CategoryController::class, 'delete']);

});
Route::controller(ProductController::class)->group(function () {
    Route::get('/product',[ProductController::class, 'getAll']);
    Route::get('/product/{id}',[ProductController::class, 'get']);
    Route::get('/product/{id}/category',[ProductController::class, 'getCategoryByProduct']);
    Route::post('/product',[ProductController::class, 'create']);
    Route::put('/product/{id}',[ProductController::class, 'update']);
    Route::delete('/product/{id}',[ProductController::class, 'delete']);
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/order',[OrderController::class, 'getAll']);
    Route::get('/order/{id}',[OrderController::class, 'get']);
    Route::delete('/order/{id}',[OrderController::class, 'delete']);

});

