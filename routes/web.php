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

Route::get('/', 'HomeController@index');

Route::post('/cadastro_pessoa_fisica', 'HomeController@cadastro_pessoa_fisica');
Route::post('/cadastro_pessoa_juridica', 'HomeController@cadastro_pessoa_juridica');

Route::get("/users", "UsersController@listAll");
Route::get("/users/{id_user}", "UsersController@specific");
