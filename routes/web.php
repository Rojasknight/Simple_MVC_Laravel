<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index');

Route::resource('categories', 'CategoryController');

Route::get('categories/{category}/{id}/products', 'ProductController@show');

Route::get('products/create', 'ProductController@create');
Route::post('products/create', 'ProductController@store');
Route::delete('products/delete/{id}', 'ProductController@destroy');



Route::get('categories/{category}/{name}/edit/{id}', 'ProductController@edit');
Route::post('categories/{category}/{id}/products', 'ProductController@update');

