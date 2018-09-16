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

// Home page
Route::get('/', 'FrontController@index');
Route::post('/', 'FrontController@search')->name('search');

// Single post
Route::get('post/{id}', 'FrontController@show')->where(['id'=>'[0-9]+']);

// Archives
Route::get('stages', 'FrontController@stages');
Route::get('formations', 'FrontController@formations');

// Contact
Route::get('contact', 'FrontController@contact');
Route::post('contact', 'FrontController@sendContactMail')->name('contact');

// Auth routes
Route::resource('admin/book', 'BookController')->middleware('auth');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
