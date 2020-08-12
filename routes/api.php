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

        // Rutas para los estados de un recurso
        Route::apiResource('statuses', 'Api\Status\StatusController', [
            'only' => ['index', 'show'],
            'as' => 'api'
        ]);

        // Rutas para los países
        Route::apiResource('countries', 'Api\Country\CountryController', [
            'only' => ['index', 'show'],
            'as' => 'api'
        ]);
        Route::apiResource('countries.states', 'Api\Country\CountryStateController', [
            'only' => ['index'],
            'as' => 'api'
        ]);

        // Rutas para los estados/departamentos
        Route::apiResource('states', 'Api\State\StateController', [
            'only' => ['index', 'show'],
            'as' => 'api'
        ]);
        Route::apiResource('states.cities', 'Api\State\StateCityController', [
            'only' => ['index'],
            'as' => 'api'
        ]);

        // Rutas para las ciudades
        Route::apiResource('cities', 'Api\City\CityController', [
            'only' => ['index', 'show'],
            'as' => 'api'
        ]);

        // Rutas para los usuarios
        Route::apiResource('users.inspections', 'Api\User\UserInspectionController', [
            'only' => ['index'],
            'as' => 'api'
        ]);

        // Rutas para las empresas
        Route::apiResource('companies', 'Api\Company\CompanyController', [
            'only' => ['index', 'show'],
            'as' => 'api'
        ]);
        Route::apiResource('companies.clients', 'Api\Company\CompanyClientController', [
            'only' => ['index', 'store'],
            'as' => 'api'
        ]);

        // Rutas para los clientes
        Route::apiResource('clients', 'Api\Client\ClientController', [
            'only' => ['show', 'update'],
            'as' => 'api'
        ]);
        Route::apiResource('clients.tanks', 'Api\Client\ClientTankController', [
            'only' => ['index', 'store'],
            'as' => 'api'
        ]);

        // Rutas para los tanques
        Route::apiResource('tanks', 'Api\Tank\TankController', [
            'only' => ['show', 'update'],
            'as' => 'api'
        ]);

        // Rutas para las ordenes de trabajo
        Route::apiResource('work_orders', 'Api\WorkOrder\WorkOrderController', [
            'only' => ['index', 'show'],
            'as' => 'api'
        ]);
        Route::apiResource('work_orders.inspections', 'Api\WorkOrder\WorkOrderInspectionController', [
            'only' => ['store'],
            'as' => 'api'
        ]);
        Route::apiResource('users.work_orders', 'Api\User\UserWorkOrderController', [
            'only' => ['index'],
            'as' => 'api'
        ]);

        // Rutas para las inspecciones
        Route::apiResource('inspections', 'Api\Inspection\InspectionController', [
            'only' => ['show', 'update'],
            'as' => 'api'
        ]);
        Route::post('inspections/{inspection}/complete', 'Api\Inspection\InspectionController@complete')
            ->name('api.inspections.complete');;

        // Rutas para las preguntas
        Route::apiResource('questions', 'Api\Question\QuestionController', [
            'only' => ['index', 'show'],
            'as' => 'api'
        ]);

        // Rutas para las respuestas
        Route::apiResource('answers', 'Api\Answer\AnswerController', [
            'only' => ['show'],
            'as' => 'api'
        ]);
        Route::apiResource('inspections.answers', 'Api\Inspection\InspectionAnswerController', [
            'only' => ['index', 'update'],
            'as' => 'api'
        ]);
        Route::apiResource('inspections.questions.answers', 'Api\Inspection\InspectionQuestionAnswerController', [
            'only' => ['store'],
            'as' => 'api'
        ]);
        Route::apiResource('dents.answers', 'Api\Dent\DentAnswerController', [
            'only' => ['index', 'update'],
            'as' => 'api'
        ]);

        // Rutas para las corrosiones
        Route::apiResource('corrosions', 'Api\Corrosion\CorrosionController', [
            'only' => ['show', 'update'],
            'as' => 'api'
        ]);
        Route::apiResource('corrosions.files', 'Api\Corrosion\CorrosionFileController', [
            'as' => 'api'
        ]);
        Route::apiResource('inspections.corrosions', 'Api\Inspection\InspectionCorrosionController', [
            'only' => ['index', 'store'],
            'as' => 'api'
        ]);

        // Rutas para las abolladuras
        Route::apiResource('dents', 'Api\Dent\DentController', [
            'only' => ['show', 'update'],
            'as' => 'api'
        ]);
        Route::apiResource('dents.files', 'Api\Dent\DentFileController', [
            'as' => 'api'
        ]);
        Route::apiResource('inspections.dents', 'Api\Inspection\InspectionDentController', [
            'only' => ['index', 'store'],
            'as' => 'api'
        ]);

        // Rutas para los accesorios
        Route::apiResource('inspections.accesories', 'Api\Inspection\InspectionAccesoryController', [
            'only' => ['index', 'store'],
            'as' => 'api'
        ]);
        Route::apiResource('accesories', 'Api\Accesory\AccesoryController', [
            'only' => ['show', 'update'],
            'as' => 'api'
        ]);

        // Rutas para los criterios de rechazo
        Route::apiResource('inspections.rejection_criterias', 'Api\Inspection\InspectionRejectionCriteriaController', [
            'only' => ['index'],
            'as' => 'api'
        ]);
        Route::apiResource('rejection_criterias', 'Api\RejectionCriteria\RejectionCriteriaController', [
            'only' => ['show'],
            'as' => 'api'
        ]);
    });
});
