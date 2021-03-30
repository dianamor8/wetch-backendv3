<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', 'HomeController@index')->name('home');

// TIPO AREA VIVIENDA
// Route::get('/tipoAreaVivienda', 'TipoAreaViviendaController@index');
// Route::get('/tipoAreaVivienda/crear', 'TipoAreaViviendaController@create');
// Route::get('/tipoAreaVivienda/editar', 'TipoAreaViviendaController@edit');
//Route::resource('tipoAreaVivienda', 'TipoAreaViviendaController');