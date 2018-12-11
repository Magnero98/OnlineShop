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
        ->only(['index', 'show', 'edit', 'update']);

});


/*========== ROUTE GROUPS =========*/

Route::group(['as' => 'admin::', 'middleware' => 'isAdmin'], function (){

    Route::resource('/users', 'UserController')
        ->only(['index', 'show', 'edit', 'update', 'destroy']);

    Route::resource('/products', 'ProductController')
        ->except(['index', 'show']);

});

Route::group(['as' => 'user::', 'middleware' => 'isUser'], function(){

    Route::resource('/orders', 'OrderController')
        ->except(['index', 'show', 'edit', 'update']);

    Route::resource('/carts', 'CartController')
        ->except(['create', 'edit']);

});


/*========== GENERAL ROUTES =========*/

Auth::routes();

Route::get('/', 'ProductController@index')->name('home');

Route::resource('/products', 'ProductController')
    ->only(['index', 'show']);