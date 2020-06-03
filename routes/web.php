<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('web')->group(function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('barcode', 'BardcodesController@create');
});


Route::get('get-role-permissions/{id}', 'EmployeeController@getRolePermissions');

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::get('sales', 'SalesController@index')->name('sales.index');
    Route::get('sales/boot', 'SalesController@boot')->name('sales.boot');
    Route::get('sales/search', 'SalesController@search')->name('sales.search');
    Route::get('sales/add', 'SalesController@addProduct')->name('sales.add-product');
    Route::get('sales/{id}/delete', 'SalesController@deleteItem')->name('sales.delete.item');
    Route::get('sales/delete-all', 'SalesController@deleteAll')->name('sales.delete.all');
    Route::get('sales/{id}/update/{quantity}', 'SalesController@update')->name('sales.update');
    Route::post('sales/checkout','SalesController@checkout')->name('sales.checkout');


    Route::resource('inventories', 'ProductsController')->only(['index', 'create', 'store', 'edit', 'update']);
    Route::get('inventories/{inventory}/destroy', 'ProductsController@destroy')->name('inventories.destroy');
    Route::get('/profile', 'EmployeeController@showProfileForm');
    Route::post('/profile/{id}', 'EmployeeController@updateProfile')->name('user.updateProfile');
    Route::get('/users', 'EmployeeController@index')->name('user.index');
    Route::get('/users/create', 'EmployeeController@create')->name('user.create');
    Route::post('/users/store', 'EmployeeController@store')->name('user.store');
    Route::get('/users/edit/{id}', 'EmployeeController@edit')->name('user.edit');
    Route::post('/users/{id}/update', 'EmployeeController@update')->name('user.update');
    Route::get('users/{id}/destroy', 'EmployeeController@destroy')->name('user.destroy');
    Route::get('/settings', 'StoreSettingsController@index')->name('settings.index');
    Route::post('/settings', 'StoreSettingsController@store')->name('settings.create');
    Route::put('/settings', 'StoreSettingsController@update')->name('settings.update');
});




Route::get('/reports', function () {

    return view('reports.index');
});

Route::get('/reports/employees', function () {

    return view('reports.employee_report');
});


Route::get('/recipts', function () {

    return view('recipts.index');
});
