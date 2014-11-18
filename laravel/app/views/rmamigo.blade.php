@extends('templates.logged')

@section('cssAdicional')
	<link rel="stylesheet" type="text/css" href="{{asset('/css/home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}">
@stop


@section('conteudo')
				
			
			<div id="formsLogin">
				<div id="login" class="col">
				<h3>Quem você deseja remover de sua lista?</h3>
					<form method="post">
						
						<input type="text" name="username" placeholder="Username" value="{{Input::old('username')}}"><br />
												
						<input type="submit" value="Remover"><br />
					</form>
				</div>
				<div class="col">
				Digite o nome de usuário da pessoa que você quer excluir da sua lista de amigos.
				</div>
			</div>
@stop


@section('jsEspecificos')
	<script type="text/javascript" src="{{asset('/js/addamigo.js')}}"></script>
@stop