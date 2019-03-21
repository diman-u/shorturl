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


Route::get('/', 'TasksController@getAll')->name('/');
Route::get('/addTask', function () {
    return view('addTask');
});
Route::post('/addTask', 'TasksController@addTask');
Route::get('/zav/{id}', 'TasksController@zav');
Route::match(['get', 'post'],'/edit/{id}', 'TasksController@edit');
Route::get('/delete/{id}', 'TasksController@delete');

Route::get('/short', 'ShortController@create');
Route::post('/short', 'ShortController@store');
Route::get('/short/{url}', 'ShortController@index');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('home', function () {
    return view('tasks');
})->name('home');;

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
