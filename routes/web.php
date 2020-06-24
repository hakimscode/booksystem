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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UsersController@index')->name('users');
Route::get('/insert-user', 'UsersController@create')->name('insert-user');
Route::post('/store-user', 'UsersController@store')->name('store-user');
Route::get('/edit-user/{id}', 'UsersController@edit');
Route::post('/update-user', 'UsersController@update')->name('update-user');
Route::get('/delete-user/{id}', 'UsersController@destroy');
