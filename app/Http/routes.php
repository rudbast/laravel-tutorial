<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@index');
Route::get('home', 'PagesController@index');

Route::get('about', 'PagesController@about');

Route::get('contact', 'PagesController@contact');

/**
 * Explicit defined routes
 */
// Route::get('articles', 'ArticlesController@index');
//
// Route::get('articles/create', 'ArticlesController@create');
//
// Route::get('articles/{id}', 'ArticlesController@show');
//
// Route::get('articles/{id}/edit', 'ArticlesController@edit');
//
// Route::post('articles', 'ArticlesController@store');

/**
 * Laravel provided all in one routes
 */
Route::resource('articles', 'ArticlesController');

/**
 * Optional authentication
 */
// Route::resource('articles', [
//     'middleware' => 'auth',
//     'uses' => 'ArticlesController',
// ]);

/**
 * Authentication routes...
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

/**
 * Registration routes...
 */
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/**
 * Custom middleware example routes where only a certain user can view
 * the pages
 */
Route::get('foo', ['middleware' => 'manager', function() {
    return 'this page may only be viewed by manager';
}]);

/**
 *
 */
Route::get('tags/{tags}', 'TagsController@show');
