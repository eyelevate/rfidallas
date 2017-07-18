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

// Admin Access
Route::get('/admins/login','AdminsController@login')->name('admins_login');
Route::post('/admins/authenticate','AdminsController@authenticate')->name('admins_auth');

/** Administrative pages **/
// Redirects if role_id > 3 (employee) check middleware/Authentice class if need to change
Route::middleware(['auth'])->group(function () { 
	Route::get('/admins','AdminsController@index')->name('admins_index');
	Route::get('/admins/create','AdminsController@create')->name('admins_create');
	Route::post('/admins/store','AdminsController@store')->name('admins_store');
	Route::get('/admins/show/{admin}','AdminsController@show')->name('admins_show');
	Route::get('/admins/edit/{admin}','AdminsController@edit')->name('admins_edit');
	Route::post('/admins/update/{admin}','AdminsController@update')->name('admins_update');
	// Cards
	Route::post('/cards','CardsController@index')->name('cards_index');
	Route::get('/cards/create','CardsController@create')->name('cards_create');
	Route::post('/cards/store','CardsController@store')->name('cards_store');
	Route::get('/cards/show/{card}','CardsController@show')->name('cards_show');
	Route::get('/cards/edit/{card}','CardsController@edit')->name('cards_edit');
	Route::post('/cards/update/{card}','CardsController@update')->name('cards_update');

	// Companies
	Route::post('/companies','CompaniesController@index')->name('companies_index');
	Route::get('/companies/create','CompaniesController@create')->name('companies_create');
	Route::post('/companies/store','CompaniesController@store')->name('companies_store');
	Route::get('/companies/show/{company}','CompaniesController@show')->name('companies_show');
	Route::get('/companies/edit/{company}','CompaniesController@edit')->name('companies_edit');
	Route::post('/companies/update/{company}','CompaniesController@update')->name('companies_update');

	// Devices
	Route::post('/devices','DevicesController@index')->name('devices_index');
	Route::get('/devices/create','DevicesController@create')->name('devices_create');
	Route::post('/devices/store','DevicesController@store')->name('devices_store');
	Route::get('/devices/show/{device}','DevicesController@show')->name('devices_show');
	Route::get('/devices/edit/{device}','DevicesController@edit')->name('devices_edit');
	Route::post('/devices/update/{device}','DevicesController@update')->name('devices_update');

	// Fees
	Route::post('/fees','FeesController@index')->name('fees_index');
	Route::get('/fees/create','FeesController@create')->name('fees_create');
	Route::post('/fees/store','FeesController@store')->name('fees_store');
	Route::get('/fees/show/{fee}','FeesController@show')->name('fees_show');
	Route::get('/fees/edit/{fee}','FeesController@edit')->name('fees_edit');
	Route::post('/fees/update/{fee}','FeesController@update')->name('fees_update');

	// Plans
	Route::post('/plans','PlansController@index')->name('plans_index');
	Route::get('/plans/create','PlansController@create')->name('plans_create');
	Route::post('/plans/store','PlansController@store')->name('plans_store');
	Route::get('/plans/show/{plan}','PlansController@show')->name('plans_show');
	Route::get('/plans/edit/{plan}','PlansController@edit')->name('plans_edit');
	Route::post('/plans/update/{plan}','PlansController@update')->name('plans_update');

	// Services
	Route::post('/services','ServicesController@index')->name('services_index');
	Route::get('/services/create','ServicesController@create')->name('services_create');
	Route::post('/services/store','ServicesController@store')->name('services_store');
	Route::get('/services/show/{service}','ServicesController@show')->name('services_show');
	Route::get('/services/edit/{service}','ServicesController@edit')->name('services_edit');
	Route::post('/services/update/{service}','ServicesController@update')->name('services_update');

	// Taxes
	Route::post('/taxes','TaxesController@index')->name('taxes_index');
	Route::get('/taxes/create','TaxesController@create')->name('taxes_create');
	Route::post('/taxes/store','TaxesController@store')->name('taxes_store');
	Route::get('/taxes/show/{tax}','TaxesController@show')->name('taxes_show');
	Route::get('/taxes/edit/{tax}','TaxesController@edit')->name('taxes_edit');
	Route::post('/taxes/update/{tax}','TaxesController@update')->name('taxes_update');

	// Transactions
	Route::post('/transactions','TransactionsController@index')->name('transactions_index');
	Route::get('/transactions/create','TransactionsController@create')->name('transactions_create');
	Route::post('/transactions/store','TransactionsController@store')->name('transactions_store');
	Route::get('/transactions/show/{transaction}','TransactionsController@show')->name('transactions_show');
	Route::get('/transactions/edit/{transaction}','TransactionsController@edit')->name('transactions_edit');
	Route::post('/transactions/update/{transaction}','TransactionsController@update')->name('transactions_update');

	// Vendors
	Route::post('/vendors','VendorsController@index')->name('vendors_index');
	Route::get('/vendors/create','VendorsController@create')->name('vendors_create');
	Route::post('/vendors/store','VendorsController@store')->name('vendors_store');
	Route::get('/vendors/show/{vendor}','VendorsController@show')->name('vendors_show');
	Route::get('/vendors/edit/{vendor}','VendorsController@edit')->name('vendors_edit');
	Route::post('/vendors/update/{vendor}','VendorsController@update')->name('vendors_update');
});