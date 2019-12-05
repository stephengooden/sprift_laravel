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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/report/{uid}', 'ReportController@index_uid')->name('report-uid');
Route::get('/reportnew/{uid}', 'ReportnewController@index_uid')->name('report-uid');
Route::get('/report-nice/{postcode}/{weekid}', 'ReportController@index_safe')->name('report-safe');
Route::get('/r/{postcode}/{weekdate?}', 'ReportController@index')->name('report-web');
Route::get('/r-plain/{postcode}/{weekdate?}', 'ReportController@plain')->name('report-plain');
Route::get('/r-pdf/{postcode}/{weekdate?}', 'ReportController@pdf')->name('report-pdf');
Route::get('/download-pdf/{uid}', 'ReportController@download_pdf')->name('download-pdf');
Auth::routes(['verify' => true, 'register' => false]);
