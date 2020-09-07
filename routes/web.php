<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\RecalculationController;
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

Route::get('/index', 'RecalculationController@index')->name('index.history');

Route::get('/income','TransactionsController@index')->name('income.index');
Route::post('/income','TransactionsController@income')->name('income.store');

Route::get('/outgo','TransactionsController@show')->name('outgo.index');
Route::post('/outgo','TransactionsController@outgo')->name('outgo.store');

//Route::get('/outcome','TransactionController')->name('outcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
