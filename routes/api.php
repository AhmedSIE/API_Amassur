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
    Route::post('edit',             'AuthController@edit');
    Route::post('montoken',         'AuthController@usertoken');
    Route::get('notifications',     'NotificationController@notification');
    Route::get('marques',           'MarqueController@index');

});
Route::group([

    'middleware' => 'api',
    'prefix' => 'services'

], function ($router) {

    Route::get('servicesfree',          'CarteController@free');
    Route::get('servicessilver',        'CarteController@silver');
    Route::get('servicesgold',          'CarteController@gold');
    Route::get('servicesplatinum',      'CarteController@platinum');
    Route::post('servicessourcription', 'CarteController@souscrire');
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'assurances'

], function ($router) {

    Route::post('assuranceAuto/save',   'AssuranceController@autosave');
    Route::post('assuranceMoto/save',   'AssuranceController@Motosave');
    Route::post('assuranceMaison/save', 'AssuranceController@maisonsave');
    Route::post('assuranceSante/save',  'AssuranceController@santesave');
    Route::post('fichiers',             'DocumentController@fichiers');
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'messages'

], function ($router) {

    Route::post('message/save', 'MessageController@save');
    Route::post('message',      'MessageController@index');
});


// Route::middleware('auth:api')->post('/user', function (Request $request) {
//     return $request->user();
// });
