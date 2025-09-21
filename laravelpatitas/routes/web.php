<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(); // laravle/ui default home route

// Product routes
$productController = 'App\Http\Controllers\ProductController';
Route::get('/products', $productController . '@index')->name('product.index');
Route::get('/products/{id}', $productController . '@show')->name('product.show');
