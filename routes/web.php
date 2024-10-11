<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BorderController;
use App\Http\Controllers\Admin\ToppingController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\WebProductController;
use App\Http\Controllers\Web\WebCategoryController;
use App\Http\Controllers\Web\WebCustomerController;
use App\Http\Controllers\Web\WebAuthController;
use App\Http\Controllers\Web\WebCartController;
use App\Http\Controllers\Web\WebOrderController;


Route::get('/', [HomeController::class, 'index'])->name('web.home');
Route::get('/pizza', [WebProductController::class, 'index'])->name('web.product.list');
Route::get('/pizza/{slug}', [WebProductController::class, 'detail'])->name('web.product.detail');
Route::get('/loai-pizza/{category}', [WebCategoryController::class, 'index'])->name('web.category.index');

Route::get('/khach-hang/', [WebCustomerController::class, 'index'])->name('web.customer.index');

Route::get('/khach-hang/cap-nhat', [WebCustomerController::class, 'update'])->name('web.customer.update');


Route::get('/don-hang/{order}', [WebCustomerController::class, 'detailOrder'])->name('web.customer.detailOrder');

Route::get('/tai-khoan/', [WebAuthController::class, 'index'])->name('web.auth');

Route::get('/gio-hang/', [WebCartController::class, 'index'])->name('web.cart');

Route::get('/dat-hang/', [WebOrderController::class, 'index'])->name('web.order');


Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::get('/category/update', [CategoryController::class, 'update'])->name('admin.category.update');

    Route::get('/size', [SizeController::class, 'index'])->name('admin.size.index');
    Route::get('/size/create', [SizeController::class, 'create'])->name('admin.size.create');
    Route::get('/size/update', [SizeController::class, 'update'])->name('admin.size.update');

    Route::get('/border', [BorderController::class, 'index'])->name('admin.border.index');
    Route::get('/border/create', [BorderController::class, 'create'])->name('admin.border.create');
    Route::get('/border/update', [BorderController::class, 'update'])->name('admin.border.update');

    Route::get('/toppings', [ToppingController::class, 'index'])->name('admin.toppings.index');
    Route::get('/toppings/create', [ToppingController::class, 'create'])->name('admin.toppings.create');
    Route::get('/toppings/update', [ToppingController::class, 'update'])->name('admin.toppings.update');

    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::get('/product/update', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/product/size', [ProductController::class, 'size'])->name('admin.product.size');
    Route::get('/product/border', [ProductController::class, 'border'])->name('admin.product.border');
    Route::get('/product/topping', [ProductController::class, 'topping'])->name('admin.product.topping');

    Route::get('/coupon', [CouponController::class, 'index'])->name('admin.coupon.index');
    Route::get('/coupon/create', [CouponController::class, 'create'])->name('admin.coupon.create');
    Route::get('/coupon/update', [CouponController::class, 'update'])->name('admin.coupon.update');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee.index');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    Route::get('/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');

    Route::get('/customer', [UserController::class, 'index'])->name('admin.customer.index');
    Route::get('/customer/show', [UserController::class, 'show'])->name('admin.customer.show');

    Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/order/show', [OrderController::class, 'show'])->name('admin.order.show');

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
});

