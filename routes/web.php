<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/admin', [AdminController::class,'index'])
    ->middleware('auth.basic')
    ->name('admin');

Route::get('/product/{id}/show', [ProductController::class,'showDetail'])
    ->name('product.show');

Route::get('/product/{id}/addProductToCart',[ProductController::class, 'addProductToCart'])->name('addProductToCart');
Route::get('/product/{id}/removeProductCart',[ProductController::class, 'removeProductCart'])->name('removeProductCart');

Route::get('/cart',function (){
    if(!session()->has("SESSION_CART")){
        $cart = [];
    }
    else{
        $cart = session("SESSION_CART");
    }

    $totalPrice = 0.0;
    foreach ($cart as $item){
        $totalPrice+=($item->product->price*$item->quantity);
    }

    return view('cart.cart',['cart'=>$cart,'totalPrice'=>$totalPrice]);
})->name('cart');

Route::post('/order',[OrderController::class,'create'])->name('order.create');
