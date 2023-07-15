<?php

use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;

Route::get('/products/{product}', [ProductsController::class, 'show'])->name('shop.products.show');
Route::get('/products/grids/products', [ProductsController::class, 'grid'])->name('shop.product.grids');

Route::middleware('auth')->group(function () {

    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

//cart
Route::get('/cart',[CartController::class,'index'])->name('cart');
Route::post('/cart',[CartController::class,'store']);
Route::delete('/cart',[CartController::class,'destroy'])->name('cart.destroy');

//checkout
Route::get('/checkout',[CheckoutController::class,'create'])->name('checkout');
Route::post('/checkout',[CheckoutController::class,'store']);
Route::get('/checkout/thankyou',[CheckoutController::class,'thank'])->name('checkout.success');

Route::resource('/orders', OrdersController::class);

//contact us
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');
Route::post('/contact',[ContactController::class,'store'])->name('contact.store')->middleware('auth');

Route::get('/about',[HomeController::class,'about'])->name('about');





