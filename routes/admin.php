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

/** Administrative pages **/

// Admin Access
Route::get('/admins/login','AdminsController@login')->name('admins_login');
Route::post('/admins/authenticate','AdminsController@authenticate')->name('admins_auth');


// Redirects if role_id > 3 (employee) or guests, check middleware/Authentice class if need to change
Route::group(['middleware' => ['check:1']], function () {
	// Partners
	Route::get('/partners','PartnersController@index')->name('partners_index');
	Route::get('/partners/create','PartnersController@create')->name('partners_create');
	Route::delete('/partners/{partner}','PartnersController@destroy')->name('partners_destroy');
	Route::post('/partners/store','PartnersController@store')->name('partners_store');
	Route::get('/partners/{partner}/show','PartnersController@show')->name('partners_show');
	Route::get('/partners/{partner}/edit','PartnersController@edit')->name('partners_edit');
	Route::patch('/partners/{partner}','PartnersController@update')->name('partners_update');

	// Managers
	Route::get('/managers','ManagersController@index')->name('managers_index');
	Route::get('/managers/create','ManagersController@create')->name('managers_create');
	Route::delete('/managers/{manager}','ManagersController@destroy')->name('managers_destroy');
	Route::post('/managers/store','ManagersController@store')->name('managers_store');
	Route::get('/managers/{manager}/show','ManagersController@show')->name('managers_show');
	Route::get('/managers/{manager}/edit','ManagersController@edit')->name('managers_edit');
	Route::patch('/managers/{manager}','ManagersController@update')->name('managers_update');
});
Route::group(['middleware' => ['check:2']], function () {
	// Employees
	Route::get('/employees','EmployeesController@index')->name('employees_index');
	Route::get('/employees/create','EmployeesController@create')->name('employees_create');
	Route::delete('/employees/{employee}','EmployeesController@destroy')->name('employees_destroy');
	Route::post('/employees/store','EmployeesController@store')->name('employees_store');
	Route::get('/employees/{employee}/show','EmployeesController@show')->name('employees_show');
	Route::get('/employees/{vendor}/edit','EmployeesController@edit')->name('employees_edit');
	Route::patch('/employees/{vendor}','EmployeesController@update')->name('employees_update');
	
});
Route::group(['middleware' => ['check:3']], function () {
	// Admins
    Route::get('/admins','AdminsController@index')->name('admins_index');
    Route::get('/admins/logout','AdminsController@logout')->name('admins_logout');
    
    // Assets
	Route::get('/assets','AssetsController@index')->name('assets_index');
	Route::get('/assets/create','AssetsController@create')->name('assets_create');
	Route::delete('/assets/{asset}','AssetsController@destroy')->name('assets_destroy');
	Route::post('/assets/store','AssetsController@store')->name('assets_store');
	Route::get('/assets/{asset}/show','AssetsController@show')->name('assets_show');
	Route::get('/assets/{asset}/edit','AssetsController@edit')->name('assets_edit');
	Route::patch('/assets/{asset}','AssetsController@update')->name('assets_update');
	Route::get('/assets/issues','AssetsController@issues')->name('assets_issues');

	// Asset Items
	Route::get('/asset-items','AssetItemsController@index')->name('asset_items_index');
	Route::get('/asset-items/create','AssetItemsController@create')->name('asset_items_create');
	Route::delete('/asset-items/{assetItem}','AssetItemsController@destroy')->name('asset_items_destroy');
	Route::get('/asset-items/deploy','AssetItemsController@deploy')->name('asset_items_deploy');
	Route::post('/asset-items/update/deploy','AssetItemsController@updateDeploy')->name('asset_items_update_deploy');
	Route::post('/asset-items/undo/deploy','AssetItemsController@undoDeploy')->name('asset_items_undo_deploy');
	Route::get('/asset-items/return','AssetItemsController@return')->name('asset_items_return');
	Route::post('/asset-items/update/return','AssetItemsController@updateReturn')->name('asset_items_update_return');
	Route::post('/asset-items/undo/return','AssetItemsController@undoReturn')->name('asset_items_undo_return');
	Route::post('/asset-items/store','AssetItemsController@store')->name('asset_items_store');
	Route::get('/asset-items/{assetItem}/show','AssetItemsController@show')->name('asset_items_show');
	Route::get('/asset-items/{assetItem}/edit','AssetItemsController@edit')->name('asset_items_edit');
	Route::patch('/asset-items/{assetItem}','AssetItemsController@update')->name('asset_items_update');
	Route::patch('/asset-items/{assetItem}/claimed','AssetItemsController@claimed')->name('asset_items_claimed');
	Route::patch('/asset-items/{assetItem}/complete','AssetItemsController@complete')->name('asset_items_complete');
	Route::patch('/asset-items/{assetItem}/resolved','AssetItemsController@resolved')->name('asset_items_resolved');

    // Cards
	Route::get('/cards','CardsController@index')->name('cards_index');
	Route::get('/cards/create','CardsController@create')->name('cards_create');
	Route::post('/cards/store','CardsController@store')->name('cards_store');
	Route::get('/cards/{card}/show','CardsController@show')->name('cards_show');
	Route::get('/cards/{card}/edit','CardsController@edit')->name('cards_edit');
	Route::patch('/cards/{card}','CardsController@update')->name('cards_update');
	// Companies
	Route::get('/companies','CompaniesController@index')->name('companies_index');
	Route::get('/companies/create','CompaniesController@create')->name('companies_create');
	Route::post('/companies/store','CompaniesController@store')->name('companies_store');
	Route::get('/companies/{company}/show','CompaniesController@show')->name('companies_show');
	Route::get('/companies/{company}/edit','CompaniesController@edit')->name('companies_edit');
	Route::patch('/companies/{company}','CompaniesController@update')->name('companies_update');

	// Customers
	Route::get('/customers','CustomersController@index')->name('customers_index');
	Route::get('/customers/create','CustomersController@create')->name('customers_create');
	Route::delete('/customers/{customer}','CustomersController@destroy')->name('customers_destroy');
	Route::post('/customers/search','CustomersController@search')->name('customers_search');
	Route::post('/customers/store','CustomersController@store')->name('customers_store');
	Route::get('/customers/{customer}/show','CustomersController@show')->name('customers_show');
	Route::get('/customers/{customer}/edit','CustomersController@edit')->name('customers_edit');
	Route::patch('/customers/{customer}','CustomersController@update')->name('customers_update');

	// Fees
	Route::get('/fees','FeesController@index')->name('fees_index');
	Route::get('/fees/create','FeesController@create')->name('fees_create');
	Route::delete('/fees/{fee}','FeesController@destroy')->name('fees_destroy');
	Route::post('/fees/store','FeesController@store')->name('fees_store');
	Route::get('/fees/{fee}/show','FeesController@show')->name('fees_show');
	Route::get('/fees/{fee}/edit','FeesController@edit')->name('fees_edit');
	Route::patch('/fees/{fee}','FeesController@update')->name('fees_update');
	Route::post('/fees/retrieve','FeesController@retrieve')->name('fees_retrieve');
	Route::post('/fees/totals','FeesController@totals')->name('fees_totals');

	// Plans
	Route::get('/plans','PlansController@index')->name('plans_index');
	Route::get('/plans/create','PlansController@create')->name('plans_create');
	Route::delete('/plans/{plan}','PlansController@destroy')->name('plans_destroy');
	Route::post('/plans/store','PlansController@store')->name('plans_store');
	Route::get('/plans/{plan}/show','PlansController@show')->name('plans_show');
	Route::get('/plans/{plan}/edit','PlansController@edit')->name('plans_edit');
	Route::patch('/plans/{plan}','PlansController@update')->name('plans_update');


	// Services
	Route::get('/services','ServicesController@index')->name('services_index');
	Route::get('/services/create','ServicesController@create')->name('services_create');
	Route::delete('/services/{service}','ServicesController@destroy')->name('services_destroy');
	Route::post('/services/store','ServicesController@store')->name('services_store');
	Route::get('/services/{service}/show','ServicesController@show')->name('services_show');
	Route::get('/services/{service}/edit','ServicesController@edit')->name('services_edit');
	Route::patch('/services/{service}','ServicesController@update')->name('services_update');
	Route::post('/services/retrieve','ServicesController@retrieve')->name('services_retrieve');

	// Taxes
	Route::get('/taxes','TaxesController@index')->name('taxes_index');
	Route::get('/taxes/create','TaxesController@create')->name('taxes_create');
	Route::post('/taxes/store','TaxesController@store')->name('taxes_store');
	Route::get('/taxes/{tax}/show','TaxesController@show')->name('taxes_show');
	Route::get('/taxes/{tax}/edit','TaxesController@edit')->name('taxes_edit');
	Route::patch('/taxes/{tax}','TaxesController@update')->name('taxes_update');

	// Transactions
	Route::get('/transactions','TransactionsController@index')->name('transactions_index');
	Route::get('/transactions/create','TransactionsController@create')->name('transactions_create');
	Route::post('/transactions/store','TransactionsController@store')->name('transactions_store');
	Route::get('/transactions/{transaction}/show','TransactionsController@show')->name('transactions_show');
	Route::get('/transactions/{transaction}/edit','TransactionsController@edit')->name('transactions_edit');
	Route::patch('/transactions/{transaction}','TransactionsController@update')->name('transactions_update');

	// Vendors
	Route::get('/vendors','VendorsController@index')->name('vendors_index');
	Route::get('/vendors/create','VendorsController@create')->name('vendors_create');
	Route::delete('/vendors/{vendor}','VendorsController@destroy')->name('vendors_destroy');
	Route::post('/vendors/store','VendorsController@store')->name('vendors_store');
	Route::get('/vendors/{vendor}/show','VendorsController@show')->name('vendors_show');
	Route::get('/vendors/{vendor}/edit','VendorsController@edit')->name('vendors_edit');
	Route::patch('/vendors/{vendor}','VendorsController@update')->name('vendors_update');
});













