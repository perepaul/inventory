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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    //sales
    Route::get('sales', 'SalesController@index')->name('sales.index');
    Route::get('sales/boot', 'SalesController@boot')->name('sales.boot');
    Route::get('sales/search', 'SalesController@search')->name('sales.search');
    Route::get('sales/add', 'SalesController@addProduct')->name('sales.add-product');
    Route::get('sales/add-sku', 'SalesController@addProductSku')->name('sales.add-produduct.sku');
    Route::get('sales/{id}/delete', 'SalesController@deleteItem')->name('sales.delete.item');
    Route::get('sales/delete-all', 'SalesController@deleteAll')->name('sales.delete.all');
    Route::get('sales/{id}/update/{quantity}', 'SalesController@update')->name('sales.update');
    Route::post('sales/checkout', 'SalesController@checkout')->name('sales.checkout');

    //sales receipt
    Route::get('sales/{reference}/print', 'SalesController@printRecept')->name('sales.print.receipt');

    //inventories
    Route::resource('inventories', 'ProductsController')->only(['index', 'create', 'store', 'edit', 'update']);
    Route::get('inventories/{inventory}/destroy', 'ProductsController@destroy')->name('inventories.destroy');

    //purchases

    Route::get('purchase', 'PurchaseController@index')->name('purchase.index');
    Route::post('purchase', 'PurchaseController@store')->name('purchase.store');
    Route::get('purchase/{id}', 'PurchaseController@show')->name('purchase.show');

    //profile
    Route::get('/profile', 'EmployeeController@showProfileForm');
    Route::post('/profile/{id}', 'EmployeeController@updateProfile')->name('user.updateProfile');

    //users
    Route::get('/users', 'EmployeeController@index')->name('user.index');
    Route::get('/users/create', 'EmployeeController@create')->name('user.create');
    Route::post('/users/store', 'EmployeeController@store')->name('user.store');
    Route::get('/users/edit/{id}', 'EmployeeController@edit')->name('user.edit');
    Route::post('/users/{id}/update', 'EmployeeController@update')->name('user.update');
    Route::get('users/{id}/destroy', 'EmployeeController@destroy')->name('user.destroy');

    //settings
    Route::get('/settings', 'StoreSettingsController@index')->name('settings.index');
    Route::post('/settings', 'StoreSettingsController@store')->name('settings.create');
    Route::put('/settings', 'StoreSettingsController@update')->name('settings.update');
});


Route::get('reports/inventory', 'ReportController@inventory')->name('reports.inventory');
Route::get('reports/purchase', 'ReportController@purchase')->name('reports.purchase');
Route::get('reports/sales', 'ReportController@sales')->name('reports.sales');
Route::get('reports/profit-loss', 'ReportController@profitLoss')->name('reports.profit.loss');

Route::get('/reports', function () {

    return view('reports.index');
});

Route::get('/reports/employees', function () {

    return view('reports.employee_report');
});
