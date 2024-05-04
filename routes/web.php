<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

route::get('post', [HomeController::class, 'post'])->middleware(['auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/404', [PageController::class, 'error']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);

Route::middleware(['auth', 'customer'])->group(function () {
    // Routes related to the CartController
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cartItem}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/cart/{cartItem}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');

});

Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
Route::get('/check-status', 'OrderController@checkStatus');

Route::post('/get-order-status', [OrderController::class, 'getOrderStatus'])->name('get-order-status');

Route::post('/order/accept', [OrderController::class, 'acceptOrder'])->name('order.accept');
Route::post('/order/reject', [OrderController::class, 'rejectOrder'])->name('order.reject');
Route::post('/order/pickup', [OrderController::class, 'pickUpOrder'])->name('order.pickup');
Route::post('/order/finish', [OrderController::class, 'finishOrder'])->name('order.finish');

Route::resource('coffees', CoffeeController::class);
Route::resource('orders', OrderController::class);
Route::resource('users', UserController::class);