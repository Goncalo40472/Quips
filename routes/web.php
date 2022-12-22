<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Auth::routes(['verify' => true]);

/* Default Routes */

Route::get('/', [RoutingController::class, 'home'])->name('home');
Route::get('/home', [RoutingController::class, 'home'])->name('home');

Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');

/* Admin Routes */

Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('is_admin');
Route::get('/users/show/{user}', [UserController::class, 'show'])->name('users.show')->middleware('is_admin');
Route::post('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('is_admin');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('is_admin');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('is_admin');
Route::post('/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('is_admin');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('is_admin');

/* Seller Routes */

Route::get('/products/{user}', [ProductController::class, 'index'])->name('products');
Route::get('products/show/{product}', [ProductController::class, 'show'])->name('products.show');