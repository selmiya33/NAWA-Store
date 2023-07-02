<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductsController;


Route::get('/products/{product}', [ProductsController::class, 'show'])->name('shop.products.show');
Route::get('/products/grids/products', [ProductsController::class, 'grid'])->name('shop.product.grids');

Route::middleware('auth')->group(function () {

    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});
