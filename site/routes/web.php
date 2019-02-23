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
Route::resource('profile', 'ProfileController')->middleware('auth');
Route::post('/updatePassword', 'ProfileController@updatePassword')->name('updatePassword');
Route::post('/helper/autocomplete_countries', 'HelperController@autocomplete_countries')->name('helper.autocomplete_countries');
Route::post('/helper/autocomplete_clients', 'HelperController@autocomplete_clients')->name('helper.autocomplete_clients');
Route::post('/helper/autocomplete_products', 'HelperController@autocomplete_products')->name('helper.autocomplete_products');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

