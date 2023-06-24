<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [App\Http\Controllers\ProductsController::class, 'show'])->name('shop.products.show');


//base route
// Route::get('/admin/products',[ProductController::class,'index'])->name('products.index');
// Route::get('/admin/products/create',[ProductController::class,'create'])->name('products.create');
// Route::post('/admin/products',[ProductController::class,'store']);
// Route::get('/admin/products/{id}',[ProductController::class,'show']);
// Route::get('/admin/products/{id}/edit',[ProductController::class,'edit']);
// Route::put('/admin/products',[ProductController::class,'update']);
// Route::delete('/admin/products/{id}',[ProductController::class,'destroy']);

Route::get('/admin/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
Route::put('/admin/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
Route::delete('/admin/products/{product}/force', [ProductController::class, 'forceDelete'])->name('products.force-delete');



Route::resource('/admin/products', ProductController::class); // = 7 routes
Route::resource('/admin/categories', CategoryController::class);// = 7 routes



// Route::get('/users',[UserController::class,'show']);
// Route::get('/users/{name?}',[UserController::class,'show']);
// Route::get('/users/{name}',[UserController::class,'show']);
