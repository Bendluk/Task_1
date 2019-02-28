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

//User routes

Route::GET('User','UserController@user_index')->name('User.index');
Route::GET('User/create','UserController@user_create')->name('User.create');
Route::POST('User','UserController@user_store')->name('User.store');
Route::DELETE('User{User}','UserController@user_destroy')->name('User.destroy');
Route::GET('User/{User}', 'UserController@add_to_group')->name('User.add_to_group');
Route::POST('User/{User}/add_to_group_ins/{Group}', 'UserController@add_to_group_ins')->name('User.add_to_group_ins');
Route::DELETE('User/{User}/destroy_group_entry/{Group}', 'UserController@destroy_group_entry')->name('User.destroy_group_entry');

//Group routes

Route::GET('Groups','GroupController@group_index')->name('Groups.index');
Route::GET('Groups/create','GroupController@group_create')->name('Groups.create');
Route::POST('Groups','GroupController@group_store')->name('Groups.store');
Route::DELETE('Groups/{Group}','GroupController@group_destroy')->name('Groups.destroy');
Route::GET('Groups/{Group}', 'GroupController@add_to_group')->name('Groups.add_to_group');
Route::POST('Groups/{Group}/add_to_group_ins/{User}', 'GroupController@add_to_group_ins')->name('Groups.add_to_group_ins');
Route::DELETE('Groups/{Group}/destroy_user_entry/{User}', 'GroupController@destroy_user_entry')->name('Groups.destroy_user_entry');





