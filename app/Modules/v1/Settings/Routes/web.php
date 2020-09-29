<?php

Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'SettingsController@index');
    Route::post('/store', 'SettingsController@store');
    Route::get('{setting}/show', 'SettingsController@show');
    Route::put('{setting}/update', 'SettingsController@update');
    Route::delete('{setting}/remove', 'SettingsController@destroy');
});

