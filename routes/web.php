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
    return view('toppage');
});

//　↓　後に削除
Route::group(['prefix' => 'admin'], function() {
    
    Route::get('users/create', 'Admin\UserController@add');
    Route::post('users/create', 'Admin\UserController@create');
    Route::get('users', 'Admin\UserController@index');
    Route::get('users/show', 'Admin\UserController@show')->name('show_user');
    Route::get('users/edit', 'Admin\UserController@edit');
    Route::post('users/edit', 'Admin\UserController@update');
    
    Route::get('customers/create', 'Admin\CustomerController@add');
    Route::post('customers/create', 'Admin\CustomerController@create');
    Route::get('customers', 'Admin\CustomerController@index');
    Route::get('customers/show', 'Admin\CustomerController@show')->name('show_customer');
    Route::get('customers/edit', 'Admin\CustomerController@edit');
    Route::post('customers/edit', 'Admin\CustomerController@update');
    
    Route::get('orderers/create', 'Admin\OrdererController@add');
    Route::post('orderers/create', 'Admin\OrdererController@create');
    Route::get('orderers', 'Admin\OrdererController@index');
    Route::get('orderers/show', 'Admin\OrdererController@show')->name('show_orderer');
    Route::get('orderers/edit', 'Admin\OrdererController@edit');
    Route::post('orderers/edit', 'Admin\OrdererController@update');
    
    Route::get('projects/create', 'Admin\ProjectController@add');
    Route::post('projects/create', 'Admin\ProjectController@create');
    Route::get('projects', 'Admin\ProjectController@index');
    Route::get('projects/show', 'Admin\ProjectController@show')->name('show_project');
    Route::get('projects/edit', 'Admin\ProjectController@edit');
    Route::post('projects/edit', 'Admin\ProjectController@update');
    
    Route::get('companies/create', 'Admin\CompanyController@add');
    Route::post('companies/create', 'Admin\CompanyController@create');
    Route::get('companies', 'Admin\CompanyController@index');
    Route::get('companies/show', 'Admin\CompanyController@show')->name('show_company');
    Route::get('companies/edit', 'Admin\CompanyController@edit');
    Route::post('companies/edit', 'Admin\CompanyController@update');
    
    Route::get('branches/create', 'Admin\BranchController@add');
    Route::post('branches/create', 'Admin\BranchController@create');
    Route::get('branches', 'Admin\BranchController@index');
    Route::get('branches/show', 'Admin\BranchController@show')->name('show_branch');
    Route::get('branches/edit', 'Admin\BranchController@edit');
    Route::post('branches/edit', 'Admin\BranchController@update');
    
    //一般ユーザがいじれないようにする
    Route::get('storages/create', 'Admin\StorageController@add');
    Route::post('storages/create', 'Admin\StorageController@create');
    Route::get('storages', 'Admin\StorageController@index');
    Route::get('storages/show', 'Admin\StorageController@show')->name('show_storage');
    Route::get('storages/edit', 'Admin\StorageController@edit');
    Route::post('storages/edit', 'Admin\StorageController@update');
    
    Route::get('machines/create', 'Admin\MachineController@add');
    Route::post('machines/create', 'Admin\MachineController@create');
    Route::get('machines', 'Admin\MachineController@index');
    Route::get('machines/show', 'Admin\MachineController@show')->name('show_machine');
    // Route::get('machine/edit', 'Admin\MachineController@edit');
    // Route::post('machine/edit', 'Admin\MachineController@update');    
    
    Route::get('rental_machines/create', 'Admin\RentalMachineController@add');
    Route::post('rental_machines/create', 'Admin\RentalMachineController@create');
    Route::get('rental_machines', 'Admin\RentalMachineController@index');
    Route::get('rental_machines/show', 'Admin\RentalMachineController@show')->name('show_rental_machine');
    Route::get('rental_machines/edit', 'Admin\RentalMachineController@edit');
    Route::post('rental_machines/edit', 'Admin\RentalMachineController@update');    
    
    Route::get('orders/create', 'Admin\OrderController@add');
    Route::post('orders/create', 'Admin\OrderController@create');
    Route::get('orders', 'Admin\OrderController@index');
    
    Route::get('orders/reservations', 'Admin\OrderController@reservation');
    Route::get('orders/uses', 'Admin\OrderController@use');
    Route::get('orders/cominghomes', 'Admin\OrderController@cominghome');
    
    Route::get('orders/show', 'Admin\OrderController@show')->name('show_order');
    Route::get('orders/edit', 'Admin\OrderController@edit');
    Route::post('orders/edit', 'Admin\OrderController@update');
    Route::get('orders/delete', 'Admin\OrderController@delete');
    
});

// ログイン処理追加　後に復活 customer以外の分も
// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
//     Route::get('customers/create', 'Admin\CustomerController@add');
//     Route::post('customers/create', 'Admin\CustomerController@create');
//     Route::get('customers', 'Admin\CustomerController@index');
//     Route::get('customers/edit', 'Admin\CustomerController@edit');
//     Route::post('customers/edit', 'Admin\CustomerController@update');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
