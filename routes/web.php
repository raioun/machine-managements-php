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

Route::get('/', function () {
    return view('welcome');
});

//　↓　後に削除
Route::group(['prefix' => 'admin'], function() {
    Route::get('customer/create', 'Admin\CustomerController@add');
    Route::post('customer/create', 'Admin\CustomerController@create');
    Route::get('customer', 'Admin\CustomerController@index');
    Route::get('customer/show', 'Admin\CustomerController@show');
    Route::get('customer/edit', 'Admin\CustomerController@edit');
    Route::post('customer/edit', 'Admin\CustomerController@update');
});

// ログイン処理追加　後に復活
// Route::group(['prefix' => 'admin'], function() {
//     Route::get('customer/create', 'Admin\CustomerController@add')->middleware('auth');
//     Route::post('customer/create', 'Admin\CustomerController@create')->middleware('auth');
//     Route::get('customer', 'Admin\CustomerController@index')->middleware('auth');
//     Route::get('customer/edit', 'Admin\CustomerController@edit')->middleware('auth');
//     Route::post('customer/edit', 'Admin\CustomerController@update')->middleware('auth');
// });