<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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

Route::get('/shop', [CoffeeController::class, 'index']);

Route::get('/coffees/{id}', [CoffeeController::class, 'show'])->name('coffees.show');

// News

Route::get('/news', function () {
    return view('ui.news.news', [
        'active' => 'News',
        'subPageTitle' => 'ORGANIC INFORMATION',
        'pageTitle' => 'News Article'
    ]);
});


Route::get('/single-news', function () {
    return view('ui.news.single-news', [
        'active' => 'Single News',
        'subPageTitle' => 'READ THE DETAILS',
        'pageTitle' => 'Single Article'
    ]);
});

// Route::post('/cart', [CartController::class, 'addToCart'])->name('addToCart');

// Route::get('/cart', [CartController::class, 'showCart'])->middleware(['auth', 'customer']);
// Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
// Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');


Route::middleware(['auth', 'customer'])->group(function () {
    // Routes related to the CartController
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cartItem}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/cart/{cartItem}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/fetch', 'CartController@fetch')->name('cart.fetch');

});

Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');