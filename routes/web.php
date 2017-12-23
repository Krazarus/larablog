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

Route::get('/whoops', function () {
    return ("Whoops is something wrong!");
});

Route::get('/test', function () {
//    echo str_ireplace("world","Petro","Привет МИР!");
});

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/', 'PostsController@index')->name('home');
Route::resource('posts', 'PostsController');
//Route::resource('filters', 'FiltersController');
Route::post('/posts/{post}/likes', 'LikesController@store');
Route::delete('/posts/{post}/likes', 'LikesController@destroy');

Route::get('/filters', 'FiltersController@index');
Route::post('/filters/{filter}', 'FiltersController@store');
Route::delete('/filters/{filter}', 'FiltersController@destroy');
