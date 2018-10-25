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

Route::get('kategorisub', function(){
	return App\Kategori::with('turunan')
	->where('parent_id')
	->get();
});
Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'BarangController@myformAjax'));


// Suplier
Route::resource('sup', 'SuplierController');
Route::get('sup_json', 'SuplierController@json');
Route::get('delete', 'SuplierController@removedata')->name('delete');
Route::get('editsup/{id}', 'SuplierController@edit');
Route::post('sup/edit/{id}', 'SuplierController@update');
Route::post('add_sup', 'SuplierController@store');
// Barang
Route::resource('bar', 'BarangController');
Route::get('bar_json', 'BarangController@json');
Route::get('deletebar', 'BarangController@removedata')->name('deletebar');
Route::get('baredit/{id}', 'BarangController@edit');
Route::post('bar/edit/{id}', 'BarangController@update');
Route::post('add_bar', 'BarangController@store');
// Penjualan
Route::resource('shop', 'PenjualanController');
Route::get('shop_json', 'PenjualanController@json');
Route::get('deleteshop', 'PenjualanController@removedata')->name('deleteshop');
Route::get('shopedit/{id}', 'PenjualanController@edit');
Route::post('shop/edit/{id}', 'PenjualanController@update');
Route::post('add_shop', 'PenjualanController@store');
Route::get('/exportpdf', 'PenjualanController@exportPDF')->name('siswa.export');
// Kategori
Route::resource('kategori', 'KategoriController');
Route::get('kat_json', 'KategoriController@json');
Route::get('deletekat', 'KategoriController@removedata')->name('deletekat');
Route::get('katedit/{id}', 'KategoriController@edit');
Route::post('kat/edit/{id}', 'KategoriController@update');
Route::post('add_kat', 'KategoriController@store');
