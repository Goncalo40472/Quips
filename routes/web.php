<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::get('/seller/home', [HomeController::class, 'sellerHome'])->name('seller.home')->middleware('is_seller');

Route::get('/buyer/home', [HomeController::class, 'buyerHome'])->name('buyer.home');