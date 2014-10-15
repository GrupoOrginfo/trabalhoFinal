@extends('templates.logged')

@section('cssAdicional')
	<link rel="stylesheet" type="text/css" href="{{asset('/css/home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}">
@stop


@section('conteudo')
	
			
			
			
			
			<div id="formsLogin">
				<div id="login" class="col">
				<h3>Alterar dados pessoais.</h3>
					<form method="post" enctype="multipart/form-data">
						
						<input type="text" name="nome" placeholder="Nome" value="{{Input::old('nome')}}" ><br />
						@if($errors->has("nome"))
							<span class="errors">{{$errors->first("nome")}}</span><br />
						@endif
						<input type="text" name="cidade" placeholder="Cidade" value="{{Input::old('cidade')}}"><br />

						<input type="text" name="email" placeholder="Email" value="{{Input::old('email')}}"><br />
						@if($errors->has("email"))
							<span class="errors">{{$errors->first("email")}}</span><br />
						@endif

						<input type="file" name="foto" placeholder="Foto de Perfil" ><br />
						@if($errors->has("foto"))
							<span class="errors">{{$errors->first("foto")}}</span><br />
						@endif

						<input type="password" name="senha" placeholder="Senha" ><br />
						@if($errors->has("senha"))
							<span class="errors">{{$errors->first("senha")}}</span><br />
						@endif
						
						<input type="submit" value="Alterar"><br />
					</form>
				</div>
				<div class="col">
				Altere os seus dados Pessoais como você achar melhor!
				<p>
					<a  href="{{URL::to('removeusuario')}}">Remover conta</a>
				</p>
				</div>
			</div>
				
@stop


@section('jsEspecificos')
	<script type="text/javascript" src="{{asset('/js/addamigo.js')}}"></script>
@stop