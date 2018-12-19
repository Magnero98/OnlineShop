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

/*========== AUTH USER ROUTE =========*/

Route::middleware('isLoggedIn')->group(function(){

    Route::resource('/orders', 'OrderController')
        ->only(['index', 'show', 'update']);

    Route::resource('/users', 'UserController')
        ->only(['show', 'edit', 'update', 'destroy']);

});


/*========== ROUTE GROUPS =========*/

Route::group(['as' => 'admin::', 'middleware' => ['isLoggedIn', 'isAdmin']], function (){

    Route::resource('/users', 'UserController')
        ->only(['index']);

    Route::resource('/products', 'ProductController')
        ->except(['index', 'show']);

});

Route::group(['as' => 'user::', 'middleware' => ['isLoggedIn', 'isUser']], function(){

    Route::get('/orders/create/cart', 'OrderController@create')->name('orders.create');
    Route::get('/orders/insert/cart', 'OrderController@store')->name('orders.store');
    Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');

    Route::resource('/carts', 'CartController')
        ->except(['create', 'edit']);
    Route::get('/carts/clear/all', 'CartController@clear')->name('carts.clear');

});

Route::get('/products', 'ProductController@index');

/*========== GENERAL ROUTES =========*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/products', 'ProductController@index')->name('home');
Route::get('/products/{product}', 'ProductController@show')->name('products.show');