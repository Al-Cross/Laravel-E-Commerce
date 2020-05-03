<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
    Route::get('/categories', 'CategoriesController@index')->name('admin.dashboard.categories');
    Route::post('/categories', 'CategoriesController@store');
    Route::get('/categories/create', 'CategoriesController@create')->name('admin.categories.create');
    Route::get('/products/create', 'ProductUploadController@create')->name('admin.products.create');
    Route::post('/products', 'ProductUploadController@store');
});

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', 'UserController@show')->name('profile');
    Route::get('/my-profile/{user}/edit', 'UserController@edit')->name('edit.profile');
    Route::patch('/my-profile/update', 'UserController@update')->name('update.profile');
    Route::get('/my-orders', 'OrderController@index')->name('orders.index');
    Route::get('/my-orders/{order}', 'OrderController@show')->name('order.details');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cart', 'CartController@show')->name('cart');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/checkout', 'CheckoutController@store');
Route::post('/paypal-checkout', 'CheckoutController@paypal')->name('paypal');
Route::get('/cart/{id}/remove', 'CartController@destroy')->name('checkout.cart.remove');
Route::patch('/cart/{id}/update', 'CartController@update')->name('checkout.cart.update');
Route::get('/cart/clear', 'CartController@clearCart')->name('checkout.cart.clear');
Route::get('/products', 'ProductController@index');
Route::get('/products/{category:slug}/{product:slug}', 'ProductController@show');
Route::get('/{category:slug}', 'ProductController@index');
Route::post('/product/add-cart', 'ProductController@addToCart')->name('add-to-cart');
