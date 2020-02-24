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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'ApiController@login');
    Route::post('register', 'ApiController@register');

    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('user', 'ApiController@user');
        Route::get('logout', 'ApiController@logout');
        Route::get('refresh', 'ApiController@refresh');
    });
});

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('employee/tree/{employee?}', 'EmployeeController@employeesTree');
    Route::get('employee', 'EmployeeController@index');
    Route::get('employee/{employee}', 'EmployeeController@view');
    Route::get('employee/possible_parents/{employee}', 'EmployeeController@getPossibleParents');
    Route::put('employee', 'EmployeeController@create');
    Route::post('employee/{employee}', 'EmployeeController@update');
    Route::delete('employee/{employee}', 'EmployeeController@delete');
});
