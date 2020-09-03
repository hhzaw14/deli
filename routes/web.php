<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontendController@index');

Route::get('/dashboard', 'TownshipController@index')->name('dashboard');

Route::resource('/category', 'CategoryController');

Route::resource('/township', 'TownshipController');

Route::resource('/cuisine', 'CuisineController');

Route::resource('/restaurant', 'RestaurantController');

Route::resource('/menu', 'MenuController');

Route::get('/orderlist','OrderlistController@index')->name('orderlist');

Route::get('/orderdetail/{id}','OrderlistController@orderdetail')->name('orderdetail');

// Route::get('/hello', 'TownshipController@index')->name('hello');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/index', 'FrontendController@index')->name('index');

Route::get('/idetail/{id}', 'FrontendController@detail')->name('idetail');

Route::get('/restaurantdetail/{id}', 'FrontendController@resdetail')->name('detail');

Route::post('/searchPost', 'FrontendController@search')->name('searchPost');

Route::get('/cart','FrontendController@cart')->name('cart');

Route::post('/order','FrontendController@order')->name('order');
