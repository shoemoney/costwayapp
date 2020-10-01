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

Route::redirect('/', 'login');

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {

    //Costway routes
    Route::resource('costway/product', 'CostWay\ProductController');

    Route::resource('import/product', 'ImportController');

    Route::resource('tracked/products', 'TrackedProductController');
    Route::get('search/tracked/products/{value}', 'TrackedProductController@search');
});
