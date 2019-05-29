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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::resource('people', 'PeopleController');
Route::get('/people/create/{type_text}', 'PeopleController@create')->name('people.create');
Route::post('/people/destroy', 'PeopleController@destroy')->name('people.destroy');
Route::post('/people/get_general_info', 'PeopleController@get_general_info')->name('people.get_general_info');
Route::post('/people/search', 'PeopleController@search')->name('people.search');
Route::post('/people/update', 'PeopleController@update')->name('people.update');
Route::post('/people/add_file', 'PeopleController@add_file')->name('people.add_file');
Route::post('/people/delete_file', 'PeopleController@delete_file')->name('people.delete_file');
Route::post('/people/add_shareholder', 'PeopleController@add_shareholder')->name('people.add_shareholder');
Route::post('/people/delete_shareholder', 'PeopleController@delete_shareholder')->name('people.delete_shareholder');
Route::post('/people/add_legal_relation', 'PeopleController@add_legal_relation')->name('people.add_legal_relation');
Route::post('/people/edit_legal_relation', 'PeopleController@edit_legal_relation')->name('people.edit_legal_relation');
Route::post('/people/delete_legal_relation', 'PeopleController@delete_legal_relation')->name('people.delete_legal_relation');
Route::resource('profile', 'ProfileController')->middleware('auth');
Route::post('/updatePassword', 'ProfileController@updatePassword')->name('updatePassword');
Route::post('/helper/autocomplete_countries', 'HelperController@autocomplete_countries')->name('helper.autocomplete_countries');
Route::post('/helper/autocomplete_clients', 'HelperController@autocomplete_clients')->name('helper.autocomplete_clients');
Route::post('/helper/autocomplete_products', 'HelperController@autocomplete_products')->name('helper.autocomplete_products');
Route::post('/helper/autocomplete_types_share', 'HelperController@autocomplete_types_share')->name('helper.autocomplete_types_share');
Route::post('/helper/autocomplete_oficial_jobs', 'HelperController@autocomplete_oficial_jobs')->name('helper.autocomplete_oficial_jobs');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

