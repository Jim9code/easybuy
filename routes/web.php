<?php

use App\Http\Controllers\EasybuyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', [EasybuyController::class, 'index']);
Route::view('/register','auth.register')->name('register');
//named routes so that we can use them in the controllers
Route::view('/login','auth.login')->name('login');
Route::view('/forgot-password','auth.forgot-password')->name('forgot-password');

// Home dashboard route backed by ProductController
Route::get('/home', [ProductController::class, 'index'])->middleware('auth')->name('home');


//auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Forgot Password routes
Route::post('/forgot-password/send', [AuthController::class, 'sendResetCode']);
Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword']);

// Product CRUD routes
Route::post('/products', [ProductController::class, 'store'])->middleware('auth');
Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('auth');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('auth');

