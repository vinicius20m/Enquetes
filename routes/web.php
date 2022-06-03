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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::namespace('App\Http\Controllers')->group(function() {

    Route::get('home','EnqueteController@index') ;
    Route::get('/','EnqueteController@index') ;
    Route::get('enquetes','EnqueteController@index')->name('enquete-index') ;
    Route::get('enquete/{enquete:id}','EnqueteController@show')->name('enquete-show') ;
    Route::get('criando-enquete', 'EnqueteController@create')->name('enquete-create') ;
    Route::post('criar-enquete', 'EnqueteController@store')->name('enquete-store') ;
    Route::get('editando-enquete/{enquete:id}', 'EnqueteController@edit')->name('enquete-edit') ;
    Route::post('editar-enquete/{enquete:id}', 'EnqueteController@update')->name('enquete-update') ;
    Route::get('excluir-enquete/{enquete:id}', 'EnqueteController@destroy')->name('enquete-destroy') ;
}) ;
