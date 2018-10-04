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


// Suplier
Route::resource('sup', 'SuplierController');
Route::get('sup_json', 'SuplierController@json');
Route::post('add_sup', 'SuplierController@store');
Route::get('delete', 'SuplierController@removedata')->name('delete');
Route::post('sup/edit/{id}', 'SuplierController@update');
Route::get('getedit/{id}', 'SuplierController@edit');
// Barang
Route::resource('bar', 'BarangController');
Route::get('bar_json', 'BarangController@json');
Route::post('add_bar', 'BarangController@store');





// Penjualan
