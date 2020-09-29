<?php

use Illuminate\Support\Facades\Route;

Route::get('rest-api/user-shop/index', 'UserShopController@index');
Route::get('rest-api/user-shop/{userShop}/index', 'UserShopController@show');
Route::post('rest-api/user-shop/store', 'UserShopController@store');
Route::post('rest-api/user-shop/{userShop}/update', 'UserShopController@update');
