<?php

use App\Http\Controllers\CategoryController;
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

