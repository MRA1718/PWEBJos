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

Route::post('/income/del_income','MainController@del_income');
Route::post('/income/edit_income','MainController@edit_income');
// Route::post('/del_income/{$id}','MainController@del_income')->name('del_income');

Route::get('/expense','MainController@expense')->name('expense') ;
Route::post('/expense/addExp','MainController@addExp');
Route::post('/expense/del_expense','MainController@del_expense');
Route::post('/expense/edit_expense','MainController@edit_expense');
