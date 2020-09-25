<?php
Route::post('oauth/login', 'Auth\ApiAuthController@login');
Route::post('oauth/register', 'Auth\RegisterController@register');
Route::get('oauth/email/verify/{id}/{hash}', 'Auth\ApiVerificationController@verify')->name('api.verification.verify');
Route::post('oauth/email/resend', 'Auth\ApiVerificationController@resend');
//Route::post('oauth/logout', 'Auth\ApiLogoutController')->middleware('auth:api');
Route::post('oauth/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
