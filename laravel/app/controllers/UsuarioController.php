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


		return View::make('home')->withFoto($foto)->withUser($username)->withTitle("CAYANA");
	}

	public function getEditarPerfil(){
		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);

		$foto = $usuario->profilePicture;
		$username = $usuario->username;

		return View::make('editperfil')->withFoto($foto)->withUser($username)->withTitle("CAYANA");
		
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

		return View::make('addamigo')->withFoto($foto)->withUser($username)->withTitle("CAYANA");

	}





	function criarConversa($amigo_id,$usuario_id)
	{	
		$conversa = new Conversa();
		
		$usuario = Usuario::find($usuario_id);

		$amigo = Usuario::find($amigo_id);

		
		
		$conversa->grupo = $usuario->username.",".$amigo->username;

		$conversa->save();
		
	
		$conversa->pertence()->attach($amigo->id);
		$conversa->pertence()->attach($usuario->id);


		$tempo = date('Y-m-d H:i:s',time());

		
		$dom = new DOMDocument('1.0','UTF-8');

		$dom->preserveWhiteSpaces = false;
		 
		$dom->formatOutput = true;

		$root = $dom->createElement("chat");

		$root->setAttribute("tempo",$tempo);

		$dom->appendChild($root);

		$dir = __DIR__. "/../../xml";

		mkdir($dir."/".$conversa->id,0777);

		$dom->save($dir."/".$conversa->id."/".$conversa->id.".xml");

		$conversa->url = $dir."/".$conversa->id."/".$conversa->id.".xml";

		$conversa->save();

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

					$this->criarConversa($amigo->id,$usuario_id);

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

		return View::make('rmamigo')->withFoto($foto)->withUser($username)->withTitle("CAYANA");
		
		
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

		$conversas = $usuario->minhasConversas();

		

		$amigos = $usuario->euFizAmizadeCom()->get();
		$user = $usuario->fezAmizadeComigo()->get();
		$amizades = [];



		$usuario->time_request = date('Y-m-d H:i:s',time());

		$usuario->save();

		if(!empty($amigos)){
		
			foreach ($amigos as $amigo) {

				$conversa = Conversa::where("grupo","=",$usuario->username.",".$amigo->username)->first();

				$atualtime = date('U',strtotime('-15 seconds',time()));

				$timebd = date('U', strtotime($amigo->time_request));


				$amizades[$amigo->username]["nome"] = $amigo->nome;

				$amizades[$amigo->username]["conversa"] = $conversa->id;


				if( $atualtime >= $timebd )
				{
					$amizades[$amigo->username]["status"] = 0;
				}
				else
				{
					$amizades[$amigo->username]["status"] = $amigo->status;
				}
				
				$amizades[$amigo->username]["fotoPerfil"] = asset('img').'/profile/'.$amigo->profilePicture;

				$amizades[$amigo->username]["notify"] = DB::table("usuario_conversa")->where("conversa_id","=",$conversa->id)->where("usuario_id","=",$usuario_id)->first()->notification;

			}
		}

		if(!empty($user)){


			foreach ($user as $user) {

				$atualtime = date('U',strtotime('-15 seconds',time()));

				$timebd = date('U', strtotime($user->time_request));



				$amizades[$user->username]["nome"] = $user->nome;
				$amizades[$user->username]["chat"] = $user->nome;

				$conversa2 = Conversa::where("grupo","=",$user->username.",".$usuario->username)->first();



				$amizades[$user->username]["conversa"] = $conversa2->id;


				if( $atualtime >= $timebd )
				{
					$amizades[$user->username]["status"] = 0;
				}
				else
				{
					$amizades[$user->username]["status"] = $user->status;	
				}
				
				$amizades[$user->username]["fotoPerfil"] = asset('img').'/profile/'.$user->profilePicture;	

				

				$amizades[$user->username]["notify"] = DB::table("usuario_conversa")->where("conversa_id","=",$conversa2->id)->where("usuario_id","=",$usuario->id)->first()->notification;
			

			}
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
