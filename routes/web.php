<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Redirect '/' to '/home'
Route::get('/', function () {
    return redirect()->route('home');
});

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Shop page
Route::get('/shoppage', [ShopController::class, 'index'])->name('shoppage');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');




// Product details
Route::get('/productDetails/{id}', [ProductDetailsController::class, 'show'])->name('productDetails.show');

// Checkout

Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store'); // <-- This is the important fix
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkoutPage'])->name('cart.checkout');

// Buy Now  
Route::post('/buy-now', [ProductDetailsController::class, 'buyNow'])->name('buy.now');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// My purchases
Route::get('/my-purchases', [PurchaseController::class, 'index'])->name('purchases.index');
/*Route::get('/order-success/{order}', function ($orderId) {
    return view('order-success', ['orderId' => $orderId]);
})->name('order.success');*/


// Admin routes protected with 'admin' middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::get('/admin/products/delete-history', [AdminProductController::class, 'deleteHistory'])->name('admin.products.deleteHistory');
    Route::put('/admin/products/{id}/restore', [AdminProductController::class, 'restore'])->name('admin.products.restore');
    Route::post('/admin/download-csv', [AdminController::class, 'downloadCsv'])->name('download.csv');
    Route::get('/admin/chat', [AdminChatController::class, 'index'])->name('admin.chat');
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
});

// Authenticated user profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});

// Optional: remove or redirect dashboard if unused
Route::get('/dashboard', function () {
    return redirect('/shoppage'); // or delete if not needed
})->middleware(['auth', 'verified'])->name('dashboard');

// Guest routes (Login/Register)
Route::middleware('guest')->group(function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login'); // fixed name
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
});

// Authenticated logout route
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Include Laravel Breeze/Fortify auth routes
require __DIR__.'/auth.php';
