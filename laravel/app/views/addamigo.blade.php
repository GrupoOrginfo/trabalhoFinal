@extends('templates.logged')

@section('cssAdicional')
	<link rel="stylesheet" type="text/css" href="{{asset('/css/home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}">
@stop


@section('conteudo')
	
			
			
			
			
			<div id="formsLogin">
				<div id="login" class="col">
				<h3>Quem é seu amigo?</h3>
					<form method="post" action="{{URL::to('/addamigo')}}">
						
						<input type="text" name="username" placeholder="Username" value="{{Input::old('username')}}"><br />
												
						<input type="submit" value="Adicionar"><br />
					</form>
				</div>
				<div class="col">
				Digite o nome de usuário do amigo que você quer adicionar! =P
				</div>
			</div>
				
@stop


@section('jsEspecificos')
	<script type="text/javascript" src="{{asset('/js/addamigo.js')}}"></script>
@stop