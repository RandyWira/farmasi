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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/jenis', 'JenisController@index')->name('jenis');

// Route::get('/addbarang', 'BarangController@create')->name('addbarang');

// Route::post('/addbarang', 'BarangController@store')->name('addbarang.store');

// // Route::get('dropdownlist', 'BarangController@getJenis');

// // Route::get('dropdownlist/getJenis/{id_jenis}', 'BarangController@getJenis');

// Route::get('/sethargajual', 'SetpersentasejualController@index')->name('sethargajual');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('home', 'HomeController');
    Route::resource('jenis', 'JenisController');
    Route::resource('barang', 'BarangController');
    Route::resource('persentasejual', 'SetpersentasejualController');
    Route::resource('satuan', 'SatuanController');
    Route::resource('opname', 'OpnameController');
    Route::resource('golongan', 'GolonganController');
    Route::get('cari', 'OpnameController@loaddata')->name('cari');
    Route::resource('riwayat', 'RiwayatController');
    Route::resource('stok', 'StokperlokasiController');
});