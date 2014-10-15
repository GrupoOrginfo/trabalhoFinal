<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getLogin');

Route::get('/sobre', 'HomeController@getAbout');

Route::get('/suporte', 'HomeController@getSupport');



Route::post('/cadastro', 'LoginController@postCadastro');
Route::post('/login', 'LoginController@postLogin');





Route::group(array('before' => 'auth'), function()
{
 
 	Route::get('/home', 'UsuarioController@getUser');

	Route::post('/addamigo', 'UsuarioController@postAddAmigo');
	Route::get('/addamigo', 'UsuarioController@getAddAmigo');

	Route::post('/removeamigo', 'UsuarioController@postRemoveAmigo');
	Route::get('/removeamigo', 'UsuarioController@getRemoveAmigo');

	Route::post('/editaperfil', 'UsuarioController@postEditarPerfil');
	Route::get('/editaperfil', 'UsuarioController@getEditarPerfil');

	Route::get('/logout', function(){
		$usuario_id = Auth::id();

		Auth::logout();

		$usuario = Usuario::find($usuario_id);
		$usuario->status = false;
		$usuario->save();
		return Redirect::to('/');
	});
	
	Route::get('/amigos','UsuarioController@verificaAmigos');

	Route::any('/removeusuario','UsuarioController@removeUsuario');

	

});