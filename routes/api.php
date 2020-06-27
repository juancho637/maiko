<?php

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

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', 'Api\Auth\AuthController@login');
            Route::post('logout', 'Api\Auth\AuthController@logout');
            Route::post('refresh', 'Api\Auth\AuthController@refresh');
            Route::get('me', 'Api\Auth\AuthController@me');
        });

        // Rutas para los países
        Route::apiResource('countries', 'Api\Country\CountryController', [
            'only' => ['index', 'show'],
            'as'=>'api'
        ]);
        Route::apiResource('countries.states', 'Api\Country\CountryStateController', [
            'only' => ['index'],
            'as'=>'api'
        ]);

        // Rutas para los estados/departamentos
        Route::apiResource('states', 'Api\State\StateController', [
            'only' => ['index', 'show'],
            'as'=>'api'
        ]);
        Route::apiResource('states.cities', 'Api\State\StateCityController', [
            'only' => ['index'],
            'as'=>'api'
        ]);

        // Rutas para las ciudades
        Route::apiResource('cities', 'Api\City\CityController', [
            'only' => ['index', 'show'],
            'as'=>'api'
        ]);

        // Rutas para las empresas
        Route::apiResource('companies', 'Api\Company\CompanyController', [
            'only' => ['index', 'show'],
            'as'=>'api'
        ]);
        Route::apiResource('companies.clients', 'Api\Company\CompanyClientController', [
            'only' => ['index', 'store'],
            'as'=>'api'
        ]);

        // Rutas para los clientes
        Route::apiResource('clients', 'Api\Client\ClientController', [
            'only' => ['show', 'update'],
            'as'=>'api'
        ]);
        Route::apiResource('clients.tanks', 'Api\Client\ClientTankController', [
            'only' => ['index', 'store'],
            'as'=>'api'
        ]);

        // Rutas para los tanques
        Route::apiResource('tanks', 'Api\Tank\TankController', [
            'only' => ['show', 'update'],
            'as'=>'api'
        ]);

        // Rutas para las ordenes de trabajo
        Route::apiResource('work_orders', 'Api\WorkOrder\WorkOrderController', [
            'only' => ['index', 'show'],
            'as'=>'api'
        ]);
        Route::apiResource('work_orders.inspections', 'Api\WorkOrder\WorkOrderInspectionController', [
            'only' => ['store'],
            'as'=>'api'
        ]);
    });
});
