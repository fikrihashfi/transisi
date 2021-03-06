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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
    Route::post('/companies/create', 'CompaniesController@create')->name('companies.create');
    Route::post('/companies/update', 'CompaniesController@update')->name('companies.edit');
    Route::post('/companies/delete', 'CompaniesController@delete')->name('companies.delete');

    Route::get('/employees', 'EmployeesController@index')->name('employees.index');
    Route::post('/employees/create', 'EmployeesController@create')->name('employees.create');
    Route::post('/employees/update', 'EmployeesController@update')->name('employees.edit');
    Route::post('/employees/delete', 'EmployeesController@delete')->name('employees.delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
