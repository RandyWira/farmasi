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

Route::get('/logout', function () {
    Auth::logout();
    return response()->redirectTo('/login');
});
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
    Route::resource('set_persentase_jual', 'SetpersentasejualController');
    Route::resource('satuan', 'SatuanController');
    Route::resource('opname', 'OpnameController');
    Route::resource('golongan', 'GolonganController');
    Route::get('cari', 'OpnameController@loaddata')->name('cari');
    Route::get('cari-supplier', 'PembelianController@loaddata')->name('carisupplier');
    Route::resource('riwayat', 'RiwayatController');
    Route::resource('stok', 'StokperlokasiController');
    Route::resource('penjualan', 'PenjualanController');
    Route::resource('pembelian', 'PembelianController');

    Route::get('report', 'PenjualanController@report')->name('report');
    Route::get('/penjualan/{penjualan}/detail', 'PenjualanController@detail')->name('penjualan.detail');
    Route::get('/penjualan/{penjualan}/cetak', 'PenjualanController@cetak_nota')->name('penjualan.cetak_nota');
    Route::get('report-beli', 'PembelianController@report')->name('report-beli');
    Route::get('/pembelian/{pembelian}/cetak', 'PembelianController@cetak_nota')->name('pembelian.cetak_nota');
    Route::get('/pembelian/{pembelian}/detail', 'PembelianController@detail')->name('pembelian.detail');

    Route::resource('mutasi_masuk', 'MutasiMasukController');
    Route::resource('mutasi_keluar', 'MutasiKeluarController');
    Route::resource('supplier', 'SupplierController');
    Route::resource('akun', 'AkunController');
    Route::resource('rekening_tahun', 'RekeningtahunController');

    Route::resource('konfigurasi', 'KonfigurasiController');
});