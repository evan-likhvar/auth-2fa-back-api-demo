<?php
Route::post('oauth/login', 'Auth\ApiAuthController@login');
//Route::post('oauth/logout', 'Auth\ApiLogoutController')->middleware('auth:api');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
