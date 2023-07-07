<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CheckoutController;



Route::get('/products/{product}', [ProductsController::class, 'show'])->name('shop.products.show');
Route::get('/products/grids/products', [ProductsController::class, 'grid'])->name('shop.product.grids');

Route::middleware('auth')->group(function () {

    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/cart',[CartController::class,'index'])->name('cart');
Route::post('/cart',[CartController::class,'store']);
Route::delete('/cart',[CartController::class,'destroy'])->name('cart.destroy');

Route::get('/checkout',[CheckoutController::class,'create'])->name('checkout');
Route::post('/checkout',[CheckoutController::class,'store']);
Route::get('/checkout/thankyou',[CheckoutController::class,'thank'])->name('checkout.success');



