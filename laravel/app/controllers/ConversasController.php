


<?php

class ConversasController extends BaseController {

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


	function getConversa($conversa = "CAYANA"){
		$usuario_id = Auth::id();

		$usuario = Usuario::find($usuario_id);

		if(!empty(Conversa::find($conversa))){
			$conversa = Conversa::find($conversa);

			$title = $conversa->grupo;

			$conversa_id = $conversa->id;

		}else{

			$title = "NÃO EXISTEM CONVERSAS AQUI";

			$conversa_id = "0";
		}

		$foto = $usuario->profilePicture;
		$username = $usuario->username;
				
		return View::make('conversa')->withFoto($foto)->withUser($username)->withTitle($title)->withConversa($conversa_id);
	}


	function add()
	{		
		$userId = Auth::id();
		$usuario = Usuario::find($userId);

		$nome = $usuario->username;

		$msg = Input::get('msg');

		$conversaId=Input::get("conversaId");


		//$conversaId = "2";
		//$msg = "Teste manual";

		$conversa=Conversa::find($conversaId);

		DB::table("usuario_conversa")->where("conversa_id","=",$conversaId)->where("usuario_id","!=",$userId)->update(array('notification' => 1));

		if (!empty($conversa)){

	 		$link=$conversa->url;

	 	}


	 	if($link != null){

			
	 		
		$xml = simplexml_load_file($link); //carrega o arquivo XML e retornando um Array


		$dir = __DIR__. "/../../xml";

		$root = $xml[0];

		$p1 = $root->addChild("".$nome."","".$msg."");

		$p1->addAttribute("data",date('Y-m-d',time()));

		$p1->addAttribute("hora",date('H:i:s',time()));

		


		file_put_contents($dir."/".$conversaId."/".$conversaId.".xml", $xml->asXML());
	}

}

	function le(){

		$conversaId=Input::get("conversaId");

		$dataAtual=Input::get("dataAtual");
		$horaAtual=Input::get("horaAtual");
		
		//$conversaId = 1;

		//$dataAtual = "0000-00-00";
		//$horaAtual = "00:00:00";


		$datahoraAtual = $dataAtual." ".$horaAtual; 




	 	$user_id=Auth::id();
	 	$user = Usuario::find($user_id);

	 	$conversa=Conversa::find($conversaId);


	 	DB::table("usuario_conversa")->where("conversa_id","=",$conversaId)->where("usuario_id","=",$user_id)->update(array('notification' => 0));

	 	if ($conversa!=null){

	 		$link=$conversa->url;

	 	}


	 	
	 	$saida = [];
	 	if(!empty($link)){

			
	 		
		$xml = simplexml_load_file($link); //carrega o arquivo XML e retornando um Array

		
		$i=0;

		
		//$amigos = $user->euFizAmizadeCom()->notification;
		//$usuario = $user->fezAmizadeComigo()->get();


						
			foreach($xml -> children() as $item){ //faz o loop nas tag com o nome "item"

				$hora = $item->attributes()->hora;
				$data = $item->attributes()->data;

				$datahora = $data." ".$hora;

				
				$pessoa = $item->getName();

				if (date('U',strtotime($datahoraAtual)) < date('U',strtotime($datahora)))
				
				{
					$saida[$i]["item"] = (String) $item;
					$saida[$i]["data"] = (String) $data;
					$saida[$i]["hora"] = (String) $hora;
					$saida[$i]["pessoa"] = $pessoa;

					if($pessoa == $user->username)
					{
						$saida[$i]["euColor"] = true;
					}
					else
					{
						$saida[$i]["euColor"] = false;
					}
					
					
				}


				$i++;

			    
			}
			
	 	}
	 
		
		

		$texto = json_encode($saida);

		echo $texto;
    }




}
