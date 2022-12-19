<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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



Route::get('/', [RoutingController::class, 'home'])->name('home');
Route::get('/home', [RoutingController::class, 'home'])->name('home');

Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/show/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');