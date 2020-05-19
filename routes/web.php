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

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');


Route::get('/iventory', function(){

    return view('products.index');

});

Route::get('/iventory/create', function(){

    return view('products.create');

});

Route::get('/iventory/edit', function(){

    return view('products.edit');

});

Route::get('/users', function(){

    return view('users.index');
});

Route::get('/users/create', function(){

    return view('users.create');
});

Route::get('/users/edit', function(){

    return view('users.edit');
});

Route::get('/profile', function(){

    return view('profile.index');

});


Route::get('/reports', function(){

    return view('reports.index');

});

Route::get('/reports/employees', function(){

    return view('reports.employee_report');

});

Route::get('/settings', function(){

    return view('settings.index');

});