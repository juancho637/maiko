<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Login routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password reset routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Verification user
Route::get('users/verify/{token}', 'Dashboard\User\UserController@verify_form')->name('dashboard.users.verify');
Route::post('users/verify', 'Dashboard\User\UserController@verify')->name('dashboard.users.verify');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('users', 'Dashboard\User\UserController', ['as' => 'dashboard']);
    Route::resource('roles', 'Dashboard\Role\RoleController', ['as' => 'dashboard']);
    Route::resource('companies', 'Dashboard\Company\CompanyController', ['as' => 'dashboard']);
    Route::resource('companies.clients', 'Dashboard\Company\CompanyClientController', [
        'except' => ['index'],
        'as' => 'dashboard',
    ]);
    Route::resource('tanks', 'Dashboard\Tank\TankController', ['as' => 'dashboard']);
    Route::resource('work_orders', 'Dashboard\WorkOrder\WorkOrderController', ['as' => 'dashboard']);
    Route::resource('work_orders.inspections', 'Dashboard\WorkOrder\WorkOrderInspectionController', [
        'except' => ['create', 'store'],
        'as' => 'dashboard',
    ]);
    Route::get('inspections/{inspection}/approved', 'Dashboard\Inspection\InspectionController@approved')
        ->name('dashboard.inspections.approved');
    Route::get('inspections/{inspection}/rejected', 'Dashboard\Inspection\InspectionController@rejected')
        ->name('dashboard.inspections.rejected');

    Route::group(['prefix' => 'settings'], function () {
        Route::resource('questions', 'Dashboard\Question\QuestionController', ['as' => 'dashboard']);
    });

    Route::group(['prefix' => 'zones'], function () {
        Route::resource('countries', 'Dashboard\Country\CountryController', ['as' => 'dashboard']);
        Route::resource('states', 'Dashboard\State\StateController', ['as' => 'dashboard']);
        Route::resource('cities', 'Dashboard\City\CityController', ['as' => 'dashboard']);
    });
});

Route::group(['prefix' => 'datatable', 'middleware' => ['auth']], function () {
    Route::resource('users', 'DataTable\User\UserController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('roles', 'DataTable\Role\RoleController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('countries', 'DataTable\Country\CountryController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('states', 'DataTable\State\StateController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('cities', 'DataTable\City\CityController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('companies', 'DataTable\Company\CompanyController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('companies.clients', 'DataTable\Company\CompanyClientController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('tanks', 'DataTable\Tank\TankController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('work_orders', 'DataTable\WorkOrder\WorkOrderController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('work_orders.inspections', 'DataTable\WorkOrder\WorkOrderInspectionController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('questions', 'DataTable\Question\QuestionController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
    Route::resource('inspections.answers', 'DataTable\Inspection\InspectionAnswerController', [
        'only' => ['index'],
        'as' => 'datatable'
    ]);
});

// Select2
Route::group(['prefix' => 'select2', 'middleware' => ['auth']], function () {
    Route::resource('states', 'Select2\StateController', ['only' => ['index'], 'as' => 'select2']);
    Route::resource('cities', 'Select2\CityController', ['only' => ['index'], 'as' => 'select2']);
    Route::resource('clients', 'Select2\ClientController', ['only' => ['index'], 'as' => 'select2']);
    Route::resource('tanks', 'Select2\TankController', ['only' => ['index'], 'as' => 'select2']);
});
