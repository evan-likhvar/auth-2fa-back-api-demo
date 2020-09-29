<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * TODO: Данную группу роутов следует переместить в соотсветствующий middleware после того как будет работать управление доступом и разрешениями
 */
Route::prefix('localization')->group(function () {
    Route::get('/', 'LocalizationController@index')->name('admin.localization.index');
    Route::get('/{locale}/{key}', 'LocalizationController@value')->name('admin.localization.value');
    Route::post('/', 'LocalizationController@store')->name('admin.localization.create');
    Route::post('/keys', 'LocalizationController@keys')->name('admin.localization.keys');
    Route::put('/{key}', 'LocalizationController@update')->name('admin.localization.update');
    Route::delete('/{key}', 'LocalizationController@destroy')->name('admin.localization.delete');
});
