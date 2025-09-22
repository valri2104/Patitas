<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(); // laravle/ui default home route

// User register routes
$registerController = 'App\Http\Controllers\Auth\RegisterController';
Route::get('/register', $registerController . '@showRegistationForm')->name('register');
Route::post('/register', $registerController . '@register')->name('register');
// Product routes
$productController = 'App\Http\Controllers\ProductController';
Route::get('/products', $productController . '@index')->name('product.index');
Route::get('/products/{id}', $productController . '@show')->name('product.show');
