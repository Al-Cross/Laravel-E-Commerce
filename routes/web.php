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
    Route::get('/users', 'DashboardController@show')->name('admin.dashboard.users');
    Route::get('/orders', 'DashboardController@orders')->name('admin.dashboard.orders');
    Route::get('/coupons', 'DashboardController@coupons');
    Route::post('/coupons/create', 'DashboardController@storeCoupon');
    Route::get('/coupons/new', 'DashboardController@createCoupon');
    Route::delete('/coupons/remove/{coupon}', 'DashboardController@destroyCoupon');
    Route::get('/users/search', 'DashboardController@search')->name('admin.dashboard.search');
    Route::delete('/users/{user}', 'DashboardController@destroy');
    Route::get('/categories', 'CategoriesController@index')->name('admin.dashboard.categories');
    Route::post('/categories', 'CategoriesController@store');
    Route::delete('/categories/{category}/delete', 'CategoriesController@destroy');
    Route::get('/notifications', 'NotificationsController@index');
    Route::delete('/notifications/{notification}', 'NotificationsController@destroy')->name('delete.notification');
    Route::get('/categories/create', 'CategoriesController@create')->name('admin.categories.create');
    Route::get('/products/create', 'ProductUploadController@create')->name('admin.products.create');
    Route::get('/products/create/{category}', 'ProductUploadController@create');
    Route::get('/products', 'ProductUploadController@index');
    Route::post('/products', 'ProductUploadController@store');
    Route::get('/products/{product:slug}/edit', 'ProductUploadController@edit')->name('admin.product.edit');
    Route::patch('/products/{product:slug}/update', 'ProductUploadController@update');
    Route::delete('/images/{product}/{image}/delete', 'ProductUploadController@removeImage');
    Route::delete('/products/{product}/delete', 'ProductUploadController@destroy')->name('admin.product.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', 'UserController@show')->name('profile');
    Route::get('/my-profile/{user:id}/wishlist', 'WishlistController@index')->name('wishlist');
    Route::post('/my-profile/{user:id}/wishlist', 'WishlistController@store')->name('wishlist.add');
    Route::get('/my-profile/{user:id}/wishlist/{id}/remove', 'WishlistController@destroy')->name('wishlist.remove');
    Route::get('/my-profile/{user}/edit', 'UserController@edit')->name('edit.profile');
    Route::patch('/my-profile/update', 'UserController@update')->name('update.profile');
    Route::get('/my-orders', 'OrderController@index')->name('orders.index');
    Route::get('/my-orders/{order}', 'OrderController@show')->name('order.details');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cart', 'CartController@show')->name('cart');
Route::get('/search', 'ProductController@search');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/checkout', 'CheckoutController@store');
Route::post('/coupon', 'CouponController@store');
Route::delete('/coupon', 'CouponController@destroy');
Route::post('/paypal-checkout', 'CheckoutController@paypal')->name('paypal');
Route::get('/cart/{id}/remove', 'CartController@destroy')->name('checkout.cart.remove');
Route::patch('/cart/{id}/update', 'CartController@update')->name('checkout.cart.update');
Route::get('/cart/clear', 'CartController@clearCart')->name('checkout.cart.clear');
Route::get('/products', 'ProductController@index')->name('all_products');
Route::get('/products/{category:slug}/{product:slug}', 'ProductController@show');
Route::get('/categories/{category:slug}', 'ProductController@index')->name('category');
Route::post('/product/add-cart', 'ProductController@fillCart')->name('add-to-cart');
