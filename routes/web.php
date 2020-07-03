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

/*
Route::get('/', function () {
    return view('index');
});
*/

Route::get('/', 'LoginController@Index');
Route::get('/escritorio', 'DesktopController@Index');
Route::get('/clientes/ver', 'ClientsController@ViewClients');
Route::get('/clientes/get', 'ClientsController@GetClients');
Route::get('/clientes/agregar', 'ClientsController@ViewAddClient');
