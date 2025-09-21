<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(); // laravel/ui default home route

// ============================================================================
// PUBLIC ROUTES (No middleware required)
// ============================================================================

// Public Product Catalog Routes
$productController = 'App\Http\Controllers\ProductController';
Route::get('/products', $productController . '@index')->name('product.index');
Route::get('/products/{id}', $productController . '@show')->name('product.show');

// ============================================================================
// ADMIN ROUTES (Requires authentication and admin role)
// ============================================================================

// Admin Product Management Routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    $adminProductController = 'App\Http\Controllers\Admin\AdminProductController';

    // Product CRUD Routes
    Route::get('/products', $adminProductController . '@index')->name('admin.product.index');
    Route::get('/products/create', $adminProductController . '@create')->name('admin.product.create');
    Route::post('/products', $adminProductController . '@store')->name('admin.product.store');
    Route::get('/products/{id}', $adminProductController . '@show')->name('admin.product.show');
    Route::get('/products/{id}/edit', $adminProductController . '@edit')->name('admin.product.edit');
    Route::put('/products/{id}', $adminProductController . '@update')->name('admin.product.update');
    Route::delete('/products/{id}', $adminProductController . '@destroy')->name('admin.product.destroy');
});
