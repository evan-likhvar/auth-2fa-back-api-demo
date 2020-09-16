<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
