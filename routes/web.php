<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
    Route::get('product', 'index');
    // Route::get('delete_category/{id}', 'delete');
    // Route::get('edit_category/{id}', 'edit');
    // Route::post('edit_category/update_category', 'update');
});
