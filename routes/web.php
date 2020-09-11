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

/* PERSONAL */
Route::get('/personal/registrar', 'PersonalController@register')->name('personal.register');
Route::post('/personal/register', 'PersonalController@create')->name('personal.create');
Route::get('/personal/designado', 'PersonalController@listAuth')->name('personal.listAuth');
Route::get('/personal/ver/{id}', 'PersonalController@viewAuth')->name('personal.viewAuth');
Route::get('/personal/actualizar/{id}', 'PersonalController@edit')->name('personal.edit');
Route::post('/personal/update', 'PersonalController@update')->name('personal.update');
Route::post('/personal/vehiculo', 'PersonalController@vehiculo')->name('personal.vehiculo');
Route::post('/personal/asignarTarea', 'PersonalController@asignarTarea')->name('personal.asignarTarea');

/* USUARIOS */
Route::get('/usuarios', 'UsuarioController@index')->name('usuario.index');
Route::post('/usuario/register', 'UsuarioController@create')->name('usuario.create');
Route::post('/usuario/update', 'UsuarioController@update')->name('usuario.update');
Route::get('/usuario/destroy/{id}', 'UsuarioController@destroy')->name('usuario.destroy');

/* PUESTOS */ 
Route::get('/puestos', 'PuestosController@index')->name('puesto.index');
Route::get('/puesto/registrar', 'PuestosController@register')->name('puesto.register');
Route::post('/puesto/register', 'PuestosController@create')->name('puesto.create');
Route::get('/puesto/editar/{id}', 'PuestosController@edit')->name('puesto.edit');
Route::post('/puesto/update', 'PuestosController@update')->name('puesto.update');
