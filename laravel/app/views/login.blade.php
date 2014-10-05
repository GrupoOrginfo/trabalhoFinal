@extends('templates.unlogged')

@section('cssAdicional')
	<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}">
@stop


@section('conteudo')

			
			
			<div id="formsLogin">
				<div id="login" class="col">
				<h3>Cadastre-se</h3>
					<form method="post" action="{{URL::to('/cadastro')}}">
						<input type="text" name="nome" placeholder="Nome" value="{{Input::old('nome')}}" ><br />
						@if($errors->has("nome"))
							<span class="errors">{{$errors->first("nome")}}</span><br />
						@endif
						<input type="text" name="username" placeholder="Username" value="{{Input::old('username')}}"><br />
						@if($errors->has("username"))
							<span class="errors">{{$errors->first("username")}}</span><br />
						@endif
						<input type="text" name="cidade" placeholder="Cidade" value="{{Input::old('cidade')}}"><br />

						<input type="text" name="email" placeholder="Email" value="{{Input::old('email')}}"><br />
						@if($errors->has("email"))
							<span class="errors">{{$errors->first("email")}}</span><br />
						@endif
						<input type="password" name="senha" placeholder="Senha" ><br />
						@if($errors->has("senha"))
							<span class="errors">{{$errors->first("senha")}}</span><br />
						@endif
						<input type="submit" value="Cadastrar"><br />
					</form>
				</div>
				<div class="col">
				<h3>Entre</h3>
				
					<form method="post" action="{{URL::to('/login')}}">
						
						<input type="text" name="usernamelogin" placeholder="Username" value="{{Input::old('usernamelogin')}}"><br />
						@if($errors->has("usernamelogin"))
							<span class="errors">{{$errors->first("usernamelogin")}}</span><br />
						@endif
						
						<input type="password" name="senhalogin" placeholder="Senha" ><br />
						@if($errors->has("senhalogin"))
							<span class="errors">{{$errors->first("senhalogin")}}</span><br />
						@endif
						<input type="submit" value="Entrar"><br />

						@if(Session::has("loginfail"))
							<div style="color:red">
								<br /><br />
								{{Session::get("loginfail")}}
							</div>
						@endif
					</form>
				</div>
			</div>
				
@stop