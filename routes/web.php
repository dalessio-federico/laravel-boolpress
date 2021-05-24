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
            Route::get('/profile', 'HomeController@profile')->name('admin-profile');
            Route::post('/profile7generate-token', 'HomeController@generateToken')->name('admin.generateToken');
            Route::resource('/posts', 'PostController')->names([
                'store'=>"admin.posts.store",
                'index'=>"admin.posts.index",
                'create'=>"admin.posts.create",
                'destroy'=>"admin.posts.destroy",
                'update'=>"admin.posts.update",
                'show'=>"admin.posts.show",
                'edit'=>"admin.posts.edit"
            ]);
            Route::resource('post', PostController::class)->parameters([
                'post' => 'slug'
            ]);
            
        });


Route::get('/post', 'PostController@index')->name('post_index');
Route::get('/post/{slug}', 'PostController@show')->name('post_details');

Route::get('/', 'HomeController@index')->name('guest_home');
