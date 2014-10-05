<?php

class HomeController extends BaseController {

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

	public function getLogin()
	{
		return View::make('login')->with("pagina", "SignInUp");
	}

	public function getAbout()
	{
		return View::make('sobre')->with("pagina", "Sobre");
	}

	public function getSupport()
	{
		return View::make('suporte')->with("pagina", "Suporte");
	}


}
