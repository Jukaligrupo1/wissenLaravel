<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controller('entidades', 'EntidadesController');
Route::controller('disciplinas', 'disciplinasController');
Route::controller('disciplinas_traduc', 'disciplinas_traducController');
Route::controller('niveles', 'nivelesController');
Route::controller('niveles_traduc', 'niveles_traducController');
Route::controller('categorias', 'categoriasController');
Route::controller('categorias_traduc', 'categorias_traducController');
Route::controller('eventos', 'EventosController');
Route::controller('nivel_participante', 'nivel_participanteController');
Route::controller('inscripciones', 'inscripcionesController');
Route::controller('user_event', 'user_eventController');
Route::controller('evaluaciones', 'EventosController');
Route::controller('pregunta_evaluacion', 'pregunta_evaluacionController');
Route::controller('examenes', 'ExamenesController');





Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
