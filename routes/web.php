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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('barcode', 'BardcodesController@create');

Route::get('/home', function () {
    return view('home');
})->name('home')/*->middleware('auth')*/;


Route::get('/iventory', function () {

    return view('products.index');
});

Route::get('/iventory/create', function () {

    return view('products.create');
});

Route::get('/iventory/edit', function () {

    return view('products.edit');
});
Route::get('get-role-permissions/{id}', 'EmployeeController@getRolePermissions');

Route::middleware('auth')->group(function () {
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


Route::get('/profile', function () {

    return view('profile.index');
});


Route::get('/reports', function () {

    return view('reports.index');
});

Route::get('/reports/employees', function () {

    return view('reports.employee_report');
});
