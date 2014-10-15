@extends('templates.logged')

@section('cssAdicional')
	<link rel="stylesheet" type="text/css" href="{{asset('/css/home.css')}}">
@stop



@section('conteudo')
	<p>Para adicionar usuario, clique/toque no seu seu Username (acima) e escolha adicionar usuário (Avatar com um "+")</p>
	<p>Para iniciar uma conversa, clique/toque no nome do amigo ao qual deseja mandar mensagem (sidebar ao lado).</p>
@stop
