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
		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);

		$foto = $usuario->profilePicture;
		$username = $usuario->username;


		return View::make('home')->withFoto($foto)->withUser($username);
	}

	public function getEditarPerfil(){
		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);

		$foto = $usuario->profilePicture;
		$username = $usuario->username;

		return View::make('editperfil')->withFoto($foto)->withUser($username);
		
	}



	public function postEditarPerfil(){
		
		$input = Input::all();


		$validator = Validator::make($input, 
			array(
				"email" => "email",
				"foto" => "mimes:jpeg,png"
			),
			array(
				"email.email"=> "Você não inseriu um e-mail válido",
				"foto.mimes" => "Apenas aceitos fotos jpg ou png"
			)
		);




		if($validator->passes())
		{		
			$usuario_id = Auth::id();

			$usuario = Usuario::find($usuario_id);

			if(Input::hasFile("foto"))
			{	

				$arquivo = Input::file("foto");
				$destinationPath = "img/profile";

				$originalname = $arquivo->getClientOriginalName();
				$filename = Auth::id()."".$originalname;

				
				$arquivo->move($destinationPath, $filename);

				$usuario->profilePicture = $filename;

			}

			if(Input::has("senha"))
			{
				$usuario->senha = Hash::make(Input::get('senha'));
			}

			if(Input::has("nome"))
			{
				$usuario->nome = Input::get('nome');
			}
			
			if(Input::has("email"))
			{
				$usuario->email = Input::get('email');
			}
			
			if(Input::has("cidade"))
			{
				$usuario->cidade = Input::get('cidade');
			}

			$usuario->save();


		}

		return Redirect::back()->withInput()->withErrors($validator->messages());
		
	}


	public function getAddAmigo(){

		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);

		$foto = $usuario->profilePicture;
		$username = $usuario->username;

		return View::make('addamigo')->withFoto($foto)->withUser($username);

	}


	public function postAddAmigo(){

		$novoAmigo = Input::get("username");

		$amigo = Usuario::where("username", "=", $novoAmigo)->first();
		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);


				

		if($amigo == null)
		{
			return Redirect::back()->withFail("Usuario não encontrado");
		}
		else
		{

			if($amigo->id == $usuario->id)
			{
				return Redirect::back()->withFail("Sabemos que você já é um grande amigo de si mesmo, mas não da pra fazer isso aqui!");	
			}
			else
			{
				$eMeuAmigo = $usuario->euFizAmizadeCom()->where("amigo_id", "=", $amigo->id)->first();
				$jaSouAmigo = $usuario->fezAmizadeComigo()->where("usuario_id", "=", $amigo->id)->first();

				if(($eMeuAmigo != null)||($jaSouAmigo!= null)){
					return Redirect::back()->withFail("Este usuário já é seu amigo.");
				}
				else
				{
					$usuario->euFizAmizadeCom()->attach($amigo->id);

					return Redirect::back()->withMsg("Amigo Adicionado!");
				}
			}

			
		}

		

		
	}


	public function getRemoveAmigo(){
		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);

		$foto = $usuario->profilePicture;
		$username = $usuario->username;

		return View::make('rmamigo')->withFoto($foto)->withUser($username);
		
		
	}



	public function postRemoveAmigo(){
		
		$rmAmigo = Input::get("username");

		$amigo = Usuario::where("username", "=", $rmAmigo)->first();
		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);


				

		if($amigo == null)
		{
			return Redirect::back()->withFail("Usuario não encontrado");
		}
		else
		{

			if($amigo->id == $usuario->id)
			{
				return Redirect::back()->withFail("Se você não gosta de si mesmo a culpa não é nossa.");	
			}
			else
			{
				$eMeuAmigo = $usuario->euFizAmizadeCom()->where("amigo_id", "=", $amigo->id)->first();
				$jaSouAmigo = $usuario->fezAmizadeComigo()->where("usuario_id", "=", $amigo->id)->first();

				if(($eMeuAmigo == null)&&($jaSouAmigo == null)){
					return Redirect::back()->withFail("Este usuário já não é seu amigo.");
				}
				else
				{
					$usuario->euFizAmizadeCom()->detach($amigo->id);
					$usuario->fezAmizadeComigo()->detach($amigo->id);

					return Redirect::back()->withMsg("Pessoa removida da sua lista");
				}
			}

			
		}

		
		
	}





	public function verificaAmigos(){ //Cria a lista de Amigos na sidebar
		$usuario_id = Auth::id();
		$usuario = Usuario::find($usuario_id);

		$amigos = $usuario->euFizAmizadeCom()->get();
		$user = $usuario->fezAmizadeComigo()->get();
		$amizades = [];
		
		

		$usuario->time_request = date('Y-m-d H:i:s',time());

		$usuario->save();

		

		


		foreach ($amigos as $amigo) {

			$atualtime = date('U',strtotime('-5 seconds',time()));

			$timebd = date('U', strtotime($amigo->time_request));



			$amizades[$amigo->username]["nome"] = $amigo->nome;
			

			if( $atualtime >= $timebd )
			{
				$amizades[$amigo->username]["status"] = 0;
			}
			else
			{
				$amizades[$amigo->username]["status"] = $amigo->status;	
			}
			
			$amizades[$amigo->username]["fotoPerfil"] = asset('img').'/profile/'.$amigo->profilePicture;

		}

		foreach ($user as $user) {

			$atualtime = date('U',strtotime('-5 seconds',time()));

			$timebd = date('U', strtotime($user->time_request));



			$amizades[$user->username]["nome"] = $user->nome;
			


			if( $atualtime >= $timebd )
			{
				$amizades[$user->username]["status"] = 0;
			}
			else
			{
				$amizades[$user->username]["status"] = $user->status;	
			}
			
			$amizades[$user->username]["fotoPerfil"] = $user->profilePicture;		

		}

		$amizade = json_encode($amizades);

		echo $amizade;
	}


	public function removeUsuario(){

		$usuario_id = Auth::id();

		Auth::logout();

		$usuario = Usuario::destroy($usuario_id);

		return	Redirect::to('/');

	}




}
