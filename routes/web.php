<?php

use App\Http\Controllers\AdminArea\CustomerController as AdminCustomerController;
use App\Http\Controllers\AdminArea\HomeController as AdminHomeController;
use App\Http\Controllers\AdminArea\BookingController as AdminBookingController;
use App\Http\Controllers\AdminArea\BusImageController as AdminBusImageController;
use App\Http\Controllers\AdminArea\BannerController as AdminBannerController;
use App\Http\Controllers\AdminArea\CategoryController as AdminCategoryController;
use App\Http\Controllers\AdminArea\BusController as AdminBusController;
use App\Http\Controllers\AdminArea\BusStopController;
use App\Http\Controllers\AdminArea\CartItemController as AdminCartItemController;
use App\Http\Controllers\AdminArea\PaymentController as AdminPaymentController;
use App\Http\Controllers\AdminArea\UsersController as AdminUsersController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PublicArea\BannerController as PublicBannerController;
use App\Http\Controllers\PublicArea\CategoryController as PublicCategoryController;
use App\Http\Controllers\PublicArea\HomeController as PublicHomeController;
use App\Http\Controllers\PublicArea\BusController as PublicBusController;
use App\Http\Controllers\PublicArea\ProfileController as PublicProfileController;
use App\Http\Controllers\PublicArea\BookingController as PublicBookingController;
use App\Http\Controllers\PublicArea\PaymentController as PublicPaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Public*/

Route::get('/', [PublicHomeController::class, 'index'])->name('home');
Route::get('/categories', [PublicHomeController::class, 'categories'])->name('categories');
Route::get('/contact', [PublicHomeController::class, 'contact'])->name('contact');
Route::get('/history', [PublicHomeController::class, 'history'])->name('history');

Route::get('/payments', [PublicHomeController::class, 'payments'])->name('payments');

Route::prefix('banners')->group(function () {
    Route::get('/get', [PublicBannerController::class, 'get'])->name('banner.get');
});

Route::prefix('categories')->group(function () {
    Route::get('/', [PublicCategoryController::class, 'index'])->name('categories');
    Route::get('/all', [PublicCategoryController::class, 'all'])->name('category.all');
    Route::get('{category_id}/get', [PublicCategoryController::class, 'get'])->name('category.get');
});

Route::prefix('buses')->group(function () {
    Route::get('/', [PublicBusController::class, 'index'])->name('buses.index');
    Route::get('/{bus_id}/single/product', [PublicBusController::class, 'singleProduct'])->name('buses.single');
    Route::get('/all', [PublicBusController::class, 'all'])->name('buses.all');
    Route::get('/{bus_id}/get', [PublicBusController::class, 'get'])->name('buses.get');
    Route::post('/filter', [PublicBusController::class, 'filter'])->name('buses.filter');
    Route::post('/search', [PublicBusController::class, 'search'])->name('buses.search');
});

