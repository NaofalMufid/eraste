<?php

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
Auth::routes();
/*
 * Product
 */
Route::get('product/trash', 'Product\ProductController@trash')->name('product.trash');
Route::post('product/restore/{id}', 'Product\ProductController@restore')->name('product.restore');
Route::delete('product/delete-permanent/{id}', 'Product\ProductController@deletePermanent')->name('product.delete-permanent');
Route::resource('product', 'Product\ProductController');

/**
 * Customer
 */
Route::get('customer/trash', 'Customer\CustomerController@trash')->name('customer.trash');
Route::post('customer/restore/{id}', 'Customer\CustomerController@restore')->name('customer.restore');
Route::delete('customer/delete-permanent/{id}', 'Customer\CustomerController@deletePermanent')->name('customer.delete-permanent');
Route::resource('customer', 'Customer\CustomerController');
/**
 * Users
 */
Route::get('user/trash', 'User\UserController@trash')->name('user.trash');
Route::post('user/restore/{id}', 'User\UserController@restore')->name('user.restore');
Route::delete('user/delete-permanent/{id}', 'User\UserController@deletePermanent')->name('user.delete-permanent');
Route::get('user/dashboard','User\UserController@dashboard')->name('dashboard');
Route::resource('user', 'User\UserController');

/**
 * Order
 */
Route::get('order/trash', 'Order\OrderController@trash')->name('order.trash');
Route::post('order/restore/{id}', 'Order\OrderController@restore')->name('order.restore');
Route::delete('order/delete-permanent/{id}', 'Order\OrderController@deletePermanent')->name('order.delete-permanent');
Route::resource('order', 'Order\OrderController');

/**
 * Front Page
 */
Route::get('/', 'FrontController@index')->name('index');
Route::get('front/cart/{pid}', 'FrontController@cart')->name('cart');
Route::post('front/buy', 'FrontController@buy')->name('buy');
Route::get('front/detail/{oid}', 'FrontController@detail')->name('detailOrder');