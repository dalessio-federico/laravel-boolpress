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


Auth::routes();



Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function () {
            Route::get('/', 'HomeController@index')->name('admin_home');
        });


Route::get('/post', 'PostController@index')->name('post_index');
Route::get('/post/{slug}', 'PostController@show')->name('post_details');

Route::get('/', 'HomeController@index')->name('guest_home');