Route::prefix('customer')->group(function () {
    Route::get('/', [PublicProfileController::class, 'index'])->name('customer.index');
    Route::get('/login', [PublicProfileController::class, 'login'])->name('customer.login');
    Route::get('/register', [PublicProfileController::class, 'register'])->name('customer.register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('customer.register.store');
    Route::get('/delete', [PublicProfileController::class, 'deleteIndex'])->name('customer.delete.index');
});

Route::prefix('booking')->group(function () {
    Route::get('/{bus_id}', [PublicBookingController::class, 'index'])->name('booking.index');
    Route::get('/{customer_id}/get', [PublicBookingController::class, 'get'])->name('booking.get');
    Route::post('/store', [PublicBookingController::class, 'store'])->name('booking.store');
    Route::post('/{booking_id}/update', [PublicBookingController::class, 'update'])->name('booking.update');
    Route::delete('/{booking_id}/delete', [PublicBookingController::class, 'delete'])->name('booking.delete');
    Route::get('/{booking_id}/status', [PublicBookingController::class, 'status'])->name('booking.status.update');
    Route::get('/user/history', [PublicBookingController::class, 'userPage'])->name('booking.user.index');
    Route::get('/user/history/data', [AdminBookingController::class, 'allUserBookings'])->name('booking.user.data');
});

Route::get('/payment', [PublicPaymentController::class, 'index'])->name('payment.index');

/*Admin Area*/
Route::prefix('admin')->group(function () {

    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.dashboard');

    // Admin-banner
    Route::prefix('banner')->group(function () {
        Route::get('/', [AdminBannerController::class, 'index'])->name('admin.banner.index');
        Route::get('/all', [AdminBannerController::class, 'all'])->name('admin.banner.all');
        Route::get('/{banner_id}/get', [AdminBannerController::class, 'get'])->name('admin.banner.get');
        Route::post('/store', [AdminBannerController::class, 'store'])->name('admin.banner.store');
        Route::post('/{banner_id}/update', [AdminBannerController::class, 'update'])->name('admin.banner.update');
        Route::delete('/{banner_id}/delete', [AdminBannerController::class, 'delete'])->name('admin.banner.delete');
        Route::get('/{banner_id}/status', [AdminBannerController::class, 'status'])->name('admin.banner.status.update');
    });

    // Admin-category
    Route::prefix('category')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/all', [AdminCategoryController::class, 'all'])->name('admin.category.all');
        Route::get('{category_id}/get', [AdminCategoryController::class, 'get'])->name('admin.category.get');
        Route::post('/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
        Route::post('/{category_id}/update', [AdminCategoryController::class, 'update'])->name('admin.category.update');
        Route::post('/{category_id}/delete', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
        Route::post('/filter', [AdminCategoryController::class, 'filter'])->name('admin.category.filter');
        Route::get('/{category_id}/status', [AdminCategoryController::class, 'status'])->name('admin.category.status.update');
    });
    // Admin-users
    Route::prefix('user')->group(function () {
        Route::get('/', [AdminUsersController::class, 'index'])->name('admin.user.index');
        Route::get('/all', [AdminUsersController::class, 'all'])->name('admin.user.all');
        Route::get('/{user_id}/get', [AdminUsersController::class, 'get'])->name('admin.user.get');
        Route::post('/store', [AdminUsersController::class, 'store'])->name('admin.user.store');
        Route::post('/{user_id}/update', [AdminUsersController::class, 'update'])->name('admin.user.update');
        Route::delete('/{user_id}/delete', [AdminUsersController::class, 'delete'])->name('admin.user.delete');
        Route::post('/filter', [AdminUsersController::class, 'filter'])->name('admin.user.filter');
    });

    // Admin-bus
    Route::prefix('bus')->group(function () {
        Route::get('/', [AdminBusController::class, 'index'])->name('admin.bus.index');
        Route::get('/all', [AdminBusController::class, 'all'])->name('admin.bus.all');
        Route::get('/{product_id}/get', [AdminBusController::class, 'get'])->name('admin.bus.get');
        Route::post('/store', [AdminBusController::class, 'store'])->name('admin.bus.store');
        Route::get('/{product_id}/edit', [AdminBusController::class, 'edit'])->name('admin.bus.edit');
        Route::post('/{product_id}/update', [AdminBusController::class, 'update'])->name('admin.bus.update');
        Route::delete('/{product_id}/delete', [AdminBusController::class, 'delete'])->name('admin.bus.delete');
        Route::post('/filter', [AdminBusController::class, 'filter'])->name('admin.bus.filter');
    });

    // Admin-bus-image
    Route::prefix('bus-image')->group(function () {
        Route::get('/{product_id}/all', [AdminBusImageController::class, 'all'])->name('admin.bus.image.all');
        Route::post('/store', [AdminBusImageController::class, 'store'])->name('admin.bus.image.store');
        Route::post('/primary', [AdminBusImageController::class, 'primary'])->name('admin.bus.image.primary');
        Route::post('/{product_image_id}/delete', [AdminBusImageController::class, 'delete'])->name('admin.bus.image.delete');
    });

    // Admin-customer
    Route::prefix('customer')->group(function () {
        Route::get('/', [AdminCustomerController::class, 'index'])->name('admin.customer.index');
        Route::get('/all', [AdminCustomerController::class, 'all'])->name('admin.customer.all');
        Route::get('/{customer_id}/edit', [AdminCustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::get('/{customer_id}/get', [AdminCustomerController::class, 'get'])->name('admin.customer.get');
        Route::post('/store', [AdminCustomerController::class, 'store'])->name('admin.customer.store');
        Route::post('/{customer_id}/update', [AdminCustomerController::class, 'update'])->name('admin.customer.update');
        Route::delete('/{customer_id}/delete', [AdminCustomerController::class, 'delete'])->name('admin.customer.delete');
    });
    // admin-bus-stop
    Route::prefix('bus-stop')->group(function () {
        Route::get('/', [BusStopController::class, 'index'])->name('admin.bus.stop.index');
        Route::get('/{bus_id}/all', [BusStopController::class, 'all'])->name('admin.bus.stop.all');
        Route::get('/{bus_id}/list', [BusStopController::class, 'list'])->name('admin.bus.stop.list');
        Route::get('/{bus_stop_id}/get', [BusStopController::class, 'get'])->name('admin.bus.stop.get');
        Route::post('/store', [BusStopController::class, 'store'])->name('admin.bus.stop.store');
        Route::post('/{bus_stop_id}/update', [BusStopController::class, 'update'])->name('admin.bus.stop.update');
        Route::delete('/{bus_stop_id}/delete', [BusStopController::class, 'delete'])->name('admin.bus.stop.delete');
    });

    //Payments
    Route::prefix('payment')->group(function () {
        Route::get('/', [AdminPaymentController::class, 'index'])->name('admin.payment.index');
        Route::get('/all', [AdminPaymentController::class, 'all'])->name('admin.payment.all');
        Route::get('/{payment_id}/get', [AdminPaymentController::class, 'get'])->name('admin.payment.get');
        Route::post('/store', [AdminPaymentController::class, 'store'])->name('admin.payment.store');
        Route::post('/{payment_id}/update', [AdminPaymentController::class, 'update'])->name('admin.payment.update');
        Route::delete('/{payment_id}/delete', [AdminPaymentController::class, 'delete'])->name('admin.payment.delete');
    });

    Route::prefix('cart-items')->group(function () {
        Route::post('store', [AdminCartItemController::class, 'store'])->name('admin.cart.item.store');
    });

    Route::prefix('booking')->group(function () {
        Route::get('/', [AdminBookingController::class, 'index'])->name('admin.booking.index');
        Route::get('/all', [AdminBookingController::class, 'all'])->name('admin.booking.all');
        Route::get('/{booking_id}/get', [AdminBookingController::class, 'get'])->name('admin.booking.get');
        Route::post('/store', [AdminBookingController::class, 'store'])->name('admin.booking.store');
        Route::post('/{booking_id}/update', [AdminBookingController::class, 'update'])->name('admin.booking.update');
        Route::delete('/{booking_id}/delete', [AdminBookingController::class, 'delete'])->name('admin.booking.delete');
        Route::get('/{booking_id}/status', [AdminBookingController::class, 'status'])->name('admin.booking.status.update');
    });
});

require __DIR__ . '/auth.php';
