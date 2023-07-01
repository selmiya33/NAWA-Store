<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
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


//base route
// Route::get('/admin/products',[ProductController::class,'index'])->name('products.index');
// Route::get('/admin/products/create',[ProductController::class,'create'])->name('products.create');
// Route::post('/admin/products',[ProductController::class,'store']);
// Route::get('/admin/products/{id}',[ProductController::class,'show']);
// Route::get('/admin/products/{id}/edit',[ProductController::class,'edit']);
// Route::put('/admin/products',[ProductController::class,'update']);
// Route::delete('/admin/products/{id}',[ProductController::class,'destroy']);

Route::middleware(['auth','auth.type:admin,super-admin'])->prefix('/admin')->group(function () {
    Route::get('/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::put('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/force', [ProductController::class, 'forceDelete'])->name('products.force-delete');

    Route::resource('/products', ProductController::class); // = 7 routes
    Route::resource('/categories', CategoryController::class); // = 7 routes
    Route::resource('/users', UserController::class); // = 7 routes
});

