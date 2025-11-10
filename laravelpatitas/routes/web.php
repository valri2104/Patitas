
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(); // laravel/ui default home route

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

// ============================================================================
// CART ROUTES (No middleware required)
// ============================================================================
$cartController = 'App\\Http\\Controllers\\CartController';
Route::middleware(['auth'])->group(function () use ($cartController) {
    Route::get('/cart', $cartController . '@index')->name('cart.index');
    Route::post('/cart/add', $cartController . '@add')->name('cart.add');
    Route::post('/cart/remove', $cartController . '@remove')->name('cart.remove');
    Route::post('/cart/update-quantity', $cartController . '@updateQuantity')->name('cart.updateQuantity');
    Route::post('/cart/purchase', $cartController . '@purchase')->name('cart.purchase');
    Route::get('/cart/purchase', $cartController . '@purchaseConfirmation')->name('cart.purchase.confirmation');
});

// ============================================================================
// ORDER ROUTES (Requires authentication)
// ============================================================================
$orderController = 'App\\Http\\Controllers\\OrderController';
Route::middleware(['auth'])->group(function () use ($orderController) {
    Route::get('/orders', $orderController . '@index')->name('order.index');
    Route::get('/orders/{id}', $orderController . '@show')->name('order.show');
});

// User register routes
$registerController = 'App\\Http\\Controllers\\Auth\\RegisterController';
Route::get('/register', $registerController . '@showRegistrationForm')->name('register');
Route::post('/register', $registerController . '@register')->name('register');

// ============================================================================
// PUBLIC ROUTES (No middleware required)
// ============================================================================

// Public Product Catalog Routes

$productController = 'App\\Http\\Controllers\\ProductController';
Route::get('/products', $productController . '@index')->name('product.index');
Route::get('/products/{id}', $productController . '@show')->name('product.show');

// ============================================================================
// ADMIN ROUTES (Requires authentication and admin role)
// ============================================================================
Route::get('/admin/dashboard', 'App\\Http\\Controllers\\Admin\\AdminController@index')->name('admin.index');

// Admin User Management Routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    $adminUserController = 'App\\Http\\Controllers\\Admin\\AdminUserController';

    // User CRUD Routes
    Route::get('/users', $adminUserController . '@index')->name('admin.user.index');
    Route::get('/users/create', $adminUserController . '@create')->name('admin.user.create');
    Route::post('/users', $adminUserController . '@store')->name('admin.user.store');
    Route::get('/users/{id}', $adminUserController . '@show')->name('admin.user.show');
    Route::get('/users/{id}/edit', $adminUserController . '@edit')->name('admin.user.edit');
    Route::put('/users/{id}', $adminUserController . '@update')->name('admin.user.update');
    Route::delete('/users/{id}', $adminUserController . '@destroy')->name('admin.user.destroy');
});

// Admin Product Management Routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    $adminProductController = 'App\\Http\\Controllers\\Admin\\AdminProductController';

    // Product CRUD Routes
    Route::get('/products', $adminProductController . '@index')->name('admin.product.index');
    Route::get('/products/create', $adminProductController . '@create')->name('admin.product.create');
    Route::post('/products', $adminProductController . '@store')->name('admin.product.store');
    Route::get('/products/{id}', $adminProductController . '@show')->name('admin.product.show');
    Route::get('/products/{id}/edit', $adminProductController . '@edit')->name('admin.product.edit');
    Route::put('/products/{id}', $adminProductController . '@update')->name('admin.product.update');
    Route::delete('/products/{id}', $adminProductController . '@destroy')->name('admin.product.destroy');
});

// Admin Order Management Routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    $adminOrderController = 'App\\Http\\Controllers\\Admin\\AdminOrderController';

    Route::get('/orders', $adminOrderController . '@index')->name('admin.order.index');
    Route::get('/orders/{id}', $adminOrderController . '@show')->name('admin.order.show');
    Route::put('/orders/{id}/status', $adminOrderController . '@updateStatus')->name('admin.order.updateStatus');
});
