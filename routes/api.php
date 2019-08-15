<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::middleware(['jwt.verify'])->group(function() {
        Route::post('logout', 'AuthController@logout');
        Route::get('user','UserController@getuser');
        Route::apiResource('category', 'CategoryController');
        Route::apiResource('customer', 'CustomerController');
        Route::apiResource('supplier', 'SupplierController');
        Route::apiResource('profile', 'ProfileController');
        Route::apiResource('qtytype', 'QtytypeController');
        Route::apiResource('product', 'ProductController');
        Route::apiResource('order', 'OrderController');
        Route::apiResource('order-detail', 'OrderDetailController');
        Route::apiResource('invoice', 'InvoiceController');
        Route::apiResource('reject', 'RejectController');
        Route::apiResource('excahnge', 'ExchangeController');
        Route::apiResource('brand', 'BrandController');

});


