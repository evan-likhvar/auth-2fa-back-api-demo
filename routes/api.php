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

Route::get('settings', 'SettingsController@index');
Route::post('settings/store', 'SettingsController@store');
Route::get('settings/{setting}/show', 'SettingsController@show');
Route::put('settings/{setting}/update', 'SettingsController@update');
Route::delete('settings/{setting}/remove', 'SettingsController@destroy');

//TODO REDEVELOP REGISTERING ROUTES FOR FUTURE MODULES
//
//$modules = config('modular.modules');
//$path = config('modular.path');
//$baseNamespace = config('modular.base_namespace');
//
//if ($modules) {
//    foreach ($modules as $module => $subModules) {
//        foreach ($subModules as $key => $subModule) {
//            if (is_string($key)) {
//                $subModule = $key;
//            }
//            $relativePath = '/' . $module . '/' . $subModule;
//            $routePath = $path . $relativePath . "/Routes/web.php";
//            if (file_exists($routePath)) {
//                Route::namespace("Modules\\$module\\$subModule\\Controllers")->group();
//            }
//        }
//    }
//}

