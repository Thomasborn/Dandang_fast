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
Route::group(['middleware' => 'auth'], function () {
    //Print Barcode
    // Route::get('/products/print-barcode', 'BarcodeController@printBarcode')->name('barcode.print');
    //Product
    Route::get('/depo', 'DepoController@index')->name('depo.index');
    //Product Category
    // Route::resource('product-categories', 'CategoriesController')->except('create', 'show');
});
// Route::prefix('depo')->group(function() {
//     Route::get('/', 'DepoController@index');
// });
