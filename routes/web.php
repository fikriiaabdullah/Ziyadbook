<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\LandingProductController;

Route::view('/', 'welcome');

Route::get('/shop', [ProductOrderController::class, 'index'])->name('shop.products.index');
Route::get('/shop/category/{categoryId}', [ProductOrderController::class, 'byCategory'])->name('shop.products.category');
Route::get('/shop/product/{id}', [ProductOrderController::class, 'show'])->name('shop.products.show');
Route::post('/shop/order', [ProductOrderController::class, 'store'])->name('shop.order.store');
Route::get('/shop/order/success/{orderId}', [ProductOrderController::class, 'success'])->name('shop.order.success');

// Public landing page route (accessible without authentication)
Route::get('/product/{product}/landing', [LandingProductController::class, 'landing'])->name('product.landing');

// Add these routes for order management and payment proof upload
Route::post('/shop/payment/upload/{order}', [ProductOrderController::class, 'uploadPaymentProof'])->name('shop.payment.upload');

// Add these routes for RajaOngkir API
Route::get('/api/provinces', [RajaOngkirController::class, 'provinces'])->name('api.provinces');
Route::get('/api/cities', [RajaOngkirController::class, 'cities'])->name('api.cities');
Route::post('/api/shipping/cost', [RajaOngkirController::class, 'cost'])->name('api.shipping.cost');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
    // Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Landing page routes
    Route::get('/landing-products', [LandingProductController::class, 'index'])->name('landing-products.index');
    Route::get('/landing-products/{product}/edit', [LandingProductController::class, 'edit'])->name('landing-products.edit');
    Route::put('/landing-products/{product}', [LandingProductController::class, 'update'])->name('landing-products.update');
    Route::get('/landing-products/{landingProduct}/show', [LandingProductController::class, 'show'])->name('landing-products.show');

    // New routes for landing product image gallery
    Route::get('/landing-products/image/{imageId}/delete', [LandingProductController::class, 'deleteImage'])->name('landing-products.delete-image');
    Route::post('/landing-products/images/reorder', [LandingProductController::class, 'reorderImages'])->name('landing-products.reorder-images');

    //Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update.status');
    //Shipping routes
    Route::resource('category', CategoryController::class);
});

require __DIR__.'/auth.php';
