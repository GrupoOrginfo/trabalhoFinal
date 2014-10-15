<?php

class LoginController extends BaseController {

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
		
	
	
	public function postCadastro()
	{	
		$input = Input::all();

		$validator = Validator::make($input, 
			array(
				"username" => "required|unique:usuarios,username",
				"senha" => "required",
				"nome" => "required",
				"email" => "email|required"
			),
			array(
				"username.required"=> "insira seu nome de usuario",
				"username.unique"=> "Este nome não está disponível",
				"senha.required"=> "insira sua senha",
				"nome.required"=> "Por favor insira seu nome.",
				"email.email"=> "Você não inseriu um e-mail válido",
				"email.required"=> "Por favor insira um e-mail",
			)
		);

		


		if ($validator->passes())
		{
			$usuario = new Usuario;

			$status = false;
			$username = Input::get('username');

			$usuario->username = $username;
			$usuario->senha = Hash::make(Input::get('senha'));
			$usuario->nome = Input::get('nome');
			$usuario->email = Input::get('email');
			$usuario->cidade = Input::get('cidade');
			$usuario->status = $status;
			$usuario->profilePicture = "padrao.jpg";

			$usuario->save();

		}
		else
		{

			return Redirect::back()->withInput()->withErrors($validator->messages());
		
		}


		

		return Redirect::to('/')->withMsg("".$usuario->nome.", seu cadastro foi efetuado! ");


	}


	public function postLogin()
	{	
		$input = Input::all();

		$validator = Validator::make($input, 
			array(
				"usernamelogin" => "required",
				"senhalogin" => "required"
			),
			array(
				"usernamelogin.required"=> "insira seu nome de usuario",
				"senhalogin.required"=> "insira sua senha"
			)
		);

			$credentials = array(
				"username" => Input::get("usernamelogin"),
				"password" => Input::get("senhalogin")
				);

		
		


		if (Auth::attempt($credentials))
		{
			


			$usuario_id = Auth::id();
			$usuario = Usuario::find($usuario_id);
			$usuario->status = true;
			$usuario->save();

			$foto = $usuario->profilePicture;
			

			return Redirect::to('home')->withMsg("Você logou como ".Auth::user()->nome);

		}
		else
		{
			if ($validator->passes())
			{
				return Redirect::back()->withInput()->withLoginfail("Usuario ou senha incorretos");
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator->messages());	
			}
			
		
		}


		


	}


}
