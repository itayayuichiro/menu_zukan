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

Route::get('/menus/search', 'MenuController@search');

Route::resource('/menus', 'MenuController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
//Route::resource('hoge', 'HogeController', ['only' => ['index', 'create', 'edit', 'store', 'destroy']]);


