<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

//Login
Route::post('login', 'Auth\PassportController@login');
Route::get('/redirect', '\App\Http\Controllers\Socialite\AuthGoogleController@redirect');
Route::get('/callback', '\App\Http\Controllers\Socialite\AuthGoogleController@callback');

//User
Route::get('user/authenticated', 'UserController@getAuthenticatedUser');
Route::post('user/{id}', 'UserController@update');
Route::resource('user', 'UserController')->except([
    'create', 'edit'
]);

//TypeAccount
Route::post('type-account/{id}', 'TypeAccountController@update');
Route::resource('type-account', 'TypeAccountController')->except([
    'create', 'edit'
]);

//Position
Route::post('position/{id}', 'PositionController@update');
Route::resource('position', 'PositionController')->except([
    'create', 'edit'
]);

//Roles
Route::post('role/{id}', 'RoleController@update');
Route::resource('role', 'RoleController')->except([
    'create', 'edit'
]);

//Procedure type
Route::post('procedure-type/{id}', 'ProcedureTypeController@update');
Route::resource('procedure-type', 'ProcedureTypeController')->except([
    'create', 'edit'
]);

//Procedure
Route::get('procedure/all', 'ProcedureController@getAllProcedures');
Route::post('procedure/{id}', 'ProcedureController@update');
Route::get('procedure/type/{id}', 'ProcedureController@showType');
Route::resource('procedure', 'ProcedureController')->except([
    'create', 'edit'
]);

//Step
Route::get('step/all', 'StepController@getAllSteps');
Route::post('step/{id}', 'StepController@update');
Route::get('step/moveUp/{id}', 'StepController@moveItemUpInList');
Route::get('step/moveDown/{id}', 'StepController@moveItemDownInList');
Route::get('step/procedure/{id}', 'StepController@showProcedure');
Route::resource('step', 'StepController')->except([
    'create', 'edit'
]);

//StepList
Route::post('steplist/{id}', 'StepListController@update');
Route::get('steplist/moveUp/{id}', 'StepListController@moveItemUpInList');
Route::get('steplist/moveDown/{id}', 'StepListController@moveItemDownInList');
Route::resource('steplist', 'StepListController')->except([
    'create', 'edit'
]);

//Organisation
Route::post('organisation/{id}', 'OrganisationController@update');
Route::resource('organisation', 'OrganisationController')->except([
    'create', 'edit'
]);

//Log
Route::resource('log', 'LogController')->except([
    'create', 'edit', 'update', 'destroy'
]);
