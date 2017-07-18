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

/** Public pages **/ 

// Home Page
Route::get('/', 'HomeController@index')->name('home'); // Home page

// Login and Registration page
Auth::routes(); // Handles /login and /register TODO: will update routes as need fit in future
Route::get('/logout','HomeController@logout')->name('logout');

// Public Dashboard
Route::get('/dashboard','HomeController@dashboard')->name('dashboard');



