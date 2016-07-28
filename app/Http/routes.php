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

Route::get('products/{num}/child','ProductsController@productsChild')->where('num', '[0-9]+');
Route::get('products/{num}/child/create','ProductsController@productsChildCreate')->where('num', '[0-9]+');
Route::post('child-product/create','ProductsController@createChild');
Route::patch('child-product/update','ProductsController@updateChild');
Route::delete('child-product/{product}', 'ProductsController@destroyChild');
Route::get('products/{num}/child/{childNum}/edit','ProductsController@editChild');
Route::post('child-product/price-formula','ProductsController@priceFormula');

Route::get('products/import/csv','ProductsController@importCsvCreate');
Route::post('products/import','ProductsController@importCsv');

/* Products & Child Products End */

Route::get('suppliers', 'SuppliersController@index');
Route::get('suppliers/new', 'SuppliersController@new');
Route::post('suppliers', 'SuppliersController@store');
Route::get('suppliers/{supplier}/edit', 'SuppliersController@edit');
Route::patch('suppliers/{supplier}', 'SuppliersController@update');
Route::delete('suppliers/{supplier}', 'SuppliersController@destroy');

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

Route::get('servers', 'ServersController@index');
Route::get('servers/new', 'ServersController@new');
Route::post('servers', 'ServersController@store');
Route::get('servers/{server}/edit', 'ServersController@edit');
Route::patch('servers/{server}', 'ServersController@update');
Route::delete('servers/{server}', 'ServersController@destroy');

Route::get('export', 'PagesController@export');
Route::get('search', 'SearchController@search');



