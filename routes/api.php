<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'api'], function ($router) {
    Route::group(['prefix' => 'v1'], function ($router) {
        Route::group(['prefix' => 'auth'], function ($router) {
            Route::post('login', 'Api\Auth\AuthController@login');
            Route::post('logout', 'Api\Auth\AuthController@logout');
            Route::post('refresh', 'Api\Auth\AuthController@refresh');
            Route::get('me', 'Api\Auth\AuthController@me');
        });

        // Rutas para las empresas
        Route::apiResource('companies', 'Api\Company\CompanyController', [
            'only' => ['index', 'show'],
            'as'=>'api'
        ]);
        Route::apiResource('companies.clients', 'Api\Company\CompanyClientController', [
            'only' => ['index', 'store'],
            'as'=>'api'
        ]);
        Route::apiResource('clients', 'Api\Client\ClientController', [
            'only' => ['show', 'update'],
            'as'=>'api'
        ]);
    });
});
