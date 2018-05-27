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

// Route::get('/', function () {
//     return view('pages.login');
// });

Route::get('/','MainController@index') ;
// Route::get('/home','MainController@home') ;
Auth::routes();
// Route::resource('income','MainController');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/money','MainController@store_money') ;
Route::get('/income','MainController@income')->name('income') ;
Route::post('/income/addPost','MainController@addPost');
