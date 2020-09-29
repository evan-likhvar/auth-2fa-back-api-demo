<?php
Route::post('oauth/login', 'Auth\ApiAuthController@login');
Route::post('oauth/register', 'Auth\RegisterController@register');
Route::get('oauth/email/verify/{id}/{hash}', 'Auth\ApiVerificationController@verify')->name('api.verification.verify');
Route::post('oauth/email/resend', 'Auth\ApiVerificationController@resend');
Route::post('oauth/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('oauth/password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/2fa/activate', 'Auth\ApiG2FAController@show2faActivate');
Route::post('/2fa/activate', 'Auth\ApiG2FAController@enable2fa');
Route::post('/2fa/disable', 'Auth\ApiG2FAController@disable2fa')->middleware('2fa');
Route::post('/2fa/login', 'Auth\ApiG2FAController@login2fa');
