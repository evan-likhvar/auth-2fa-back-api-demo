<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Auth::routes(['verify' => true]);
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/home', 'HomeController@index')
//    ->middleware(['auth', '2fa', 'verified'])->name('home');


Route::get('/2fa/activate', 'Auth\G2FAController@show2faActivate')->name('profile.2fa.activate.show');
Route::post('/2fa/activate', 'Auth\G2FAController@enable2fa')->name('profile.2fa.activate');
Route::post('/2fa/verify', 'Auth\G2FAController@verify')->name('profile.2fa.verify')->middleware('2fa');
Route::post('/2fa/disable_2fa', 'Auth\G2FAController@disable2fa')->name('profile.2fa.disable')->middleware('2fa');
