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
    Route::get('/categories/create', 'CategoriesController@show')->name('admin.dashboard.create');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products', 'ProductController@index');
Route::get('/products/{category:slug}/{product:slug}', 'ProductController@show');
Route::get('/{category:slug}', 'ProductController@index');
