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
    return view('temp');
});


// Suplier
Route::resource('sup', 'SuplierController');
Route::get('sup_json', 'SuplierController@json');
Route::get('delete', 'SuplierController@removedata')->name('delete');
Route::get('getedit/{id}', 'SuplierController@edit');
Route::post('sup/edit/{id}', 'SuplierController@update');
Route::post('add_sup', 'SuplierController@store');
// Barang
Route::resource('bar', 'BarangController');
Route::get('bar_json', 'BarangController@json');
Route::get('delete', 'BarangController@removedata')->name('delete');
Route::get('getedit/{id}', 'BarangController@edit');
Route::post('bar/edit/{id}', 'BarangController@update');
Route::post('add_bar', 'BarangController@store');
// Penjualan
Route::resource('shop', 'PenjualanController');
Route::get('shop_json', 'PenjualanController@json');
Route::get('delete', 'PenjualanController@removedata')->name('delete');
Route::get('getedit/{id}', 'PenjualanController@edit');
Route::post('shop/edit/{id}', 'PenjualanController@update');
Route::post('add_shop', 'PenjualanController@store');
