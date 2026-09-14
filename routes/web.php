<?php

use App\Http\Controllers\EasybuyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AiHistoryController;
use App\Http\Controllers\SourcingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [EasybuyController::class, 'index'])->name('landing');

// Auth View Routes
Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/forgot-password', 'auth.forgot-password')->name('forgot-password');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password/send', [AuthController::class, 'sendResetCode']);
    Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword']);
});

// Auth Action Routes
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Home Dashboard & Wholesale Catalog
Route::get('/home', [ProductController::class, 'index'])->middleware('auth')->name('home');
Route::get('/catalog', [ProductController::class, 'catalog'])->middleware('auth')->name('catalog');
Route::get('/home/catalog', function() {
    return redirect()->route('catalog');
})->middleware('auth');

// Product Detail & Show
Route::get('/home/product/{id}', [ProductController::class, 'show'])->middleware('auth')->name('product.show');
Route::get('/product/{id}', function($id) {
    return redirect('/home/product/' . $id);
})->middleware('auth');

// Product CRUD (Supplier / Admin)
Route::post('/products', [ProductController::class, 'store'])->middleware('auth')->name('products.store');
Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('auth')->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('auth')->name('products.destroy');

// Procurement Cart Routes
Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart');
Route::get('/home/cart', function() {
    return redirect()->route('cart');
})->middleware('auth');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/sync', [CartController::class, 'sync'])->name('cart.sync');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.delete');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Checkout & Paystack Payment Routes
Route::get('/checkout', [PaymentController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::post('/payment/initialize', [PaymentController::class, 'initialize'])->middleware('auth')->name('payment.initialize');
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::post('/payment/webhook', [PaymentController::class, 'webhook'])->name('payment.webhook');
Route::get('/order/invoice/{orderNumber}', [PaymentController::class, 'invoice'])->middleware('auth')->name('order.invoice');
Route::post('/order/invoice/{orderNumber}/email', [PaymentController::class, 'resendEmail'])->middleware('auth')->name('order.invoice.email');

// Supplier Portal & Workspace Routes
Route::view('/supplier', 'supplier-onboard')->name('supplier.onboard');
Route::view('/supplier/register', 'supplier-onboard')->name('supplier.register');
Route::view('/become-a-supplier', 'supplier-onboard')->name('become-a-supplier');
Route::post('/supplier/apply', [SupplierController::class, 'apply'])->name('supplier.apply');
Route::get('/supplier/status', [SupplierController::class, 'status'])->middleware('auth')->name('supplier.status');
Route::get('/supplier/portal', function() {
    return redirect()->route('supplier.status');
})->middleware('auth');
Route::get('/supplier/dashboard', [SupplierController::class, 'dashboard'])->middleware('auth')->name('supplier.dashboard');
Route::post('/supplier/order-item/{id}/status', [SupplierController::class, 'updateOrderStatus'])->middleware('auth')->name('supplier.order.status');

// Admin Central Operations Panel (SuperAdmin Only)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::post('/supplier-applications/{id}/approve', [AdminController::class, 'approveApplication'])->name('applications.approve');
    Route::post('/supplier-applications/{id}/reject', [AdminController::class, 'rejectApplication'])->name('applications.reject');
    Route::post('/supplier/{id}/tier', [AdminController::class, 'updateSupplierTier'])->name('supplier.tier');
    Route::post('/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('users.role');
    Route::post('/users/{id}/status', [AdminController::class, 'updateUserStatus'])->name('users.status');
    Route::post('/users/{id}/reset-password', [AdminController::class, 'resetUserPassword'])->name('users.reset_password');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('products.destroy');
});

// AI Sourcing Engine & Simulation Endpoints
Route::post('/api/sourcing/simulate', [SourcingController::class, 'simulate'])->name('sourcing.simulate');
Route::post('/api/sourcing/convert-to-cart', [SourcingController::class, 'convertToCart'])->name('sourcing.convert');

// AI Conversation History & Real-Time Procurement Chat Endpoints
Route::get('/api/ai/conversations', [AiHistoryController::class, 'index'])->name('ai.conversations');
Route::get('/api/ai/conversations/{id}', [AiHistoryController::class, 'show'])->name('ai.conversation.show');
Route::post('/api/ai/chat', [AiHistoryController::class, 'chat'])->name('ai.chat');
Route::delete('/api/ai/conversations/{id}', [AiHistoryController::class, 'delete'])->name('ai.conversation.delete');

