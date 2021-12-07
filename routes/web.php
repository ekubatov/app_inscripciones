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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('Alumno', 'AlumnoController')->middleware('auth');

Route::get('edit_cursos/{profesor}', 'ProfesorController@edit_cursos')->name('profesor.edit_cursos')->middleware('auth');
Route::post('update_cursos/{profesor}', 'ProfesorController@update_cursos')->name('profesor.update_cursos')->middleware('auth');
Route::resource('Profesor', 'ProfesorController')->middleware('auth');

Route::get('edit_profesors/{curso}', 'CursoController@edit_profesors')->name('curso.edit_profesors')->middleware('auth');
Route::post('update_profesors/{curso}', 'CursoController@update_profesors')->name('curso.update_profesors')->middleware('auth');
Route::resource('Curso', 'CursoController')->middleware('auth');

Route::resource('Inscripcion', 'InscripcionController')->middleware('auth');

