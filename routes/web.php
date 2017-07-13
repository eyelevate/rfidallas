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


// HomeController
Route::get('/', 'HomeController@index')->name('home'); // Home page
Route::get('/dashboard', 'HomeController@dasbboard')->name('dashboard'); // Login Dashboard
Auth::routes(); // Handles /login and /register TODO: will update routes as need fit in future

