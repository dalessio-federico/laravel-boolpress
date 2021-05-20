<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Route::resource('/post', 'PostController',['parameters' => ['post' => 'slug']]);

Route::get('/user', 'UserController@index');
Route::get('/user{id}', 'UserController@show')->name('user.show');

Auth::routes(/*['register'=>FALSE] per togliere la parte di registrazione*/);

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
        });