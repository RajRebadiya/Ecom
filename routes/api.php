<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CalculatorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApiController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('forget-password', 'forgetPassword');
    Route::post('verify-password', 'verifyPassword');
    Route::post('new-password', 'NewPassword');
    Route::get('show-category', 'category');
    Route::get('new-arrival', 'NewArrival');
    Route::post('wishlist', 'wishlist');
    Route::post('cart', 'cart');
    Route::post('single-delete-cart', 'SingleDeleteCart');
    Route::post('remove-all-cart', 'RemoveAllCart');
    Route::post('product-detail', 'ProductDetail');
    Route::post('search-data', 'SearchData');
    Route::post('sort-filter', 'SortFilter');
    Route::post('edit-profile', 'EditProfile');
    Route::post('order-history', 'OrderHistory');
    Route::post('single-order-history', 'SingleOrderHistory');
    Route::get('coupon', 'Coupon');
    Route::post('review', 'Review');
    Route::post('save-address', 'SaveAddress');
    Route::post('add-review', 'AddReview');
    Route::get('save-address-list', 'SaveAddressList');
    Route::post('checkout', 'Checkout');
    Route::post('checkout-payment', 'CheckoutPayment');
});
