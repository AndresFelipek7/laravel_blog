<?php

/*Para conocer las consultas hechas en una pagina*/

DB::listen(function($query){
	//Cambiando sql por time nos da los milisegundos de cada consulta
	echo "<pre>{ $query->sql }</pre>";
});

/*Rutas Generales de otros modulos*/

Route::get('/' , ['as' => 'home' , 'uses' => 'PagesController@home']);
Route::get('saludo/{nombre?}', ['as' => 'saludo' , 'uses' => 'PagesController@saludo'])->where('nombre' , "[A-Za-z]+");

/*Rutas para hacer el CRUD , con la ruta de tipo resource*/

Route::resource('mensaje' , 'MessagesController');
Route::resource('usuarios' , 'UsersController');

/*Ruta para hacer Autentificacion*/

Route::get('login' , 'Auth\LoginController@showLoginForm');
Route::post('login' , 'Auth\LoginController@login');
Route::get('logout' , 'Auth\LoginController@logout');

/*Ruta de prueba*/

Route::get('roles' , function() {
	return App\Role::with('user')->get();
});