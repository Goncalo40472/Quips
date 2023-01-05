<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController; 
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReceiptController;

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

/* Home Routes */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

/* User Routes */

Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/{user}/edit', [UserController::class, 'edit'])->name('profile.edit')->middleware('is_auth_user');
Route::post('/profile/{user}', [UserController::class, 'update'])->name('profile.update')->middleware('is_auth_user');
Route::post('/profile/destroy/{user}', [UserController::class, 'destroy'])->name('profile.destroy')->middleware('is_auth_user');

/* Admin Routes */

Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('is_admin');
Route::get('/users/show/{user}', [UserController::class, 'show'])->name('users.show')->middleware('is_admin');
Route::post('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('is_admin');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('is_admin');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('is_admin');
Route::post('/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('is_admin');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('is_admin');

/* Products Routes */

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{user}', [ProductController::class, 'myProducts'])->name('myProducts')->middleware('is_auth_user');
Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/create/{user}', [ProductController::class, 'create'])->name('products.create')->middleware('is_auth_user');
Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit')->middleware('is_product_owner');
Route::post('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('is_product_owner');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('is_product_owner');

/* Search Routes */

Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/search/{order}', [ProductController::class, 'orderedSearch'])->name('search.order');

/* Reviews Routes */

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

/* Payments Routes */

Route::get('/checkout/{product}', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/payment', [PaymentController::class, 'payment'])->name('payment.store');
Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');

/* Cart Routes */

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/removeProduct/{product}', [CartController::class, 'removeProduct'])->name('cart.removeProduct');
Route::post('/cart/addProduct/{product}', [CartController::class, 'addProduct'])->name('cart.addProduct');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/productQuantity/{product}', [CartController::class, 'productQuantity'])->name('cart.productQuantity');

/* Receipt Routes */

Route::get('/receipt/{buy}', [ReceiptController::class, 'generateReceipt'])->name('receipt')->middleware('is_buy_owner');
