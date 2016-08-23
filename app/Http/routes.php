<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/404', function () {
    return view('errors.404');
});


Route::get('/home', 'HomeController@index');

/* Products & Child Products  Start */

Route::get('products', 'ProductsController@index');
Route::get('products/new', 'ProductsController@new');
Route::post('products', 'ProductsController@store');
Route::get('products/{product}/edit', 'ProductsController@edit');
Route::patch('products/{product}', 'ProductsController@update');
Route::delete('products/{product}', 'ProductsController@destroy');

Route::get('products/{num}/child','ProductsController@productsChild');
Route::get('products/{sku}/child/create','ProductsController@productsChildCreate');
Route::post('child-product/create','ProductsController@createChild');
Route::patch('child-product/update','ProductsController@updateChild');
Route::delete('child-product/{product}', 'ProductsController@destroyChild');
Route::get('products/child/{childNum}/edit','ProductsController@editChild');
Route::post('child-product/price-formula','ProductsController@priceFormula');

/* Products & Child Products End */

/* Export Products Start */

Route::get('export/product/{formula?}/{server?}','ExportController@exportProductFormula');
Route::get('export/locations/{server?}','ExportController@exportLocations');
Route::get('export/servers/{server?}','ExportController@exportServers');

/* Export Products End */



Route::get('suppliers', 'SuppliersController@index');
Route::get('suppliers/new', 'SuppliersController@new');
Route::post('suppliers', 'SuppliersController@store');
Route::get('suppliers/{supplier}/edit', 'SuppliersController@edit');
Route::patch('suppliers/{supplier}', 'SuppliersController@update');
Route::delete('suppliers/{supplier}', 'SuppliersController@destroy');

Route::get('supplier/{num}/import/csv','ImportController@importCsvCreate');
Route::post('supplier/{num}/import/csv','ImportController@importCsv');
Route::post('supplier/import/csv','ImportController@importCsv');
Route::post('import/store','ImportController@importStore');

Route::get('import/csv','ImportController@importCreate');


Route::get('categories', 'CategoriesController@index');
Route::get('categories/new', 'CategoriesController@new');
Route::post('categories', 'CategoriesController@store');
Route::get('categories/{category}/edit', 'CategoriesController@edit');
Route::patch('categories/{category}', 'CategoriesController@update');
Route::delete('categories/{category}', 'CategoriesController@destroy');

Route::get('subcategories', 'SubcategoriesController@index');
Route::get('subcategories/new', 'SubcategoriesController@new');
Route::post('subcategories', 'SubcategoriesController@store');
Route::get('subcategories/{subcategory}/edit', 'SubcategoriesController@edit');
Route::patch('subcategories/{subcategory}', 'SubcategoriesController@update');
Route::delete('subcategories/{subcategory}', 'SubcategoriesController@destroy');

Route::get('locations', 'LocationsController@index');
Route::get('locations/new', 'LocationsController@new');
Route::post('locations', 'LocationsController@store');
Route::get('locations/{location}/edit', 'LocationsController@edit');
Route::patch('locations/{location}', 'LocationsController@update');
Route::delete('locations/{location}', 'LocationsController@destroy');



Route::resource('servers', 'ServersController');

Route::get('export', 'PagesController@export');
Route::get('search', 'SearchController@search');



