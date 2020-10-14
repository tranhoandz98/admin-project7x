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

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => 'checkAdmin'], function () {
    Route::get('/', 'HomeController@index')->name('admin');
    Route::get('/logout', 'HomeController@logout')->name('logout');
    // user
    Route::get('user/getDistricts/{id}','UserController@getDistricts')->name('user.getDistricts');
    Route::get('user/search','UserController@search')->name('user.search');
    Route::resource('user', 'UserController');
    Route::get('user/changeStatus/{id}','UserController@changeStatus')->name('user.changeStatus');
    Route::resource('user', 'UserController');
    // role
    // Route::get('role/getPermission','RoleController@getPermission');
    Route::get('role/destroyRole/{id}','RoleController@destroyRole')->name('role.destroyRole');
    Route::resource('role', 'RoleController');

});
Route::get('/admin/login', 'Admin\HomeController@login')->name('login');
Route::post('/admin/login', 'Admin\HomeController@postLogin');
