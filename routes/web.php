<?php

use App\Http\Controllers\AddtocartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Models\category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('protected-route', 'ProtectedController@index')->middleware('auth');


Route::view('/', 'index');
Route::view('/home', 'index');
Route::view('shop', 'shop');
Route::view('blog', 'blog');
Route::view('contact', 'contact');
Route::view('login', 'login');
Route::view('register', 'register');
Route::view('admin-login', 'admin/layout/template');
Route::view('dash', 'admin/layout/dashboard');
// Route::view('category', 'admin/layout/category');

Route::controller(UserController::class)->group(function () {
    Route::post('submit', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout');
    Route::get('user-profile', 'user_profile');
    Route::post('update-profile', 'update_profile');
    Route::post('forget-password', 'forget_password');
    Route::post('verify-otp', 'verify_otp');
    Route::get('change-password', 'change_password');
    Route::get('verify-password', 'verify_password');
    Route::post('set-password', 'set_password');
    // Route::get('/', 'user_data');
});

Route::controller(CategoryController::class)->group(function () {

    Route::view('category', 'admin/layout/category');
    Route::post('add_category', 'add_category');
    Route::get('category', 'index');
    Route::get('delete_category/{id}', 'delete');
    Route::get('edit_category/{id}', 'edit');
    Route::post('edit_category/update_category', 'update');
    Route::get('shop', 'show');
});

Route::controller(ProductController::class)->group(function () {

    // Route::view('product', 'admin/layout/product/product');
    Route::post('add_product', 'add_product');
    Route::get('add_product', 'index_2');
    Route::get('product', 'index');
    Route::get('home', 'index_3');
    Route::get('/', 'index_3');
    Route::get('delete_product/{id}', 'delete');
    Route::get('edit_product/{id}', 'edit');
    Route::post('edit_product/update_product', 'update');
    Route::get('all_product', 'show_product');
    Route::get('all_product/{men}', 'show_product_cat');
    Route::get('product-detail/{id}', 'product_detail');
    Route::get('shop', 'shop_show');
    Route::post('filter', 'filter');
    Route::get('reset', 'reset_shop');
    Route::post('latest-product', 'latest_product');
    Route::get('all-products', 'getAllProducts');
});

Route::controller(WishlistController::class)->group(function () {
    Route::get('wishlist', 'wishlist');
    Route::post('add-to-wishlist', 'add_to_wishlist');
    Route::post('remove-all-wishlist', 'remove_all_wishlist');
    Route::post('/remove-wishlist-item/{id}', 'removeItem')->name('wishlist.removeItem');
});

Route::controller(AddtocartController::class)->group(function () {
    Route::post('add-to-cart', 'add_to_cart');
    Route::get('cart', 'cart');
    Route::post('delete-cart/{id}', 'delete');
    Route::post('remove-all-cart', 'remove_all_cart');
    Route::post('update-quantity/{id}', 'updateCart');
});

Route::controller(CouponController::class)->group(function () {
    Route::post('apply-coupon', 'applyCoupon');
});
// Route::view('add-to-cart', 'add_to_cart');
// Route::view('cal', 'cal');

Route::controller(OrderController::class)->group(function () {

    Route::post('checkout', 'placeOrder')->name('checkout');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::post('/delete-temporary-order', [OrderController::class, 'deleteTemporaryOrder'])->name('deleteTemporaryOrder');
});

Route::controller(OrderDetailController::class)->group(function () {
    Route::post('payment', 'payment');
    Route::post('payment-success', 'paymentSuccess');
});

Route::controller(OrderHistoryController::class)->group(function () {

    Route::get('orders', 'show_order');
    Route::post('full_order', 'full_order');
});

Route::controller(ReviewController::class)->group(function () {
    Route::post('review', 'add_review');
    Route::get('test-api', 'test_api');
});

Route::get('send-email', [SendEmailController::class, 'send']);
