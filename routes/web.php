<?php
use App\Http\Controllers\AdminArea\CustomerController as AdminCustomerController;
use App\Http\Controllers\AdminArea\HomeController as AdminHomeController;
use App\Http\Controllers\AdminArea\OrderController as AdminOrderController;
use App\Http\Controllers\AdminArea\ProductImageController as AdminProductImageController;
use App\Http\Controllers\AdminArea\BannerController as AdminBannerController;
use App\Http\Controllers\AdminArea\CategoryController as AdminCategoryController;
use App\Http\Controllers\AdminArea\ProductController as AdminProductController;
use App\Http\Controllers\AdminArea\CartItemController as AdminCartItemController;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PublicArea\BannerController as PublicBannerController;
use App\Http\Controllers\PublicArea\CartController as PublicCartController;
use App\Http\Controllers\PublicArea\CartItemController as PublicCartItemController;
use App\Http\Controllers\PublicArea\CategoryController as PublicCategoryController;
use App\Http\Controllers\PublicArea\HomeController as PublicHomeController;
use App\Http\Controllers\PublicArea\OrderController as PublicOrderController;
use App\Http\Controllers\PublicArea\BusController as PublicBusController;
use App\Http\Controllers\PublicArea\ProfileController as PublicProfileController;
use App\Http\Controllers\PublicArea\WishListController as PublicWishListController;
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

Route::prefix('wishlist')->group(function () {
    Route::get('/', [PublicWishListController::class, 'index'])->name('wishList.index');
    Route::post('/{customer_id}/{product_id}/add', [PublicWishListController::class, 'add'])->name('wishList.add');
    Route::post('/{customer_id}/{product_id}/remove', [PublicWishListController::class, 'remove'])->name('wishList.remove');
    Route::get('/{customer_id}/all', [PublicWishListController::class, 'all'])->name('wishList.all');
    Route::delete('/{wishList_id}/delete', [PublicWishListController::class, 'delete'])->name('wishList.delete');
    Route::get('/{customer_id}/check', [PublicWishListController::class, 'check'])->name('wishList.check');
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

Route::prefix('cart')->group(function () {
    Route::get('/', [PublicCartController::class, 'cart'])->name('cart.index');
    Route::get('/{customer_id}/get', [PublicCartController::class, 'get'])->name('cart.get');
    // Route::delete('/{cart_id}/delete', [PublicCartController::class, 'delete'])->name('cart.delete');
    Route::post('/{cart_id}/update', [PublicCartController::class, 'update'])->name('cart.update');
    Route::post('/{cart_id}/check-out', [PublicCartController::class, 'checkOut'])->name('cart.checkOut');
});

Route::prefix('cart-items')->group(function () {
    Route::post('/{customer_id}/{product_id}/store', [PublicCartItemController::class, 'store'])->name('cart.item.store');
    Route::get('/{customer_id}/get', [PublicCartItemController::class, 'get'])->name('cart.item.get');
    Route::get('/{product_id}/{customer_id}/find', [PublicCartItemController::class, 'find'])->name('cart.item.find');
    Route::post('/{cart_item_id}/quantity/update', [PublicCartItemController::class, 'updateQuantity'])->name('cart.item.quantity.update');
    Route::delete('/{cart_item_id}/all/delete', [PublicCartItemController::class, 'deleteAll'])->name('cart.item.delete.all');
    Route::delete('/{cart_item_id}/delete', [PublicCartItemController::class, 'deleteItem'])->name('cart.item.delete');
    Route::get('/{cart_item_id}/count', [PublicCartItemController::class, 'count'])->name('cart.item.count');
});

Route::prefix('order')->group(function () {
    Route::get('/{customer_id}/store', [PublicOrderController::class, 'store'])->name('order.store');
});

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

    // Admin-product
    Route::prefix('product')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('admin.product.index');
        Route::get('/all', [AdminProductController::class, 'all'])->name('admin.product.all');
        Route::get('/{product_id}/get', [AdminProductController::class, 'get'])->name('admin.product.get');
        Route::post('/store', [AdminProductController::class, 'store'])->name('admin.product.store');
        Route::get('/{product_id}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/{product_id}/update', [AdminProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/{product_id}/delete', [AdminProductController::class, 'delete'])->name('admin.product.delete');
        Route::post('/filter', [AdminProductController::class, 'filter'])->name('admin.product.filter');
    });

    // Admin-product-image
    Route::prefix('product-image')->group(function () {
        Route::get('/{product_id}/all', [AdminProductImageController::class, 'all'])->name('admin.product.image.all');
        Route::post('/store', [AdminProductImageController::class, 'store'])->name('admin.product.image.store');
        Route::post('/{request_id}/{product_id}/primary', [AdminProductImageController::class, 'primary'])->name('admin.product.image.primary');
        Route::post('/{product_image_id}/delete', [AdminProductImageController::class, 'delete'])->name('admin.product.image.delete');
    });

    // Admin-product-image
    Route::prefix('customer')->group(function () {
        Route::get('/', [AdminCustomerController::class, 'index'])->name('admin.customer.index');
        Route::get('/all', [AdminCustomerController::class, 'all'])->name('admin.customer.all');
        Route::get('/{customer_id}/edit', [AdminCustomerController::class, 'edit'])->name('admin.customer.edit');
        Route::get('/{customer_id}/get', [AdminCustomerController::class, 'get'])->name('admin.customer.get');
        Route::post('/store', [AdminCustomerController::class, 'store'])->name('admin.customer.store');
        Route::post('/{customer_id}/update', [AdminCustomerController::class, 'update'])->name('admin.customer.update');
        Route::delete('/{customer_id}/delete', [AdminCustomerController::class, 'delete'])->name('admin.customer.delete');
    });

    // Admin-order
    Route::prefix('order')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('admin.order.index');
        Route::get('/all', [AdminOrderController::class, 'all'])->name('admin.order.all');
        Route::get('/{order_id}/edit', [AdminOrderController::class, 'edit'])->name('admin.order.edit');
        Route::post('/{order_id}/update', [AdminOrderController::class, 'update'])->name('admin.order.update');
        Route::get('/{order_id}/get', [AdminOrderController::class, 'get'])->name('admin.order.get');
        Route::get('/{customer_id}/find', [AdminOrderController::class, 'find'])->name('admin.order.find');
        Route::get('/{order_id}/cart/item/get', [AdminOrderController::class, 'getCartItem'])->name('admin.order.cartItem.get');
        Route::get('/{order_id}/paid/update', [AdminOrderController::class, 'paidUpdate'])->name('admin.order.paid.update');
        Route::get('/{order_id}/shipped/update', [AdminOrderController::class, 'shippedUpdate'])->name('admin.order.shipped.update');
        Route::delete('/{order_id}/delete', [AdminOrderController::class, 'delete'])->name('admin.order.delete');
        Route::post('/{customer_id}/store', [AdminOrderController::class, 'store'])->name('admin.order.store');
    });

    Route::prefix('cart-items')->group(function () {
        Route::post('store', [AdminCartItemController::class, 'store'])->name('admin.cart.item.store');
    });
});

require __DIR__ . '/auth.php';

