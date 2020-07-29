<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',            'AuthController@login');
    Route::post('loginemail',       'AuthController@loginemail');
    Route::post('logout',           'AuthController@logout');
    Route::post('register',         'AuthController@register');
    Route::post('photo',            'AuthController@photo');
    Route::get('partir/{id}',       'AuthController@destroy');
    Route::post('refresh',          'AuthController@refresh');
    Route::post('user',             'AuthController@user');
    Route::get('notifications',     'NotificationController@notification');

});
Route::group([

    'middleware' => 'api',
    'prefix' => 'services'

], function ($router) {

    Route::get('servicesfree',      'CarteController@free');
    Route::get('servicessilver',    'CarteController@silver');
    Route::get('servicesgold',      'CarteController@gold');
    Route::get('servicesplatinum',  'CarteController@platinum');
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'assurances'

], function ($router) {

    Route::post('assuranceAuto/save', 'AssuranceController@autosave');
    Route::post('assuranceMoto/save', 'AssuranceController@Motosave');
});


// Route::middleware('auth:api')->post('/user', function (Request $request) {
//     return $request->user();
// });
