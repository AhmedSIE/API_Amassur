<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',        'AuthController@login');
    Route::post('logout',       'AuthController@logout');
    Route::post('register',     'AuthController@register');
    Route::get('partir/{id}',   'AuthController@destroy');
    Route::post('refresh',      'AuthController@refresh');
    Route::post('user',         'AuthController@user');

});

Route::apiResource('produits',              'ProduitController');
Route::apiResource('origines',              'OrigineController');

Route::get('produits/{produit}/origines',   'OrigineController@index');

Route::get('users/produits',                'UserController@index');
Route::post('user/produits',                'UserController@show');


// Route::middleware('auth:api')->post('/user', function (Request $request) {
//     return $request->user();
// });
