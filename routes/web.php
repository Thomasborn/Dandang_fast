<?php

use App\Http\Controllers\DepoController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SalerController;
use Illuminate\Support\Facades\Route;
// use Modules\Depo\Http\Controllers\DepoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')
        ->name('home');

    // Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
    //     ->name('sales-purchases.chart');

        Route::get('/sales-purchases/chart-data/{month}/{year}', 'HomeController@salesPurchasesChart')
        ->name('sales-purchases.chart');

        Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
        ->name('current-month.chart');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')
        ->name('payment-flow.chart');
        Route::resource('depo', DepoController::class);
        Route::resource('saler', SalerController::class);
});
  //Product
// Route::get('/depo', 'DepoController@index')->name('depo.index');
// Route::get('/saler', 'DepoController@index')->name('saler.index');
Route::post('/export/pdf', [ExportController::class, 'exportPDF'])->name('export.pdf');
Route::post('/export/xlsx', [ExportController::class, 'exportXLSX'])->name('export.xlsx');
// routes/web.php
// Route::get('/depo', [DepoController::class,'index'])->name('depo.index');


