<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductOrderController;

Route::view('/', 'welcome');

Route::get('/shop', [ProductOrderController::class, 'index'])->name('shop.products.index');
Route::get('/shop/category/{categoryId}', [ProductOrderController::class, 'byCategory'])->name('shop.products.category');
Route::get('/shop/product/{id}', [ProductOrderController::class, 'show'])->name('shop.products.show');
Route::post('/shop/order', [ProductOrderController::class, 'store'])->name('shop.order.store');
Route::get('/shop/order/success/{orderId}', [ProductOrderController::class, 'success'])->name('shop.order.success');

// Add these routes for order management and payment proof upload
Route::post('/shop/payment/upload/{order}', [ProductOrderController::class, 'uploadPaymentProof'])->name('shop.payment.upload');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/creaate', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    //Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update.status');
    //Shipping routes
    Route::resource('shipping', ShippingController::class);
});

require __DIR__.'/auth.php';
