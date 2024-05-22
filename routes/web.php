<?php

use App\Http\Controllers\AddtocartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CouponController;
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
    // Route::get('/', 'user_data');
});

Route::controller(CategoryController::class)->group(function () {

    Route::view('category', 'admin/layout/category');
    Route::post('add_category', 'add_category');
    Route::get('category', 'index');
    Route::get('delete_category/{id}', 'delete');
    Route::get('edit_category/{id}', 'edit');
    Route::post('edit_category/update_category', 'update');
});

Route::controller(ProductController::class)->group(function () {

    // Route::view('product', 'admin/layout/product/product');
    Route::post('add_product', 'add_product');
    Route::get('add_product', 'index_2');
    Route::get('product', 'index');
    Route::get('delete_product/{id}', 'delete');
    Route::get('edit_product/{id}', 'edit');
    Route::post('edit_product/update_product', 'update');
    Route::get('all_product', 'show_product');
    Route::get('all_product/{men}', 'show_product_cat');
    Route::get('product-detail/{id}', 'product_detail');
});

Route::controller(WishlistController::class)->group(function () {
    Route::get('wishlist', 'wishlist');
    Route::post('add-to-wishlist', 'add_to_wishlist');
    Route::post('remove-all-wishlist', 'remove_all_wishlist');
});

Route::controller(AddtocartController::class)->group(function () {
    Route::post('add-to-cart', 'add_to_cart');
    Route::get('cart', 'cart');
    Route::post('delete-cart/{id}', 'delete');
    Route::post('remove-all-cart', 'remove_all_cart');
});


Route::controller(CouponController::class)->group(function () {
    Route::get('add-coupon', 'add_coupon');
});
// Route::view('add-to-cart', 'add_to_cart');
// Route::view('cal', 'cal');
