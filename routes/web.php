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

Route::resource('todo', 'ToDoController');
Route::get('/todo/{id}/done', 'ToDoController@done')->name('todo.done');
Route::get('/todo/{id}/undone', 'ToDoController@undone')->name('todo.undone');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
