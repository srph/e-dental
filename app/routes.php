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

Route::group(['prefix' => 'dashboard', 'before' => 'auth'], function()
{
	/**
	 * Administrators
	 * @link dashboard/administrator/*
	 */
	Route::group([
		'namespace' => 'Administrator',
		'prefix' => 'admin',
		'before' => 'admin'
	], function()
	{
		Route::resource('users', 'UsersController');
		Route::put('users/{id}/profile', ['uses' => 'UsersController@updateProfile', 'as' => 'dashboard.admin.users.profile.update']);

		Route::resource('records', 'RecordsController');
		Route::resource('schedules', 'SchedulesController');
	});

	/**
	 * Personal
	 * @link dashboard/you/*
	 */
	Route::group([
		'namespace' => 'You',
		'prefix' => 'you'
	], function()
	{
		Route::resource('records', 'RecordsController');
		Route::resource('schedules', 'SchedulesController');

		/**
		 * @link dasboard/you/settings/*
		 */
		Route::group(['prefix' => 'settings'], function()
		{
			Route::get('/', ['as' => 'dashboard.you.settings.index', 'uses' => 'SettingsController@index']);
			Route::put('user', ['as' => 'dashboard.you.settings.user', 'uses' => 'SettingsController@user']);
			Route::put('profile', ['as' => 'dashboard.you.settings.profile', 'uses' => 'SettingsController@profile']);
		});
	});

	Route::get('/', ['as' => 'dashboard.index', 'uses' => 'You\DashboardController@index']);
});

/**
 * Authentication
 * @link auth/*
 */
Route::group(['prefix' => 'auth'], function()
{
	Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', ['as' => 'auth.auth', 'uses' => 'AuthController@postLogin']);
	Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);
});

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);