
<?php
// OrderItem routes
$orderItemController = 'App\\Http\\Controllers\\OrderItemController';
Route::get('/order-items', $orderItemController . '@index')->name('orderItem.index');
Route::get('/order-items/{id}', $orderItemController . '@show')->name('orderItem.show');

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home/Welcome Route
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

// Laravel UI default home route
Auth::routes(); 

// User register routes
$registerController = 'App\Http\Controllers\Auth\RegisterController';
Route::get('/register', $registerController . '@showRegistrationForm')->name('register');
Route::post('/register', $registerController . '@register')->name('register');


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

// ============================================================================
// VETERINARY APPOINTMENT ROUTES (Requires authentication)
// ============================================================================

Route::group(['middleware' => 'auth'], function () {
    $appointmentController = 'App\Http\Controllers\VeterinaryAppointmentController';

    // Veterinary Appointment CRUD Routes
    Route::get('/appointments', $appointmentController . '@index')->name('veterinary-appointment.index');
    Route::get('/appointments/create', $appointmentController . '@create')->name('veterinary-appointment.create');
    Route::post('/appointments', $appointmentController . '@store')->name('veterinary-appointment.store');
    Route::get('/appointments/{id}', $appointmentController . '@show')->name('veterinary-appointment.show');
    Route::get('/appointments/{id}/edit', $appointmentController . '@edit')->name('veterinary-appointment.edit');
    Route::put('/appointments/{id}', $appointmentController . '@update')->name('veterinary-appointment.update');
    Route::delete('/appointments/{id}', $appointmentController . '@destroy')->name('veterinary-appointment.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Order routes (user)
Route::middleware('auth')->group(function () {
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/create', [App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
    Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
