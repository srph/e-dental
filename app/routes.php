<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'dashboard'], function()
{
	/**
	 * Administrators
	 * @link dashboard/administrator/*
	 */
	Route::group([
		'namespace' => 'Administrator',
		'prefix' => 'admin'
	], function()
	{
		Route::resource('users', 'UsersController');
		Route::resource('records', 'RecordsController');
		Route::resource('schedules', 'SchedulesController');
	});

	// Route::resource('schedules', 'SchedulesController');
	// Route::resource('schedules', 'SchedulesController');
});

/**
 * Authentication
 * @link auth/*
 */
Route::group(['prefix' => 'auth'], function()
{
	Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', ['as' => 'auth.login', 'uses' => 'AuthController@postLogin']);
	Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);
});

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);