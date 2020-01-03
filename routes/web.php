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
});

Route::resource('tarif', 'TarifController');
Route::resource('user', 'UserController');
Route::resource('site', 'SiteController');
Route::resource('tache', 'TacheController');
Route::get('proposition/{prop}/generate', 'PropositionController@generate')->name('proposition.generate');
Route::get('proposition/{prop}/addTache', 'PropositionController@addTache')->name('proposition.addTache');
Route::resource('proposition', 'PropositionController');

//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
