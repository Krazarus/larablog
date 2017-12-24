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

Route::get('/test', function () {

    $array = [
        1 => [1, 4, 5, 8, 11, 23, 25, 28, 31, 44, 50],
        2 => [1, 2, 4, 7, 11, 32, 43, 46, 49],
        3 => [1, 3, 5, 6, 8, 11, 23, 33, 44, 49],
        4 => [1],
        5 => [5],
        6 => [5],
        7 => [1],
        8 => [1],
        9 => [1],
        10 => [1]

    ];
    foreach ($array as $items => $value) {
        foreach ($value as $item) {
            echo "factory->create(['user_id' => {$items}, 'liked_id' => {$item}]" . '<br>';
        }
    }
//    dd($array);
});


Auth::routes();

Route::get('/', 'PostsController@index')->name('home');
Route::resource('posts', 'PostsController');
Route::resource('filters', 'FiltersController');
Route::post('/posts/{post}/likes', 'LikesController@store');
Route::delete('/posts/{post}/likes', 'LikesController@destroy');
