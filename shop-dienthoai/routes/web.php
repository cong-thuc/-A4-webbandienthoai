<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderExportController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController as CustomerOrderController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ⭐ ROUTE CHO ADMIN ⭐
Route::prefix('admin')->name('admin.')->group(function () {
    // Khi vào /admin tự động chuyển hướng tới login
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // Đăng nhập Admin (không dùng guest để luôn truy cập được)
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);

    // Các route quản trị (yêu cầu auth và is_admin)
    Route::middleware(['auth', 'is_admin'])->group(function () {
        // Dashboard Admin
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Quản lý Danh mục
        Route::resource('categories', AdminCategoryController::class);

        // Quản lý Sản phẩm
        Route::resource('products', AdminProductController::class);

        // Quản lý Đơn hàng
        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::get('orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
        Route::put('orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');

        // Quản lý tài khoản người dùng
        Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::put('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');

        // Xuất file Excel đơn hàng
        Route::get('orders/export/excel', [OrderExportController::class, 'export'])->name('orders.export');

        // Thống kê doanh thu ngày và năm
        Route::get('revenue/day', [App\Http\Controllers\Admin\RevenueController::class, 'day'])->name('revenue.day');
        Route::get('revenue/year', [App\Http\Controllers\Admin\RevenueController::class, 'year'])->name('revenue.year');
    });
});

// ⭐ ROUTE CHO KHÁCH HÀNG ⭐

// Trang chủ (Home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Danh sách sản phẩm tổng
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Xem sản phẩm theo danh mục
Route::get('/category/{id}', [ProductController::class, 'category'])->name('products.category');

// Chi tiết sản phẩm
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// Tìm kiếm sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Đặt hàng (Checkout) – yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CustomerOrderController::class, 'create'])->name('orders.create');
    Route::post('/checkout', [CustomerOrderController::class, 'store'])->name('orders.store');

    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [CustomerOrderController::class, 'show'])->name('orders.show');

    Route::get('/cart/buy-now/{id}', [App\Http\Controllers\CartController::class, 'buyNow'])->name('cart.buyNow');

    // ⭐ Route trang Tài khoản
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
});

// Auth Route (Laravel Breeze hoặc Laravel UI tự sinh ra)
require __DIR__.'/auth.php';

//login google account
 Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login-by-google');
 Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);