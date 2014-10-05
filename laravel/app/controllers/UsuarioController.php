<?php

class UsuarioController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getUser()
	{
		return View::make('home')->withMsg("Voce Logou");
	}

	public function addAmigo(){

		$novoAmigo = Input::get("amigo");

		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);

		$usuario->usuario_usuario()->attach(3);
	}


	public function removeAmigo(){
		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);

		$usuario->usuario_usuario()->detach($amigo_id);

		

	}

	public function verificaAmigos(){
		$usuario_id = Auth::id();
		$usuario = Usuario::find($usuario_id);

		$amigos = $usuario->usuario_usuario()->get();
		$amizades = [];
		
		//var_dump($usuario);

		foreach ($amigos as $amigo) {

			$amizades[$amigo->username]["nome"] = $amigo->nome;
			$amizades[$amigo->username]["status"] = $amigo->status;
			$amizades[$amigo->username]["fotoPerfil"] = $amigo->profilePicture;			

		}
		//var_dump($amizades);

		$amizade = json_encode($amizades);

		echo $amizade;
	}


}
