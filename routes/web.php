<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCouponController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Shop & Products
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/collections', [ProductController::class, 'collections'])->name('collections');
Route::get('/category/{slug}', [ProductController::class, 'categoryProducts'])->name('category.products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{key}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');
Route::post('/checkout/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('checkout.removeCoupon');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

// Orders
Route::get('/order/success/{orderNumber}', [OrderController::class, 'success'])->name('order.success');
Route::get('/track-order', [OrderController::class, 'track'])->name('order.track');

// Policies
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/refund-policy', [HomeController::class, 'refundPolicy'])->name('refund.policy');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/size-chart', [HomeController::class, 'sizeChart'])->name('size.chart');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Admin Login
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    
    // Protected Admin Routes
    Route::middleware(['auth.admin'])->group(function () {
        
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Categories
        Route::resource('categories', AdminCategoryController::class);
        
        // Products
        Route::resource('products', AdminProductController::class);
        Route::delete('/products/image/{image}', [AdminProductController::class, 'deleteImage'])->name('products.deleteImage');
        
        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::patch('/orders/{order}/payment', [AdminOrderController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus');
        Route::get('/orders/{order}/whatsapp', [AdminOrderController::class, 'whatsapp'])->name('orders.whatsapp');
        Route::get('/orders/{order}/customer-whatsapp', [AdminOrderController::class, 'customerWhatsapp'])->name('orders.customerWhatsapp');
        
        // Coupons
        Route::resource('coupons', AdminCouponController::class);
    });

   

});